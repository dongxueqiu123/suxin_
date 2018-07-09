<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ServicesAdapte;
use App\Eloquent\ApiModuleModel;
use Illuminate\Support\Facades\DB;
use App\Services\EquipmentsServices;
use App\Services\CollectorsServices;
use App\Services\AlarmsServices;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->equipmentsServices = new EquipmentsServices();
        $this->collectorsServices = new CollectorsServices();
        $this->alarmsServices = new AlarmsServices();
        $this->servicesAdapte = new servicesAdapte();
        $this->middleware('auth.user');
    }

    public function test(){

        $user = DB::select('select * from users where id = :id', ['id' => 1]);
        dump($user[0]);die;
    }

    public function index()
    {
        $firmId =  (\Auth()->user()->companyId??1) == 0 ? 1 : (\Auth()->user()->companyId??1);
        //机械设备总数
        $countInfo['equipmentCountAll'] = $this->equipmentsServices->getInfoClient( $this->equipmentsServices->getCountAllUrl(),['firmId'=>$firmId]);
        //机械设备在线数
        $countInfo['equipmentCount'] = $this->equipmentsServices->getInfoClient( $this->equipmentsServices->getCountUrl(),['firmId'=>$firmId,'onlineFlag'=>'1']);

        //无线节点总数
        $countInfo['collectorCountAll'] = $this->collectorsServices->getInfoClient($this->collectorsServices->getCountUrl(),['firmId'=>$firmId]);
        //无线节点在线数
        $countInfo['collectorCount'] = $this->collectorsServices->getInfoClient( $this->collectorsServices->getCountUrl(),['firmId'=>$firmId,'onlineFlag'=>'1']);

        //温度告警总数
        $countInfo['alarmTempCountAll'] = $this->alarmsServices->getInfoClient( $this->alarmsServices->getCountUrl('1'),['firmId'=>$firmId,'category'=>'1']);
        //温度告警待处理数
        $countInfo['alarmTempCount'] = $this->alarmsServices->getInfoClient($this->alarmsServices->getCountAlarmUrl(),['firmId'=>$firmId,'firmId'=>'1','category'=>'1']);

        //振动告警总数
        $countInfo['alarmBobCountAll'] = $this->alarmsServices->getInfoClient( $this->alarmsServices->getCountUrl('2'),['firmId'=>$firmId,'category'=>'2']);
        //振动警待处理数
        $countInfo['alarmBobCount'] = $this->alarmsServices->getInfoClient( $this->alarmsServices->getCountAlarmUrl(),['firmId'=>$firmId,'category'=>'2']);

        $count = [];
        foreach ($countInfo as $key=>$data){
            $count[$key] = $data['code'] == 0?$data['data']:0;
        }
        return view('admin.index',[

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
