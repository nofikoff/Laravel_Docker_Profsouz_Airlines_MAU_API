<?php

namespace Modules\API\Http\Controllers;

use Modules\API\Http\Resources\PostResource;
use Modules\Documents\Entities\Document;
use Modules\Posts\Entities\Post;

class SearchController extends APIController
{

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $entities = Post::list()->published()->search(request('search'))->userReadBranches()->get();

        $entities = $entities->concat(Document::list()->search(request('search'))->userReadBranches()->get());

        return PostResource::collection($entities);
    }
}
