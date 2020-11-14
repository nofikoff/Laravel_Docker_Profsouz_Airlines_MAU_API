<?php

namespace Modules\Posts\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Posts\Entities\Comment;
use Modules\Posts\Entities\Post;
use Modules\Posts\Http\Requests\CommentRequest;
use Modules\Posts\Services\CommentService;

class CommentsController extends Controller
{
    /**
     * @param CommentRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(CommentRequest $request)
    {
        /** @var Post $post */
        $post = Post::findOrFail($request->get('post_id'));
        $this->authorize('comment', $post);

        $comment = $post->comments()->make([
            'user_id'   => \Auth::id(),
            'text'      => $request->get('text'),
            'parent_id' => $request->get('parent_id', 0)
        ]);

        $comment->image = CommentService::storeFile($request);
        $comment->save();

        return $this->comments_list($post);
    }

    /**
     * @param Comment $comment
     * @param CommentRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Comment $comment, CommentRequest $request)
    {
        $this->authorize('update', $comment);
        CommentService::update($comment, $request);

        return $this->comments_list($comment->post);
    }

    public function post($id)
    {
        $post = Post::findOrFail($id);

        return view('posts::comments.index', compact('post'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function comments_list(Post $post)
    {
        return view('posts::comments._list', ['comments' => $post->comments()->where('parent_id', 0)->get()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function destroy(Request $request)
    {
        $comment = Comment::where('id', $request->get('id'))->firstOrFail();
        $this->authorize('delete', $comment);

        $comment->delete();

        return view('posts::comments._list', ['comments' => $comment->post->comments()->where('parent_id', 0)->get()]);
    }

}
