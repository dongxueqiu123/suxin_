<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.user');
    }

    public function index()
    {
        $user = \Auth()->user();
        $company = $user->company;
        $http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
        $endDate    = date("Y-m-d H:i:s");
        $startDate  = date("Y-m-d H:i:s",time()-600);
        $url = $http_type.$_SERVER['HTTP_HOST'].'/console/influx/timeseries/ex_temp/3/'.$startDate.'/'.$endDate.'/';
        $data = $this->httpGet($url,[]);
        $collectorData = json_decode($data);
        return view('admin.highchart',[
            'data'=>json_encode($collectorData['data']),
            'active'=>'home',
        ]);
        return view('admin.index',[
            'company'=>$company,
        ]);
    }

    public function highcharts(){
        return view('admin.highchart');
    }

    public function permission(){
        return view('permission');
    }

    public function test11(){
        return view('test',
            [
                'boxTitle'=>'测试11',
                'active' => 'test11'
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

    public function test12(){
        return view('test',
            [
                'boxTitle'=>'测试12',
                'active' => 'test12'
            ]
        );
    }

    public function test2(){
        return view('test',
            [
                'boxTitle'=>'测试2',
                'active' => 'test2'
            ]
        );
    }
}
