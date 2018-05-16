<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/5/9
 * Time: 下午3:16
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\OrderProductServices;
use App\Services\OrdersServices;

class OrdersController extends Controller
{
    public function __construct(){
        $this->ordersServices = new OrdersServices();
    }

    public function index(){
        $orders =  $this->ordersServices->getList(static::PAGE_SIZE_DEFAULT);
        foreach ($orders as $order){
           if(time()-strtotime($order->create_time)>=30*60 && $order->status==0){
               $modelData['id'] = $order->id;
               $modelData['status'] = 2;
               if($this->ordersServices->save($modelData)){
                   $order->status = $modelData['status'];
               }
           }
        }
        return view('orders.list',
            [
                'boxTitle'=>'我的订单',
                'active' => 'orders',
                'orderProducts'=>$order->orderProducts??[],
                'route' => route('api.orderProduct.delete'),
                'orders' => $orders??'',
            ]
        );
    }

    public function show($orderNo){
        $order =  $this->ordersServices->getByOrderNo($orderNo);
        if($order->status != 0){
            return redirect(route('orders'));
        }
        return view('orders.show',
            [
                'boxTitle'=>'订单列表',
                'active' => 'orders',
                'orderProducts'=>$order->orderProducts??[],
                'route' => route('api.orderProduct.delete'),
                'order' => $order??'',
            ]
        );
    }
}