<?php

namespace Modules\Posts\Http\Controllers;

use Modules\Posts\Entities\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \App\Http\Controllers\Controller;
use Modules\Posts\Entities\PostAttachment;
use Modules\Posts\Http\Requests\PostRequest;
use Modules\Posts\Entities\Tag;
use Modules\Posts\Services\PostService;
use Modules\Users\Entities\Log;

class PostsController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $posts = Post::userReadBranches()->list()->published()->paginate(10);

        return view('posts::index', compact('posts'));
    }

    public function tag($tag_alias)
    {
        $tag = Tag::where('alias', $tag_alias)->firstOrFail();

        $posts = $tag->posts()->userReadBranches()->list()->published()->paginate(40);

        return view('posts::index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create($type)
    {
        return view('posts::create', compact('type'));
    }

    /**
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Mpdf\MpdfException
     * @throws \Throwable
     */
    public function store(PostRequest $request)
    {
        PostService::storeFromRequest($request);

        return redirect(route('posts.index'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show($id)
    {
        $post = Post::where('id', $id)->list()->published()->firstOrFail();

        $this->authorize('view', $post);

        \Auth::user()->notifications()->posts()->where('entity_id', $post->id)->update([
            'read' => 1
        ]);

        return view('posts::show', compact('post'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit($id)
    {
        $post = Post::where('id', $id)->firstOrFail();

        $this->authorize('update', $post);

        $comments = [];

        $logs = $post->logs()->with(['entity', 'entity.comments'])
            ->orderBy('created_at')
            ->get()
            ->map(function ($log) use (&$comments) {
                /** @var Log $log */
                $log_comment = $log->entity->comments()
                    ->where('created_at', '<', $log->created_at)
                    ->whereNotIn('id', $comments)
                    ->get();

                $log->comments = $log_comment;

                $comments = array_merge($comments, $log_comment->pluck('id')->toArray());

                return $log;
            })->sortByDesc('created_at');

        $last_comments = $post->comments()
            ->whereNotIn('id', $comments)
            ->orderBy('created_at')
            ->get();

        $comments = array_merge($comments, $last_comments->pluck('id')->toArray());

        return view('posts::edit', compact('post', 'logs', 'last_comments', 'comments'));
    }

    /**
     * @param PostRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::where('id', $id)->firstOrFail();
        $this->authorize('update', $post);

        PostService::updateFromRequest($post, $request);

        return redirect(route('posts.index'));
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Request $request)
    {
        $post = Post::findOrFail($request->get('id'));

        $this->authorize('delete', $post);

        foreach ($post->attachments as $attachment) {
            \Storage::delete($attachment->file);
        }

        $post->delete();

        return redirect(route('posts.index'));
    }

    public function downloadAttachment($attachment_id)
    {
        $attachment = PostAttachment::findOrFail($attachment_id);

        $filename  = str_slug(preg_replace('/(\..*)/', '', $attachment->name));
        $extension = preg_replace('/(.*\.)/', '', $attachment->file);

        return \Storage::download($attachment->file, sprintf('%s.%s', $filename, $extension));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function detachFiles($id, Request $request)
    {
        $file = PostAttachment::find($id);

        $this->authorize('update', $file->post);

        $file->delete();

        return redirect()->back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function premoderate()
    {
        $posts = Post::premoderation()->list()->paginate(10);

        return view('posts::index', compact('posts'));
    }

    /**
     * @param $id
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function downloadPdf($id)
    {
        $post = Post::find($id);

        $this->authorize('view', $post);

        return \response($post->financial_info->getPdfContent(), 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    /**
     * @param $hash
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function pdfFromHash($hash)
    {
        if (! \Cache::has('post.pdf.'.$hash)) {
            abort(404);
        }
        $post = Post::find(\Cache::pull('post.pdf.'.$hash));

        return \response($post->financial_info->getPdfContent(), 200, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    /**
     * @param $hash
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function attachFromHash($hash)
    {
        if (! \Cache::has('post.attachment.'.$hash)) {
            abort(404);
        }

        $attachment = PostAttachment::findOrFail(\Cache::pull('post.attachment.'.$hash));

        $filename  = str_slug(preg_replace('/(\..*)/', '', $attachment->name));
        $extension = preg_replace('/(.*\.)/', '', $attachment->name);

        return \Storage::download($attachment->file, sprintf('%s.%s', $filename, $extension));
    }
}
