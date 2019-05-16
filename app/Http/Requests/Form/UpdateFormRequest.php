<?php

namespace App\Http\Requests\Form;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id'                             => 'required|integer|exists:forms',
            'title'                          => 'required|min:3|max:255',
            'description'                    => 'nullable|min:3|max:1000',
            'is_published'                   => 'required|boolean',
            'is_finished'                    => 'required|boolean',
            'can_download_results'           => 'required|boolean',
            'questions'                      => 'required|array|min:1',
            'questions.*'                    => 'array',
            'questions.*.id'                 => 'nullable|integer|exists:form_questions,id',
            'questions.*.title'              => 'required|min:3|max:255',
            'questions.*.selectedAnswerType' => 'required|exists:answer_types,type',
            'questions.*.is_required'        => 'required|boolean',
            'questions.*.answers'            => 'required_if:questions.*.answer_type,radio,checkbox,select|array',
            'questions.*.answers.*.id'       => 'nullable|integer|exists:answer_variants,id',
            'questions.*.answers.*.title'    => 'required|min:1|max:255',
        ];
    }
}
