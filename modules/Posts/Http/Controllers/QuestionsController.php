<?php

namespace Modules\Posts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Posts\Entities\PostQuestion;
use Modules\Posts\Entities\PostQuestionOption;

class QuestionsController extends Controller
{

    public function vote(Request $request)
    {
        $option = PostQuestionOption::findOrFail($request->get('question_option_id'));

        $option->question->votes()->create([
            'user_id' => \Auth::id(),
            'post_question_option_id' => $option->id
        ]);

        return redirect()->back();
    }

}
