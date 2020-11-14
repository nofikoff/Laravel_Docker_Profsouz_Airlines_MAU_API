<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\TagRequest;
use Modules\Posts\Entities\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $tags = Tag::query();

        if ($request->get('search')) {
            $search = '%'.$request->get('search').'%';

            $tags = $tags->where(function ($q) use ($search) {
                /** @var Builder $q */
                return $q->where('name', 'like', $search)
                    ->orWhere('alias', 'like', $search)
                    ->orWhere('class', 'like', $search);
            });
        }

        $tags = $tags->orderBy('name')->paginate(10);

        return view('admin::modules.tag.lists', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin::modules.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  TagRequest $request
     * @return Response
     */
    public function store(TagRequest $request)
    {
        Tag::create($request->all());

        return redirect(route('admin.tag.list'));
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('admin::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);

        return view('admin::modules.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     * @param  TagRequest $request
     * @return Response
     */
    public function update($id, TagRequest $request)
    {
        $tag = Tag::findOrFail($id);

        $tag->update($request->all());

        return redirect(route('admin.tag.list'));
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        Tag::findOrFail($id)->delete();

        return redirect(route('admin.tag.list'));
    }
}
