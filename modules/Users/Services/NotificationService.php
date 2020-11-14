<?php

namespace Modules\Users\Services;

use Illuminate\Support\Collection;
use Modules\Posts\Entities\Branch;
use Modules\Posts\Entities\Comment;
use Modules\Posts\Entities\Post;
use Modules\Users\Entities\Group;
use Modules\Users\Entities\Permission;
use Modules\Users\Entities\User;
use Modules\Users\Events\NotificationBroadcast;
use Modules\Posts\Entities\PostQuestion;
use Modules\Documents\Entities\Document;
use Modules\Users\Services\Notifications\NotificationInterface;

/**
 * Class NotificationService
 * @package Modules\Users\Services
 */
class NotificationService
{

    /**
     * @var NotificationInterface
     */
    private $notification;

    /**
     * NotificationService constructor.
     *
     * @param NotificationInterface $notification
     */
    public function __construct(NotificationInterface $notification)
    {
        $this->notification = $notification;
    }

    /**
     * @param User $user
     */
    public function toUser(User $user)
    {
        $this->notyUser($user);
    }

    /**
     * @param Collection $users
     */
    public function toUsers(Collection $users)
    {
        foreach ($users as $user) {
            $this->toUser($user);
        }
    }

    /**
     * @param Branch $branch
     * @param bool $force
     */
    public function toBranch(Branch $branch, $force = false)
    {
        $users = $force ?
            $this->getForceBranchUsers($branch->id) :
            $branch->user_settings()->wherePivot('key', 'notification')->get();

        $this->toUsers($users);
    }

    public function toGroup(Group $group)
    {
        $this->toUsers($group->users);
    }

    public function toAdministrations()
    {
        $group = Group::find(Group::ADMINISTRATION_ID);

        if ($group) {
            $this->toGroup($group);
        }
    }

    public function toCommittee()
    {
        $group = Group::find(Group::COMMITTEE_ID);

        if ($group) {
            $this->toGroup($group);
        }
    }

    public function toBranchModerators(Branch $branch)
    {
        $permission = Permission::where('name', 'full')->first();

        $groups_id = $branch->groups()->wherePivot('permission_id', $permission->id)->pluck('group_id');

        $users = User::whereHas('groups', function ($query) use ($groups_id) {
            return $query->whereIn('group_id', $groups_id);
        })->get();

        $this->toUsers($users);
    }

    /**
     * @param User $user
     * @return bool
     */
    private function notyUser(User $user)
    {
        if (in_array($user->id, $this->notification->getExceptedUserIds())) {
            return false;
        }

        $read = false;

        if ($this->isOnline($user) && $this->notification->isUrgent()) {
            broadcast(new NotificationBroadcast($user, $this->notification));
            $read = true;
        }

        if ($this->notification->isSms()) {
            $this->sendSms($user);
        }

        $this->notification->createNotification($user, $read);

    }

    /**
     * @param User $user
     */
    private function sendSms(User $user)
    {
        if (env('SMS_LOGIN', false) || env('SMS_KEY', false)) {
            app('sms.provider')->send('+'.$user->phone, $this->notification->getText($user->locale));
        }
    }


    /**
     * @param User $user
     * @return bool
     */
    private function isOnline(User $user)
    {
        $online_channels = app('centrifuge')->channels();
        $channel         = 'user_'.$user->id;

        return isset($online_channels['body']['data']) && in_array($channel, $online_channels['body']['data']);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|Collection|static[]
     */
    private function getForceBranchUsers()
    {
        $user_ids = \DB::table('group_user')
            ->join('branch_group', 'branch_group.group_id', '=', 'group_user.group_id')
            ->get()->pluck('user_id');

        return User::whereIn('id', $user_ids)->get();
    }
}