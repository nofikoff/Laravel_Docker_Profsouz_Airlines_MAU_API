<?php

namespace Modules\Users\Repositories;

use Modules\Posts\Entities\Branch;
use Modules\Users\Entities\User;

class SettingNotificationRepository
{

    /**
     * @param User $user
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|static|static[]
     */
    public function getBranches(User $user) {
        $branch_settings = $user->branch_settings()->wherePivot('key', 'notification')->get();
        $branches        = Branch::whereIn('id', $user->available_branch_ids)->get();
        $branches        = $branches->merge($branch_settings);

        $notify_branch_ids = $user->notify_branch_ids;

        foreach ($branches as $branch) {
            $branch->access_notify = $notify_branch_ids->contains($branch->id);
            $branch->follow  = !is_null(optional($branch->pivot)->key);
        }

        return $branches;
    }


    public function branchFollow(User $user, $branch_id, $urgent) {
        $user->branch_settings()->syncWithoutDetaching([
            $branch_id => [
                'key'   => 'notification',
                'value' => $urgent
            ]
        ]);
    }

    public function branchUnfollow(User $user, $branch_id) {
        if ($user->branch_settings->contains($branch_id)) {
            $user->branch_settings()->detach($branch_id);
        }
    }

}