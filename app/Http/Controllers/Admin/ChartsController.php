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
        return view('charts.collectorChart',
            [
                'collector'=>$collector,
                'boxTitle'=>'采集器数据展示',
                'active' => 'collectors',
            ]
        );
    }

    public function  collectorResponse(){
        $array = [["2018-04-03T17:26:24Z",28.7],["2018-04-03T17:26:32Z",28.7],["2018-04-03T17:26:40Z",28.7],["2018-04-03T17:26:48Z",28.6],["2018-04-03T17:26:56Z",28.7],["2018-04-03T17:27:04Z",28.7],["2018-04-03T17:27:12Z",28.7],["2018-04-03T17:27:20Z",28.7],["2018-04-03T17:27:28Z",28.6],["2018-04-03T17:27:36Z",28.7],["2018-04-03T17:27:44Z",28.7],["2018-04-03T17:27:52Z",28.7],["2018-04-03T17:28:00Z",28.7],["2018-04-03T17:28:08Z",28.7],["2018-04-03T17:28:16Z",28.7],["2018-04-03T17:28:24Z",28.7],["2018-04-03T17:28:32Z",28.7],["2018-04-03T17:28:40Z",28.6],["2018-04-03T17:28:48Z",28.6],["2018-04-03T17:28:56Z",28.6],["2018-04-03T17:29:04Z",28.7],["2018-04-03T17:29:12Z",28.7],["2018-04-03T17:29:21Z",28.7],["2018-04-03T17:29:28Z",28.6],["2018-04-03T17:29:36Z",28.7],["2018-04-03T17:29:44Z",28.7],["2018-04-03T17:29:52Z",28.6],["2018-04-03T17:30:00Z",28.7]];
        return response()->json([
            'code' => 0,
            'data' => $array
        ]);
    }
}