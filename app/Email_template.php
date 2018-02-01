<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Model Email_template for email template management.
 *
 * Author : Prajakta Sisale.
 */
class Email_template extends Model
{
    /**
     * The da tabase table used by the model.
     *
     * @var string
     */
    protected $table = 'email_template';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'subject', 'content'];
}