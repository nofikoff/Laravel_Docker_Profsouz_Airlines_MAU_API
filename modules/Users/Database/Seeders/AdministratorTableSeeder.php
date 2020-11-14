<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Users\Entities\Group;
use Modules\Users\Entities\Notification;
use Modules\Users\Entities\User;
use Modules\Users\Entities\Role;
use Modules\Users\Services\UserBranchSetting;

class AdministratorTableSeeder extends Seeder
{

    /**
     * @param UserBranchSetting $user_setting
     */
    public function run(UserBranchSetting $user_setting)
    {
        Model::unguard();
        User::truncate();
        Notification::truncate();

        \DB::table('branch_user_setting')->truncate();

        $admin = User::create([
            'phone'        => '380111111111',
            'first_name'   => 'General',
            'last_name'    => 'Admin',
            'password'     => 'password',
            'locale'       => env('SETTINGS_DEFAULT_LANG'),
            'is_confirmed' => true,
        ]);
        $admin->roles()->attach(1);
        $admin->save();

        foreach (Group::whereNotIn('id', [1])->get() as $group) {
            $admin->groups()->attach($group);
            $user_setting->attachByGroupBranches($group, $admin->id);
        }

        $moder = User::create([
            'phone'      => '380222222222',
            'first_name' => 'John',
            'last_name'  => 'Doe',
            'password'   => 'password',
            'locale'     => env('SETTINGS_DEFAULT_LANG'),
        ]);

        $moder->roles()->attach(2);
        $moder->save();
    }
}
