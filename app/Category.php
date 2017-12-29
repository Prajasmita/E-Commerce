<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Model Category for Category management.
 *
 * Author : Prajakta Sisale.
 */
class Category extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

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
    protected $fillable = ['name', 'parent_id','category_id','status'];

    /**
     * Function for categories and Products relationship.
     *
     */
    public function products()
    {
        return $this->belongsToMany('App\Product');
    }
    /**
     * Function for categories and Products relationship.
     *
     */
    public function category_product()
    {
        return $this->belongsTo('App\Category_product');
    }
    /**
     * Function for category and subcategory relationship.
     *
     */
    public function category()
    {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public function sub_category()
    {
        return $this->hasMany('App\Category', 'parent_id');
    }

}
