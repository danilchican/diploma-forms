<?php

namespace App\Models;

use Doctrine\DBAL\Query\QueryBuilder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SubmittedForm
 *
 * @property-read \App\Models\Form                                                       $form
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SubmittedAnswer[] $answers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SubmittedAnswer[] $submittedAnswers
 * @property int                                                                         $id
 * @property int                                                                         $form_id
 * @property string                                                                      $author_ip_address
 * @property \Illuminate\Support\Carbon|null                                             $created_at
 * @property \Illuminate\Support\Carbon|null                                             $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmittedForm newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmittedForm newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmittedForm query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmittedForm whereAuthorIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmittedForm whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmittedForm whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmittedForm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmittedForm whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmittedForm submittedBy($ip)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SubmittedForm forForm($id)
 * @mixin \Eloquent
 */
class SubmittedForm extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['form_id', 'author_ip_address'];

    /**
     * Get author IP address.
     *
     * @return string
     */
    public function getAuthorIpAddress()
    {
        return $this->author_ip_address;
    }

    /**
     * Set author IP address.
     *
     * @param string $ip_address
     */
    public function setAuthorIpAddress($ip_address)
    {
        $this->author_ip_address = $ip_address;
    }

    /**
     * Filter submitted forms by IP address of the client.
     *
     * @param QueryBuilder $query
     * @param string       $ip
     *
     * @return mixed
     */
    public function scopeSubmittedBy($query, $ip)
    {
        return $query->where('author_ip_address', $ip);
    }

    /**
     * Filter submitted form for a particular form.
     *
     * @param QueryBuilder $query
     * @param              $id
     *
     * @return mixed
     */
    public function scopeForForm($query, $id)
    {
        return $query->where('form_id', $id);
    }

    /**
     * Get related form with questions and answer variants.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    /**
     * Get user answers for a form.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function submittedAnswers()
    {
        return $this->hasMany(SubmittedAnswer::class);
    }
}
