<?php
/**
 * Created by Prajakta Sisale.
 * User: webwerks
 * Date: 19/1/18
 * Time: 5:17 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Contact_us extends Model {


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'contact_us';

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
    protected $fillable = ['name', 'email','contact_no','subject','message'];


}
