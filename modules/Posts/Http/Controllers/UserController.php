<?php

namespace Modules\Posts\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\Posts\Entities\Post;

class UserController extends Controller
{

    public function index()
    {
        $posts = Post::where('user_id',
            \Auth::id())->list()->published()->statused(request('status'))->paginate(10);

        return view('posts::user.index', compact('posts'));
    }

}
