<?php

namespace Modules\Users\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Posts\Entities\PostQuestion;
use Modules\Users\Entities\User;

class PostQuestionPolicy
{

    use HandlesAuthorization;

    /**
     * @param User $user
     * @param PostQuestion $question
     * @return bool
     */
    public function set_winner(User $user, PostQuestion $question)
    {
        return ($user->is_editor() || $question->post->user_id == $user->id) && ! $question->winner_id
            && ($question->is_expired || $question->closed);
    }
}
