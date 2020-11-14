<?php

namespace Modules\API\Http\Controllers;

use Illuminate\Http\Request;
use Modules\API\Http\Resources\BranchResource;
use Modules\API\Http\Resources\PostResource;
use Modules\API\Http\Resources\UserResource;
use Modules\Posts\Entities\Branch;
use Modules\Users\Entities\User;

class ProfileController extends APIController
{

    /**
     * @param User $user
     * @return UserResource
     */
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getUserPosts(User $user)
    {
        $posts = $user->posts()->userReadBranches()->published()->list()->orderByDesc('created_at')->paginate(10);

        return PostResource::collection($posts);
    }

    /**
     * @return UserResource
     */
    public function getUser(): UserResource
    {
        return new UserResource(\Auth::user());
    }

    /**
     * @param $branch_alias
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function branchUsers($branch_alias)
    {
        $branch_user_ids = Branch::where('alias', $branch_alias)->firstOrFail()->user_ids;

        return UserResource::collection(User::whereIn('id', $branch_user_ids)->get());
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function branchAccessUser()
    {
        return BranchResource::collection(Branch::postable()->userAccess()->get(['id', 'name']));
    }

    /**
     * @param User $user
     * @param Request $request
     * @return UserResource
     */
    public function confirmUser(User $user, Request $request)
    {
        if (! \Auth::user()->is_editor()) {
            abort(403);
        }
        $user->is_confirmed = $request->get('is_confirmed', ! $user->is_confirmed);
        $user->save();

        return new UserResource($user);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getUserContacts()
    {
        return UserResource::collection(User::where('id', '!=', \Auth::id())->search(request('search'))->get());
    }
}
