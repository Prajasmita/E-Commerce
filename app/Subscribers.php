<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Model subscribers for newsletters subscription.
 *
 * Author : Prajakta Sisale.
 */
class Subscribers extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subscribers';

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
    protected $fillable = ['email'];
}