<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
/**
 * Model User for User management.
 *
 * Author : Prajakta Sisale.
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table ='users';
    protected $fillable = [
        'first_name','last_name', 'email', 'password','status','role_id','remember_token','contact_no'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Always Hash the password when we save it
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * Always capitalize the first name when we retrieve it
     */
    public function getFirstNameAttribute($value) {
        return ucfirst($value);
    }

    /**
     * Always capitalize the last name when we retrieve it
     */
    public function getLastNameAttribute($value) {
        return ucfirst($value);
    }

    /**
     * Always capitalize the first name when we save it to the database
     */
    public function setFirstNameAttribute($value) {
        $this->attributes['first_name'] = ucfirst($value);
    }

    /**
     * Always capitalize the last name when we save it to the database
     */
    public function setLastNameAttribute($value) {
        $this->attributes['last_name'] = ucfirst($value);
    }
    /**
     * Function for roles and users relationship.
     *
     */
    public function role()
    {
        return $this->belongsTo('App\Role');
    }
    /**
     * Function for user and wishlist relationship.
     *
     */
    public function user_wishlist()
    {
        return $this->hasMany('App\User_wishlist');
    }
    /**
     * Function for users and user_address relationship.
     *
     */
    public function user_address()
    {
        return $this->belongsTo('App\User_address');
    }


}
