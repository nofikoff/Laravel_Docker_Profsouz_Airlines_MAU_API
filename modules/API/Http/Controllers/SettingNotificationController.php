<?php

namespace Modules\API\Http\Controllers;

use Modules\API\Http\Resources\SettingNotificationBranchResource;
use Modules\Users\Http\Requests\SettingNotificationRequest;

class SettingNotificationController extends \Modules\Users\Http\Controllers\SettingNotificationController
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\View\View
     */
    public function index()
    {
        return SettingNotificationBranchResource::collection($this->repo->getBranches(\Auth::user()));
    }

    /**
     * @param SettingNotificationRequest $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function branchFollow(SettingNotificationRequest $request)
    {
        $this->repo->branchFollow(\Auth::user(), $request->get('branch_id'), $request->get('urgent'));
    }

    /**
     * @param SettingNotificationRequest $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function branchUnfollow(SettingNotificationRequest $request)
    {
        $this->repo->branchUnfollow(\Auth::user(), $request->get('branch_id'));
    }
}
