<?php

namespace Modules\Posts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Posts\Entities\SystemPost;

class SystemPostController extends Controller
{

    /**
     * @param Request $request
     * @param SystemPost $system_post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Request $request, SystemPost $system_post)
    {
        $system_post->delete();

        return back();
    }
}
