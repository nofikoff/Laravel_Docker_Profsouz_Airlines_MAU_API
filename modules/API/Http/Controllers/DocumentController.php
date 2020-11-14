<?php

namespace Modules\API\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Api\Http\Requests\StoreRequest;
use Modules\API\Http\Resources\BranchResource;
use Modules\API\Http\Resources\DocumentResource;
use Modules\Documents\Entities\Document;
use Modules\Documents\Http\Requests\UpdateRequest;
use Modules\Documents\Services\DocumentService;
use Modules\Posts\Entities\Branch;

class DocumentController extends Controller
{

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $documents = Document::list()->userReadBranches()->published()->paginate(20);

        return DocumentResource::collection($documents);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function branches()
    {
        $branches = \Modules\Posts\Entities\Branch::userRead()->documentable()->get();

        return BranchResource::collection($branches);
    }

    /**
     * @param $branch_alias
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function branch($branch_alias)
    {
        $active_branch = Branch::where('alias', $branch_alias)->firstOrFail();

        $documents = $active_branch->documents()->list()->userReadBranches()
            ->search(request('search'))->published()->paginate(20);

        return DocumentResource::collection($documents);
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(StoreRequest $request)
    {
        DocumentService::storeFromRequest($request);

        return \response('OK.');
    }

    /**
     * @param $id
     * @return DocumentResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        $document = Document::where('id', $id)->list()->published()->firstOrFail();

        $this->authorize('view', $document);

        return new DocumentResource($document);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update($id, UpdateRequest $request)
    {
        /** @var Document $document */
        $document = Document::findOrFail($id);

        $this->authorize('update', $document);

        DocumentService::updateFromRequest($document, $request);

        return \response('OK.');
    }

    /**
     * Remove the specified resource from storage.
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        $this->authorize('delete', $document);
        $document->delete();

        return \response('OK.');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function getDocLink($id)
    {
        $document = Document::findOrFail($id);

        $this->authorize('view', $document);

        $hash = str_random();

        \Cache::put('post.document.'.$hash, $id, 1);

        return response()->json(['link' => route('download.document', ['hash' => $hash])]);
    }
}
