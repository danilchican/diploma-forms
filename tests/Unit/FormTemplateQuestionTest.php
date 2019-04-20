<?php

namespace Tests\Unit;

use App\Models\AnswerType;
use App\Models\FormTemplateQuestion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FormTemplateQuestionTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_form_template_question()
    {
        $answerType = factory(AnswerType::class)->create();

        FormTemplateQuestion::create([
            'title'          => 'Sample Form Template Question',
            'answer_type_id' => $answerType->id,
        ]);

        $templateQuestion = FormTemplateQuestion::firstOrFail();

        $this->assertEquals('Sample Form Template Question', $templateQuestion->getTitle());
        $this->assertEquals($answerType->id, $templateQuestion->answer_type_id);
    }

    public function test_template_question_should_have_an_answer_type()
    {
        $answerType = factory(AnswerType::class)->create();

        $templateQuestion = new FormTemplateQuestion([
            'title' => 'Sample Form Template Question',
        ]);

        $templateQuestion->answerType()->associate($answerType);
        $templateQuestion->save();

        $actualTemplateQuestion = FormTemplateQuestion::with('answerType')->firstOrFail();

        $this->assertEquals('Sample Form Template Question', $actualTemplateQuestion->getTitle());
        $this->assertEquals($answerType->id, $actualTemplateQuestion->answerType->id);
    }
}
