<?php

namespace Modules\Users\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class UsersDatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

//        $this->call(LaratrustSeeder::class);
//        $this->call(RolesTableSeeder::class);
//        $this->call(AdministratorTableSeeder::class);
//        $this->call(PermissionTableSeeder::class);
    }
}
