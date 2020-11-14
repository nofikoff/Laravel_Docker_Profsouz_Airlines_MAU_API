<?php

namespace Modules\Users\Services;

use Modules\Users\Entities\Group;
use Modules\Users\Entities\Permission;

class UserBranchSetting
{
    protected $permissions;

    public function __construct()
    {
        $this->permissions = Permission::whereIn('name', ['notification', 'full'])->get();
    }

    public function attachByGroupUsers(Group $group, $branch_id)
    {
        $has = false;
        foreach ($this->permissions as $permission){
            if($group->hasBranchPermission($branch_id, $permission)){
                $has = true;
            }
        }
        if(!$has) return false;

        $insert_data = collect();

        foreach ($group->users as $user) {
            if($user->branch_settings->contains($branch_id)) continue;
            $insert_data->push(collect([
                'user_id'   => $user->id,
                'branch_id' => $branch_id,
                'key'       => 'notification',
                'value'     => 1
            ]));
        }

        \DB::table('branch_user_setting')->insert($insert_data->toArray());
    }

    public function detachByGroupUsers(Group $group, $branch_id)
    {
        $user_ids = $group->users()->pluck('user_id');

        \DB::table('branch_user_setting')
            ->whereIn('user_id', $user_ids)
            ->where('branch_id', $branch_id)
            ->delete();
    }

    public function attachByGroupBranches(Group $group, $user_id)
    {
        $branches = $group->branches()->wherePivotIn('permission_id', $this->permissions->pluck('id'))->get();

        $insert_data = collect();

        foreach ($branches as $branch) {
            if($branch->user_settings->contains($user_id)) continue;
            $insert_data->push(collect([
                'user_id'   => $user_id,
                'branch_id' => $branch->id,
                'key'       => 'notification',
                'value'     => 1
            ]));
        }

        \DB::table('branch_user_setting')->insert($insert_data->toArray());
    }


    public function detachByGroupBranches(Group $group, $user_id)
    {
        $branches_id = $group->branches()->wherePivotIn('permission_id', $this->permissions->pluck('id'))->pluck('branch_id');

        \DB::table('branch_user_setting')
            ->where('user_id', $user_id)
            ->whereIn('branch_id', $branches_id)
            ->delete();
    }

}