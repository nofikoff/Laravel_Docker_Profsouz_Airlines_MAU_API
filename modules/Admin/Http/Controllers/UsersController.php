<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Users\Entities\User;
use Modules\Admin\Http\Requests\UserUpdateRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('admin::modules.users.list', [
            'users' => User::orderByDesc('id')->paginate(10),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $string = '%' . $request->get('search') . '%';
        $users = User::where('first_name', 'like', $string)
            ->orWhere('last_name', 'like', $string)
            ->orWhere('phone', 'like', $string)
            ->orWhere('position', 'like', $string)
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin::modules.users.list', [
            'users' => $users,
        ]);
    }

    /**
     * @param $user_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirm($user_id)
    {
        $user = User::findOrFail($user_id);

        $user->is_confirmed = $user->is_confirmed ? false : true;

        $user->save();
        return redirect()->route('admin.users.item', $user_id);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showNotVerified()
    {
        return view('admin::modules.users.list', [
            'users' => User::where('is_confirmed', false)->orderByDesc('id')->paginate(10),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showVerified()
    {
        return view('admin::modules.users.list', [
            'users' => User::where('is_confirmed', true)->orderByDesc('id')->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($user_id)
    {
        return view('admin::modules.users.item', [
            'user' => User::findOrFail($user_id),
        ]);
    }

    /**
     * @param Request $request
     * @param $user_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateRoles(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        $user->roles()->sync($request->get('role'));

        return redirect()->route('admin.users.item', $user_id);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UserUpdateRequest $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->phone = $request->get('phone');
        $user->position = $request->get('position');
        $user->birthday = $request->get('birth_date');
        $user->save();
        return redirect()->route('admin.users.list');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
