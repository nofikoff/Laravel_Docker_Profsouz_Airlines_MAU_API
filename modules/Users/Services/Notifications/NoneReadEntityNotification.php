<?php

namespace Modules\Users\Services\Notifications;

use Illuminate\Database\Eloquent\Model;
use Modules\Users\Entities\Notification;
use Modules\Users\Entities\User;

class NoneReadEntityNotification extends BaseEntityNotification
{

    /**
     * CreatePostNotification constructor.
     * @param $posts_count
     * @param $documents_count
     */
    public function __construct($posts_count, $documents_count)
    {
        $this->event              = 'noneread_entity';
        $this->entity             = null;
        $this->is_urgent          = true;
        $this->message_trans_key  = 'users::notifications.noneread_entity';
        $this->message_trans_data = compact('posts_count', 'documents_count');
        $this->url                = route('user.notifications.not-read');
    }

    /**
     * @param User $user
     * @param int $read
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function createNotification(User $user, $read = 0): ?Model
    {
        return Notification::create([
            'user_id'   => $user->id,
            'read'      => $read,
            'is_urgent' => $this->is_urgent,
            'event'     => $this->getEventType()
        ]);
    }

}