<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AnswerVariantTemplate
 *
 * @property int                                   $id
 * @property string                                $title
 * @property int                                   $form_template_question_id
 * @property-read \App\Models\FormTemplateQuestion $formTemplateQuestion
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerVariantTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerVariantTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerVariantTemplate query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerVariantTemplate
 *         whereFormTemplateQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerVariantTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerVariantTemplate whereTitle($value)
 * @mixin \Eloquent
 */
class AnswerVariantTemplate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'form_template_question_id'];

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
    public function formTemplateQuestion()
    {
        return $this->belongsTo(FormTemplateQuestion::class);
    }
}
