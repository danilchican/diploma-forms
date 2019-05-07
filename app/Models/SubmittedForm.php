<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
     * Get related form with questions and answer variants.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
