<?php

namespace Modules\Users\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Passport\HasApiTokens;
use Modules\Posts\Entities\Branch;
use Modules\Posts\Entities\Comment;
use Modules\Posts\Entities\Post;
use Modules\Documents\Entities\Document;
use Modules\Posts\Entities\SystemPost;
use Modules\Users\Traits\RoleTrait;

/**
 * Class User
 * @package Modules\Users\Entities
 */
class User extends Authenticatable
{

    use RoleTrait, HasApiTokens, SoftDeletes;

    const IS_CONFIRMED     = 1;
    const IS_NOT_CONFIRMED = 0;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'password',
        'avatar',
        'position',
        'image',
        'birthday',
        'is_confirmed',
        'locale'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * This mutator automatically hashes the password.
     *
     * @var string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make($value);
    }

    /**
     * @param $value
     */
    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = self::cropPhone($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public static function cropPhone($value)
    {
        return str_replace(['+', '(', ')', ' ', '-'], '', $value);
    }

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
    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function morph_notifications()
    {
        return $this->morphMany(Notification::class, 'entity');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return $this
     */
    public function branch_settings()
    {
        return $this->belongsToMany(Branch::class, 'branch_user_setting')->withPivot(['key', 'value']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function system_posts()
    {
        return $this->hasMany(SystemPost::class)->latest();
    }

    /**
     * @return string
     */
    public function getAvatarAttribute()
    {
        if ($this->img) {
            return \Storage::url($this->img);
        }

        return asset('avatar/default-user-img.jpg');
    }

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    /**
     * UPDATED
     *
     * @return Collection
     */
    public function getAvailableBranchIdsAttribute()
    {
        return $this->is_editor() ? Branch::all()->pluck('id') : \DB::table('group_user')
            ->join('branch_group', 'branch_group.group_id', '=', 'group_user.group_id')
            ->where('group_user.user_id', $this->id)->get()
            ->unique('branch_id')->pluck('branch_id');
    }

    /**
     * UPDATED
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAccessBranchIdsAttribute()
    {
        return $this->getBranchIdsByPermissions(['full', 'store']);
    }

    /**
     * @return Collection|User
     */
    public function getFullAccessBranchIdsAttribute()
    {
        return $this->getBranchIdsByPermissions(['full']);
    }

    /**
     * @return Collection|static
     */
    public function getNotifyBranchIdsAttribute()
    {
        return $this->getBranchIdsByPermissions(['notification', 'full']);
    }

    /**
     * @return Collection|User
     */
    public function getReadBranchIdsAttribute()
    {
        return $this->getBranchIdsByPermissions(['readonly', 'full']);
    }

    /**
     * @return mixed|null|string
     */
    public function getShowBirthdayAttribute()
    {
        return $this->birthday ? Carbon::parse($this->birthday)->format('d-m-Y') : $this->birthday;
    }

    /**
     * @param $permission_names
     * @return Collection|static
     */
    public function getBranchIdsByPermissions($permission_names)
    {
        $permissions = Permission::whereIn('name', $permission_names)->get();

        return $this->is_editor() ? Branch::all()->pluck('id') : \DB::table('group_user')
            ->join('branch_group', 'branch_group.group_id', '=', 'group_user.group_id')
            ->whereIn('branch_group.permission_id', $permissions->pluck('id'))
            ->where('group_user.user_id', $this->id)
            ->get()->pluck('branch_id');
    }

    /**
     * @return mixed
     */
    public function getNotReadNotificationsCountAttribute()
    {
        return $this->notifications()->noneRead()->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @return BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    /**
     * @param $query
     * @param $search
     * @return $this|Builder
     */
    public function scopeSearch($query, $search)
    {
        /** @var Builder $query */
        $query->when($search, function ($q) use ($search) {
            $search = '%'.$search.'%';
            $q->where(function ($q) use ($search) {
                /** @var Builder $q */
                $q->where('first_name', 'like', $search)
                    ->orWhere('last_name', 'like', $search)
                    ->orWhere('position', 'like', $search)
                    ->orWhere('phone', 'like', $search);
            });
        });
    }

    /**
     * @param Post $post
     * @return bool
     */
    public function canEditedPost(Post $post)
    {
        if ($this->is_editor()) {
            return true;
        }

        return $post->user_id == $this->id && $this->hasAccessToBranchId($post->branch_id);
    }

    /**
     * UPDATED
     *
     * @param $branch_id
     * @return bool
     */
    public function hasAccessToBranchId($branch_id)
    {
        if ($this->is_editor()) {
            return true;
        }

        $permissions = Permission::whereIn('name', ['full', 'store'])->get();

        return (bool)\DB::table('group_user')
            ->join('branch_group', 'branch_group.group_id', '=', 'group_user.group_id')
            ->where('branch_group.branch_id', $branch_id)
            ->whereIn('branch_group.permission_id', $permissions->pluck('id'))
            ->where('group_user.user_id', $this->id)
            ->count();
    }

    /**
     * @return bool
     */
    public function is_moder()
    {
        return $this->hasRole(Role::where('name', 'moder')->first());
    }

    /**
     * @return bool
     */
    public function is_admin()
    {
        return $this->hasRole(Role::where('name', 'admin')->first());
    }

    /**
     * @return bool
     */
    public function is_editor()
    {
        return $this->is_admin() || $this->is_moder();
    }

    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->phone;
    }

    /**
     * @param string $token
     * @return mixed|\Psr\Http\Message\ResponseInterface|void
     */
    public function sendPasswordResetNotification($token)
    {
        return app('sms.provider')->send('+'.$this->phone, 'PIN код: '.$token);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeIsConfirmed($query)
    {
        return $query->where('is_confirmed', self::IS_CONFIRMED);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeIsNotConfirmed($query)
    {
        return $query->where('is_confirmed', self::IS_NOT_CONFIRMED);
    }

    /**
     * @param $phone
     * @return \Illuminate\Database\Eloquent\Model|User|null|object
     */
    public function findForPassport($phone)
    {
        return $this->where('phone', $phone)->first();
    }
}