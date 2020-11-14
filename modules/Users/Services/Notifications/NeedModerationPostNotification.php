<?php

namespace Modules\Users\Services\Notifications;

use Modules\Posts\Entities\Post;

class NeedModerationPostNotification extends BaseEntityNotification
{

    public function __construct(Post $post)
    {
        $this->event              = 'post_need_moderation';
        $this->entity             = $post;
        $this->is_urgent          = true;
        $this->is_sms             = true;
        $this->message_trans_key  = 'users::notifications.need_moderation_post';
        $this->message_trans_data = ['title' => $post->title];
        $this->url                = $post->url;
    }

}