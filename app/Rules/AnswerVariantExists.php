<?php

namespace App\Rules;

use App\Models\FormQuestion;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class AnswerVariantExists implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $questionId = explode('.', $attribute)[1];

        if (!is_numeric($questionId)) {
            return false;
        }

        try {
            $question = FormQuestion::with(['answerType', 'answers'])->findOrFail($questionId);
        } catch (ModelNotFoundException $e) {
            return false;
        }

        return $this->validateByAnswerType($question, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Неверный тип ответа на вопрос.';
    }

    private function validateByAnswerType(FormQuestion $question, $value)
    {
        $answerType = $question->answerType;
        $answerVariants = $question->answers;

        if ($answerType->isAnswersRequired()) {
            if ($answerType->getType() !== 'checkbox') {
                $validator = Validator::make(['answer' => (int)$value],
                    ['answer' => 'required|integer|exists:answer_variants,id']);

                if ($validator->fails()) {
                    \Log::debug('Wrong answer variant', [$value, $validator->errors()]);
                    return false;
                }

                return true;
            }

            $checkboxValidator = Validator::make(['answers' => $value],
                ['answers' => 'required|array', 'answers.*' => 'required|integer']);

            if (!$checkboxValidator->fails()) {
                $answerVariantsIDs = $answerVariants->pluck('id');
                $value = collect($value)->map(function ($item) { return (int)$item; })->toArray();

                foreach ($value as $item) {
                    if (!$answerVariantsIDs->contains($item)) {
                        \Log::debug('Wrong answer variant', [$answerVariantsIDs, $value, $item]);
                        return false;
                    }
                }

                return true;
            }

            \Log::debug('Wrong answer variant', [$value, $checkboxValidator->errors()]);
            return false;
        }

        return !Validator::make(['answer' => $value], ['answer' => 'required'])->fails();
    }
}