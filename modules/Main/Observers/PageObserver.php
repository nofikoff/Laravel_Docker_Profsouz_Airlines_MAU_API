<?php

namespace Modules\Main\Observers;

use Modules\Main\Entities\Page;

class PageObserver
{
    public function creating(Page $page)
    {
        $page->alias = str_slug($page->title);
        $page->order = Page::count();
    }
}