<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/3/30
 * Time: 下午4:38
 */
namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LiaisonsModel extends AppModel{

    public $timestamps = false;
    protected $table = 'liaison';
    protected $primaryKey = 'id';


    protected $fillable = [
        'id','pattern','pattern_id','mobile','email','operator_id'
    ];

    public function scopePattern($query,$pattern){
        $query->where('pattern' ,'=' ,$pattern);
    }


    public function scopeFirmId($query,$firmId){
        $query->where('firm_id' ,'=' ,$firmId);
    }

    public function company(){
        return $this->belongsTo('App\Eloquent\CompaniesModel','firm_id','id');
    }

    public function equipment(){
        return $this->belongsTo('App\Eloquent\EquipmentsModel','equipment_id','id');
    }

    public function collector(){
        return $this->belongsTo('App\Eloquent\CollectorsModel','collector_id','id');
    }
}