<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/5/7
 * Time: 下午5:02
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CartsServices;

class CartsController extends Controller
{
    public function __construct(){
        $this->cartsServices = new CartsServices();
    }

    public function index()
    {
        $companyId = \Auth::user()->company->id??'';
        $queryArray = [];
        $companyId && $queryArray['companyId'] = $companyId;
        $carts = $this->cartsServices->getList('0',$queryArray);
        foreach ($carts as $cart){
            $ids[] = $cart->id;
        }
        $idStr = implode(',',$ids??[]);
        return view('carts.list',
            [
                'idStr' => $idStr,
                'carts' => $carts,
                'boxTitle'=>'',
                'active' => 'carts',
                'route' => route('api.carts.store'),
            ]
        );
    }

}