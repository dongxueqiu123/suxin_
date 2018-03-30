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


class ThresholdsModel extends Model
{
    public $timestamps = false;
    protected $table = 'threshold';
    protected $primaryKey = 'id';

    const PATTERN = ['1'=>'厂家'  ,'2'=>'机械设备' ,'3'=>'采集设备'];
    const CATEGORY = ['1'=>'温度' ,'2'=>'加速度'];
    const GRADE = ['1'=>'一般' ,'2'=>'次要' ,'3'=>'重要' ,'4'=>'紧要'];

    protected $fillable = [
        'id','pattern','pattern_id','category','grade','lowlimit','toplimit','operator_id'
    ];

    public function getCategory($id){
        $category = self::CATEGORY;
        $result   = empty($id)?$category:$category[$id];
        return $result;
    }

    public function getGrade($id){
        $grade  = self::GRADE;
        $result = empty($id)?$grade:$grade[$id];
        return $result;
    }

    public function getPattern($id){
        $pattern = self::PATTERN;
        $result  =  empty($id)?$pattern:$pattern[$id];
        return $result;
    }
}

