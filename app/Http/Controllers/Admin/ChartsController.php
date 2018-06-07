<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/4/4
 * Time: 下午2:36
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
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
        $startTime    = time()-3*60;
        $newStartTime = time()-10*60;
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
        $speedData = $this->getSpeedData($http_type,'acc_orig',$collector->id??'',$startTime);

        $dateTime =  time()-3*60;
        if(empty($speedData['data']) || count($speedData['data'])<=32){
            $time = 60*60*1000;
            for($i=1; $i<=24; $i++){
                $dateTime = $dateTime-10*60;
                $data = is_array($speedData['data'])?$speedData['data']:[];
                $speedData = $this->getSpeedData($http_type,'acc_orig',$collector->id??'',$dateTime);
                $speedData['data'] = is_array($speedData['data'])?$speedData['data']:[];
                $speedData['data'] = array_merge($speedData['data'],$data);
                if(count($speedData['data'])>300){
                    break;
                }
            }
        }

        $temperatureData = $this->getTemperatureData($http_type,'ex_temp',$collector->id??'',$newStartTime);

        $dateTime =  time()-10*60;
        if(empty($temperatureData['data']) || count($temperatureData['data'])){
            for($i=1; $i<=24; $i++){
                $dateTime = $dateTime-10*60;
                $data = is_array($temperatureData['data'])?$temperatureData['data']:[];
                $temperatureData = $this->getTemperatureData($http_type,'ex_temp',$collector->id??'',$dateTime);
                $temperatureData['data'] = is_array($temperatureData['data'])?$temperatureData['data']:[];
                $temperatureData['data'] = array_merge($temperatureData['data'],$data);
                if(count($temperatureData['data'])>300){
                    break;
                }
            }
        }
        $humidityData = $this->getHumidityData($http_type,'in_hum',$collector->id??'',$newStartTime);

        $dateTime =  time()-10*60;
        if(empty($humidityData['data']) || count($humidityData['data'])){
            for($i=1; $i<=24; $i++){
                $dateTime = $dateTime-10*60;
                $data = is_array($humidityData['data'])?$humidityData['data']:[];
                $humidityData = $this->getHumidityData($http_type,'in_hum',$collector->id??'',$dateTime);
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
        $startTime    = time()-3*60;
        $newStartTime = time()-10*60;
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';

        $speedData = $this->getSpeedData($http_type,'acc_orig',$collector->id??'',$startTime);


        $dateTime =  time()-3*60;
        if(empty($speedData['data']) || count($speedData['data'])<=32){
            $time = 60*60*1000;
            for($i=1; $i<=24; $i++){
                $dateTime = $dateTime-10*60;
                $data = is_array($speedData['data'])?$speedData['data']:[];
                $speedData = $this->getSpeedData($http_type,'acc_orig',$collector->id??'',$dateTime);
                $speedData['data'] = is_array($speedData['data'])?$speedData['data']:[];
                $speedData['data'] = array_merge($speedData['data'],$data);
                if(count($speedData['data'])>300){
                    break;
                }
            }
        }

        $temperatureData = $this->getTemperatureData($http_type,'ex_temp',$collector->id??'',$newStartTime);
        $dateTime =  time()-10*60;
        if(empty($temperatureData['data']) || count($temperatureData['data'])){
            for($i=1; $i<=24; $i++){
                $dateTime = $dateTime-10*60;
                $data = is_array($temperatureData['data'])?$temperatureData['data']:[];
                $temperatureData = $this->getTemperatureData($http_type,'ex_temp',$collector->id??'',$dateTime);
                $temperatureData['data'] = is_array($temperatureData['data'])?$temperatureData['data']:[];
                $temperatureData['data'] = array_merge($temperatureData['data'],$data);
                if(count($temperatureData['data'])>300){
                    break;
                }
            }
        }

        $humidityData = $this->getHumidityData($http_type,'in_hum',$collector->id??'',$newStartTime);
        /*        $url = $http_type.$_SERVER['HTTP_HOST'].'/admin/charts/collectorResponse';
                $data = $this->httpGet($url,[]);
                $collectorData = json_decode($data);*/

        $dateTime =  time()-10*60;
        if(empty($humidityData['data']) || count($humidityData['data'])){
            for($i=1; $i<=24; $i++){
                $dateTime = $dateTime-10*60;
                $data = is_array($humidityData['data'])?$humidityData['data']:[];
                $humidityData = $this->getHumidityData($http_type,'in_hum',$collector->id??'',$dateTime);
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
        $_SERVER['HTTP_HOST'] = 'www.suxiniot.com';
        $url = $http_type.$_SERVER['HTTP_HOST'].'/console/influx/timeseries/'.$state.'/'.$id.'?startTime='.($endDate-8*60*60)*1000;
        $data = $this->httpGet($url,[]);
        return $data;
    }

    public function getSpeedData($http_type,$state,$id,$endDate){
        $_SERVER['HTTP_HOST'] = 'www.suxiniot.com';
        $url = $http_type.$_SERVER['HTTP_HOST'].'/console/influx/timeseries/'.$state.'/'.$id.'?startTime='.($endDate-8*60*60)*1000;
        $data = $this->httpGet($url,[]);
        return $data;
    }

    public function getHumidityData($http_type,$state,$id,$endDate){
        $_SERVER['HTTP_HOST'] = 'www.suxiniot.com';
        $url = $http_type.$_SERVER['HTTP_HOST'].'/console/influx/timeseries/'.$state.'/'.$id.'?startTime='.($endDate-8*60*60)*1000;
        $data = $this->httpGet($url,[]);
        return $data;
    }

    public function getHistorySpeedData($http_type,$state,$id,$endDate,$period){

        $_SERVER['HTTP_HOST'] = 'www.suxiniot.com';
        $url = $http_type.$_SERVER['HTTP_HOST'].'/console/influx/timeseries/period/'.$state.'/'.$id.'?endTime='.($endDate-8*60*60)*1000 .'&period='.$period;
        $data = $this->httpGet($url,[]);
        return $data;
    }

    public function collectorHistoryChart($id,Request $request){
        $queryArray['firmId'] = Auth::user()->company->id??'';

        $startTime = $request->input('startTime');
        $endTime   = $request->input('endTime');
        $ext['sort'] = true;
        $collectors = $this->collectorsServices->getList(0,$queryArray,'','',$ext);

        $collector =  ($id==0)?$collectors->first():$this->collectorsServices->get($id);

        return view('charts.collectorHistoryChart',
            [
                'time'=>$endTime,
                'collector'=>$collector,
                'collectors'=>$collectors,
                'boxTitle'=>'无线节点数据展示',
                'active' => 'historyRealTime',
            ]
        );
    }

    /**
     * 获取请求时间段和次数
     * 1.5分钟之内直接请求
     * 2.5-30分钟每次请求5分钟
     * 3.30-60分钟每次请求10分钟
     * 4.60-240分钟每次请求30分钟
     * 5.大于240分钟每次请求60分钟
     * @param $startTime 开始时间
     * @param $endTime 结束时间
     * @return array
     */
    public function countIntervalAndTimes($startTime,$endTime){
        $differenceTime = $endTime-$startTime;

        if($differenceTime <= 300){ //5分钟之内直接请求
            $interval = (int)ceil($differenceTime/60);//分钟
        }elseif($differenceTime > 300 && $differenceTime <= 30*60){ //5-30分钟每次请求5分钟
            $times = (int) ceil($differenceTime/(60*5));//次数
            $interval = 5;//分钟
        }elseif($differenceTime > 30*60 && $differenceTime <= 60*60){ //30-60分钟每次请求10分钟
            $times = (int) ceil($differenceTime/(60*10));
            $interval = 10;
        }elseif($differenceTime > 60*60 && $differenceTime <= 60*240){ //60-240分钟每次请求30分钟
            $times = (int) ceil($differenceTime/(60*30));
            $interval = 30;
        }elseif($differenceTime > 60*240 ){ //大于240分钟每次请求60分钟
            $times = ceil($differenceTime/60*60);
            $interval = 60;
        }
        return ['interval'=>$interval??1,'times'=>$times??1];
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

    public function  collectorHistoryResponse(Request $request){
        ini_set('date.timezone','Asia/Shanghai');
        $queryArray['firmId'] = Auth::user()->company->id??'';
        $startTime = strtotime($request->input('startTime'));
        $endTime   = strtotime($request->input('endTime'),time());
        $id   = $request->input('id');
        //$startTime = time()-3*60;
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
        //$speedData = $this->getSpeedData($http_type,'acc_orig',$id,$startTime);
        //dump($speedData);

        $IntervalAndTimes = $this->countIntervalAndTimes($startTime, $endTime);
        $data = [];

        for ($i = 0; $i<$IntervalAndTimes['times'];$i++){
            $speedData = $this->getHistorySpeedData($http_type,'acc_orig',$id??'',$endTime-$i*$IntervalAndTimes['interval']*60,$IntervalAndTimes['interval']);
            $data =array_merge($speedData['data'],$data);
        }


        return response()->json([
            'code' => 0,
            'data' => json_encode($data)??''
        ]);
    }

    public function  collectorResponse(){
        $array = [["2018-04-03T17:34:24Z",29.7],["2018-04-03T17:35:32Z",28.7]];
        return response()->json([
            'code' => 0,
            'data' => $array
        ]);
    }
}