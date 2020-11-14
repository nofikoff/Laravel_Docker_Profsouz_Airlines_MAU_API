<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Users\Entities\Group;
use Modules\Users\Entities\Permission;
use Modules\Users\Entities\Role;

class PermissionTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Permission::truncate();
        Role::truncate();
        Group::truncate();
        \DB::table('branch_user')->truncate();
        \DB::table('branch_group')->truncate();
        \DB::table('role_user')->truncate();
        \DB::table('group_user')->truncate();

        Permission::create([
            'name'         => 'full',
            'display_name' => 'Полный доступ',
        ]);
        Permission::create([
            'name'         => 'readonly',
            'display_name' => 'Чтения',
        ]);
        Permission::create([
            'name'         => 'store',
            'display_name' => 'написания Постов через предмодерацию',
        ]);
        Permission::create([
            'name'         => 'store_comment',
            'display_name' => 'Комментирование',
        ]);
        Permission::create([
            'name'         => 'notification',
            'display_name' => 'Получение уведомлений из Ветки',
        ]);

        $default_groups = [
            'Все пользователи',
            'Администраторы',
            'Исполком',
            'Служба эксплуатации',
            'Комитет по компьютерам',
            'Старшие члены профсоюза',
            'Руководители',
            'Гостиницы',
            'Спецодежда',
            'Питание',
            'Развозка',
        ];

        foreach ($default_groups as $default_group) {
            Group::create([
                'name' => $default_group,
            ]);
        }

        Role::create([
            'name'         => 'admin',
            'display_name' => 'Администратор',
        ]);

        Role::create([
            'name'         => 'moder',
            'display_name' => 'Модератор',
        ]);
    }
}
