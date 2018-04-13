<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class UsersModel extends AppModel
{
    use EntrustUserTrait;

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','name','email','password','companyId'
    ];

    public function scopeEmail($query,$email){
        $query->where('email','=',$email);
    }

    public function company(){
        return $this->hasOne('App\Eloquent\CompaniesModel','id','companyId');
    }

    public function roleUser(){
        return $this->belongsTo('App\Eloquent\RoleUserModel','id','user_id');
    }
}

