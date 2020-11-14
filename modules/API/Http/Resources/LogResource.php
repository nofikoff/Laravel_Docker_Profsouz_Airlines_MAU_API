<?php

namespace Modules\API\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class LogResource extends Resource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     * @throws \Throwable
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id,
            'user_id'    => $this->user_id,
            'type'       => $this->type,
            'value'      => $this->value,
            'ip'         => $this->ip,
            'template'   => view('admin::modules.log._'.$this->type, ['log' => $this])->render(),
            'comment'    => $this->comment,
            'created_at' => optional($this->created_at)->format('d.m.Y в h:i:s'),
            'user'       => $this->whenLoaded('user', function () {
                return new UserResource($this->user);
            })
        ];
    }
}
