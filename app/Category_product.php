<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category_product extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'category_product';

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
    protected $fillable = ['category_id', 'product_id'];

    public function products()
    {
        return $this->belongsTo('App\Product','product_id','id');
    }

    public function category()
    {
        return $this->hasone('App\Category','id','category_id');
    }
}
