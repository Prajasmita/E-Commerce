<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Model Banner for Banner management.
 *
 * Author : Prajakta Sisale.
 */
class Banner extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'banners';

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
    protected $fillable = ['banner_name', 'banner_image','status'];
    /**
     * Always capitalize the banner name when we retrieve it
     *
     * @param $value
     */
    public function getBannerNameAttribute($value) {
        return ucfirst($value);
    }

    /**
     * Always capitalize the banner name when we save it to the database
     *
     * @param $value
     */
    public function setBannerNameAttribute($value) {
        $this->attributes['banner_name'] = ucfirst($value);
    }


}
