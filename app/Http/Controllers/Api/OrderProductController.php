<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/5/10
 * Time: 下午5:34
 */
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrdersServices;
use App\Services\OrderProductServices;

class OrderProductController extends Controller
{
    public function __construct()
    {
        $this->ordersServices = new OrdersServices();
        $this->orderProductServices = new OrderProductServices();
        $this->middleware('auth.user');
    }

    public function delete(Request $request)
    {
        $totalPrice = 0;
        $input = $request->only(['orderNo', 'orderId', 'orderProductId']);
        $this->orderProductServices->destroy($input['orderProductId']);
        $queryArray['orderNo'] = $input['orderNo'];
        $orderProducts = $this->orderProductServices->getList(0,$queryArray);
        foreach ($orderProducts as $orderProduct){
           $totalPrice += $orderProduct->product->price;
        }
        $orderArray['totalPrice'] = $totalPrice;
        $orderArray['id'] = $input['orderId'];
        if($state = $this->ordersServices->save($orderArray)){
            return response()->json([
                'state' => $state,
                'route' => route('orders.show',['orderNo'=>$input['orderNo']])
            ]);
        };
    }
}