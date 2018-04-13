<?php

namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;



class CollectorsModel extends AppModel
{
    public $timestamps = false;
    protected $table = 'collector';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','name','mac','pattern','pattern_id','operator_id'
    ];

    public function scopeFirmId($query,$firmId){
        $query->where('firm_id' ,'=' ,$firmId);
    }

    public function scopeEquipmentId($query,$equipmentId){
        $query->where('equipment_id' ,'=' ,$equipmentId);
    }

    public function company(){
        return $this->belongsTo('App\Eloquent\CompaniesModel','firm_id','id');
    }

    public function equipment(){
        return $this->belongsTo('App\Eloquent\EquipmentsModel','equipment_id','id');
    }
}

