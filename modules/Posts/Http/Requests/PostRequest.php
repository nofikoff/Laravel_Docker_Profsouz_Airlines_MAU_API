<?php

namespace Modules\Posts\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Posts\Entities\Branch;
use Modules\Posts\Entities\Post;

class PostRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'branch_id'     => [
                'required',
                'integer',
                'exists:branches,id',
                function ($attribute, $value, $fail) {
                    if (! \Auth::user()->hasAccessToBranchId((int)$value)) {
                        return $fail(trans('validation.branch_access_not'));
                    }
                },
                function ($attribute, $value, $fail) {
                    $branch = Branch::find($value);
                    if (!in_array($branch->type, [Branch::TYPE_POST, Branch::TYPE_FINN_HELP])) {
                        return $fail(trans('validation.invalid_branch_type'));
                    }

                    if($branch->type == Branch::TYPE_FINN_HELP && $this->type != Post::TYPE_FINN_HELP) {
                        return $fail(trans('validation.invalid_branch_type'));
                    }
                }
            ],
            'title'         => 'required|string|max:255',
            'attachments.*' => 'nullable|file|mimes:pdf,doc,docx,txt,xls,xlsx,opt,rtf'
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
