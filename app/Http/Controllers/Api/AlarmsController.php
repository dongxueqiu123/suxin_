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
use App\Http\Controllers\Controller;

class AlarmsController extends Controller{
    public function __construct()
    {
        $this->alarmsServices = new AlarmsServices();
        $this->middleware('auth.user');
    }


    public function edit($id,Request $request){
        $request->validate([
            'status'=>'required',
        ]);
        $input = $request->only(['status' ,'remark']);
        $input['id'] = $id;
        if($state = $this->alarmsServices->save($input)){
            return response()->json([
                'state' => $state,
                'route' => route('alarms')
            ]);
        }
    }
}