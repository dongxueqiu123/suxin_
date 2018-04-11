<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/4/2
 * Time: 上午9:50
 */
namespace App\Http\Controllers\Admin;

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
        $this->middleware('auth.user');
    }

    public function index(){
        $user = \Auth()->user();
        $alarms = $this->alarmsServices->getAll();
        $filterAlarms = $this->alarmsServices->getFilterAlarms($alarms, $user);
        $alarms = array_merge($filterAlarms['company'], $filterAlarms['equipment'], $filterAlarms['collector']);
        foreach ($alarms as $alarm){
            $alarm->category = $this->thresholdsServices->getConstant($alarm,'category');
            $alarm->grade    = $this->thresholdsServices->getConstant($alarm,'grade');
        }

        return view('alarms.list',
            [
                'alarms' => $alarms,
                'boxTitle'=>'告警记录列表',
                'active' => 'alarms'
            ]
        );
    }
}