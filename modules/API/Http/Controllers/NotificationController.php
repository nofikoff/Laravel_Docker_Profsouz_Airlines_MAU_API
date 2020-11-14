<?php

namespace Modules\API\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Modules\API\Http\Resources\NotificationResource;
use Modules\Users\Entities\Notification;
use Modules\Users\Events\NotificationBroadcast;

class NotificationController extends APIController
{

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getNotifications()
    {
        $query = \Auth::user()->notifications()
            ->with('entity')
            ->latest();

        $resource = NotificationResource::collection($query->paginate(20));

        foreach ($query->paginate(20) as $notification) {
            if ($notification->read) {
                continue;
            }

            $notification->update([
                'read' => 1
            ]);
        }

        return $resource;
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function notRead()
    {
        $notifications_query = \Auth::user()->notifications()->noneRead();

        $notifications = $notifications_query->paginate(100);

        $notifications_query->update([
            'read' => 1
        ]);

        return NotificationResource::collection($notifications);
    }

    public function broadcastNotifications()
    {
        $notifications = $this->getNoneReadUrgentNotifications();

        /** @var \Notification $notification */
        foreach ($notifications as $notification) {
            if ($notification->noty) {
                broadcast(new NotificationBroadcast(\Auth::user(), $notification->noty));
            }
        }
    }

    public function getNotReadCount()
    {
        $count = \Auth::user()->notifications()->noneRead()->count();

        return response()->json(compact('count'));
    }

    /**
     * @param Notification $notification
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Notification $notification)
    {
        return response()->json(['success' => $notification->delete()]);
    }

    /**
     * @return Collection
     */
    private function getNoneReadUrgentNotifications()
    {
        $query = \Auth::user()->notifications()->noneRead()->where('is_urgent', 1);

        $notifications = $query->get();

        $query->update(['read' => 1]);

        return $notifications;
    }

}
