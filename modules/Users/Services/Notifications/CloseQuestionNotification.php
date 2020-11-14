<?php

namespace Modules\Users\Services\Notifications;

use Modules\Posts\Entities\PostQuestion;

class CloseQuestionNotification extends BaseEntityNotification
{

    public function __construct(PostQuestion $question)
    {
        $this->event              = 'question_close';
        $this->entity             = $question;
        $this->is_urgent          = true;
        $this->is_sms             = true;
        $this->message_trans_key  = 'users::notifications.close_question';
        $this->message_trans_data = ['title' => optional($question->post)->title];
        $this->url                = $question->post->url;
    }

}