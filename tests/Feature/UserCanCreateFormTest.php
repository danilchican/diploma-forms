<?php

namespace Tests\Feature;

use App\Models\Form;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class UserCanCreateFormTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed');
    }


    public function test_user_can_create_valid_form()
    {
        $this->disableExceptionHandling();

        $user = factory(User::class)->create([
            'role_id' => Role::named(Role::ADMIN_ROLE_SLUG)->firstOrFail()->id,
        ]);

        try {
            $response = $this->actingAs($user)->post('/dashboard/forms/create', $this->getValidData());
        } catch (ValidationException $e) {
            var_dump($e->errors());
            $this->fail($e->getMessage());
        }

        $response->assertSessionHasNoErrors();
        $response->assertStatus(200);
        $response->assertJsonStructure(['success', 'messages']);
        $response->assertJsonFragment(['success' => true]);
        $response->assertJsonFragment(['messages' => ['Опрос успешно создан.']]);

        $this->assertEquals(1, Form::count());
        $this->assertGeneralFormDetails($user);
    }

    private function assertGeneralFormDetails(User $user)
    {
        $form = Form::with(['questions.answerType', 'questions.answers', 'author'])->firstOrFail();

        // check form
        $this->assertEquals('Title of the form', $form->getTitle());
        $this->assertEquals('Description of the form', $form->getDescription());
        $this->assertEquals($user->id, $form->author->id);

        // check questions
        $this->assertEquals(2, $form->questions->count());

        $firstQuestion = $form->questions->first();
        $firstQuestionAnswers = $firstQuestion->answers;

        $this->assertEquals('First Question Title', $firstQuestion->getTitle());
        $this->assertTrue($firstQuestion->isRequired());
        $this->assertEquals('checkbox', $firstQuestion->answerType->type);
        $this->assertEquals(2, $firstQuestionAnswers->count());
        $this->assertEquals('Yes', $firstQuestionAnswers->first()->getTitle());
        $this->assertEquals('No', $firstQuestionAnswers->last()->getTitle());

        $secondQuestion = $form->questions->last();
        $this->assertEquals('Second Question Title', $secondQuestion->getTitle());
        $this->assertFalse($secondQuestion->isRequired());
        $this->assertEquals('text', $secondQuestion->answerType->type);
        $this->assertEquals(0, $secondQuestion->answers->count());
    }

    private function getValidData()
    {
        return [
            'title'       => 'Title of the form',
            'description' => 'Description of the form',
            'questions'   => [
                [
                    'title'              => 'First Question Title',
                    'is_required'        => '1',
                    'selectedAnswerType' => 'checkbox',
                    'answers'            => [
                        ['title' => 'Yes'],
                        ['title' => 'No'],
                    ],
                ],
                [
                    'title'              => 'Second Question Title',
                    'is_required'        => false,
                    'selectedAnswerType' => 'text',
                ],
            ],
        ];
    }
}
