<?php

namespace Tests\Unit;

use App\Models\AnswerType;
use App\Models\Form;
use App\Models\FormQuestion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FormQuestionTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_form_question()
    {
        $role = factory(\App\Models\Role::class)->create();
        $user = factory(User::class)->create(['role_id' => $role->id]);
        $answerType = factory(AnswerType::class)->create();

        $form = factory(Form::class)->create(['author_id' => $user->id]);

        FormQuestion::create([
            'title'          => 'Sample Form Question Title',
            'is_required'    => true,
            'answer_type_id' => $answerType->id,
            'form_id'        => $form->id,
        ]);

        $formQuestion = FormQuestion::firstOrFail();

        $this->assertEquals('Sample Form Question Title', $formQuestion->getTitle());
        $this->assertTrue($formQuestion->isRequired());
        $this->assertEquals($answerType->id, $formQuestion->answer_type_id);
        $this->assertEquals($form->id, $formQuestion->form_id);
    }

    public function test_form_question_should_have_an_answer_type()
    {
        $role = factory(\App\Models\Role::class)->create();
        $user = factory(User::class)->create(['role_id' => $role->id]);
        $answerType = factory(AnswerType::class)->create();

        $form = factory(Form::class)->create(['author_id' => $user->id]);

        $formQuestion = new FormQuestion([
            'title'       => 'Sample Form Question Title 2',
            'is_required' => true,
            'form_id'     => $form->id,
        ]);

        $formQuestion->answerType()->associate($answerType);
        $formQuestion->save();

        $actualFormQuestion = FormQuestion::with('answerType')->firstOrFail();

        $this->assertEquals('Sample Form Question Title 2', $actualFormQuestion->getTitle());
        $this->assertTrue($actualFormQuestion->isRequired());
        $this->assertEquals($answerType->id, $actualFormQuestion->answerType->id);
        $this->assertEquals($form->id, $actualFormQuestion->form_id);
    }

    public function test_form_question_should_have_a_form()
    {
        $role = factory(\App\Models\Role::class)->create();
        $user = factory(User::class)->create(['role_id' => $role->id]);
        $answerType = factory(AnswerType::class)->create();

        $form = factory(Form::class)->create(['author_id' => $user->id]);

        $formQuestion = new FormQuestion([
            'title'          => 'Sample Form Question Title 3',
            'answer_type_id' => $answerType->id,
        ]);

        $formQuestion->form()->associate($form);
        $formQuestion->save();

        $actualFormQuestion = FormQuestion::with('answerType')->firstOrFail();

        $this->assertEquals('Sample Form Question Title 3', $actualFormQuestion->getTitle());
        $this->assertTrue($actualFormQuestion->isRequired());
        $this->assertEquals($form->id, $actualFormQuestion->form->id);
        $this->assertEquals($answerType->id, $actualFormQuestion->answerType->id);
    }
}
