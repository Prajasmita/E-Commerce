<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Model User_wish_list for User_wish_list management.
 *
 * Author : Prajakta Sisale.
 */
class User_wishlist extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_wishlist';

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
    protected $fillable = ['id', 'product_id','user_id'];
    /**
     * Function for user and wishlist relationship.
     *
     */

    public function user(){
        return $this->belongsTo('App\User');
    }
    /**
     * Function for products and wishlist relationship.
     *
     */
    public function product(){
        return $this->belongsTo('App\Product');
    }

}
