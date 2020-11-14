<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Posts\Entities\Post;

class SetWinnerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'post_id' =>[
                'required',
                'exists:posts,id',
                function($attribute, $value, $fail) {
                    if(Post::find($value)->status != Post::STATUS_PUBLISHED){
                        return $fail(trans('validation.die'));
                    }
                }
            ]

        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
