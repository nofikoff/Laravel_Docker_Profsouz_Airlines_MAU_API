<?php

namespace Modules\Posts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Modules\Posts\Traits\BranchPermissionsScopeable;
use Modules\Users\Entities\Log;
use Modules\Users\Entities\Notification;
use Modules\Users\Entities\User;

class Post extends Model
{

    use SoftDeletes, BranchPermissionsScopeable;

    protected $fillable = [
        'title',
        'user_id',
        'branch_id',
        'type',
        'body',
        'status',
        'importance',
        'info_status_id',
        'is_commented',
        'sms_notify',
        'in_top',
    ];

    const STATUS_PUBLISHED     = 'published';
    const STATUS_PREMODERATION = 'premoderation';
    const STATUS_DRAFT         = 'draft';

    const TYPE_DEFAULT   = 'default';
    const TYPE_QUESTION  = 'question';
    const TYPE_FINN_HELP = 'finn_help';

    const PDF_DIR = 'public/finnhelp/';

    /**
     * Relationships
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function question()
    {
        return $this->hasOne(PostQuestion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachments()
    {
        return $this->hasMany(PostAttachment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function user_readers()
    {
        return $this->belongsToMany(User::class)->wherePivot('read', 1);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function info_status()
    {
        return $this->belongsTo(InfoStatus::class, 'info_status_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'entity');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function logs()
    {
        return $this->morphMany(Log::class, 'entity');
    }

    /**
     * @return array
     */
    public static function statuses()
    {
        return [
            self::STATUS_PUBLISHED,
            self::STATUS_PREMODERATION,
            self::STATUS_DRAFT
        ];
    }

    /**
     * @return array
     */
    public static function formStatuses()
    {
        return [
            self::STATUS_PUBLISHED,
            self::STATUS_DRAFT
        ];
    }

    /**
     * @return array
     */
    public static function types()
    {
        return [
            self::TYPE_DEFAULT,
            self::TYPE_QUESTION
        ];
    }

    /**
     * @return string
     */
    public function getUrlAttribute()
    {
        return route('posts.show', ['id' => $this->id]);
    }

    /**
     * @return bool
     */
    public function getIsPublishedAttribute()
    {
        return $this->status == self::STATUS_PUBLISHED;
    }

    public function getImagesAttribute()
    {
        return $this->attachments->filter(function($attachment) {
            $attachment->url = url(\Storage::url($attachment->file));
            return $attachment->type === PostAttachment::TYPE_IMAGE;
        })->all();
    }

    /**
     * SCOPES
     */

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeInTop($query)
    {
        return $query->orderBy('in_top', 'DESC');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeCommentsCount($query)
    {
        return $query->withCount('comments');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeType($query)
    {
        return request('post_type') ? $query->where('type', request('post_type')) : $query;
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopePublished($query)
    {
        return $query->where(function ($query) {

            if (\Auth::user()->is_editor()) {
                return $query->where('status', '<>', self::STATUS_DRAFT)->orWhere('user_id', \Auth::user()->id);
            }

            return $query->where('status', self::STATUS_PUBLISHED)
                ->orWhere('user_id', \Auth::user()->id);
        })->orderByDesc('created_at');
    }

    public function scopePremoderation($query)
    {
        return $query->where('status', self::STATUS_PREMODERATION)->orderByDesc('created_at');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeList($query)
    {
        return $query->with([
            'user',
            'question',
            'attachments',
            'info_status',
            'branch',
            'tags',
            'user_readers'
        ])->commentsCount()->inTop()->type();
    }

    /**
     * @param Builder $query
     * @param string $search
     * @return Builder
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            /** @var Builder $query */
            $query->where('title', 'like', '?')
                ->orWhere('body', 'like', '?')
                ->setBindings(['%'.$search.'%', '%'.$search.'%']);
        });
    }

    /**
     * @param Builder $query
     * @param bool $status
     * @return Builder mixed
     */
    public function scopeStatused($query, $status = false)
    {
        return ! $status ? $query : $query->where('status', $status);
    }

    /**
     * @return bool|string
     */
    public function getPDFAttribute()
    {
        if ($this->financial_info && $this->financial_info->getPdfContent()) {
            return route('posts.pdf', [$this->id]);
        }

        return false;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function financial_info()
    {
        return $this->hasOne(FinancialInfo::class);
    }
}
