<?php

namespace Modules\API\Http\Controllers;

use Carbon\Carbon;
use Modules\API\Http\Requests\PostsReadRequest;
use Modules\API\Http\Resources\BranchResource;
use Modules\API\Http\Resources\LogResource;
use Modules\API\Http\Resources\InfoStatusesResource;
use Modules\API\Http\Resources\PostResource;
use Modules\Posts\Entities\Branch;
use Modules\Posts\Entities\Post;
use Modules\Posts\Entities\PostAttachment;
use Modules\Posts\Http\Requests\PostRequest;
use Modules\Posts\Services\PostService;

class PostController extends APIController
{

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $posts = Post::userReadBranches()->list()->published()->paginate(10);

        return PostResource::collection($posts);
    }

    /**
     * @param $id
     * @return PostResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        $post = Post::where('id', $id)->list()->published()->firstOrFail();

        $this->authorizeWithoutException('view', $post);

        \Auth::user()->notifications()->posts()
            ->where('entity_id', $post->id)
            ->update([
                'read' => 1
            ]);

        return new PostResource($post);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function branches()
    {
        $branches = Branch::userRead()->root()->postable()->withCount([
            'posts as none_read_posts_count' => function ($q) {
                $q->published()->whereDoesntHave('user_readers', function ($q) {
                    $q->where('user_id', \Auth::user()->id);
                });
            }
        ])->get();

        return BranchResource::collection($branches);
    }

    /**
     * @param $branch_alias
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function branch($branch_alias)
    {
        $branch = Branch::where('alias', $branch_alias)
            ->userRead()
            ->firstOrFail();

        $posts = $branch->posts()->userReadBranches()->list()->published()->paginate(10);

        return PostResource::collection($posts);
    }

    /**
     * @param PostRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Throwable
     */
    public function store(PostRequest $request)
    {
        $post = PostService::storeFromRequest($request);

        return response()->json(['success' => true, 'post_id' => $post->id]);
    }

    /**
     * @param $id
     * @param PostRequest $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update($id, PostRequest $request)
    {
        $post = Post::where('id', $id)->firstOrFail();
        $this->authorize('update', $post);

        PostService::updateFromRequest($post, $request);

        return response()->json(['success' => true]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $this->authorize('delete', $post);

        return response()->json(['success' => $post->delete()]);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function my()
    {
        $posts = Post::where('user_id', \Auth::id())->list()->published()
            ->statused(request('status'))
            ->withCount('comments')
            ->paginate(10);

        return PostResource::collection($posts);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getInfoStatuses()
    {
        $statuses = \Modules\Posts\Entities\InfoStatus::all();

        return InfoStatusesResource::collection($statuses);
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function history(Post $post)
    {
        $logs = $post->logs()->with(['entity', 'entity.comments', 'user'])
            ->orderBy('created_at')
            ->paginate(10);

        return LogResource::collection($logs);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function premoderate()
    {
        $posts = Post::premoderation()->list()->paginate(10);

        return PostResource::collection($posts);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function getPdfLink($id)
    {
        $post = Post::find($id);

        $this->authorize('view', $post);

        $hash = str_random();

        \Cache::put('post.pdf.'.$hash, $id, Carbon::now()->addMinute());

        return response()->json(['link' => route('download.pdf', ['hash' => $hash])]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function getAttachmentLink($id)
    {
        $attachment = PostAttachment::find($id);

        $post = $attachment->post;

        $this->authorize('view', $post);

        $hash = str_random();

        \Cache::put('post.attachment.'.$hash, $id, Carbon::now()->addMinute());

        return response()->json(['link' => route('download.attachment', ['hash' => $hash])]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function removeAttachment($id)
    {
        $attachment = PostAttachment::find($id);

        $this->authorize('update', $attachment->post);

        $attachment->delete();

        return response()->json(['success' => 'ok']);
    }

    /**
     * @param PostsReadRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function read(PostsReadRequest $request)
    {
        foreach (Post::findMany($request->get('post_ids')) as $post) {
            $post->user_readers()->attach(\Auth::user()->id, ['read' => 1]);
        }

        return response()->json(['success' => 'ok']);
    }

}
