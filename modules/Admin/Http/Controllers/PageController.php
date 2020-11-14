<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\PageRequest;
use Modules\Main\Entities\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $pages = Page::ordered()->get();

        return view('admin::modules.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin::modules.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  PageRequest $request
     * @return Response
     */
    public function store(PageRequest $request)
    {
        Page::create($request->all());

        return redirect(route('admin.pages.index'));
    }

    
    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Page $page)
    {
        return view('admin::modules.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     * @param  PageRequest $request
     * @return Response
     */
    public function update(PageRequest $request, Page $page)
    {
        $page->update($request->all());

        return redirect(route('admin.pages.index'));
    }

    /**
     * @param Page $page
     * @return string
     * @throws \Exception
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return redirect(route('admin.pages.index'));
    }

    public function up(Page $page)
    {
        $page->toUp();

        return redirect(route('admin.pages.index'));
    }

    public function down(Page $page)
    {
        $page->toDown();

        return redirect(route('admin.pages.index'));
    }
}
