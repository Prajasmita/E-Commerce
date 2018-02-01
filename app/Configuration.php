<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Model Configuration for Configuration management.
 *
 * Author : Prajakta Sisale.
 */
class Configuration extends Model
{
    /**
     * The da tabase table used by the model.
     *
     * @var string
     */
    protected $table = 'configurations';

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
    protected $fillable = ['conf_key', 'conf_value','status'];

    

}
