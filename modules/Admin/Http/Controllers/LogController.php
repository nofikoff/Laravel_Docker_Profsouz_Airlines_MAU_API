<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Users\Entities\Log;

class LogController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $logs = Log::with([
            'entity' => function ($query) {
                $query->withTrashed();
            }
        ])->orderByDesc('created_at')->paginate(20);

        return view('admin::modules.log.index', compact('logs'));
    }
}