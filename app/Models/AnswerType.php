<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AnswerType
 *
 * @property int     $id
 * @property string  $title
 * @property string  $type
 * @property boolean $answers_required
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerType whereAnswersRequired($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerType whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\AnswerType named($type)
 * @mixin \Eloquent
 */
class AnswerType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'type', 'answers_required'];

    /**
     * @var array
     */
    protected $casts = [
        'answers_required' => 'boolean',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get Answer Type id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get title of the Answer Type.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get type of the Answer Type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Check if answers required for an Answer Type.
     *
     * @return boolean
     */
    public function isAnswersRequired()
    {
        return $this->answers_required;
    }

    /**
     * Find Answer Type by type.
     *
     * @param \Doctrine\DBAL\Query\QueryBuilder $query
     * @param string                            $type
     *
     * @return \Doctrine\DBAL\Query\QueryBuilder
     */
    public function scopeNamed($query, $type)
    {
        return $query->where('type', $type);
    }
}
