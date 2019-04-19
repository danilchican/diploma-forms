<?php

namespace Tests\Unit;

use App\Models\AnswerType;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AnswerTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_answer_type()
    {
        AnswerType::create([
            'title'            => 'Sample Answer Type',
            'type'             => 'sample-answer-type',
            'answers_required' => true,
        ]);

        $type = AnswerType::firstOrFail();

        $this->assertEquals('Sample Answer Type', $type->getTitle());
        $this->assertEquals('sample-answer-type', $type->getType());
        $this->assertTrue($type->isAnswersRequired());
    }

    public function test_can_find_answer_type_by_type_name()
    {
        AnswerType::create([
            'title'            => 'Sample Answer Type 2',
            'type'             => 'sample-answer-type-2',
            'answers_required' => false,
        ]);

        $expectedType = AnswerType::firstOrFail();
        $actualType = AnswerType::named('sample-answer-type-2')->firstOrFail();

        $this->assertEquals($expectedType->id, $actualType->id);
        $this->assertEquals('Sample Answer Type 2', $actualType->getTitle());
        $this->assertEquals('sample-answer-type-2', $actualType->getType());
        $this->assertFalse($actualType->isAnswersRequired());
    }
}
