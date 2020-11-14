<?php

namespace Modules\Main\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Main\Entities\Page;

class PageController extends Controller
{

    public function show($alias)
    {
        $page = Page::where('alias', $alias)->published()->firstOrFail();

        return view('main::page', compact('page'));
    }

}
