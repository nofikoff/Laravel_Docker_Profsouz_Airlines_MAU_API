<?php

namespace Modules\Posts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use \Input;
use Modules\Posts\Entities\Post;
use Modules\Users\Entities\Group;

class GroupController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $posts = Post::select([
            'posts.*',
            'groups.name as group_name',
        ])
            ->leftJoin('branch_group', 'branch_group.branch_id', '=', 'posts.branch_id')
            ->leftJoin('groups', 'groups.id', '=', 'branch_group.group_id')
            ->whereIn('posts.branch_id', \Auth::user()->read_branch_ids)
            ->list()
            ->published()
            ->paginate(10);

        $groups_posts = $posts->groupBy('group_name');

        $links = $posts->appends(Input::except('page'))->links('pagination');

        return view('posts::groups.index', compact('groups_posts', 'links'));
    }

    /**
     * @param $branch_alias
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($group_id)
    {
        /** @var Group $group */
        $group = \Auth::user()->groups()->where('group_id', $group_id)
            ->firstOrFail();

        $branch_ids = $group->branches()->pluck('branch_id');

        $posts = Post::whereIn('branch_id', $branch_ids)->userReadBranches()->list()->published()->paginate(10);

        return view('posts::groups.show', compact('posts', 'group'));
    }


}
