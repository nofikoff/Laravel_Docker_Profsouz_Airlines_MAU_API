<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Users\Entities\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $list = [
        [
            'name'          => 'admin',
            'display_name'  => 'Администратор',
        ],

        [
            'name'          => 'moder',
            'display_name'  => 'Модератор',
        ],
    ];

    public function run()
    {
        Model::unguard();

        Role::truncate();

        Role::insert($this->list);
    }
}
