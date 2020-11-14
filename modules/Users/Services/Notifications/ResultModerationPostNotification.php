<?php

namespace Modules\Users\Services\Notifications;

use Modules\Posts\Entities\Post;

class ResultModerationPostNotification extends BaseEntityNotification
{

    public function __construct(Post $post)
    {
        $this->event              = 'post_result_moderation';
        $this->entity             = $post;
        $this->is_urgent          = true;
        $this->is_sms             = true;
        $this->url                = $post->url;
        $this->message_trans_key  = $post->status == Post::STATUS_PUBLISHED ?
            'users::notifications.success_moderation_post' :
            'users::notifications.fail_moderation_post';
        $this->message_trans_data = ['title' => $post->title];

    }

    public function getType(): string
    {
        return $this->entity->status == Post::STATUS_PUBLISHED ? 'success' : 'error';
    }

}