<?php

namespace Modules\Users\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Users\Entities\User;
use Modules\Users\Services\Notifications\NotificationInterface;

class NotificationBroadcast implements ShouldBroadcast
{

    use SerializesModels;

    public $user;
    public $message;
    public $url;
    public $type;

    /**
     * NotificationBroadcast constructor.
     *
     * @param User $user
     * @param NotificationInterface $notification
     */
    public function __construct(User $user, NotificationInterface $notification)
    {
        $this->user    = $user;
        $this->message = $notification->getText($user->locale);
        $this->url     = $notification->getUrl();
        $this->type    = $notification->getType();
    }

    /**
     * @return Channel
     */
    public function broadcastOn()
    {
        return new Channel('user_'.$this->user->id);
    }
}
