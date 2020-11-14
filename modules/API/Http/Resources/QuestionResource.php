<?php

namespace Modules\API\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class QuestionResource extends Resource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'             => $this->id,
            'winner_id'      => $this->winner_id,
            'expiration_at'  => $this->expiration_at,
            'expiration'     => optional($this->expiration_at)->format('Y-m-d h:i:s'),
            'is_expired'     => optional($this->expiration_at)->lessThan(now()),
            'closed'         => $this->closed,
            'options'        => $this->options,
            'can_set_winner' => $this->authorizeWithoutException('set_winner', $this->resource),
            'user_option_id' => $this->getUserVoteOptionId(),
        ];
    }

    /**
     * @param string $ability
     * @param $post
     * @return bool
     */
    public function authorizeWithoutException(string $ability, $post): bool
    {
        try {
            \Gate::authorize($ability, $post);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
