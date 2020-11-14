<?php

namespace Modules\API\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class BranchResource extends Resource
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
            'name'        => $this->name,
            'alias'       => $this->alias,
            'description' => $this->description,
            'parent_id'   => $this->parent_id,
            'is_inherit'  => $this->is_inherit,
            'type'        => $this->type,
            'pivot'       => $this->whenPivotLoaded('branch_user_setting', function () {
                return $this->pivot;
            }),
            'none_read_posts_count' => $this->none_read_posts_count
        ];
    }
}
