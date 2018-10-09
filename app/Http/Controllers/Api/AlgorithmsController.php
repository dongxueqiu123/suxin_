<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/7/6
 * Time: 上午10:35
 */
namespace App\Http\Controllers\Api;

use App\Eloquent\InfluxDataModel;
use App\Eloquent\AlarmsModel;
use App\Services\AlarmsServices;
use App\Services\ThresholdsServices;
use Illuminate\Http\Request;
use App\Eloquent\ApiModuleModel;
use App\Http\Controllers\Controller;

class AlgorithmsController extends Controller{
    public function __construct()
    {
        $this->alarmsServices = new AlarmsServices();
        $this->influxData = new InfluxDataModel();
        $this->alarms = new AlarmsModel();
    }

    public function getOptionHtml(Request $request){
        $className = $request->input('className');
        $str = '';
        $classes = config('algorithm.'.$className.'.classify');
        foreach ($classes as $name=>$class){
            $str.= '<option value="'.$name.'" info="'.($class['info']??'暂无数据').'" outPutInfo="'.($class['outPutInfo']??'暂无数据').'" inPutInfo="'.($class['inPutInfo']??'暂无数据').'" inPutType="'.($class['inPutType']??'暂无数据').'" outPutType="'.($class['outPutType']??'暂无数据').'" >'.$class['name'].'</option>';
        }
        return response()->json([
            'code' => 0,
            'info'  => $str
        ]);
    }


    public function getAcc(Request $request){
        $num = $request->input('num')??1;
        if($num == 1){
            $data = $this->influxData::orderby('id','desc')->first();
            $data->test1 = $this->gl($data->acc_peak);
            $data->test2 = $this->gl($data->acc_peak);;
            $data->test3 = $this->gl($data->acc_peak);;
            $data = [$data];
        }else{
            $data = $this->influxData::limit($num)->orderby('id','desc')->get();
            //$data = $data->sortBy('id');
        }

        return response()->json($data);
    }

    public function gl($acc){
        //$result = rand(0.00,1.00);
        if($acc<1){
            $result = $this->randomFloat(0.00,1.00);
        }elseif($acc<2){
            $result = $this->randomFloat(1.00,3.00);
        }elseif($acc<3){
            $result = $this->randomFloat(3.00,7.00);
        }elseif($acc<4){
            $result = $this->randomFloat(7.00,9.00);
        }elseif($acc<5){
            $result = $this->randomFloat(9.00,11.00);
        }elseif($acc<6){
            $result = $this->randomFloat(11.00,13.00);
        }elseif($acc<7){
            $result = $this->randomFloat(13.00,15.00);
        }elseif($acc<8){
            $result = $this->randomFloat(15.00,17.00);
        }elseif($acc<9){
            $result = $this->randomFloat(17.00,19.00);
        }elseif($acc<10){
            $result = $this->randomFloat(19.00,21.00);
        }else{
            $result = $this->randomFloat(21.00,30.00);
        }
        return $result;
    }


    function randomFloat($min = 0, $max = 1) {
        $mun = sprintf("%.2f",mt_rand() / mt_getrandmax() * ($max - $min));
        if($min == 0){
            $result = $min + $mun;
        }else{
            $result = rand($min,$max) + $mun;
        }
        return $result;
    }
}