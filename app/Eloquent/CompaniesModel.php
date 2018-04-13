<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CompaniesModel extends AppModel
{
    protected $table = 'companies';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','name','abbreviation','userId','created_at','updated_at'
    ];


    public function scopeId($query,$id){
        $query->where('id','=',$id);
    }

    public function provider(){
        return $this->hasmany('App\Eloquent\EquipmentsModel','provider_id','id');
    }

    public function consumer(){
        return $this->hasmany('App\Eloquent\EquipmentsModel','consumer_id','id');
    }

    public function collector(){
        return $this->hasmany('App\Eloquent\CollectorsModel','firm_id','id');
    }
}

