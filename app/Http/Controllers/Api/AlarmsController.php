<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/4/2
 * Time: 下午1:21
 */
namespace App\Http\Controllers\Api;

use App\Services\AlarmsServices;
use App\Services\ThresholdsServices;
use Illuminate\Http\Request;
use App\Eloquent\ApiModuleModel;
use App\Http\Controllers\Controller;

class AlarmsController extends Controller{
    public function __construct()
    {
        $this->alarmsServices = new AlarmsServices();
        $this->middleware('auth.user');
    }


    public function edit(Request $request){
        $input = $request->only(['remark' ,'status' ,'collectorId' ,'id' ,'category' ,'operatorId']);
        $data = $this->alarmsServices->postClient(env('HTTP_URL',$_SERVER['HTTP_HOST']).ApiModuleModel::MODULE_ALARM_UPDATEBYID ,$input);
        return response()->json([
            'code' => $data['code'],
            'route' => route('alarms')
        ]);
    }
}