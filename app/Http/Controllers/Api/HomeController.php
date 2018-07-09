<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/6/21
 * Time: 下午4:04
 */

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Eloquent\ApiModuleModel;
use App\Services\CollectorsServices;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->collectorsServices = new CollectorsServices();
        $this->middleware('auth.user');
    }

    public function getMapPoint(){
        $queryArray['firmId'] =  (\Auth()->user()->companyId??1) == 0 ? 1 : (\Auth()->user()->companyId??1);
        $info = $this->collectorsServices->getApiInfo( $this->collectorsServices->getUrl(),$queryArray);
        return response()->json([
            'code' => $info['code'],
            'data' => $info['data'],
            'info' => $info['info'],]);
    }
}