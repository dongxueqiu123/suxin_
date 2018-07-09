<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/7/6
 * Time: 上午10:35
 */
namespace App\Http\Controllers\Api;

use App\Services\AlarmsServices;
use App\Services\ThresholdsServices;
use Illuminate\Http\Request;
use App\Eloquent\ApiModuleModel;
use App\Http\Controllers\Controller;

class AlgorithmsController extends Controller{
    public function __construct()
    {
        $this->alarmsServices = new AlarmsServices();
        $this->middleware('auth.user');
    }

    public function getOptionHtml(Request $request){
        $className = $request->input('className');
        $str = '';
        $classes = config('algorithm.'.$className.'.classify');
        foreach ($classes as $name=>$class){
            $str.= '<option value="'.$name.'">'.$class['name'].'</option>';
        }
        return response()->json([
            'code' => 0,
            'info'  => $str
        ]);
    }
}