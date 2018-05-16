<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/5/10
 * Time: 上午10:04
 */
namespace App\Services;

use App\Eloquent\OrdersModel;


class OrdersServices extends ServicesAdapte
{
    public function __construct(){
        $this->init();
    }

    private $orders, $orderProductServices, $productsServices;
    public function init(){
        $this->orders = new OrdersModel();
        $this->orderProductServices = new OrderProductServices();
        $this->productsServices = new ProductsServices();
    }

    public function getList(int $pageSize = 0,
                            array $queryArray = [],
                            bool $queryBelongsTo = true,
                            bool $queryChildren = true, $ext = []){

        $query = $this->orders->nothing()->deleteTime();

        foreach($queryArray as $key => $value){
            if($key == 'orderNo'){
                $value && $query->orderNo($value);
            }
        }

        $orders = $pageSize === 0?$query->get(): $query->paginate($pageSize);
        return $orders;
    }

    public function get($id){
        $thresholds = $this->orders::find($id);
        return $thresholds;
    }

    public function getByOrderNo($orderNo){
        return $this->orders->nothing()->orderNo($orderNo)->first();
    }

    public function save(array $modelData)
    {
        if(isset($modelData['id'])){
            $this->orders = $this->get($modelData['id']);
            if(isset($modelData['totalPrice']))
            $this->orders->total_price = $modelData['totalPrice'];
        }else{
            $orderProducts['orderNo'] = $modelData['orderNo'];
            $totalPrice = 0;
            foreach ($modelData['productIds']??[] as $productId) {
                $orderProducts['productId'] = $productId;
                $this->orderProductServices = new OrderProductServices();
                if($this->orderProductServices->save($orderProducts)){
                    $product = $this->productsServices->get($productId);
                    $totalPrice += $product['price'];
                }
            }
            ($modelData['createTime']??'') && $this->orders->create_time = $modelData['createTime'];
            $this->orders->order_no = $modelData['orderNo'];
            $this->orders->total_price = $totalPrice;
        }
        ($modelData['status']??'') && $this->orders->status = $modelData['status'];
        $this->orders->user_id = \Auth::user()->id;
        $this->orders->company_id = (\Auth::user()->company->id??0);
        ($modelData['deleteTime']??'') && $this->orders->delete_time = $modelData['deleteTime'];
        $state = $this->orders->save();
        return $state;
    }

    /**
     * 获得订单id
     * @param string $serviceId 业务id 目前只有一个支付业务
     * @return string
     */
    public function getOrderNo($serviceId = '1'){
        $user = \Auth::user();
        $userId = $user->id??0;
        $companyId = $user->company()->id??0;
        return $serviceId.$companyId.time().$userId;
    }
}