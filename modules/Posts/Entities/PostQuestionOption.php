<?php

namespace Modules\Posts\Entities;

use Illuminate\Database\Eloquent\Model;

class PostQuestionOption extends Model
{

    protected $fillable = ['name'];

    public $timestamps = false;

    public function question()
    {
        return $this->belongsTo(PostQuestion::class, 'post_question_id', 'id')->with('options');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes()
    {
        return $this->hasMany(PostQuestionVote::class);
    }

//    public function scopeWinner($query, $post_id, $option_id)
//    {
//        return $query->where('id', $option_id)->where('post_question_id', $post_id);
//    }

}
