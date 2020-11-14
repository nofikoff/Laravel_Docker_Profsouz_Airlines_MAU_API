<?php

namespace Modules\Posts\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Documents\Database\Seeders\DocumentCategoryTableSeeder;
use Modules\Documents\Database\Seeders\DocumentTableSeeder;
use Modules\Users\Database\Seeders\AdministratorTableSeeder;
use Modules\Users\Database\Seeders\PermissionTableSeeder;
use Modules\Users\Database\Seeders\RolesTableSeeder;

class PostsDatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(RolesTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(AdministratorTableSeeder::class);

        $this->call(InfoStatusTableSeeder::class);
        $this->call(FinnTypesTableSeeder::class);
        $this->call(BranchTableSeeder::class);
        $this->call(TagTableSeeder::class);

        if (env('APP_ENV', 'local') == 'local') {
            $this->call(PostTableSeeder::class);
            $this->call(DocumentTableSeeder::class);
        }
    }
}
