<?php

namespace App\Http\Controllers\Dashboard;

use App\Exceptions\CreateFormException;
use App\Exceptions\UpdateFormException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Form\CreateFormRequest;
use App\Http\Requests\Form\UpdateFormRequest;
use App\Models\AnswerType;
use App\Models\AnswerVariant;
use App\Models\Form;
use App\Models\FormQuestion;
use App\Models\FormTemplate;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Mavinoo\LaravelBatch\LaravelBatchFacade as Batch;

class FormController extends Controller
{
    public function showCreateFormPage(Request $request)
    {
        $answerTypes = AnswerType::all();
        $hasTemplate = false;
        $data = compact(['answerTypes', 'hasTemplate']);

        if ($request->has('template')) {
            $hasTemplate = true;
            $template = FormTemplate::with('questions.answerVariants', 'questions.answerType')
                ->findOrFail($request->template);

            $data = array_merge($data, compact(['hasTemplate', 'template']));
        }

        return view('dashboard.forms.create')->with($data);
    }

    public function showFormsListPage()
    {
        $forms = Form::with('author')->latest()->paginate();
        return view('dashboard.forms.index')->with('forms', $forms);
    }

    /**
     * Show Edit Form Page.
     *
     * @param $id
     *
     * @return $this
     */
    public function showEditFormPage($id)
    {
        $form = Form::with(['author', 'questions.answerType', 'questions.answers'])->findOrFail($id);
        $answerTypes = AnswerType::all();
        return view('dashboard.forms.edit')->with(compact(['form', 'answerTypes']));
    }

    /**
     * Show View Results page of the form.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showViewResultsFormPage($id)
    {
        $prefix = 'answers.submittedAnswers';

        $relations = [
            $prefix . '.question.answerType',
            $prefix . '.question' => function ($query) {
                $query->withCount('answers as answer_variants_count');
            },
            $prefix . '.selectedAnswer',
        ];

        $form = Form::with($relations)->findOrFail($id);
        $questionsWithAnswers = collect($this->calculateStatistics($form));

        return view('dashboard.forms.view')->with(compact(['form', 'questionsWithAnswers']));
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
        } catch (CreateFormException | UpdateFormException $e) {
            DB::rollBack();

            \Log::error($e->getMessage());
            \Log::error($e->getTraceAsString());

            return response()->json([
                'success' => false,
                'errors'  => [$e->getMessage()],
            ], 403);
        }
    }

    /**
     * Update an existing Form.
     *
     * @param UpdateFormRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateForm(UpdateFormRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->updateFormExecutor($request);
            DB::commit();

            return response()->json([
                'success'  => true,
                'messages' => ['Опрос успешно обновлен.'],
            ]);
        } catch (CreateFormException | UpdateFormException $e) {
            DB::rollBack();

            \Log::error($e->getMessage());
            \Log::error($e->getTraceAsString());

            return response()->json([
                'success' => false,
                'errors'  => [$e->getMessage()],
            ], 403);
        }
    }

    /**
     * Store Form Executor.
     *
     * @param Request $request
     *
     * @throws CreateFormException
     * @throws UpdateFormException
     */
    protected function storeFormExecutor(Request $request)
    {
        $user = \Auth::user();

        $form = new Form($request->only(['title', 'description', 'is_published']));
        $user->forms()->save($form);

        $questions = $request->input('questions');

        $this->saveQuestionsAndTheirAnswerVariants($questions, $form);
    }

    /**
     * Update Form Executor.
     *
     * @param Request $request
     *
     * @throws \App\Exceptions\CreateFormException
     * @throws UpdateFormException
     */
    protected function updateFormExecutor(Request $request)
    {
        try {
            $form = Form::with(['questions', 'questions.answerType', 'questions.answers'])
                ->findOrFail($request->input('id'));
            $form->update($request->only(['title', 'description', 'is_finished', 'is_published']));

            $questions = collect($request->input('questions'));

            $newQuestions = $questions
                ->filter(function ($question) { return !array_key_exists('id', $question); })
                ->toArray();
            $oldQuestions = $questions
                ->filter(function ($question) { return array_key_exists('id', $question); })
                ->toArray();

            $this->saveQuestionsAndTheirAnswerVariants($newQuestions, $form, false);
            $this->updateExistingQuestionsAndTheirAnswerVariants($form->questions, $oldQuestions);
        } catch (ModelNotFoundException | MassAssignmentException $e) {
            throw new UpdateFormException('Опрос, который вы пытаетесь обновить, не найден.');
        } catch (UpdateFormException $e) {
            throw $e;
        }
    }

    /**
     * Save questions and related answer variants.
     *
     * @param      $newQuestions
     * @param      $form
     *
     * @param bool $isNewForm
     *
     * @throws CreateFormException
     * @throws UpdateFormException
     */
    protected function saveQuestionsAndTheirAnswerVariants($newQuestions, $form, $isNewForm = true)
    {
        $newQuestionModelsAndAnswers = collect();

        foreach ($newQuestions as $question) {
            $questionModel = null;

            try {
                $answerType = AnswerType::named($question['selectedAnswerType'])->firstOrFail();
            } catch (ModelNotFoundException $e) {
                if ($isNewForm) {
                    throw new CreateFormException('Выбран неверный тип ответа.');
                }
                throw new UpdateFormException('Выбран неверный тип ответа.');
            }

            $questionModel = new FormQuestion([
                'title'       => $question['title'],
                'is_required' => $question['is_required'],
            ]);

            $questionAnswers = collect();

            if (array_key_exists('answers', $question) && \is_array($question['answers'])) {
                foreach ($question['answers'] as $answer) {
                    $questionAnswers->push(new AnswerVariant(['title' => $answer['title']]));
                }
            }

            $questionModel->answerType()->associate($answerType);
            $newQuestionModelsAndAnswers->push(['question' => $questionModel, 'answers' => $questionAnswers]);
        }

        $form->questions()->saveMany($newQuestionModelsAndAnswers->pluck('question'));

        $newQuestionModelsAndAnswers->filter(function ($question) {
            return array_key_exists('answers', $question) && collect($question['answers'])->isNotEmpty();
        })->each(function ($question) {
            $question['question']->answers()->saveMany($question['answers']);
        });
    }

    /**
     * Update existing questions and their answer variants.
     *
     * @param Collection $questionModels
     * @param            $oldQuestions
     *
     * @throws UpdateFormException
     */
    protected function updateExistingQuestionsAndTheirAnswerVariants(Collection $questionModels, $oldQuestions)
    {
        foreach ($oldQuestions as $question) {
            $questionModel = $questionModels->firstWhere('id', $question['id']);

            if ($questionModel === null) {
                throw new UpdateFormException('Возникли проблемы с обновлением опроса. Обратитесь к администратору.');
            }

            $questionModel->setTitle($question['title']);
            $questionModel->setRequired($question['is_required']);

            try {
                $answerType = AnswerType::named($question['selectedAnswerType'])->firstOrFail();
            } catch (ModelNotFoundException $e) {
                throw new UpdateFormException('У вопроса выбран неверный тип ответа.');
            }

            $questionModel->answerType()->associate($answerType);
            $questionModel->save();

            if ($answerType->isAnswersRequired()) {
                if (array_key_exists('answers', $question) && \is_array($question['answers'])) {
                    $allAnswers = collect($question['answers']);

                    $newAnswers = $allAnswers
                        ->filter(function ($answer) { return !array_key_exists('id', $answer); })
                        ->map(function ($answer) { return new AnswerVariant($answer); });

                    $oldAnswers = $allAnswers
                        ->filter(function ($answer) { return array_key_exists('id', $answer); })
                        ->toArray();

                    Batch::update(new AnswerVariant, $oldAnswers, 'id');
                    $questionModel->answers()->saveMany($newAnswers);
                }
            } else {
                $questionModel->answers()->delete();
            }
        }
    }

    private function calculateStatistics(Form $form)
    {
        $statistics = [];
        $answers = $form->answers->pluck('submittedAnswers')->collapse()->all();

        $questions = collect($answers)->pluck('question')->unique()->all();
        $answers = collect($answers)->groupBy('question.id');

        foreach ($questions as $question) {
            $statistics[] = $this->calculateQuestionStatistic($question, $answers->get($question->id));
        }

        return $statistics;
    }

    private function calculateQuestionStatistic(FormQuestion $question, $answers)
    {
        $diagramType = $this->defineDiagramType($question->answerType, $question->answer_variants_count);

        return [
            'question_title' => $question->getTitle(),
            'diagram'        => $diagramType,
            'answers'        => $this->defineQuestionAnswersStatistic($answers, $diagramType),
            'total_answers'  => $answers->count(),
        ];
    }

    private function defineQuestionAnswersStatistic(Collection $answers, string $diagramType)
    {
        $answersCount = $answers->count();
        $answers = $answers->toArray();

        if ($diagramType === 'list') {
            return collect($answers)->pluck('text_answer')->all();
        }

        $needToOrderAnswers = $diagramType === 'horizontal';
        $statistics = collect();

        $groupedAnswers = collect($answers)->groupBy('selected_answer.title')->all();

        foreach ($groupedAnswers as $answerTitle => $answer) {
            $statistics->push([
                'title'      => $answerTitle,
                'count'      => \count($answer),
                'percentage' => round(\count($answer) / $answersCount * 100, 2),
            ]);
        }

        return $needToOrderAnswers ? $statistics->sortByDesc('count')->all() : $statistics->all();
    }

    private function defineDiagramType(AnswerType $answerType, $answerVariantsCount)
    {
        if (!$answerType->isAnswersRequired()) {
            return 'list';
        }

        if ($answerVariantsCount > 5) {
            return 'horizontal';
        }

        return 'pie';
    }
}
