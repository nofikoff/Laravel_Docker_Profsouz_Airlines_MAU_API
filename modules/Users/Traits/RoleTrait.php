<?php
/**
 * Created by PhpStorm.
 * User: theardent
 * Date: 19.03.18
 * Time: 12:26
 */

namespace Modules\Users\Traits;

use Modules\Posts\Entities\Branch;
use Modules\Users\Entities\Group;
use Modules\Users\Entities\Permission;
use Modules\Users\Entities\Role;

trait RoleTrait
{

    /**
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->roles->contains($role);
    }

    /**
     * @param $group
     * @return mixed
     */
    public function hasGroup($group)
    {
        return $this->groups->contains($group);
    }

    /**
     * @param $branch
     * @return bool
     */
    public function hasBranch($branch)
    {
        if ($branch instanceof Branch) {
            $branch = $branch->id;
        }

        return (bool)\DB::table('group_user')
            ->join('branch_group', 'branch_group.group_id', '=', 'group_user.group_id')
            ->where('branch_group.branch_id', $branch)
            ->where('group_user.user_id', $this->id)
            ->count();
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

        return (bool)\DB::table('group_user')
            ->join('branch_group', 'branch_group.group_id', '=', 'group_user.group_id')
            ->where('branch_group.branch_id', $branch)
            ->where('branch_group.permission_id', $permission)
            ->where('group_user.user_id', $this->id)
            ->count();
    }
}