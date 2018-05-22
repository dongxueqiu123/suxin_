<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/5/9
 * Time: 下午3:16
 */
namespace App\Http\Controllers\Admin;

use App\Eloquent\OrdersModel;
use App\Http\Controllers\Controller;
use App\Services\OrderProductServices;
use App\Services\OrdersServices;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function __construct(){
        $this->orders = new OrdersModel();
        $this->ordersServices = new OrdersServices();
    }

    public function index(Request $request){
        $type = $request->input('type')??1;
        $page = $request->input('page');
        $parameters = ['type' => ($type)];
        $companyId = \Auth::user()->company->id??'';
        $queryArray = [];
        $companyId && $queryArray['companyId'] = $companyId;
        $queryArray['status'] = 0;
        $ext['page'] = $type == $queryArray['status'] ? $page: 1;
        $newOrders =  $this->ordersServices->getList(static::PAGE_SIZE_DEFAULT, $queryArray,true,true,$ext);
        foreach ($newOrders as $order){
           if(time()-strtotime($order->create_time)>=30*60 && $order->status==0){
               $modelData['id'] = $order->id;
               $modelData['status'] = 2;
               if($this->ordersServices->save($modelData)){
                   $order->status = $modelData['status'];
               }
           }
        }

        $queryArray['status'] = 1;
        $ext['page'] = $type == $queryArray['status'] ? $page: 1;
        $payOrders =  $this->ordersServices->getList(static::PAGE_SIZE_DEFAULT, $queryArray,true,true,$ext);

        $queryArray['status'] = 2;
        $ext['page'] = $type == $queryArray['status'] ? $page: 1;
        $overdueOrders =  $this->ordersServices->getList(static::PAGE_SIZE_DEFAULT, $queryArray,true,true,$ext);

        return view('orders.list',
            [
                'boxTitle'=>'我的订单',
                'active' => 'orders',
                'orderProducts'=>$order->orderProducts??[],
                'route' => route('api.orderProduct.delete'),
                'newOrders' => $newOrders??'',
                'payOrders' => $payOrders??'',
                'overdueOrders' => $overdueOrders??'',
                'parameters' => $parameters??[],
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

    public function info($orderNo){

        if($orderNo == 0 ){
            $companyId = \Auth::user()->company->id??0;
            $options['status'] = $this->orders->getPaidStatus(); //1是已支付
            $orders = $this->ordersServices->getByCompany($companyId, $options);
        }else{
            $order = $this->ordersServices->getByOrderNo($orderNo);
            $orders[]=$order;
        }
        return view('orders.info',
            [
                'boxTitle'=>'订单详情',
                'active' => 'ordersInfo',
                'orders' => $orders,
                'route' => route('api.orderProduct.delete'),
            ]
        );
    }
}