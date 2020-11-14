<?php

namespace Modules\API\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\API\Http\Resources\FinnTypeResource;

class FinancialController extends Controller
{

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getTypes()
    {
        $types = \Modules\Posts\Entities\FinnType::all();

        return FinnTypeResource::collection($types);
    }
}
