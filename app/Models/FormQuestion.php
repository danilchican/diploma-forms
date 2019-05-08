<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FormQuestion
 *
 * @property-read \App\Models\AnswerType                                               $answerType
 * @property-read \App\Models\Form                                                     $form
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\AnswerVariant[] $answers
 * @property int                                                                       $id
 * @property string                                                                    $title
 * @property int                                                                       $form_id
 * @property int                                                                       $answer_type_id
 * @property boolean                                                                   $is_required
 * @property string|null                                                               $created_at
 * @property string|null                                                               $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormQuestion whereAnswerTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormQuestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormQuestion whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormQuestion whereIsRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormQuestion whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormQuestion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FormQuestion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'form_id', 'answer_type_id', 'is_required',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['is_required' => 'boolean'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get title of the question.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set question title.
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Set required flag.
     *
     * @param boolean $required
     */
    public function setRequired($required)
    {
        $this->is_required = $required;
    }

    /**
     * Check if question is required of form.
     *
     * @return boolean
     */
    public function isRequired()
    {
        return $this->is_required;
    }

    /**
     * Check if question is need to chosen answer.
     *
     * @return bool
     */
    public function isNeedToChooseAnswer()
    {
        return $this->answerType->isAnswersRequired();
    }

    /**
     * Get related form for the question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    /**
     * Get answer type of the form.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function answerType()
    {
        return $this->belongsTo(AnswerType::class);
    }

    /**
     * Get related answers for a question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(AnswerVariant::class);
    }
}
