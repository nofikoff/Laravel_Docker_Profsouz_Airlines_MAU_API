<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Posts\Entities\InfoStatus;

class InfoStatusController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $statuses = InfoStatus::all();

        return view('admin::modules.infostatus.list', compact('statuses'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $status = new InfoStatus();

        return view('admin::modules.infostatus.edit', compact('status'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        InfoStatus::create($request->only(['uk', 'ru', 'en']));

        return redirect(route('admin.infostatus.list'));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $status = InfoStatus::find($id);

        return view('admin::modules.infostatus.edit', compact('status'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $infostatus = InfoStatus::find($id);
        $infostatus->update($request->only(['uk', 'ru', 'en']));
        $infostatus->save();

        return redirect(route('admin.infostatus.list'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $infostatus = InfoStatus::find($id);
        $infostatus->delete();

        return redirect()->back();
    }
}
