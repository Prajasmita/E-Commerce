<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * Model Role for Role management.
 *
 * Author : Prajakta Sisale.
 */
class Role extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'roles';

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
    protected $fillable = ['name'];
    /**
     * Function for roles and users relationship.
     *
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
