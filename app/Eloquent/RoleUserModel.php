<?php
namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;

class RoleUserModel extends Model
{
    
    protected $table = 'role_user';
    public $timestamps = false;

    public function roles(){
        return $this->hasOne('App\Eloquent\Role','id','role_id');
    }
}
