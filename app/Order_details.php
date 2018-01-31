<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_details extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'order_details';

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
    protected $fillable = ['id', 'order_id','product_id','amount','quantity'];

    public function product(){

        return $this->hasMany('App\Product');

    }

    /**
     * Function for users order and order details relationship.
     *
     */
    public function user_order()
    {
        return $this->belongsTo('App\User_order','order_id','id');
    }


}