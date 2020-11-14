<?php

namespace Modules\API\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use Modules\Users\Entities\Notification;

class NotificationResource extends Resource
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
            'user_id'     => $this->user_id,
            'is_urgent'   => $this->is_urgent,
            'read'        => $this->read,
            'event'       => $this->event,
            'entity_id'   => $this->entity_id,
            'entity_type' => $this->entity_type,
            'text'        => $this->text,
            'url'         => $this->url,
            'user'        => $this->getUser(),
            'branch_name' => $this->getBranchName(),
            'post_type'   => $this->getPostType(),
            'created_at'  => optional($this->created_at)->format('d.m.Y в h:i')
        ];
    }

    /**
     * @return UserResource|null
     */
    private function getUser()
    {
        $user = null;

        switch ($this->entity_type) {
            case Notification::TYPE_COMMENT:
            case Notification::TYPE_QUESTION:
                $user = $this->getPost()->user;
                break;
            case Notification::TYPE_POST:
            case Notification::TYPE_DOCUMENT:
                $user = $this->entity->user;
                break;
            case Notification::TYPE_USER:
                $user = $this->entity;
                break;
        }

        return $user ? new UserResource($user) : null;
    }

    /**
     * @return string
     */
    private function getBranchName()
    {
        $name = '';

        switch ($this->entity_type) {
            case Notification::TYPE_COMMENT:
            case Notification::TYPE_QUESTION:
                $name = $this->getPost()->branch->name;
                break;
            case Notification::TYPE_POST:
            case Notification::TYPE_DOCUMENT:
                $name = $this->entity->branch->name;
                break;
        }

        return $name;
    }

    /**
     * @return string
     */
    private function getPostType()
    {
        $name = '';

        switch ($this->entity_type) {
            case Notification::TYPE_COMMENT:
            case Notification::TYPE_QUESTION:
                $name = $this->getPost()->type;
                break;
            case Notification::TYPE_POST:
                $name = $this->entity->type;
                break;
        }

        return $name;
    }

    private function getPost() {
        return $this->entity->post ?: $this->entity->post()->withTrashed()->first();
    }
}
