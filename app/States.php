<?php
/**
 * Created by Prajakta Sisale.
 * User: webwerks
 * Date: 16/1/18
 * Time: 7:22 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'states';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    /**
     * Function for roles and users relationship.
     *
     */
    public function countries()
    {
        return $this->hasMany('App\Countries');
    }

}