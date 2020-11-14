<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Posts\Entities\Branch;
use Modules\Users\Services\UserBranchSetting;

class Group extends Model
{

    use SoftDeletes;

    const DEFAULT_ID        = 1;
    const ADMINISTRATION_ID = 2;
    const COMMITTEE_ID      = 3;

    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function branches()
    {
        return $this->belongsToMany(Branch::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * @param $branch
     * @param $permission
     */
    public function attachBranchPermission($branch, $permission)
    {
        if ($branch instanceof Branch) {
            $branch = $branch->id;
        }

        if ($permission instanceof Permission) {
            $permission = $permission->id;
        }

        \DB::table('branch_group')->insert([
            'group_id'      => $this->id,
            'branch_id'     => $branch,
            'permission_id' => $permission
        ]);

        Branch::find($branch)->touchChildren();

        app('user_branch_setting')->attachByGroupUsers($this, $branch);
    }

    /**
     * @param UserBranchSetting $user_setting
     * @param $branch
     * @param $permission
     */
    public function detachBranchPermission($branch, $permission)
    {
        if ($branch instanceof Branch) {
            $branch = $branch->id;
        }

        if ($permission instanceof Permission) {
            $permission = $permission->id;
        }

        \DB::table('branch_group')
            ->where('branch_id', $branch)
            ->where('group_id', $this->id)
            ->where('permission_id', $permission)
            ->delete();

        Branch::find($branch)->touchChildren();

        app('user_branch_setting')->detachByGroupUsers($this, $branch);
    }

    /**
     * @param $branch
     * @param $permission
     * @return bool
     */
    public function hasBranchPermission($branch, $permission)
    {
        if ($branch instanceof Branch) {
            $branch = $branch->id;
        }

        if ($permission instanceof Permission) {
            $permission = $permission->id;
        }

        return (bool)\DB::table('branch_group')
            ->where('branch_id', $branch)
            ->where('group_id', $this->id)
            ->where('permission_id', $permission)
            ->count();
    }
}
