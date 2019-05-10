<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FormTemplate
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FormTemplateQuestion[] $questions
 * @property int                                                                              $id
 * @property string                                                                           $title
 * @property string|null                                                                      $description
 * @property \Illuminate\Support\Carbon                                                       $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormTemplate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormTemplate whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormTemplate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormTemplate whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormTemplate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormTemplate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\FormTemplate query()
 * @mixin \Eloquent
 */
class FormTemplate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description'];

    const UPDATED_AT = null;

    /**
     * Get title of the Form template.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title of the Form template.
     *
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * Get description of the Form template.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description of the Form template.
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get created date of the form template.
     *
     * @return Carbon
     */
    public function getCreatedDate()
    {
        return $this->created_at;
    }

    /**
     * Get related template questions for a Form template.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(FormTemplateQuestion::class);
    }
}
