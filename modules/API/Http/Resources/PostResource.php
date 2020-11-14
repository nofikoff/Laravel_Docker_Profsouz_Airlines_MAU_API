<?php

namespace Modules\API\Http\Resources;

use \Modules\API\Http\Resources\Traits\Authorizable;
use Illuminate\Http\Resources\Json\Resource;

class PostResource extends Resource
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
            'id'             => $this->id,
            'title'          => $this->title,
            'user_id'        => $this->user_id,
            'branch_id'      => $this->branch_id,
            'branch_name'    => $this->branch->name,
            'type'           => $this->type,
            'body'           => $this->body,
            'status'         => $this->status,
            'importance'     => $this->importance,
            'info_status_id' => $this->info_status_id,
            'is_commented'   => $this->is_commented,
            'sms_notify'     => $this->sms_notify,
            'in_top'         => $this->in_top,
            'images'         => $this->images,
            'pdf'            => asset($this->pdf),
            'comments_count' => $this->comments_count,
            'commentable'    => $this->authorizeWithoutException('comment', $this->resource),
            'deletable'      => $this->authorizeWithoutException('delete', $this->resource),
            'editable'       => $this->authorizeWithoutException('update', $this->resource),
            'link'           => route('posts.show', ['id' => $this->id]),
            'created_at'     => optional($this->created_at)->format('d.m.Y в h:i'),
            'read'           => $request->user() ? $this->user_readers->contains($request->user()) : true,
            'user'           => $this->whenLoaded('user', function () {
                return new UserResource($this->user);
            }),
            'question'       => $this->whenLoaded('question', function () {
                return new QuestionResource($this->question);
            }),
            'financial_info' => $this->whenLoaded('financial_info', function () {
                return new FinancialInfoResource($this->financial_info);
            }),
            'attachments'    => $this->whenLoaded('attachments', function () {
                return PostAttachmentResource::collection($this->attachments);
            })
        ];
    }


}
