<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/7/6
 * Time: 上午10:37
 */
namespace App\Services;

use App\Eloquent\AlarmsModel;
use App\Eloquent\ApiModuleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class AlgorithmsServices extends ServicesAdapte{
    public function __construct(){
        $this->init();
    }

    public function init(){

    }

    public function getUrl(){
        return env('HTTP_URL',$_SERVER['HTTP_HOST']).ApiModuleModel::MODULE_DEMO;
    }
}
