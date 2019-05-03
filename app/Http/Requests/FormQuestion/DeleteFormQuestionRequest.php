<?php

namespace App\Http\Requests\FormQuestion;

use Illuminate\Foundation\Http\FormRequest;

class DeleteFormQuestionRequest extends FormRequest
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
            'form_id'     => 'required|integer|exists:forms,id',
            'question_id' => 'required|integer|exists:form_questions,id',
        ];
    }
}
