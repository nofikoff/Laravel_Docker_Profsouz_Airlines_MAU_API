<?php

namespace Modules\API\Http\Controllers;

use Modules\API\Http\Resources\SystemPostResource;
use Modules\Posts\Entities\SystemPost;

class SystemPostController extends APIController
{

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return SystemPostResource::collection(\Auth::user()->system_posts);
    }

    /**
     * @param SystemPost $systemPost
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(SystemPost $systemPost)
    {
        $this->authorize('destroy', $systemPost);
        return response()->json(['success' => $systemPost->delete()]);
    }
}
