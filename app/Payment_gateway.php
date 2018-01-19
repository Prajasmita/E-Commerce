<?php
/**
 * Created by Prajakta Sisale.
 * User: webwerks
 * Date: 17/1/18
 * Time: 6:45 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Payment_gateway extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'payment_gateway';

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
    protected $fillable = ['id', 'name'];

}