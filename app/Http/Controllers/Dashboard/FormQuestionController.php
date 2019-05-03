<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\FormQuestion\DeleteFormQuestionRequest;
use App\Models\Form;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class FormQuestionController extends Controller
{
    /**
     * Delete Form question from Form.
     *
     * @param DeleteFormQuestionRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFormQuestion(DeleteFormQuestionRequest $request)
    {
        try {
            $form = Form::withCount('questions')->findOrFail($request->input('form_id'));

            if ($form->questions_count < 2) {
                return response()->json([
                    'success' => false,
                    'errors'  => ['Опрос должен иметь хотя бы один вопрос.'],
                ], 403);
            }

            $question = $form->questions()->with('answers')->findOrFail($request->input('question_id'));

            DB::beginTransaction();

            $question->answers()->delete();
            $question->delete();

            DB::commit();

            return response()->json([
                'success'  => true,
                'messages' => ['Вопрос успешно удален.'],
            ]);
        } catch (ModelNotFoundException $e) {
            DB::rollBack();

            \Log::error($e->getMessage());
            \Log::error($e->getTraceAsString());

            return response()->json([
                'success' => false,
                'errors'  => ['Опрос или его вопрос не найдены.', 'Обновите страницу и попробуйте еще раз.'],
            ], 403);
        }
    }
}
