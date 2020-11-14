<?php

namespace Modules\API\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class PageResource extends Resource
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
            'id'    => $this->id,
            'title' => $this->title,
            'alias' => $this->alias,
            'text'  => $this->text,
            'order' => $this->order,
            'hide'  => $this->hide,
        ];
    }
}
