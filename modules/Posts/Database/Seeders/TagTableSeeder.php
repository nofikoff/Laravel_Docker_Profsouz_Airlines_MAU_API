<?php

namespace Modules\Posts\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Posts\Entities\Tag;
use Modules\Posts\Entities\Post;
use Modules\Posts\Entities\PostTag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $tags = [
        [
            'name'  => 'Эксплуатация',
            'class' => 'danger',
        ],

        [
            'name'  => 'Услуги',
            'class' => 'info',
        ],

        [
            'name'  => 'Автомобили',
            'class' => 'success',
        ],

        [
            'name'  => 'Недвижимость',
            'class' => 'warning',
        ],
    ];

    public function run()
    {
        Model::unguard();

        Tag::truncate();

        foreach ($this->tags as $tag) {
            Tag::create([
                'name'  => $tag['name'],
                'class' => $tag['class'],
                'alias' => str_slug($tag['name']),
            ]);
        }

    }
}
