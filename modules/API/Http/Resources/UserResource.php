<?php

namespace Modules\API\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserResource extends Resource
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
            'id'           => $this->id,
            'phone'        => $this->phone,
            'full_name'    => $this->fullName,
            'first_name'   => $this->first_name,
            'last_name'    => $this->last_name,
            'avatar'       => asset($this->avatar),
            'no_avatar'    => ! $this->img,
            'position'     => $this->position,
            'birthday'     => $this->show_birthday,
            'is_confirmed' => $this->is_confirmed,
            'locale'       => $this->locale,
            'last_seen'    => $this->updated_at->format('H:i d.m.Y')
        ];
    }
}
