<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

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
    protected $fillable = ['product_name', 'sku', 'short_discription', 'long_discription', 'price', 'special_price', 'special_price_from_date', 'special_price_to_date', 'image_name', 'quantity', 'meta_title', 'meta_discription', 'meta_keyword', 'category','status','is_feature'];

    /**
     * Function for product image and product relationship.
     *
     */
    public function image()
    {
        return $this->hasOne('App\Image_product');
    }

    /**
     * Function for product image and product relationship.
     *
     */
    public function image_products()
    {
        return $this->hasMany('App\Image_product');
    }
    /**
     * Function for products and categories relationship.
     *
     */
    public function category()
    {
        return $this->belongsToMany('App\Category');
    }

    public function category_product()
    {
        return $this->hasMany('App\Category_product');
    }

    /**
     * Function for products and wishlist relationship.
     *
     */
    public function wishlist(){
        return $this->hasMany(Wishlist::class);
    }

    public function order_details()
    {
        return $this->hasMany('App\Order_details');
    }
}
