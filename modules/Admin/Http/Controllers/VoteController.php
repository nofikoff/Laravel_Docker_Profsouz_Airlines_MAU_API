<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\SetWinnerRequest;
use Modules\Posts\Entities\Post;
use Illuminate\Support\Carbon;
use Modules\Posts\Entities\PostQuestionOption;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $posts = Post::whereHas('question', function($query) {
            $query->where(function($query) {
                $query->where('expiration_at', '<=', Carbon::now())->orWhere('closed', 1);
            })->where('winner_id', null);
        })->list()->paginate(10);
        return view('admin::modules.vote.list', compact('posts'));
    }

    public function setWinner(SetWinnerRequest $request)
    {
        $post_id    = $request->get('post_id');
        $option_id  = $request->get('option_id');

        $post       = Post::where('id', $post_id)
                            ->whereHas('question', function($query) use ($post_id) {
                                    $query->where(function($query) {
                                        $query->where('expiration_at', '<=', Carbon::now())->orWhere('closed', 1);
                                    })->where('winner_id', null);
                                })->list()->firstOrFail();

        if($post->question->options->contains($option_id))
        {
            $question = $post->question;
            $question->winner_id = $option_id;
            $question->save();
        }


        return back();
    }

}
