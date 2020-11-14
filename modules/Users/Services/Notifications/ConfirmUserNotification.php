<?php

namespace Modules\Users\Services\Notifications;

use Modules\Users\Entities\User;

class ConfirmUserNotification extends BaseEntityNotification
{

    public function __construct(User $user)
    {
        $this->event              = 'user_confirm';
        $this->entity             = $user;
        $this->is_urgent          = true;
        $this->is_sms             = true;
        $this->url                = "";
        $this->message_trans_key  = 'users::notifications.your_account_is_confirm';
        $this->message_trans_data = [];
    }
}