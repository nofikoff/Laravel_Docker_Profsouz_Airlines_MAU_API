<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Posts\Entities\Post;
use Modules\Admin\Http\Requests\PremoderateRequest;
use Illuminate\Support\Carbon;
use Modules\Users\Services\Notifications\ResultModerationPostNotification;

class PremoderateController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('admin::modules.premoderation.list', [
            'posts' => Post::premoderation()->list()->paginate(10),
        ]);
    }

    public function action(PremoderateRequest $request)
    {
        $post = Post::find($request->get('id'));

        if ($post->status != Post::STATUS_PREMODERATION) {
            return abort(404);
        }

        $post->status     = $request->get('action');
        $post->created_at = Carbon::now();
        $post->save();

        app('notification', ['notification' => new ResultModerationPostNotification($post)])->toUser($post->user);

        return redirect()->route('admin.premoderate.list');
    }
}
