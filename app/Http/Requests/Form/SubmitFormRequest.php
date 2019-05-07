<?php

namespace App\Http\Requests\Form;

use App\Rules\AnswerVariantExists;
use Illuminate\Foundation\Http\FormRequest;

class SubmitFormRequest extends FormRequest
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
            'form-id'   => 'required|integer|exists:forms,id',
            'answers'   => 'required|array',
            'answers.*' => ['required', new AnswerVariantExists]
        ];
    }
}
