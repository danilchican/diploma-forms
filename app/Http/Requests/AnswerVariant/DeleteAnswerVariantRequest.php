<?php

namespace App\Http\Requests\AnswerVariant;

use Illuminate\Foundation\Http\FormRequest;

class DeleteAnswerVariantRequest extends FormRequest
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
            'id' => 'required|integer|exists:answer_variants,id',
        ];
    }
}
