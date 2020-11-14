<?php

namespace Modules\Users\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Users\Entities\User;
use Modules\Users\Http\Requests\UpdateUserRequest;

class HomeController extends Controller
{

    public function index()
    {
        if (\Auth::user()) {
            return redirect(route('posts.index'));
        } else {
            return redirect(route('login'));
        }
    }

    public function home()
    {
        return redirect(route('posts.index'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getHomePage()
    {
        return view('users::edit', ['user' => \Auth::user()]);
    }

    /**
     * @param Request $request
     *
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function postUpdateUser(UpdateUserRequest $request)
    {
        $user = \Auth::user();

        $dublicate_rows = User::where('phone', '=', '?')
            ->where('id', '!=', '?')
            ->setBindings([User::cropPhone($request->get('phone')), $user->id])
            ->count();

        if ($dublicate_rows) {
            return redirect()->back()->with('error', trans('users::user.error_phone'));
        }

        $user->update($request->only([
            'last_name',
            'first_name',
            'position',
            'birthday',
            'phone',
        ]));

        if ($request->file('image')) {
            $file = $request->file('image');

            $filename = $request->file('image')->storeAs('public/avatars',
                uniqid().'.'.$file->getClientOriginalExtension());

            $user->img = $filename;
        }

        if ($request->get('webcam')) {
            $file = str_replace('data:image/jpeg;base64,','',$request->get('webcam'));

            $filename = 'public/avatars/'. uniqid() . '.jpeg';
            \Storage::put($filename, base64_decode($file));

            $user->img = $filename;
        }

        if ($request->get('password', false)) {
            if (strcmp($request->get('password'), $request->get('password_confirm')) !== 0) {
                return redirect()->back()->with('error', trans('users::user.error_password'));
            }

            $user->password = $request->get('password');
        }

        $user->save();

        return redirect()->back()->with('success', trans('users::user.success_update'));
    }

    public function confirmPage()
    {
        if (\Auth::user()->is_confirmed) {
            return redirect(route('posts.index'));
        }

        return view('users::auth.confirm');
    }

    public function cron()
    {
        \Artisan::call('system-post:create');
        \Artisan::call('notifications:send');

        return response('Ok.');
    }
}