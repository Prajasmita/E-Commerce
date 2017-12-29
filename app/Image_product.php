<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image_product extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'image_products';

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
    protected $fillable = ['product_image_name', 'product_id','id'];

    /**
     * Function for product image and product relationship.
     *
     */
    public function products()
    {
        return $this->belongsTo('App\Product');
    }
}
