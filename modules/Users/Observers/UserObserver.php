<?php

namespace Modules\Users\Observers;

use Modules\Users\Entities\Group;
use Modules\Users\Entities\User;
use Modules\Users\Services\Notifications\ConfirmUserNotification;
use Modules\Users\Services\Notifications\RegisterUserNotification;
use Modules\Users\Services\UserBranchSetting;

class UserObserver
{
    public function created(User $user)
    {
        $user->groups()->attach(1);

        app('user_branch_setting')->attachByGroupBranches(Group::find(Group::DEFAULT_ID), $user->id);
        app('notification', ['notification' => new RegisterUserNotification($user)])->toAdministrations();
    }

    public function saving(User $user)
    {
        if($user->isDirty('is_confirmed') && $user->is_confirmed) {
            app('notification', ['notification' => new ConfirmUserNotification($user)])->toUser($user);
        }
    }
}