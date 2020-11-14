<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use \Auth;
use \Input;
use Modules\Users\Entities\User;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $users = User::query();

        if ($request->get('search')) {
            $search = '%'.$request->get('search').'%';

            $users = $users->where('first_name', 'like', $search)
                ->orWhere('last_name', 'like', $search)
                ->orWhere('phone', 'like', $search)
                ->orWhere('position', 'like', $search);
        }

        $users = $users->orderByDesc('created_at')->isConfirmed()->paginate(10);

        return view('users::index', compact('users'));
    }

    /**
     * @param $locale
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setLocale($locale)
    {
        if (in_array($locale, explode(',', env('SETTINGS_LOCALES')))) {
            if ($user = \Auth::user()) {
                $user->locale = $locale;
                $user->save();
            }

            \Session::put('locale', $locale);
        } else {
            abort(404, 'Locale not found.');
        }

        return redirect()->back();
    }

    /**
     * @param null $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id = null)
    {
        $user = is_null($id) ? Auth::user() : User::findOrFail($id);

        $comments = $user->comments()->whereHas('post', function ($query) {
            return $query->published()->where('is_commented', 1)->userReadBranches();
        })->latest()->paginate(10, ['*'], 'comment_page');

        $posts_comments = $comments->groupBy('post.title');
        $comments       = $comments->appends(Input::except('comment_page'));
        $comments_links = $comments->links('pagination');

        return view('users::profile', compact('user', 'posts_comments', 'comments_links'));
    }
}
