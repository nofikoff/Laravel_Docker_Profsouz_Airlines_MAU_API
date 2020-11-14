<?php

namespace Modules\Users\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Users\Entities\Group;
use Modules\Users\Entities\Permission;
use Modules\Users\Entities\User;

class GroupPolicy
{

    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Group $group
     * @return bool
     */
    public function posting(User $user, Group $group)
    {
        if ($user->is_editor()) {
            return true;
        }

        $permissions = Permission::whereIn('name', ['full', 'store'])->get();

        return (bool)\DB::table('group_user')
            ->join('branch_group', 'branch_group.group_id', '=', 'group_user.group_id')
            ->whereIn('branch_group.permission_id', $permissions->pluck('id'))
            ->where('group_user.user_id', $user->id)
            ->count();
    }
}
