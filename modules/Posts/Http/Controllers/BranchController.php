<?php

namespace Modules\Posts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use \Input;
use Modules\Posts\Entities\Branch;
use Modules\Posts\Entities\Post;

class BranchController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $posts          = Post::userReadBranches()->list()->published()->paginate(10);
        $branches_posts = $posts->groupBy('branch.name');
        $links          = $posts->appends(Input::except('page'))->links('pagination');

        return view('posts::branches.index', compact('branches_posts', 'links'));
    }

    /**
     * @param $branch_alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($branch_alias)
    {
        $branch = Branch::where('alias', $branch_alias)
            ->userRead()
            ->firstOrFail();

        $posts = $branch->posts()->userReadBranches()->list()->published()->paginate(10);

        return view('posts::branches.show', compact('posts', 'branch'));
    }
}
