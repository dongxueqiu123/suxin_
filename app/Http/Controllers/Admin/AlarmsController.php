<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/4/2
 * Time: 上午9:50
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\AlarmsServices;
use App\Services\ThresholdsServices;
use App\Services\CollectorsServices;
use App\Http\Controllers\Controller;


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
        $queryArray['firmId'] =  (\Auth()->user()->companyId??1) == 0 ? 1 : (\Auth()->user()->companyId??1) ;
        $body = $this->alarmsServices->getApiList($this->alarmsServices->getUrl(), static::PAGE_SIZE_DEFAULT, $page, $queryArray,  ['category'=>true,'grade'=>true]);

        $alarms = empty($body['data'])?[]:$body['data'];
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
        $queryArray['firmId'] =  (\Auth()->user()->companyId??1) == 0 ? 1 : (\Auth()->user()->companyId??1) ;
        $queryArray['status'] = 3;
        !empty($name) &&  $queryArray['name'] = $name;
        $body = $this->alarmsServices->getApiList($this->alarmsServices->getRecoverUrl(), static::PAGE_SIZE_DEFAULT, $page, $queryArray,  ['category'=>true,'grade'=>true]);
        $alarms = empty($body['data'])?[]:$body['data'];
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
        $queryArray['firmId'] =  (\Auth()->user()->companyId??1) == 0 ? 1 : (\Auth()->user()->companyId??1) ;
        $queryArray['status'] = 2;
        $body = $this->alarmsServices->getApiList($this->alarmsServices->getRecoverUrl(), static::PAGE_SIZE_DEFAULT, $page, $queryArray, ['category'=>true,'grade'=>true]);
        $alarms = empty($body['data'])?[]:$body['data'];
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