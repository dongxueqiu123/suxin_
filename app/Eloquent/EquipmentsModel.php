<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class EquipmentsModel extends Model
{
    public $timestamps = false;
    protected $table = 'equipment';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','name','provider_id','consumer_id','operator_id'
    ];

    public function provider(){
        return $this->hasOne('App\Eloquent\CompaniesModel','id','provider_id');
    }

    public function consumer(){
        return $this->hasOne('App\Eloquent\CompaniesModel','id','consumer_id');
    }

}

