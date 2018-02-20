<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_order extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_order';

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
    protected $fillable = ['id','user_id','coupon_id','billing_address','grand_total','shipping_charges','payment_gateway_id','discount','order_no'];

    /**
     * Function for users and user_address relationship.
     *
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    /**
     * Function for users order and order details relationship.
     *
     */
    public function order_details()
    {
        return $this->belongsTo('App\Order_details','id','order_id');
    }


}