<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/6/21
 * Time: 下午4:04
 */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Eloquent\ApiModuleModel;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->servicesAdapte = new servicesAdapte();
        $this->middleware('auth.user');
    }

    public function getMapPoint(){
       dump(1);die;
    }
}