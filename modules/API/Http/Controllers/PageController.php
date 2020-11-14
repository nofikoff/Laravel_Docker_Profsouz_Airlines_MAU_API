<?php

namespace Modules\API\Http\Controllers;

use Modules\API\Http\Resources\PageResource;
use Modules\Main\Entities\Page;

class PageController extends APIController
{

    /**
     * @param $alias
     * @return PageResource
     */
    public function show($alias)
    {
        $page = Page::where('alias', $alias)->published()->firstOrFail();

        return new PageResource($page);
    }
}
