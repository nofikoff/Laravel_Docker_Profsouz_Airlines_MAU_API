<?php

namespace Modules\API\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class SettingNotificationBranchResource extends Resource
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
            'id'            => $this->id,
            'name'          => $this->name,
            'access_notify' => $this->access_notify,
            'follow'        => $this->follow
        ];
    }
}
