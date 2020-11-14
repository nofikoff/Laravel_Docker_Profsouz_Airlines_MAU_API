<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingNotificationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'branch_id' => [
                'required',
                'integer',
                'exists:branches,id',
                function($attribute, $value, $fail) {
                    if(!$this->user()->notify_branch_ids->contains($value)){
                        return $fail(trans('validation.branch_access_not'));
                    }
                }
            ],

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
