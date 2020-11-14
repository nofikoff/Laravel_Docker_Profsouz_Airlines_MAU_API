<?php

namespace Modules\Users\Services\Notifications;

use Illuminate\Database\Eloquent\Model;
use Modules\Users\Entities\User;

/**
 * Interface NotificationInterface
 * @package Modules\Users\Services\Notifications
 */
interface NotificationInterface
{

    public function getEventType(): string;

    public function createNotification(User $user, $read = 0): ?Model;

    public function isUrgent(): bool;

    public function isSms(): ?bool;

    public function getEntity(): ?Model;

    public function getUrl(): string;

    public function getText($locale): string;

    public function getSystemText($locale): string;

    public function getExceptedUserIds();

    public function getType(): string;
}