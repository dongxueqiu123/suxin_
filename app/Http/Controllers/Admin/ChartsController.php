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

class ChartsController extends Controller{

    public function __construct(){
        $this->collectorsServices = new CollectorsServices();
        $this->middleware('auth.user');
    }

    public function collectorChart($id){
        $collector = $this->collectorsServices->get($id);
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
        $url = $http_type.$_SERVER['HTTP_HOST'].'/admin/charts/collectorResponse';
        $data = $this->httpGet($url,[]);
        $collectorData = json_decode($data);
        return view('charts.collectorChart',
            [
                'data' => $collectorData['data'],
                'collector'=>$collector,
                'boxTitle'=>'采集器数据展示',
                'active' => 'collectors',
            ]
        );
    }

    public function collectorChartRealTime($id){
        $collector = $this->collectorsServices->get($id);
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
        $url = $http_type.$_SERVER['HTTP_HOST'].'/admin/charts/collectorResponse';
        $data = $this->httpGet($url,[]);
        $collectorData = json_decode($data);
        return view('charts.collectorChart',
            [
                'data' => $collectorData['data'],
                'collector'=>$collector,
                'boxTitle'=>'实时数据展示',
                'active' => 'realTime',
            ]
        );
    }

    private function httpGet($url,$params = array()) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 200);
        @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        if(!empty($params)){
            curl_setopt($ch, CURLOPT_POSTFIELDS,self::json_encode($params));
            curl_setopt($ch, CURLOPT_POST, TRUE);
        }
        $r = curl_exec($ch);
        if ($ch != null)
            curl_close($ch);
        return $r;
    }

    public function  collectorResponse(){
        $array = [["2018-04-03T17:34:24Z",29.7],["2018-04-03T17:35:32Z",28.7]];
        return response()->json([
            'code' => 0,
            'data' => $array
        ]);
    }
}