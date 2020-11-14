<?php

namespace Modules\Documents\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Posts\Entities\Branch;

class StoreRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'branch_id'   => [
                'required',
                'exists:branches,id',
                function ($attribute, $value, $fail) {
                    $branch = Branch::find($value);
                    if ($branch->type != Branch::TYPE_DOCUMENT) {
                        return $fail(trans('validation.invalid_branch_type'));
                    }
                }
            ],
            'file'        => 'required|file',
            'description' => 'required|between:6,255',
            //'tags'        => 'required|array',
            'importance'  => 'nullable|in:0,1',
            'notify'      => 'nullable|in:0,1',
            'status'      => 'required|in:published,draft'
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
