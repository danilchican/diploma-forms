<?php

namespace App\Models;

use Carbon\Carbon;
use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Form
 *
 * @property-read \App\Models\User           $author
 * @property int                             $id
 * @property string                          $title
 * @property string|null                     $description
 * @property boolean                         $is_finished
 * @property boolean                         $is_published
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Form query()
 * @mixin \Eloquent
 */
class Form extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author_id', 'title', 'description',
        'is_finished', 'is_published',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_finished'  => 'boolean',
        'is_published' => 'boolean',
    ];

    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 10;

    /**
     * Get title of the form.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set title of the form.
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get description of the form.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description of the form.
     *
     * @param string|null $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Check if form voting is canceled.
     *
     * @return boolean
     */
    public function isFinished()
    {
        return $this->is_finished;
    }

    /**
     * Set finished flag for the form.
     *
     * @param boolean $value
     */
    public function setFinished($value)
    {
        $this->is_finished = $value;
    }

    /**
     * Check if form is published.
     *
     * @return boolean
     */
    public function isPublished()
    {
        return $this->is_published;
    }

    /**
     * Set published flag for the form.
     *
     * @param boolean $value
     */
    public function setPublished($value)
    {
        $this->is_published = $value;
    }

    /**
     * Get created date of the form.
     *
     * @return Carbon
     */
    public function getCreatedDate()
    {
        return $this->created_at;
    }

    /**
     * Select published forms only.
     *
     * @param QueryBuilder $query
     *
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * @param QueryBuilder $query
     * @param string       $phrase
     *
     * @return mixed
     */
    public static function scopeSearch($query, $phrase)
    {
        return $query->where('title', 'like', '%' . $phrase . '%')
            ->orWhere('description', 'like', '%' . $phrase . '%');
    }


    /**
     * Author of the Form.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * Get related form questions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(FormQuestion::class);
    }
}
