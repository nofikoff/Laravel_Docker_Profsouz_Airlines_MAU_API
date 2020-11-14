<?php

namespace Modules\API\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class DocumentResource extends Resource
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
            'id'          => $this->id,
            'branch_id'   => $this->branch_id,
            'user_id'     => $this->user_id,
            'file'        => $this->file,
            'url'         => $this->url,
            'size'        => $this->size,
            'description' => $this->description,
            'status'      => $this->status,
            'importance'  => $this->importance,
            'is_notify'   => $this->is_notify,
            'created'     => $this->created_at->format('H:i d.m.Y'),
            'link'        => route('documents.download', $this->id)
        ];
    }
}
