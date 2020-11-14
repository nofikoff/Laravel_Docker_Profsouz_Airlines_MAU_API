<?php

namespace Modules\API\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\SetWinnerRequest;
use Modules\API\Http\Resources\OptionResource;
use Modules\Posts\Entities\Post;
use Modules\Posts\Entities\PostQuestion;
use Modules\Posts\Entities\PostQuestionOption;

class QuestionController extends Controller
{

    public function vote(Request $request)
    {
        $option = PostQuestionOption::findOrFail($request->get('question_option_id'));

        $status = $option->question->votes()->create([
            'user_id'                 => \Auth::id(),
            'post_question_option_id' => $option->id
        ]);

        return response()->json(['success' => (bool)$status]);
    }

    public function getOptions($id)
    {
        $question = Post::where('id', $id)->where('type', Post::TYPE_QUESTION)->firstOrFail()->question;

        return OptionResource::collection($question->options);
    }

    public function setWinner(SetWinnerRequest $request)
    {
        $post_id   = $request->get('post_id');
        $option_id = $request->get('option_id');
        $result    = false;

        $post = Post::where('id', $post_id)
            ->whereHas('question', function ($query) use ($post_id) {
                $query->where(function ($query) {
                    $query->where('expiration_at', '<=', Carbon::now())->orWhere('closed', 1);
                })->where('winner_id', null);
            })->list()->firstOrFail();

        if ($post->question->options->contains($option_id)) {
            $question            = $post->question;
            $question->winner_id = $option_id;
            $result              = $question->save();
        }

        return response()->json(['success' => $result]);
    }
}
