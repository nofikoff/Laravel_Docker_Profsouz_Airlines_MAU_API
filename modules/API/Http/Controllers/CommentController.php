<?php

namespace Modules\API\Http\Controllers;

use Illuminate\Http\Request;
use Modules\API\Http\Requests\CommentUpdateRequest;
use Modules\API\Http\Resources\CommentResource;
use Modules\Posts\Entities\Comment;
use Modules\Posts\Entities\Post;
use Modules\Posts\Http\Requests\CommentRequest;
use Modules\Posts\Services\CommentService;

class CommentController extends APIController
{

    /**
     * @param $id
     * @return CommentResource
     */
    public function getComments($id)
    {
        $comment = Comment::find($id);

        return new CommentResource($comment);
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function postComments(Post $post)
    {
        $comments = $post->comments()->with('user')->parents()->paginate(10);

        foreach ($comments as $comment) {
            $this->_loadChild($comment);
        }

        return CommentResource::collection($comments);
    }

    /**
     * @param CommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Post $post, Request $request)
    {
        $this->authorize('comment', $post);

        $comment = $post->comments()->make([
            'user_id'   => \Auth::id(),
            'text'      => $request->get('text'),
            'parent_id' => $request->get('parent_id', 0)
        ]);

        $comment->image = CommentService::storeFile($request);

        return response()->json(['success' => $comment->save()]);
    }

    /**
     * @param Comment $comment
     * @param CommentUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Post $post, Comment $comment, CommentUpdateRequest $request)
    {
        $this->authorize('update', $comment);
        return response()->json(['success' => CommentService::update($comment, $request)]);
    }



    /**
     * @param Post $post
     * @param Comment $comment
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function delete(Post $post, Comment $comment)
    {
        $this->authorize('delete', $comment);

        return response()->json(['success' => $comment->delete()]);
    }

    public function my()
    {
        $comments = Comment::where('user_id', \Auth::id())->with('post')->latest()->paginate(10);

        return CommentResource::collection($comments);
    }

    /**
     * @param Comment $comment
     */
    private function _loadChild(Comment $comment)
    {
        $comment->load('user');

        foreach ($comment->children as $child) {
            $this->_loadChild($child);
        }
    }
}
