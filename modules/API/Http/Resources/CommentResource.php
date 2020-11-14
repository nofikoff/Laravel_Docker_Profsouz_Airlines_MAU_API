<?php

namespace Modules\API\Http\Resources;

use \Modules\API\Http\Resources\Traits\Authorizable;
use Illuminate\Http\Resources\Json\Resource;

class CommentResource extends Resource
{

    use Authorizable;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'post_id'    => $this->post_id,
            'user_id'    => $this->user_id,
            'parent_id'  => $this->parent_id,
            'text'       => $this->text,
            'image'      => $this->image_url ? asset($this->image_url) : null,
            'created_at' => optional($this->created_at)->format('d.m.Y в h:i'),
            'updated_at' => $this->updated_at,
            'children'   => $this->whenLoaded('children', function () {
                return CommentResource::collection($this->children);
            }),
            'user'       => $this->whenLoaded('user', function () {
                return new UserResource($this->user);
            }),
            'post'       => $this->whenLoaded('post', function () {
                return new PostResource($this->post);
            }),
            'can_reply' => $this->whenLoaded('post', function () {
                return $this->authorizeWithoutException('comment', $this->post) && $this->post->is_commented;
            }),
            'can_edit' => $this->authorizeWithoutException('update', $this->resource)
        ];
    }
}
