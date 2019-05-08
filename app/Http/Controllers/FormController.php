<?php

namespace App\Http\Controllers;

use App\Exceptions\SubmitFormException;
use App\Http\Requests\Form\SubmitFormRequest;
use App\Models\Form;
use App\Models\SubmittedAnswer;
use App\Models\SubmittedForm;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class FormController extends Controller
{
    /**
     * View Form Page by Form id.
     *
     * @param $id
     *
     * @return $this
     */
    public function viewFormPage($id)
    {
        $form = Form::published()->with(['questions', 'questions.answerType', 'questions.answers'])
            ->withCount('submissions')
            ->findOrFail($id);
        $questions = $form->questions;
        $answersCount = $form->submissions_count;
        $isAlreadySubmitted = SubmittedForm::submittedBy(request()->ip())->first() !== null;
        return view('forms.view')->with(compact(['form', 'questions', 'answersCount', 'isAlreadySubmitted']));
    }

    /**
     * Submit Form by client.
     *
     * @param SubmitFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submitForm(SubmitFormRequest $request)
    {
        // TODO add validation ip address for saving by middleware
        // TODO add UI protect by ip address

        $form = Form::published()->opened()->findOrFail((int)$request->input('form-id'));
        $questionNumbers = collect($request->input('answers'))->keys()->toArray();
        $questions = $form->questions()->with('answerType')->whereIn('id', $questionNumbers)->get();

        if ($questions->count() !== \count($questionNumbers)) {
            return redirect()->back()->withInput()->with('error', 'Вы ответили не на все вопросы.');
        }

        try {
            DB::beginTransaction();
            $this->saveSubmittedForm($form, $questions, $request);
            DB::commit();
        } catch (SubmitFormException $e) {
            DB::rollBack();

            \Log::error($e->getMessage());
            \Log::error($e->getTraceAsString());

            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', 'Ваши ответы были приняты. Спасибо.');
    }

    /**
     * Save submitted form.
     *
     * @param Form       $form
     * @param Collection $questions
     * @param Request    $request
     *
     * @throws SubmitFormException
     */
    protected function saveSubmittedForm(Form $form, Collection $questions, Request $request)
    {
        $submittedForm = new SubmittedForm;
        $submittedForm->setAuthorIpAddress($request->ip());
        $submittedForm->form()->associate($form);

        if (!$submittedForm->save()) {
            throw new SubmitFormException('Невозможно сохранить результаты. Обратитесь к администратору');
        }

        $requestAnswers = $request->input('answers');
        $answers = [];

        foreach ($requestAnswers as $questionNumber => $answer) {
            $question = $questions->firstWhere('id', (int)$questionNumber);

            if ($question->answerType->isAnswersRequired()) {
                if ($question->answerType->getType() !== 'select') {
                    foreach ($answer as $item) { // answers
                        $answers[] = new SubmittedAnswer([
                            'submitted_form_id'          => $submittedForm->id,
                            'form_question_id'           => (int)$questionNumber,
                            'selected_answer_variant_id' => (int)$item,
                        ]);
                    }
                } else {
                    $answers[] = new SubmittedAnswer([
                        'submitted_form_id'          => $submittedForm->id,
                        'form_question_id'           => (int)$questionNumber,
                        'selected_answer_variant_id' => (int)$answer,
                    ]);
                }
            } else {
                $answers[] = new SubmittedAnswer([
                    'submitted_form_id' => $submittedForm->id,
                    'form_question_id'  => (int)$questionNumber,
                    'text_answer'       => $answer,
                ]);
            }

        }

        $submittedForm->answers()->saveMany($answers);
    }
}
