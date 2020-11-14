<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Users\Entities\Group;
use Modules\Users\Entities\User;
use Modules\Users\Services\UserBranchSetting;

class GroupController extends Controller
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $groups = Group::query();

        if ($request->get('search')) {
            $search = '%'.$request->get('search').'%';

            $groups = $groups->where('name', 'like', $search);
        }

        $groups = $groups->orderByDesc('name')->paginate(20);

        return view('admin::modules.group.list', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin::modules.group.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $group = Group::create([
            'name' => $request->get('name')
        ]);

        return redirect(route('admin.group.edit', ['id' => $group->id]));
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id, Request $request)
    {
        $group = Group::where('id', $id)->with('users')->firstOrFail();
        $users = collect();

        if ($request->get('search')) {
            foreach (explode(' ', $request->get('search')) as $item) {
                $users = $users->merge(User::search($item)->whereNotIn('id', $group->users->pluck('id'))->get());
            }
        }

        $users = $users->unique('id')->sortBy('last_name');

        return view('admin::modules.group.edit', compact('group', 'users'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update($id, Request $request)
    {
        $group = Group::find($id);
        $group->name = $request->get('name', $group->name);
        $group->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $group = Group::find($id);

        foreach ($group->users as $user) {
            $user->groups()->detach($group);
        }

        $group->delete();

        return redirect()->back();
    }

    public function updateUser(UserBranchSetting $user_setting, $id, Request $request)
    {
        $group = Group::find($id);
        $user  = User::find($request->get('user_id'));

        if ($user->hasGroup($group)) {
            $user->groups()->detach($group);
            $user_setting->attachByGroupBranches($group, $user->id);
        } else {
            $user->groups()->attach($group);
            $user_setting->detachByGroupBranches($group, $user->id);
        }

        $user->save();
    }
}
