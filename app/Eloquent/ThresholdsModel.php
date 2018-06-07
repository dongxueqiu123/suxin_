<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 2018/3/30
 * Time: 9:42
 */
namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ThresholdsModel extends AppModel
{
    public $timestamps = false;
    protected $table = 'threshold';
    protected $primaryKey = 'id';

    const FIRM = 'firm_id';
    const EQUIPMENT = 'equipment_id';
    const COLLECTOR = 'collector_id';
    const PATTERN = [self::FIRM=>'厂家'  ,self::EQUIPMENT=>'机械设备' ,self::COLLECTOR=>'采集设备'];
    const CATEGORY = ['1'=>'温度' ,'2'=>'加速度' ,'3'=>'离线'];
    const GRADE = ['1'=>'一般' ,'2'=>'次要' ,'3'=>'重要' ,'4'=>'紧要'];

    protected $fillable = [
        'id','pattern','pattern_id','category','grade','lowlimit','toplimit','operator_id'
    ];


    public function scopeFirmId($query,$firmId){
        $query->where('firm_id' ,'=' ,$firmId);
    }

    public function getCategory($id){
        $category = self::CATEGORY;
        $result   = empty($id)?$category:$category[$id];
        return $result;
    }

    public function getGrade($id){
        $grade  = self::GRADE;
        $result = empty($id)?$grade:($grade[$id]??'');
        return $result;
    }

    public function getPattern(array $excepts = []){
        $pattern = self::PATTERN;
        foreach ($excepts as $except){
            unset($pattern[$except]);
        }
        return $pattern;
    }

    public function getFirmName(){
        return self::FIRM;
    }

    public function getEquipmentName(){
        return  self::EQUIPMENT;
    }

    public function getCollectorName(){
        return  self::COLLECTOR;
    }

    public function getPatternStatus($model){
        $result = '';
        $firm = self::FIRM;
        $equipment = self::EQUIPMENT;
        $collector = self::COLLECTOR;
        if($model->$firm??''){
            $result = self::FIRM;
        }elseif($model->$equipment??''){
            $result = self::EQUIPMENT;
        }elseif($model->$collector??''){
            $result = self::COLLECTOR;
        }
        return $result;
    }

    public function scopePattern($query,$pattern){
        $query->where('pattern' ,'=' ,$pattern);
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

