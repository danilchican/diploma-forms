<?php

namespace App\Http\Requests\Form;

use Illuminate\Foundation\Http\FormRequest;

class CreateFormRequest extends FormRequest
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
            'title'                          => 'required|min:3|max:255',
            'is_published'                   => 'required|boolean',
            'description'                    => 'nullable|min:3|max:1000',
            'questions'                      => 'required|array|min:1',
            'questions.*'                    => 'array',
            'questions.*.title'              => 'required|min:3|max:255',
            'questions.*.selectedAnswerType' => 'required|exists:answer_types,type',
            'questions.*.is_required'        => 'required|boolean',
            'questions.*.answers'            => 'required_if:questions.*.answer_type,radio,checkbox,select|array',
            'questions.*.answers.*.title'    => 'required|min:1|max:255',
        ];
    }
}
