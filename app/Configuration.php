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


    /**
     * Always capitalize the Configuration key when we retrieve it
     */
    public function getConfKeyAttribute($value) {
        return ucfirst($value);
    }

    /**
     * Always capitalize the configuration value when we retrieve it
     */
    public function getConfValueAttribute($value) {
        return ucfirst($value);
    }

    /**
     * Always capitalize the Configuration key when we save it to the database
     */
    public function setConfKeyAttribute($value) {
        $this->attributes['conf_key'] = ucfirst($value);
    }

    /**
     * Always capitalize the configuration value when we save it to the database
     */
    public function setConfValueAttribute($value) {
        $this->attributes['conf_value'] = ucfirst($value);
    }



}
