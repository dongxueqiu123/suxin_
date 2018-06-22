<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ServicesAdapte;
use App\Eloquent\ApiModuleModel;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->servicesAdapte = new servicesAdapte();
        $this->middleware('auth.user');
    }

    public function index()
    {
        $user = \Auth()->user();
        $company = $user->company;
        $url = env('HTTP_URL',$_SERVER['HTTP_HOST']);

        //机械设备总数
        $urls['equipmentCountAll'] = $url.ApiModuleModel::MODULE_EQUIPMENT_COUNTALL;
        $countInfo['equipmentCountAll'] = $this->servicesAdapte->getClient( $urls['equipmentCountAll'],0,0,['firmId'=>$company->id??'1'],[$this->servicesAdapte::LIMITATION,$this->servicesAdapte::PAGINATION]);
        //机械设备在线数
        $urls['equipmentCount'] = $url.ApiModuleModel::MODULE_EQUIPMENT_COUNT;
        $countInfo['equipmentCount'] = $this->servicesAdapte->getClient( $urls['equipmentCount'],0,0,['firmId'=>$company->id??'1','onlineFlag'=>'1'],[$this->servicesAdapte::LIMITATION,$this->servicesAdapte::PAGINATION]);

        $urls['collectorCount'] = $url.ApiModuleModel::MODULE_COLLECTOR_COUNT;
        //无线节点总数
        $countInfo['collectorCountAll'] = $this->servicesAdapte->getClient( $urls['collectorCount'],0,0,['firmId'=>$company->id??'1'],[$this->servicesAdapte::LIMITATION,$this->servicesAdapte::PAGINATION]);
        //无线节点在线数
        $countInfo['collectorCount'] = $this->servicesAdapte->getClient( $urls['collectorCount'],0,0,['firmId'=>$company->id??'1','onlineFlag'=>'1'],[$this->servicesAdapte::LIMITATION,$this->servicesAdapte::PAGINATION]);

        $urls['alarmTempCount'] = $url.ApiModuleModel::MODULE_ALARM_COUNT.'/1';
        //温度告警总数
        $countInfo['alarmTempCountAll'] = $this->servicesAdapte->getClient( $urls['alarmTempCount'],0,0,['firmId'=>$company->id??'1','category'=>'1'],[$this->servicesAdapte::LIMITATION,$this->servicesAdapte::PAGINATION]);
        //温度告警待处理数
        $urls['alarmTempCountAlarm'] = $url.ApiModuleModel::MODULE_ALARM_COUNTALARM;
        $countInfo['alarmTempCount'] = $this->servicesAdapte->getClient( $urls['alarmTempCountAlarm'],0,0,['firmId'=>$company->id??'1','firmId'=>'1','category'=>'1'],[$this->servicesAdapte::LIMITATION,$this->servicesAdapte::PAGINATION]);

        $urls['alarmBobCount'] = $url.ApiModuleModel::MODULE_ALARM_COUNT.'/2';
        //振动告警总数
        $countInfo['alarmBobCountAll'] = $this->servicesAdapte->getClient( $urls['alarmBobCount'],0,0,['firmId'=>$company->id??'1','category'=>'2'],[$this->servicesAdapte::LIMITATION,$this->servicesAdapte::PAGINATION]);
        //振动警待处理数
        $urls['alarmBobCountAlarm'] = $url.ApiModuleModel::MODULE_ALARM_COUNTALARM;
        $countInfo['alarmBobCount'] = $this->servicesAdapte->getClient( $urls['alarmBobCountAlarm'],0,0,['firmId'=>$company->id??'1','firmId'=>'1','category'=>'2'],[$this->servicesAdapte::LIMITATION,$this->servicesAdapte::PAGINATION]);

        $count = [];
        foreach ($countInfo as $key=>$data){
            $count[$key] = $data['code'] == 0?$data['data']:0;
        }
        return view('admin.index',[
            'company' => $company,
            'count'   => $count
        ]);
    }

    public function highcharts(){
        return view('admin.highchart');
    }


    public function permission(){
        return view('permission');
    }


}
