<?php

namespace Modules\Posts\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Users\Entities\Notification;
use Modules\Users\Entities\User;

class PostQuestion extends Model
{

    use SoftDeletes;

    protected $fillable = ['winner_id', 'expiration_at', 'closed', 'default_option_id'];

    protected $dates = ['expiration_at'];

    /**
     * Relationships
     */

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options()
    {
        return $this->hasMany(PostQuestionOption::class)->withCount('votes');
    }

    public function winner()
    {
        return $this->belongsTo(PostQuestionOption::class, 'winner_id', 'id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes()
    {
        return $this->hasMany(PostQuestionVote::class);
    }

    public function default_option()
    {
        return $this->belongsTo(PostQuestionOption::class, 'default_option_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'entity');
    }

    public function setDefaultOptionByOptionName($option_name)
    {
        if ($option_name) {
            $default_question = $this->options()->where('name', $option_name)->first();
            if ($default_question) {
                $this->update([
                    'default_option_id' => $default_question->id
                ]);
            }
        }
    }

    /**
     * @return bool
     */
    public function getIsExpiredAttribute()
    {
        return $this->expiration_at < Carbon::now();
    }

    /**
     * @return mixed
     */
    public function getVotesCountAttribute()
    {
        return $this->options->sum('votes_count');
    }

    public function getNotVoteUserIdsAttribute()
    {
        $vote_user_ids = $this->votes->pluck('user_id');

        return \DB::table('branch_user')->where('branch_id', $this->post->branch_id)->whereNotIn('user_id',
            $vote_user_ids)->pluck('user_id');
    }

    public function getUrlAttribute()
    {
        return $this->post->url;
    }

    /**
     * @param User|bool $user
     * @return bool
     */
    public function isUserVote($user = false)
    {
        $user = $user ? $user : \Auth::user();

        return ! ! $this->votes()->where('user_id', $user->id)->first();
    }

    /**
     * @param bool $user
     * @return bool|mixed
     */
    public function getUserVoteOptionId($user = false)
    {
        $user = $user ? $user : \Auth::user();

        $vote = $this->votes()->where('user_id', $user->id)->first();

        return $vote ? $vote->post_question_option_id : false;
    }


    public function getVotesResult()
    {
        $not_vote_users_count = count($this->not_vote_user_ids);
        $all_votes_count          = $this->votes_count + $not_vote_users_count;

        $result = collect();

        foreach ($this->options as $option) {

            $option_votes_count = $option->votes_count;

            if ($this->default_option_id == $option->id) {
                $option_votes_count += $not_vote_users_count;
            }

            $result->prepend((object)[
                'id'          => $option->id,
                'name'        => $option->name,
                'votes_count' => $option_votes_count,
                'percent'     => $all_votes_count && $option_votes_count ? (100 / $all_votes_count * $option_votes_count) : 0,
            ]);

        }

        return $result;
    }
}
