<?php

namespace Modules\Users\Console;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Modules\Users\Entities\User;

class CreateSystemNotification extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'system-post:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create system collect notifications';


    public function handle()
    {
        $birthday_users = User::whereDay('birthday', date('d'))->whereMonth('birthday', date('m'))->get();

        foreach (User::where('is_confirmed', 1)->get() as $user) {
            $messages = collect();

            foreach ($birthday_users as $birthday_user) {
                if ($birthday_user->id == $user->id) {
                    continue;
                }
                $messages->push(trans('posts::system_post.message_birthday',
                    ['user_name' => $birthday_user->full_name]));
            }

            foreach ($user->notifications()->noneRead()->noneUrgent()->get() as $notification) {
                $messages->push($notification->system_text);
            }

            if($messages->count()) {
                $user->system_posts()->create(['body' => $messages->implode('<br>')]);
            }
        }

    }
}
