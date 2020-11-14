<?php

namespace Modules\Users\Console;

use Illuminate\Console\Command;
use Modules\Users\Entities\Notification;
use Modules\Users\Entities\User;
use Modules\Users\Services\Notifications\NoneReadEntityNotification;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class SendNotificationCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'notifications:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send none-urgent notifications.';


    /**
     * Create a new command instance.
     *
     * @return void
     */

    public function handle()
    {

        foreach (Notification::noneRead()->noneUrgent()->get()->groupBy('user_id') as $user_id => $notifications) {

            $posts_count = $notifications->filter(function ($notification) {
                return $notification->entity_type == Notification::TYPE_POST;
            })->count();

            $documents_count = $notifications->filter(function ($notification) {
                return $notification->entity_type == Notification::TYPE_DOCUMENT;
            })->count();

            $user = User::find($user_id);

            app('notification',
                ['notification' => new NoneReadEntityNotification($posts_count, $documents_count)])->toUser($user);

        }

    }

}
