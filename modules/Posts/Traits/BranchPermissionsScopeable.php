<?php

namespace Modules\Posts\Traits;

use Illuminate\Database\Eloquent\Builder;
use Modules\Users\Entities\User;

trait BranchPermissionsScopeable
{

    /**
     * @param Builder $query
     * @param User|null $user
     * @return Builder
     */
    public function scopeUserReadBranches($query, $user = null)
    {
        $user = is_null($user) ? \Auth::user() : $user;

        return $query->whereIn('branch_id', $user->read_branch_ids);
    }

    /**
     * @param Builder $query
     * @param User|null $user
     * @return Builder
     */
    public function scopeUserAccessBranches($query, $user = null)
    {
        $user = is_null($user) ? \Auth::user() : $user;

        return $query->whereIn('branch_id', $user->access_branch_ids);
    }
}