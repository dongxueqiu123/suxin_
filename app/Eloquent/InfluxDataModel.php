<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/4/13
 * Time: 下午4:07
 */
namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class InfluxDataModel extends AppModel{

    public $timestamps = false;
    protected $table = 'influx_data';
    protected $primaryKey = 'id';

    public function scopeLimit($query,$num){
        $query->simplePaginate($num);
    }
}