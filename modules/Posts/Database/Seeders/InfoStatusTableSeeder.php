<?php

namespace Modules\Posts\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Posts\Entities\InfoStatus;

class InfoStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private $list = [
        [
            'ru'    => 'Успешно выполнен',
            'uk'    => 'Вдало виконаний',
            'en'    => 'Successfully completed',
        ],

        [
            'ru'    => 'Отклонён',
            'uk'    => 'Відхилений',
            'en'    => 'Reject',
        ],

        [
            'ru'    => 'В процессе выполнения',
            'uk'    => 'В процесі виконання',
            'en'    => 'In the process of implementation',
        ],

        [
            'ru'    => 'Ожидает дополнительную информацию',
            'uk'    => 'Очікує додаткову інформацію',
            'en'    => 'Awaiting for an additional information',
        ],
    ];

    public function run()
    {
        Model::unguard();
        InfoStatus::truncate();

        foreach ($this->list as $item) {
            InfoStatus::create([
                'ru'    => $item['ru'],
                'uk'    => $item['uk'],
                'en'    => $item['en'],
            ]);
        }

    }
}
