<?php

namespace Modules\Documents\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \App\Http\Controllers\Controller;
use Modules\Documents\Entities\Document;
use Modules\Documents\Services\DocumentService;
use Modules\Posts\Entities\Tag;
use Storage;
use Modules\Documents\Http\Requests\StoreRequest;
use Modules\Documents\Http\Requests\UpdateRequest;
use Modules\Users\Entities\User;
use Modules\Posts\Entities\Branch;

class DocumentsController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $documents = Document::list()->userReadBranches()->published()->paginate(20);

        return view('documents::index', compact('documents'));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\StreamedResponse|void
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function download($id)
    {
        $document = Document::findOrFail($id);

        //$this->authorize('view', $document);

        $filename  = str_slug(preg_replace('/(\..*)/', '', $document->file));
        $extension = preg_replace('/(.*\.)/', '', $document->file);

        $path = '/public/'.trim(Document::STORAGE_PATH, '/').'/'.$document->url;

        try {
            return Storage::download($path, sprintf('%s.%s', $filename, $extension));
        } catch (\Exception $e) {
            return abort(404, 'Файл '.$document->file.' не найден!');
        }

    }

    /**
     * @param $hash
     * @return \Symfony\Component\HttpFoundation\StreamedResponse|void
     */
    public function docFromHash($hash)
    {
        if (! \Cache::get('post.document.'.$hash)) {
            abort(404);
        }

        $document = Document::findOrFail(\Cache::pull('post.document.'.$hash));

        $filename  = str_slug(preg_replace('/(\..*)/', '', $document->file));
        $extension = preg_replace('/(.*\.)/', '', $document->file);

        $path = '/public/'.trim(Document::STORAGE_PATH, '/').'/'.$document->url;

        try {
            return Storage::download($path, sprintf('%s.%s', $filename, $extension));
        } catch (\Exception $e) {
            return abort(404, 'Файл '.$document->file.' не найден!');
        }
    }

    public function search(Request $request)
    {
        if (strlen($string = $request->get('search_query')) < 3) {
            return redirect()->route('documents.index');
        }

        $documents = Document::list()
            ->search($string)
            ->userReadBranches()
            ->published()
            ->paginate(20);

        return view('documents::index', compact('documents'));
    }

    /**
     * @param $tag_alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tag($tag_alias)
    {
        $tag = Tag::where('alias', '?')
            ->setBindings([$tag_alias])
            ->firstOrFail();

        $documents = $tag->documents()
            ->list()
            ->userReadBranches()
            ->published()
            ->paginate(20);

        return view('documents::index', compact('documents'));
    }

    public function branch($branch_alias)
    {
        $active_branch = Branch::where('alias', $branch_alias)->firstOrFail();

        $documents = $active_branch->documents()->list()->userReadBranches()->published()->paginate(20);

        return view('documents::index', compact('documents', 'active_branch'));
    }

    public function user($user_id)
    {
        $user      = User::findOrFail($user_id);
        $documents = $user->documents()->list()->userReadBranches()->published()->paginate(20);

        return view('documents::index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('documents::create', [
            'branches' => Branch::userAccess()->documentable()->get(),
            'tags'     => Tag::get(),
        ]);
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        DocumentService::storeFromRequest($request);

        return redirect()->route('documents.index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('documents::show');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        $document = Document::findOrFail($id);

        $this->authorize('update', $document);

        $logs = $document->logs()->with(['entity'])
            ->orderBy('created_at')
            ->get();

        return view('documents::edit', [
            'branches'      => Branch::userAccess()->documentable()->get(),
            'tags'          => Tag::get(),
            'document'      => $document,
            'document_tags' => $document->tags,
            'logs'          => $logs
        ]);
    }

    /**
     * @param UpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateRequest $request, $id)
    {
        /** @var Document $document */
        $document = Document::findOrFail($id);

        $this->authorize('update', $document);

        DocumentService::updateFromRequest($document, $request);

        return redirect(route('documents.index'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Request $request)
    {
        $document = Document::findOrFail($request->get('id'));
        $this->authorize('delete', $document);
        $document->delete();

        return redirect()->route('documents.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function premoderate()
    {
        $documents = Document::premoderation()->list()->paginate(10);

        return view('documents::index', compact('documents'));
    }
}
