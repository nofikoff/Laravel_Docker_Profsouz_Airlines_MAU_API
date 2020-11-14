<?php

namespace Modules\Main\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Documents\Entities\Document;
use Modules\Posts\Entities\Post;

class SearchController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $entities = Post::list()->published()->search(request('search'))->userReadBranches()->get();

        $entities = $entities->concat(Document::list()->search(request('search'))->userReadBranches()->get());

        return view('main::search', compact('entities'));
    }
}