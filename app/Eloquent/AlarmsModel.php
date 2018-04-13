<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/4/2
 * Time: 上午9:34
 */
namespace APP\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AlarmsModel extends AppModel {

    public $timestamps = false;
    protected $table = 'alarm';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id' ,'collector_id' ,'equipment_id' ,'category' ,'grade' ,'detail' ,'status' ,'remark' ,'operator_id' ,'operate_time'
    ];

    public function scopeFirmId($query,$firmId){
        $query->where('firm_id' ,'=' ,$firmId);
    }

    public function collector(){
        return $this->belongsTo('App\Eloquent\CollectorsModel','collector_id','id');
    }

    public function equipment(){
        return $this->belongsTo('App\Eloquent\EquipmentsModel','equipment_id','id');
    }

    public function consumer(){
        return $this->belongsTo('App\Eloquent\CompaniesModel','consumer_id','id');
    }

    public function provider(){
        return $this->belongsTo('App\Eloquent\CompaniesModel','provider_id','id');
    }
}