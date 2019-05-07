<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AnswerVariant
 *
 * @property int                           $id
 * @property string                        $title
 * @property int                           $form_question_id
 * @property-read \App\Models\FormQuestion $formQuestion
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerVariant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerVariant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerVariant query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerVariant whereFormQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerVariant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerVariant whereTitle($value)
 * @mixin \Eloquent
 */
class AnswerVariant extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'form_question_id'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get title of the Answer variant.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set Answer's variant title.
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get related Form question for the Answer variant.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function formQuestion()
    {
        return $this->belongsTo(FormQuestion::class);
    }
}
