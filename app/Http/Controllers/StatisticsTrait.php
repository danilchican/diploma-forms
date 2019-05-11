<?php

namespace App\Http\Controllers;

use App\Models\AnswerType;
use App\Models\Form;
use App\Models\FormQuestion;
use Illuminate\Support\Collection;

trait StatisticsTrait
{
    protected $statisticsPrefix = 'answers.submittedAnswers';

    protected function getStatisticsRelations()
    {
        return [
            $this->statisticsPrefix . '.question.answerType',
            $this->statisticsPrefix . '.question' => function ($query) {
                $query->withCount('answers as answer_variants_count');
            },
            $this->statisticsPrefix . '.selectedAnswer',
        ];
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
            return collect($answers)->pluck('text_answer')->unique()->all();
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