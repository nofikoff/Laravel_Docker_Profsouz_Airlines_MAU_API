<?php

namespace Modules\Users\Services\Notifications;

use Illuminate\Database\Eloquent\Model;
use Modules\Users\Entities\User;

class RegisterUserNotification extends BaseEntityNotification
{

    public function __construct(User $user)
    {
        $this->event              = 'user_register';
        $this->entity             = $user;
        $this->is_urgent          = true;
        $this->is_sms             = true;
        $this->message_trans_key  = 'users::notifications.register_user';
        $this->message_trans_data = ['name' => $user->full_name];
        $this->url                = route('profile', ['id' => $user->id]);
    }

    /**
     * @param User $user
     * @param int $read
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function createNotification(User $user, $read = 0): ?Model
    {
        return $this->entity->morph_notifications()->create([
            'is_urgent' => $this->is_urgent,
            'user_id'   => $user->id,
            'read'      => $read,
            'event'     => $this->getEventType()
        ]);
    }

}