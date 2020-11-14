<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Posts\Entities\FinnType;

class FinnTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $types = FinnType::all();

        return view('admin::modules.finn_types.list', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(FinnType $type)
    {
        return view('admin::modules.finn_types.edit', compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        FinnType::create($request->only(['ru', 'en', 'uk']));

        return redirect(route('admin.finn_types.index'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(FinnType $type)
    {
        return view('admin::modules.finn_types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, FinnType $type)
    {
        $type->update($request->only(['ru', 'en', 'uk']));

        return redirect(route('admin.finn_types.index'));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(FinnType $type)
    {
        $type->delete();

        return back();
    }
}
