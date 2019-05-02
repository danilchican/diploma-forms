<?php

namespace Tests\Unit;

use App\Models\AnswerType;
use App\Models\AnswerVariant;
use App\Models\Form;
use App\Models\FormQuestion;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnswerVariantTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_answer_variant()
    {
        $role = factory(\App\Models\Role::class)->create();
        $user = factory(User::class)->create(['role_id' => $role->id]);
        $answerType = factory(AnswerType::class)->create();

        $form = factory(Form::class)->create(['author_id' => $user->id]);
        $formQuestion = factory(FormQuestion::class)->create([
            'answer_type_id' => $answerType->id,
            'form_id'        => $form->id,
        ]);

        AnswerVariant::create([
            'title'            => 'Sample Answer Variant Title',
            'form_question_id' => $formQuestion->id,
        ]);

        $answerVariant = AnswerVariant::firstOrFail();

        $this->assertEquals('Sample Answer Variant Title', $answerVariant->getTitle());
        $this->assertEquals($formQuestion->id, $answerVariant->form_question_id);
    }

    public function test_answer_variant_should_have_a_form_question()
    {
        $role = factory(\App\Models\Role::class)->create();
        $user = factory(User::class)->create(['role_id' => $role->id]);
        $answerType = factory(AnswerType::class)->create();

        $form = factory(Form::class)->create(['author_id' => $user->id]);
        $formQuestion = factory(FormQuestion::class)->create([
            'answer_type_id' => $answerType->id,
            'form_id'        => $form->id,
        ]);

        $answerVariant = new AnswerVariant([
            'title' => 'Sample Answer Variant Title 1',
        ]);

        $answerVariant->formQuestion()->associate($formQuestion);
        $answerVariant->save();

        $actualAnswerVariant = AnswerVariant::with('formQuestion')->firstOrFail();

        $this->assertEquals('Sample Answer Variant Title 1', $actualAnswerVariant->getTitle());
        $this->assertEquals($formQuestion->id, $actualAnswerVariant->formQuestion->id);
    }
}
