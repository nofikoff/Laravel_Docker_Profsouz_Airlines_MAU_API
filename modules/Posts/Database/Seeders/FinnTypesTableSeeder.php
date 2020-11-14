<?php

namespace Modules\Posts\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Posts\Entities\FinnType;

class FinnTypesTableSeeder extends Seeder
{
    private $list = [
        [
            'ru'    => 'Финпомощь при рождении ребенка',
            'uk'    => 'Фіндопомогу при народженні дитини',
            'en'    => 'Financial childbirth assistance',
        ],

        [
            'ru'    => 'Финпомощь при болезни',
            'uk'    => 'Фіндопомогу при хворобі',
            'en'    => 'Financial help in case of illness',
        ],

        [
            'ru'    => 'Смерть',
            'uk'    => 'Смерть',
            'en'    => 'Financial help in case of death',
        ],

        [
            'ru'    => 'Прочее',
            'uk'    => 'Інше',
            'en'    => 'Other',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        FinnType::truncate();

        foreach ($this->list as $item) {
            FinnType::create([
                'ru'    => $item['ru'],
                'uk'    => $item['uk'],
                'en'    => $item['en'],
            ]);
        }
    }
}
