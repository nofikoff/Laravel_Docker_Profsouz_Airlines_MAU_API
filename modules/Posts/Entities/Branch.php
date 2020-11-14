<?php

namespace Modules\Posts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Modules\Users\Entities\Group;
use Modules\Users\Entities\Permission;
use Modules\Users\Entities\User;
use Modules\Documents\Entities\Document;

class Branch extends Model
{

    use SoftDeletes;

    const TYPE_POST      = 'post';
    const TYPE_DOCUMENT  = 'document';
    const TYPE_FINN_HELP = 'finn_help';

    const TYPES = [
        self::TYPE_POST,
        self::TYPE_DOCUMENT,
        //self::TYPE_FINN_HELP
    ];

    protected $fillable = ['name', 'parent_id', 'description', 'type', 'is_inherit'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function user_settings()
    {
        return $this->belongsToMany(User::class, 'branch_user_setting')->withPivot(['key', 'value']);
    }

    public function getAvailableTypesAttribute()
    {
        return $this->type == self::TYPE_DOCUMENT ? [self::TYPE_DOCUMENT] : [self::TYPE_POST];
    }

    /**
     * @return bool
     */
    public function getIsFinnHelpAttribute()
    {
        return $this->type == self::TYPE_FINN_HELP;
    }

    /**
     * @param $value
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name']  = $value;
        $this->attributes['alias'] = str_slug($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class)->withPivot('permission_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * @param Builder $query
     * @param User|null $user
     * @return Builder
     */
    public function scopeUserRead($query, $user = null)
    {
        $user = is_null($user) ? \Auth::user() : $user;

        return $query->whereIn('id', $user->available_branch_ids);
    }

    /**
     * @param Builder $query
     * @param User|null $user
     * @return Builder
     */
    public function scopeUserAccess($query, $user = null)
    {
        $user = is_null($user) ? \Auth::user() : $user;

        return $query->whereIn('id', $user->access_branch_ids);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeDocumentable($query)
    {
        return $query->where('type', self::TYPE_DOCUMENT);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopePostable($query)
    {
        return $query->whereIn('type', [self::TYPE_POST]);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeRoot($query)
    {
        return $query->where('parent_id', 0);
    }

    public function touchChildren()
    {
        foreach ($this->children as $child) {
            $child->touch();
        }
    }

    /**
     * @return Model|Branch|null|object
     */
    public static function getDefaultFinnHelp()
    {
        return Branch::where('type', Branch::TYPE_FINN_HELP)->first();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getUserIdsAttribute()
    {
        return \DB::table('group_user')
            ->join('branch_group', 'branch_group.group_id', '=', 'group_user.group_id')
            ->where('branch_group.branch_id', $this->id)->get()
            ->unique('user_id')->pluck('user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|User[]
     */
    public function getUsersAttribute()
    {
        return User::whereIn('id', $this->user_ids)->get();
    }
}
