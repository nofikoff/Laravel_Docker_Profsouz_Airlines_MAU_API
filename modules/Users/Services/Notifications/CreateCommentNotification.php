<?php

namespace Modules\Users\Services\Notifications;

use Modules\Posts\Entities\Comment;

class CreateCommentNotification extends BaseEntityNotification
{

    public function __construct(Comment $comment)
    {
        $this->event              = 'comment_created';
        $this->entity             = $comment;
        $this->is_urgent          = true;
        $this->message_trans_key  = 'users::notifications.new_comment';
        $this->message_trans_data = ['message' => $comment->text];
        $this->url                = $comment->post->url;
        $this->excepted_user_ids  = [$comment->user_id];
    }

}