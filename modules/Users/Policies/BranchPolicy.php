<?php

namespace Modules\Users\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Posts\Entities\Branch;
use Modules\Users\Entities\Permission;
use Modules\Users\Entities\User;

class BranchPolicy
{

    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Branch $branch
     * @return bool
     */
    public function posting(User $user, Branch $branch)
    {
        return $user->hasAccessToBranchId($branch->id);
    }

    /**
     * @param User $user
     * @param Branch $branch
     * @return bool
     */
    public function publishing(User $user, Branch $branch)
    {
        return $user->hasBranchPermission($branch, Permission::where('name', 'full')->first()) || $user->is_editor();
    }
}
