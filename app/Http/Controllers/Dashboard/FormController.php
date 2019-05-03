<?php

namespace App\Http\Controllers\Dashboard;

use App\Exceptions\CreateFormException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Form\CreateFormRequest;
use App\Models\AnswerType;
use App\Models\AnswerVariant;
use App\Models\Form;
use App\Models\FormQuestion;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    public function showCreateFormPage()
    {
        return view('dashboard.forms.create')->with('answerTypes', AnswerType::all());
    }

    public function showFormsListPage()
    {
        $forms = Form::with('author')->latest()->paginate();
        return view('dashboard.forms.index')->with('forms', $forms);
    }

    public function showEditFormPage($id) {
        $form = Form::with(['author', 'questions.answerType'])->findOrFail($id);
        $answerTypes = AnswerType::all();
        return view('dashboard.forms.edit')->with(compact(['form', 'answerTypes']));
    }

    /**
     * Create new Form.
     *
     * @param CreateFormRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeForm(CreateFormRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->storeFormExecutor($request);
            DB::commit();

            return response()->json([
                'success'  => true,
                'messages' => ['Опрос успешно создан.'],
            ]);
        } catch (CreateFormException $e) {
            DB::rollBack();

            \Log::error($e->getMessage());
            \Log::error($e->getTraceAsString());

            return response()->json([
                'success' => false,
                'errors'  => [$e->getMessage()],
            ]);
        }
    }

    public function updateForm() {
        // TODO
    }
    /**
     * Store Form Executor.
     *
     * @param Request $request
     *
     * @throws CreateFormException
     */
    protected function storeFormExecutor(Request $request)
    {
        $user = \Auth::user();

        $form = new Form($request->only(['title', 'description']));
        $user->forms()->save($form);

        $questions = $request->input('questions');
        $questionModelsAndAnswers = collect();

        foreach ($questions as $question) {
            $questionModel = null;

            try {
                $answerType = AnswerType::named($question['selectedAnswerType'])->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw new CreateFormException('Выбран неверный тип ответа.');
            }

            $questionModel = new FormQuestion([
                'title'       => $question['title'],
                'is_required' => $question['is_required'],
            ]);

            $questionAnswers = collect();

            if (array_key_exists('answers', $question) && \is_array($question['answers'])) {
                foreach ($question['answers'] as $answer) {
                    $questionAnswers->push(new AnswerVariant(['title' => $answer]));
                }
            }

            $questionModel->answerType()->associate($answerType);
            $questionModelsAndAnswers->push(['question' => $questionModel, 'answers' => $questionAnswers]);
        }

        $form->questions()->saveMany($questionModelsAndAnswers->pluck('question'));

        $questionModelsAndAnswers->filter(function ($question) {
            return array_key_exists('answers', $question) && collect($question['answers'])->isNotEmpty();
        })->each(function ($question) {
            $question['question']->answers()->saveMany($question['answers']);
        });
    }
}
