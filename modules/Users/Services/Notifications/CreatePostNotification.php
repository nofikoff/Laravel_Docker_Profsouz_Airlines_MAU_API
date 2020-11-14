<?php
/**
 * Created by PhpStorm.
 * User: theardent
 * Date: 07.04.18
 * Time: 11:15
 */

namespace Modules\Users\Services\Notifications;

use Modules\Posts\Entities\Post;

class CreatePostNotification extends BaseEntityNotification
{

    public function __construct(Post $post)
    {
        $this->event              = 'post_created';
        $this->entity             = $post;
        $this->is_sms             = (boolean)$post->sms_notify;
        $this->is_urgent          = $post->importance;
        $this->message_trans_key  = 'users::notifications.new_post';
        $this->message_trans_data = ['title' => $post->title];
        $this->url                = $post->url;
        $this->excepted_user_ids  = [$post->user_id];
    }

}