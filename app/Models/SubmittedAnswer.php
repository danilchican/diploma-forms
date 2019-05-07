<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SubmittedAnswer
 *
 * @property-read \App\Models\FormQuestion  $question
 * @property-read \App\Models\AnswerVariant $selectedAnswer
 * @property-read \App\Models\SubmittedForm $submittedForm
 * @property int                            $id
 * @property int                            $submitted_form_id
 * @property int                            $form_question_id
 * @property int|null                       $selected_answer_variant_id
 * @property string|null                    $text_answer
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmittedAnswer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmittedAnswer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmittedAnswer query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmittedAnswer whereFormQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmittedAnswer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmittedAnswer whereSelectedAnswerVariantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmittedAnswer whereSubmittedFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmittedAnswer whereTextAnswer($value)
 * @mixin \Eloquent
 */
class SubmittedAnswer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'submitted_form_id', 'form_question_id', 'selected_answer_variant_id', 'text_answer',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get text answer for a question.
     *
     * @return string|null
     */
    public function getTextAnswer()
    {
        return $this->text_answer;
    }

    /**
     * Set text answer.
     *
     * @param string|null $answer
     */
    public function setTextAnswer($answer = null)
    {
        $this->text_answer = $answer;
    }

    /**
     * Get a related submitted form.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function submittedForm()
    {
        return $this->belongsTo(SubmittedForm::class);
    }

    /**
     * Get a related answered question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question()
    {
        return $this->belongsTo(FormQuestion::class, 'form_question_id');
    }

    /**
     * Get related selected answer for a question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function selectedAnswer()
    {
        return $this->belongsTo(AnswerVariant::class, 'selected_answer_variant_id');
    }
}
