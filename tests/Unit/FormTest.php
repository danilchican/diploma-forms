<?php

namespace Tests\Unit;

use App\Models\Form;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FormTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_form()
    {
        $adminRole = factory(\App\Models\Role::class)->state('admin')->create();
        $user = factory(User::class)->create([
            'role_id' => $adminRole->id,
        ]);

        Form::create([
            'title'       => 'Sample Form Title',
            'description' => 'Sample Form Description',
            'is_finished' => true,
            'author_id'   => $user->id,
        ]);

        $form = Form::firstOrFail();

        $this->assertEquals('Sample Form Title', $form->getTitle());
        $this->assertEquals('Sample Form Description', $form->getDescription());
        $this->assertTrue($form->isFinished());
        $this->assertEquals($user->id, $form->author_id);
    }

    public function test_form_should_have_an_author()
    {
        $adminRole = factory(\App\Models\Role::class)->state('admin')->create();
        $user = factory(User::class)->create([
            'role_id' => $adminRole->id,
        ]);

        $form = new Form([
            'title' => 'Sample Form Template Question',
        ]);

        $form->author()->associate($user);
        $form->save();

        $actualForm = Form::with('author')->firstOrFail();

        $this->assertEquals('Sample Form Template Question', $actualForm->getTitle());
        $this->assertNull($actualForm->getDescription());
        $this->assertFalse($actualForm->isFinished());
        $this->assertEquals($user->id, $actualForm->author->id);
    }
}
