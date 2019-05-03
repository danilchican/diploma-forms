<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\AnswerVariant\DeleteAnswerVariantRequest;
use App\Http\Controllers\Controller;
use App\Models\AnswerVariant;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AnswerVariantController extends Controller
{
    public function deleteAnswerVariant(DeleteAnswerVariantRequest $request)
    {
        try {
            $answerVariant = AnswerVariant::findOrFail($request->input('id'));
            $answerVariant->delete();

            return response()->json([
                'success'  => true,
                'messages' => ['Вариант ответа успешно удален.'],
            ]);
        }catch (ModelNotFoundException $e) {
            \Log::error($e->getMessage());
            \Log::error($e->getTraceAsString());

            return response()->json([
                'success' => false,
                'errors'  => ['Вариант ответа не найден.', 'Обновите страницу и попробуйте еще раз.'],
            ], 403);
        }
    }
}
