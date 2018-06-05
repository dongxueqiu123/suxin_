<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/4/2
 * Time: 上午9:50
 */
namespace App\Http\Controllers\Admin;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Services\AlarmsServices;
use App\Services\ThresholdsServices;
use App\Services\CollectorsServices;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;


class AlarmsController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->alarmsServices = new AlarmsServices();
        $this->thresholdsServices = new ThresholdsServices();
        $this->collectorsServices = new CollectorsServices();
    }

    public function index(Request $request){
        $page = $request->input('page')??1;
        $queryArray['firmId'] = \Auth()->user()->company->id??1;
        $body  = $this->alarmsServices->getClient('http://52.80.145.123:8080/console/alarm/retrieveAlarm',static::PAGE_SIZE_DEFAULT,$page,$queryArray);
        $alarms = empty($body['data'])?[]:$body['data'];
        foreach($alarms as $key=>$alarm){
            $alarms[$key]['categoryName']= $this->thresholdsServices->getConstantByArray($alarm,'category');
            $alarms[$key]['gradeName'] = $this->thresholdsServices->getConstantByArray($alarm,'grade');
        }
        $alarms  = new LengthAwarePaginator($alarms,$body['count'],static::PAGE_SIZE_DEFAULT,$page,['path'=>'']);
        return view('alarms.list',
            [
                'alarms' => $alarms,
                'boxTitle'=>'告警记录列表',
                'active' => 'alarms'
            ]
        );
    }

    public function recover(Request $request){
        $page = $request->input('page')??1;
        $name = $request->input('name')??null;
        $queryArray['firmId'] = \Auth()->user()->company->id??1;
        $queryArray['status'] = 3;
        !empty($name) &&  $queryArray['name'] = $name;
        $body  = $this->alarmsServices->getClient('http://52.80.145.123:8080/console/alarm/retrieveByParams',static::PAGE_SIZE_DEFAULT,$page,$queryArray);

        $alarms = empty($body['data'])?[]:$body['data'];
        foreach($alarms as $key=>$alarm){
            $alarms[$key]['categoryName']= $this->thresholdsServices->getConstantByArray($alarm,'category');
            $alarms[$key]['gradeName'] = $this->thresholdsServices->getConstantByArray($alarm,'grade');
        }
        $alarms  = new LengthAwarePaginator($alarms,$body['count'],static::PAGE_SIZE_DEFAULT,$page,['path'=>'']);
        return view('alarms.recover',
            [
                'name' => $name,
                'alarms' => $alarms,
                'boxTitle'=>'告警记录列表',
                'active' => 'recover'
            ]
        );
    }

    public function search(Request $request){
        $page = $request->input('page');
        $name = $request->input('name');
        $queryArray['firmId'] = \Auth()->user()->company->id??'1';
        $queryArray['status'] = 2;
        $body  = $this->alarmsServices->getClient('http://52.80.145.123:8080/console/alarm/retrieveByParams',static::PAGE_SIZE_DEFAULT,$page,$queryArray);
        $alarms = empty($body['data'])?[]:$body['data'];
        foreach($alarms as $key=>$alarm){
            $alarms[$key]['category']= $this->thresholdsServices->getConstantByArray($alarm,'category');
            $alarms[$key]['grade'] = $this->thresholdsServices->getConstantByArray($alarm,'grade');
        }
        $alarms  = new LengthAwarePaginator($alarms,$body['count'],static::PAGE_SIZE_DEFAULT,$page,['path'=>'']);
        return view('alarms.recover',
            [
                'alarms' => $alarms,
                'boxTitle'=>'告警记录列表',
                'active' => 'alarms',
                'name' =>$name
            ]
        );
    }
}