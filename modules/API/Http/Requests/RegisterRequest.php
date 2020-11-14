<?php

namespace Modules\API\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Users\Entities\User;

class RegisterRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'phone'                 => 'required|string|size:12|unique:users',
            'first_name'            => 'required|string|max:255',
            'last_name'             => 'required|string|max:255',
            'password'              => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|string|min:6|same:password',
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->has('phone')) {
            $this->merge(['phone' => User::cropPhone($this->phone)]);
        }
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
