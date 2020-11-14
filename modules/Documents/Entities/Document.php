<?php

namespace Modules\Documents\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Posts\Traits\BranchPermissionsScopeable;
use Modules\Users\Entities\Log;
use Modules\Users\Entities\User;
use Modules\Posts\Entities\Tag;
use Modules\Posts\Entities\Branch;
use Modules\Users\Entities\Notification;

class Document extends Model
{

    use SoftDeletes;
    use BranchPermissionsScopeable;

    protected $fillable = [
        'branch_id',
        'user_id',
        'file',
        'url',
        'size',
        'description',
        'status',
        'importance',
        'is_notify',
    ];

    const STORAGE_PATH = 'upload/documents';

    const STATUS_PUBLISHED     = 'published';
    const STATUS_PREMODERATION = 'premoderation';
    const STATUS_DRAFT         = 'draft';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'document_tags');
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
            self::STATUS_DRAFT,
        ];
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeList($query)
    {
        return $query->with(['user', 'branch', 'tags']);
    }

    /**
     * @param Builder $query
     * @param string $search
     * @return Builder
     */
    public function scopeSearch($query, $search)
    {
        $query->when($search, function ($query) use ($search) {
            $query->where(function ($query) use ($search) {
                /** @var \Illuminate\Database\Query\Builder $query */
                $query->where('file', 'like', '?')
                    ->orWhere('description', 'like', '?')
                    ->setBindings(['%'.$search.'%', '%'.$search.'%']);
            });
        });
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
            return $query->where('status', self::STATUS_PUBLISHED)->orWhere('user_id', \Auth::user()->id);
        })->orderByDesc('id');
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopePremoderation($query)
    {
        return $query->where('status', self::STATUS_PREMODERATION)->orderByDesc('created_at');
    }

    /**
     * @param $query
     * @return string
     */
    public function getDownloadUrlAttribute($query)
    {
        return route('documents.download', $this->id);
    }
}
