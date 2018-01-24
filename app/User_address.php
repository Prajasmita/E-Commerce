<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_address extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_address';

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
    protected $fillable = ['user_id','company_name','email','first_name','middle_name','last_name','address1','address2','title','city','state','country','zip_code','contact_no','note','primary'];

    /**
     * Function for users and user_address relationship.
     *
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    /**
     * Function for States and user_address relationship.
     *
     */
    public function states()
    {
        return $this->hasOne('App\States','id','state');
    }
    /**
     * Function for Countries and user_address relationship.
     *
     */
    public function countries()
    {
        return $this->hasOne('App\Countries','id','country');
    }



}