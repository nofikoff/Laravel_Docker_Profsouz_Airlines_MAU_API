<?php

namespace Modules\Users\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Posts\Entities\Branch;
use Modules\Users\Http\Requests\SettingNotificationRequest;
use Modules\Users\Repositories\SettingNotificationRepository;

class SettingNotificationController extends Controller
{
    public $repo;

    public function __construct(SettingNotificationRepository $repository)
    {
        $this->repo = $repository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('users::settings.notifications', [
            'branches' => $this->repo->getBranches(\Auth::user())
        ]);
    }

    /**
     * @param SettingNotificationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function branchFollow(SettingNotificationRequest $request)
    {
        $this->repo->branchFollow(\Auth::user(), $request->get('branch_id'), $request->get('urgent'));

        return back();
    }

    /**
     * @param SettingNotificationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function branchUnfollow(SettingNotificationRequest $request)
    {
        $this->repo->branchUnfollow(\Auth::user(), $request->get('branch_id'));

        return back();
    }

}
