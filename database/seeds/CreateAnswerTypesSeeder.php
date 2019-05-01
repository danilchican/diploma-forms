<?php

use App\Exceptions\SeederException;
use Illuminate\Database\Seeder;

class CreateAnswerTypesSeeder extends Seeder
{
    const ANSWER_TYPES_PROPERTY = 'app.answer_types';

    /**
     * Run the database seeds.
     *
     * @throws SeederException
     *
     * @return void
     */
    public function run()
    {
        $answerTypes = config(self::ANSWER_TYPES_PROPERTY);

        if ($answerTypes === null) {
            throw new SeederException('Answer types to import are not found in property '
                . self::ANSWER_TYPES_PROPERTY . '. ' . $answerTypes);
        }

        foreach ($answerTypes as $type) {
            \App\Models\AnswerType::create([
                'title'            => $type['title'],
                'type'             => $type['type'],
                'answers_required' => $type['answers_required'],
            ]);
        }
    }
}
