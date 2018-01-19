<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
/**
 * Model User for User management.
 *
 * Author : Prajakta Sisale.
 */
class Countries extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'countries';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * Function for countries and states relationship.
     *
     */
    public function states()
    {
        return $this->belongsTo('App\States');
    }

}