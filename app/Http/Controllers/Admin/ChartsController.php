<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/4/4
 * Time: 下午2:36
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CollectorsServices;
use Illuminate\Support\Facades\Auth;

class ChartsController extends Controller{

    public function __construct(){
        $this->collectorsServices = new CollectorsServices();
        $this->middleware('auth.user');
    }

    public function collectorChart($id){
        $queryArray['firmId'] = Auth::user()->company->id??'';
        $time = 1000;
        $ext['sort'] = true;
        $collectors = $this->collectorsServices->getList(0,$queryArray,'','',$ext);
        $collector =  ($id==0)?$collectors->first():$this->collectorsServices->get($id);
        $startDate    = date("Y-m-d H:i:s",time()+8*60*60-3*60);
        $newStartDate = date("Y-m-d H:i:s",time()+8*60*60-10*60);
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
        $speedData = $this->getSpeedData($http_type,'acc_orig',$collector->id??'',$startDate);

        $dateTime =  time()+8*60*60-3*60;
        if(empty($speedData['data']) || count($speedData['data'])){
            $time = 60*60*1000;
            for($i=1; $i<=24; $i++){
                $dateTime = $dateTime-10*60;
                $data = is_array($speedData['data'])?$speedData['data']:[];
                $speedData = $this->getSpeedData($http_type,'acc_orig',$collector->id??'',date("Y-m-d H:i:s",$dateTime));
                $speedData['data'] = is_array($speedData['data'])?$speedData['data']:[];
                $speedData['data'] = array_merge($speedData['data'],$data);
                if(count($speedData['data'])>300){
                    break;
                }
            }
        }

        $temperatureData = $this->getTemperatureData($http_type,'ex_temp',$collector->id??'',$newStartDate);

        $dateTime =  time()+8*60*60-10*60;
        if(empty($temperatureData['data']) || count($temperatureData['data'])){
            for($i=1; $i<=24; $i++){
                $dateTime = $dateTime-10*60;
                $data = is_array($temperatureData['data'])?$temperatureData['data']:[];
                $temperatureData = $this->getTemperatureData($http_type,'ex_temp',$collector->id??'',date("Y-m-d H:i:s",$dateTime));
                $temperatureData['data'] = is_array($temperatureData['data'])?$temperatureData['data']:[];
                $temperatureData['data'] = array_merge($temperatureData['data'],$data);
                if(count($temperatureData['data'])>300){
                    break;
                }
            }
        }
        $humidityData = $this->getHumidityData($http_type,'in_hum',$collector->id??'',$newStartDate);

        $dateTime =  time()+8*60*60-10*60;
        if(empty($humidityData['data']) || count($humidityData['data'])){
            for($i=1; $i<=24; $i++){
                $dateTime = $dateTime-10*60;
                $data = is_array($humidityData['data'])?$humidityData['data']:[];
                $humidityData = $this->getHumidityData($http_type,'in_hum',$collector->id??'',date("Y-m-d H:i:s",$dateTime));
                $humidityData['data'] = is_array($humidityData['data'])?$humidityData['data']:[];
                $humidityData['data'] = array_merge($humidityData['data'],$data);
                if(count($humidityData['data'])>300){
                    break;
                }
            }
        }

/*        $url = $http_type.$_SERVER['HTTP_HOST'].'/admin/charts/collectorResponse';
        $data = $this->httpGet($url,[]);
        $collectorData = json_decode($data);*/
        return view('charts.collectorChart',
            [
                'data' => json_encode($temperatureData['data'])??'',
                'speedData'=>json_encode($speedData['data'])??'',
                'humidityData'=>json_encode($humidityData['data'])??'',
                'time'=>$time,
                'collector'=>$collector,
                'collectors'=>$collectors,
                'boxTitle'=>'无线节点数据展示',
                'active' => 'collectors',
            ]
        );
    }


    public function collectorChartRealTime($id){
        $queryArray['firmId'] = Auth::user()->company->id??'';
        $ext['sort'] = true;
        $time = 1000;
        $collectors = $this->collectorsServices->getList(0,$queryArray,'','',$ext);
        $collector =  ($id==0)?$collectors->first():$this->collectorsServices->get($id);
        $startDate    = date("Y-m-d H:i:s",time()+8*60*60-3*60);
        $newStartDate = date("Y-m-d H:i:s",time()+8*60*60-10*60);
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';

        $speedData = $this->getSpeedData($http_type,'acc_orig',$collector->id??'',$startDate);


        $dateTime =  time()+8*60*60-3*60;
        if(empty($speedData['data']) || count($speedData['data'])){
            $time = 60*60*1000;
            for($i=1; $i<=24; $i++){
                $dateTime = $dateTime-10*60;
                $data = is_array($speedData['data'])?$speedData['data']:[];
                $speedData = $this->getSpeedData($http_type,'acc_orig',$collector->id??'',date("Y-m-d H:i:s",$dateTime));
                $speedData['data'] = is_array($speedData['data'])?$speedData['data']:[];
                $speedData['data'] = array_merge($speedData['data'],$data);
                if(count($speedData['data'])>300){
                    break;
                }
            }
        }

        $temperatureData = $this->getTemperatureData($http_type,'ex_temp',$collector->id??'',$newStartDate);
        $dateTime =  time()+8*60*60-10*60;
        if(empty($temperatureData['data']) || count($temperatureData['data'])){
            for($i=1; $i<=24; $i++){
                $dateTime = $dateTime-10*60;
                $data = is_array($temperatureData['data'])?$temperatureData['data']:[];
                $temperatureData = $this->getTemperatureData($http_type,'ex_temp',$collector->id??'',date("Y-m-d H:i:s",$dateTime));
                $temperatureData['data'] = is_array($temperatureData['data'])?$temperatureData['data']:[];
                $temperatureData['data'] = array_merge($temperatureData['data'],$data);
                if(count($temperatureData['data'])>300){
                    break;
                }
            }
        }

        $humidityData = $this->getHumidityData($http_type,'in_hum',$collector->id??'',$newStartDate);
        /*        $url = $http_type.$_SERVER['HTTP_HOST'].'/admin/charts/collectorResponse';
                $data = $this->httpGet($url,[]);
                $collectorData = json_decode($data);*/

        $dateTime =  time()+8*60*60-10*60;
        if(empty($humidityData['data']) || count($humidityData['data'])){
            for($i=1; $i<=24; $i++){
                $dateTime = $dateTime-10*60;
                $data = is_array($humidityData['data'])?$humidityData['data']:[];
                $humidityData = $this->getHumidityData($http_type,'in_hum',$collector->id??'',date("Y-m-d H:i:s",$dateTime));
                $humidityData['data'] = is_array($humidityData['data'])?$humidityData['data']:[];
                $humidityData['data'] = array_merge($humidityData['data'],$data);
                if(count($humidityData['data'])>300){
                    break;
                }
            }
        }
        return view('charts.collectorChart',
            [
                'data' => json_encode($temperatureData['data'])??'',
                'speedData'=>json_encode($speedData['data'])??'',
                'humidityData'=>json_encode($humidityData['data'])??'',
                'time'=>$time,
                'collector'=>$collector,
                'collectors'=>$collectors,
                'boxTitle'=>'实时数据展示',
                'active' => 'realTime',
            ]
        );
    }

    public function getTemperatureData($http_type,$state,$id,$endDate){
        $url = $http_type.$_SERVER['HTTP_HOST'].'/console/influx/timeseries/'.$state.'/'.$id.'?startTime='.urlencode($endDate);
        $data = $this->httpGet($url,[]);
        return $data;
    }

    public function getSpeedData($http_type,$state,$id,$endDate){
        $url = $http_type.$_SERVER['HTTP_HOST'].'/console/influx/timeseries/'.$state.'/'.$id.'?startTime='.urlencode($endDate);
        $data = $this->httpGet($url,[]);
        return $data;
    }

    public function getHumidityData($http_type,$state,$id,$endDate){
        $url = $http_type.$_SERVER['HTTP_HOST'].'/console/influx/timeseries/'.$state.'/'.$id.'?startTime='.urlencode($endDate);
        $data = $this->httpGet($url,[]);
        return $data;
    }

    private function httpGet($url,$params = array()) {
        try{
            $html = @file_get_contents($url);
        }catch (Exception $e){
            return $data['data'] = [];
        }

        $collectorData = json_decode($html,true);
        return $collectorData;
    }

    public function  collectorResponse(){
        $array = [["2018-04-03T17:34:24Z",29.7],["2018-04-03T17:35:32Z",28.7]];
        return response()->json([
            'code' => 0,
            'data' => $array
        ]);
    }
}