<?php

use App\Exceptions\SeederException;
use Illuminate\Database\Seeder;

class CreateFormTemplatesSeeder extends Seeder
{
    const FORM_TEMPLATES_PROPERTY = 'app.form_templates';

    /**
     * Run the database seeds.
     *
     * @throws SeederException
     *
     * @return void
     */
    public function run()
    {
        $formTemplates = config(self::FORM_TEMPLATES_PROPERTY);

        if ($formTemplates === null) {
            throw new SeederException('Form templates to import are not found in property '
                . self::FORM_TEMPLATES_PROPERTY . '. ' . $formTemplates);
        }

        $answerTypes = \App\Models\AnswerType::all();

        foreach ($formTemplates as $template) {
            $templateModel = \App\Models\FormTemplate::create([
                'title'       => $template['title'],
                'description' => $template['description'],
            ]);

            $questions = $template['questions'];
            $questionModels = [];

            foreach ($questions as $question) {
                $answerType = $answerTypes->firstWhere('type', $question['answer_type']);

                $q = new \App\Models\FormTemplateQuestion([
                    'title'       => $question['title'],
                    'is_required' => $question['is_required'],
                ]);

                $q->answerType()->associate($answerType);
                $questionModels[] = $q;
            }

            $templateModel->questions()->saveMany($questionModels);

            $questions = collect($questions);

            foreach ($questionModels as $question) {
                if (!$question->answerType->isAnswersRequired()) {
                    continue;
                }

                $plainQuestion = $questions->firstWhere('title', $question->getTitle());

                $answers = collect($plainQuestion['answer_variants'])->map(function ($item) {
                    return new \App\Models\AnswerVariantTemplate(['title' => $item]);
                });

                $question->answerVariants()->saveMany($answers);
            }
        }
    }
}
