<?php

namespace Modules\Users\Services\Notifications;

use Modules\Posts\Entities\PostQuestion;

class SetWinnerQuestionNotification extends BaseEntityNotification
{

    public function __construct(PostQuestion $question)
    {

        $this->event              = 'question_set_winner';
        $this->entity             = $question;
        $this->is_urgent          = true;
        $this->message_trans_key  = 'users::notifications.poll_fi';
        $this->message_trans_data = ['title' => $question->post ? $question->post->title : ''];
        $this->url                = $question->post ? $question->post->url : '#';
    }

}