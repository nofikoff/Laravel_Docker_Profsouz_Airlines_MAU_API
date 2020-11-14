<?php

namespace Modules\Users\Services\Notifications;

use Modules\Posts\Entities\Post;

class SendToPremoderatePostNotification extends BaseEntityNotification
{

    public function __construct(Post $post)
    {
        $this->event              = 'post_send_to_premoderation';
        $this->entity             = $post;
        $this->is_urgent          = true;
        $this->message_trans_key  = 'users::notifications.premoderate_post';
        $this->message_trans_data = [];
        $this->url                = '#';
    }

}