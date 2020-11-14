<?php

namespace Modules\Users\Listeners;

use Modules\Users\Entities\Log;

class UserEventSubscriber
{

    /**
     * Handle user login events.
     */
    public function onUserLogin($event)
    {
        $ip = \Request::getClientIp();

        Log::create([
            'user_id' => \Auth::id(),
            'type'    => Log::TYPE_LOGIN,
            'ip'      => $ip
        ]);
    }

    /**
     * Handle user logout events.
     */
    public function onUserLogout($event)
    {
        $ip = \Request::getClientIp();

        if (\Auth::check()) {
            Log::create([
                'user_id' => \Auth::id(),
                'type'    => Log::TYPE_LOGOUT,
                'ip'      => $ip
            ]);
        }

    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'Modules\Users\Listeners\UserEventSubscriber@onUserLogin'
        );

        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'Modules\Users\Listeners\UserEventSubscriber@onUserLogout'
        );
    }
}