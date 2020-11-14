<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Documents\Entities\Document;
use Modules\Documents\Services\DocumentService;
use Modules\Posts\Entities\Tag;
use Modules\Posts\Entities\Branch;
use Modules\Documents\Http\Requests\UpdateRequest;
use Modules\Documents\Http\Requests\StoreRequest;

class DocumentController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('admin::modules.document.list', [
            'documents' => Document::list()->orderByDesc('id')->paginate(20),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        if (strlen($string = $request->get('search')) < 3) {
            return redirect()->route('admin.document.list');
        }

        return view('admin::modules.document.list', [
            'documents' => Document::where('file', 'like', '?')
                ->orWhere('description', 'like', '?')
                ->with(['user', 'branch', 'tags'])
                ->setBindings(['%'.$string.'%', '%'.$string.'%'])
                ->orderByDesc('id')
                ->paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin::create');
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
        $document = Document::findOrFail($id);

        return view('admin::modules.document.edit', [
            'branches'      => Branch::get(),
            'tags'          => Tag::get(),
            'document'      => $document,
            'document_tags' => $document->tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateRequest $request, $id)
    {
        /** @var DOcument $document */
        $document = Document::findOrFail($id);

        DocumentService::updateFromRequest($document, $request);

        return redirect()->route('admin.document.edit', $document->id);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request)
    {
        $document = Document::findOrFail($request->get('id'));

        $document->delete();

        return redirect()->route('admin.document.list');
    }
}
