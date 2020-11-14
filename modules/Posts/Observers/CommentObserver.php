<?php

namespace Modules\Posts\Observers;

use Modules\Posts\Entities\Comment;
use Modules\Users\Services\Notifications\CreateCommentNotification;
use Modules\Users\Services\NotificationService;

class CommentObserver
{

    public function deleting(Comment $comment)
    {
        $comment->children()->delete();
        $comment->notifications()->delete();
    }


    public function created(Comment $comment)
    {
        app('notification',
            ['notification' => new CreateCommentNotification($comment)])->toBranch($comment->post->branch);
    }

}