<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/5/10
 * Time: 上午9:24
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\OrdersServices;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->ordersServices = new OrdersServices();
        $this->middleware('auth.user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'productStr' => 'required',
        ]);
        $productStr = $request->input('productStr');
        $input['productIds'] = explode(',',$productStr);
        $input['status'] = '0';
        $input['createTime'] = date('Y-m-d H:i:s', time());
        $input['orderNo'] = $this->ordersServices->getOrderNo();
        if($state = $this->ordersServices->save($input)){
            return response()->json([
                'state' => $state,
                'route' => route('orders.show',['orderNo'=>$input['orderNo']])
            ]);
        }
    }

    public function getBeUseInfo(Request $request){
        $orderNo = $request->input('orderNo');

        $orderProducts = $this->ordersServices->isCanUse($orderNo);

        if(!$orderProducts->isEmpty()){
            //不能使用
            $isBeUse = 0;
            foreach ($orderProducts as $orderProduct)
            {
                $products[]= $orderProduct->product->name;
            }
            $info = implode(',',$products);
        }else{
            $isBeUse = 200;
        }
        return response()->json([
            'state' => $isBeUse,
            'info' =>$info??'',
        ]);
    }

}