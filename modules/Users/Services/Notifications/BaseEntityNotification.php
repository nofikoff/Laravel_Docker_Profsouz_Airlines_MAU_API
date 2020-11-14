<?php

namespace Modules\Users\Services\Notifications;

use Illuminate\Database\Eloquent\Model;
use Modules\Users\Entities\User;

class BaseEntityNotification implements NotificationInterface
{

    protected $excepted_user_ids = [];
    protected $entity;
    protected $event;
    protected $is_urgent;
    protected $is_sms            = false;
    protected $message_trans_data;
    protected $message_trans_key;
    protected $url;

    public function getType(): string
    {
        return 'success';
    }

    public function getEventType(): string
    {
        return $this->event;
    }

    public function isUrgent(): bool
    {
        return $this->is_urgent;
    }

    public function isSms(): ?bool
    {
        return $this->is_sms;
    }

    public function getEntity(): ?Model
    {
        return $this->entity;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getText($locale): string
    {
        return trans($this->message_trans_key, $this->message_trans_data, $locale);
    }

    public function getSystemText($locale): string
    {
        if (! $this->getUrl()) {
            return $this->getText($locale);
        }

        $trans_data = $this->message_trans_data;

        array_walk($trans_data, function (&$value, $key) {
            $value = sprintf('<a href="%s">%s</a>', $this->getUrl(), $value);
        });

        return trans($this->message_trans_key, $trans_data, $locale);
    }

    public function getExceptedUserIds()
    {
        return $this->excepted_user_ids;
    }

    public function createNotification(User $user, $read = 0): ?Model
    {
        return $this->entity->notifications()->create([
            'is_urgent' => $this->is_urgent,
            'user_id'   => $user->id,
            'read'      => $read,
            'event'     => $this->getEventType()
        ]);
    }
}