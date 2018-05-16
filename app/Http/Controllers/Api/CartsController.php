<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/5/8
 * Time: 下午4:09
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CartsServices;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    public function __construct()
    {
        $this->cartsServices = new CartsServices();
        $this->middleware('auth.user');
    }

    public function store(Request $request){
        $request->validate([
            'productId' => 'required',
        ]);
        $input = $request->only(['productId']);
        $input['userId'] = \Auth::user()->id;
        $input['companyId'] = (\Auth::user()->company->id??0);
        $carts = $this->cartsServices->getList(0,$input);
        if($carts->isEmpty()){
            if($state = $this->cartsServices->save($input)){
                return response()->json([
                    'state' => $state,
                    'route' => route('products.buy'),
                    'info' => '添加购物车成功',
                ]);
            }
        }else{
            return response()->json([
                'state' => '201',
                'route' => route('products.buy'),
                'info' => '购物车已存在此商品']);
        }

    }

    public function delete(Request $request){
        $request->validate([
            'idStr' => 'required',
        ]);
        $idStr = $request->input('idStr');
        $ids = explode(',',$idStr);
        foreach ($ids as $id){
            $input['id'] = $id;
            $input['deleteTime'] = date('Y-m-d H-i-s',time());
            $state = $this->cartsServices->save($input);
        }
        return response()->json([
            'state' => $state,
            'route' => route('carts'),
        ]);
    }
}
