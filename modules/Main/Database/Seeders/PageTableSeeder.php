<?php

namespace Modules\Main\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Main\Entities\Page;
use Faker\Factory as Faker;

class PageTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $pages = [
            [
                'title' => 'О системе'
            ],
            [
                'title' => 'О профсоюзе'
            ]
        ];

        Page::truncate();

        $faker = Faker::create();

        foreach ($pages as $key => $page) {
            Page::create([
                'title' => $page['title'],
                'text'  => $faker->realText(),
                'order' => $key
            ]);
        }


    }
}
