<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Modules\Users\Events\NotificationBroadcast;

class NotificationController extends Controller
{

    public function index()
    {
        $notifications = \Auth::user()->notifications()->latest()->paginate(10);

        foreach ($notifications as $notification) {
            if ($notification->read) {
                continue;
            }

            $notification->update([
                'read' => 1
            ]);
        }

        return view('users::notifications.index', compact('notifications'));
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function notRead()
    {
        $notifications_query = \Auth::user()->notifications()->noneRead();

        $notifications = $notifications_query->paginate(100);

        $notifications_query->update([
            'read' => 1
        ]);

        return view('users::notifications.index', compact('notifications'));
    }


    public function getNotifications()
    {
        $notifications = $this->getNoneReadUrgentNotifications();

        /** @var \Notification $notification */
        foreach ($notifications as $notification) {
            if ($notification->noty) {
                broadcast(new NotificationBroadcast(\Auth::user(), $notification->noty));
            }
        }
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
