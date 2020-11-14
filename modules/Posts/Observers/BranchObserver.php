<?php

namespace Modules\Posts\Observers;

use Modules\Posts\Entities\Branch;
use Modules\Users\Entities\Permission;

class BranchObserver
{

    public function saving(Branch $branch)
    {
        if ($branch->parent_id && !$branch->type) {
            $branch->type = $branch->parent->type;
        }

    }

    public function saved(Branch $branch)
    {
        if ($branch->is_inherit && $branch->parent_id) {
            $branch->groups()->sync([]);
            foreach ($branch->parent->groups as $group) {
                $permission = Permission::find($group->pivot->permission_id);
                $group->attachBranchPermission($branch, $permission);
            }
        }

        foreach ($branch->children as $child) {
            $child->touch();
        }
    }

}