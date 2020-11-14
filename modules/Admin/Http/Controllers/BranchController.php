<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Posts\Entities\Branch;
use Modules\Users\Entities\Group;
use Modules\Users\Entities\Permission;
use Modules\Users\Entities\User;

class BranchController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $branches = Branch::query();

        if ($request->get('search')) {
            $search = '%'.$request->get('search').'%';

            $branches = $branches->where(function ($q) use ($search) {
                /** @var Builder $q */
                return $q->where('name', 'like', $search)
                    ->orWhere('alias', 'like', $search)
                    ->orWhere('description', 'like', $search);
            });
        } else {
            $branches = $branches->where('parent_id', 0);
        }

        $branches = $branches->orderBy('name')->paginate(10);

        return view('admin::modules.branch.list', compact('branches'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $branches = Branch::orderBy('name')->get();
        $groups   = Group::orderBy('name')->get();

        $permissions = Permission::all();

        return view('admin::modules.branch.create',
            compact('branches', 'groups', 'permissions'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $branch = new Branch($request->only([
            'name',
            'description',
            'type',
            'is_inherit'
        ]));

        if ($request->get('parent_id', 0) !== 0) {
            $parent = Branch::find($request->get('parent_id'));
            $branch->parent_id = $parent->id;
        } else {
            $branch->parent_id = 0;
        }

        $branch->save();

        return redirect(route('admin.branch.edit', ['id' => $branch->id]));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $branch   = Branch::find($id);
        $branches = Branch::where('id', '!=', $id)->where('parent_id', '!=', $id)->orderBy('name')->get();
        $groups   = Group::orderBy('name')->get();

        $permissions = Permission::all();

        return view('admin::modules.branch.edit',
            compact('branch', 'branches', 'groups', 'permissions'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, Request $request)
    {
        $branch = Branch::find($id);

        $branch->name        = $request->get('name', $branch->name);
        $branch->description = $request->get('description', null);
        $branch->type        = $request->get('type', $branch->type);
        $branch->is_inherit  = $request->has('is_inherit');

        if ($request->get('parent_id')) {
            $parent_branch     = Branch::find($request->get('parent_id'));
            $branch->parent_id = $parent_branch->id;
        } else {
            $branch->parent_id = 0;
        }

        $branch->save();

        return redirect()->back();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        /** @var Branch $branch */
        $branch = Branch::find($id);

        foreach ($branch->children as $child) {
            $child->parent_id = $branch->parent_id;
            $child->save();
        }

        /** @var User $user */
        $branch->groups()->detach($branch->groups);

        $branch->delete();

        return redirect()->back();
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getGroups($id, Request $request)
    {
        $branch      = Branch::find($id);
        $groups      = Group::all();
        $permissions = Permission::all();

        return view('admin::modules.branch.groups', compact('branch', 'groups', 'permissions'));
    }

    /**
     * @param $id
     * @param Request $request
     */
    public function updateGroups($id, Request $request)
    {
        /** @var Branch $branch */
        $branch     = Branch::find($id);
        $group      = Group::find($request->get('group'));
        $permission = Permission::find($request->get('permission'));

        if ($group->hasBranchPermission($branch, $permission)) {
            $group->detachBranchPermission($branch, $permission);
        } else {
            $group->attachBranchPermission($branch, $permission);
        }

        $group->save();
    }
}
