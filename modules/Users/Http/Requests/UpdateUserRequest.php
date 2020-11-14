<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'last_name'        => 'required|string',
            'first_name'       => 'required|string',
            'position'         => 'nullable|string',
            'birthday'         => 'nullable|date:Y-m-d',
            'phone'            => 'required|string',
            'password'         => 'nullable|string',
            'password_confirm' => 'nullable|string',
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
