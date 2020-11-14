<?php

namespace Modules\Posts\Entities;

use Illuminate\Database\Eloquent\Model;

class PostQuestionVote extends Model
{

    protected $fillable = ['user_id', 'post_question_option_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function option()
    {
        return $this->belongsTo(PostQuestionOption::class, 'post_question_option_id');
    }
}
