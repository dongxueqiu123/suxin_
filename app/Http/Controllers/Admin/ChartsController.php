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
        $collectors = $this->collectorsServices->getList(0,$queryArray);
        $collector = $this->collectorsServices->get($id);
        $startDate    = date("Y-m-d H:i:s",time()+8*60*60-10*60);
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
        $speedData = $this->getSpeedData($http_type,'acc_orig',$collector->id??'',$startDate);
        $temperatureData = $this->getTemperatureData($http_type,'ex_temp',$collector->id??'',$startDate);
        $humidityData = $this->getHumidityData($http_type,'in_hum',$collector->id??'',$startDate);
/*        $url = $http_type.$_SERVER['HTTP_HOST'].'/admin/charts/collectorResponse';
        $data = $this->httpGet($url,[]);
        $collectorData = json_decode($data);*/
        return view('charts.collectorChart',
            [
                'data' => json_encode($temperatureData['data'])??'',
                'speedData'=>json_encode($speedData['data'])??'',
                'humidityData'=>json_encode($humidityData['data'])??'',
                'collector'=>$collector,
                'collectors'=>$collectors,
                'boxTitle'=>'无线节点数据展示',
                'active' => 'collectors',
            ]
        );
    }


    public function collectorChartRealTime($id){
        $queryArray['firmId'] = Auth::user()->company->id??'';
        $collectors = $this->collectorsServices->getList(0,$queryArray);
        $collector = $this->collectorsServices->get($id);
        $startDate    = date("Y-m-d H:i:s",time()+8*60*60-10*60);
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';

        $speedData = $this->getSpeedData($http_type,'acc_orig',$collector->id??'',$startDate);

        $temperatureData = $this->getTemperatureData($http_type,'ex_temp',$collector->id??'',$startDate);

        $humidityData = $this->getHumidityData($http_type,'in_hum',$collector->id??'',$startDate);
        /*        $url = $http_type.$_SERVER['HTTP_HOST'].'/admin/charts/collectorResponse';
                $data = $this->httpGet($url,[]);
                $collectorData = json_decode($data);*/
        return view('charts.collectorChart',
            [
                'data' => json_encode($temperatureData['data'])??'',
                'speedData'=>json_encode($speedData['data'])??'',
                'humidityData'=>json_encode($humidityData['data'])??'',
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