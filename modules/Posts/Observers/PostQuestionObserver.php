<?php

namespace Modules\Posts\Observers;

use Modules\Posts\Entities\Post;
use Modules\Posts\Entities\PostQuestion;
use Modules\Users\Services\Notifications\CloseQuestionNotification;
use Modules\Users\Services\Notifications\SetWinnerQuestionNotification;

class PostQuestionObserver
{
    public function saved(PostQuestion $question)
    {
        if ($question->isDirty('winner_id') && $question->post->status == Post::STATUS_PUBLISHED) {
            app('notification',
                ['notification' => new SetWinnerQuestionNotification($question)])->toBranch($question->post->branch);
        }

        if ($question->isDirty('closed') && $question->closed  && $question->post->status == Post::STATUS_PUBLISHED) {
            app('notification',
                ['notification' => new CloseQuestionNotification($question)])->toCommittee();
        }
    }
}