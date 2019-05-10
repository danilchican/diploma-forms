<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FormTemplateQuestion
 *
 * @property-read \App\Models\AnswerType   $answerType
 * @property-read \App\Models\FormTemplate $template
 * @property int                           $id
 * @property string                        $title
 * @property int                           $answer_type_id
 * @property int                           $form_template_id
 * @property int                           $is_required
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormTemplateQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormTemplateQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormTemplateQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormTemplateQuestion whereAnswerTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormTemplateQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormTemplateQuestion whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormTemplateQuestion whereFormTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormTemplateQuestion whereIsRequired($value)
 * @mixin \Eloquent
 */
class FormTemplateQuestion extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'answer_type_id', 'form_template_id', 'is_required'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get Form Template Question id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get title of the Form Template Question.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get Form Template Question's Answer Type.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function answerType()
    {
        return $this->belongsTo(AnswerType::class);
    }

    /**
     * Get Form Template related model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function template()
    {
        return $this->belongsTo(FormTemplate::class);
    }
}
