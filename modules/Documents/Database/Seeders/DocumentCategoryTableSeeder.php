<?php

namespace Modules\Documents\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Documents\Entities\DocumentCategory;

class DocumentCategoryTableSeeder extends Seeder
{
    private $list = [
      'Бухгалтерские документы', 'Архивные документы', 'Бизнес документы', 'Контракты', 'Договорённости',
      'Правила и устав', 'Бизнес-план', 'Накладная', 'История заказов и продвижения', 'Исполком',
    ];

    public function run()
    {
        Model::unguard();

        DocumentCategory::truncate();

        foreach ($this->list as $item)
        {
            DocumentCategory::create([
               'name'   => $item,
               'alias'  => str_slug($item),
            ]);
        }
    }
}
