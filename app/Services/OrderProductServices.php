<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/5/10
 * Time: 上午11:31
 */
namespace App\Services;

use App\Eloquent\OrderProductModel;

class OrderProductServices extends ServicesAdapte
{
    public function __construct(){
        $this->init();
    }

    private $orderProduct;
    public function init(){
        $this->orderProduct = new OrderProductModel();
    }

    public function getList(int $pageSize = 0,
                            array $queryArray = [],
                            bool $queryBelongsTo = true,
                            bool $queryChildren = true, $ext = []){

        $query = $this->orderProduct->nothing();

        foreach($queryArray as $key => $value){
            if($key == 'orderNo'){
                $value && $query->orderNo($value);
            }

        }

        $liaisons = $pageSize === 0?$query->get(): $query->paginate($pageSize);
        return $liaisons;
    }

    public function get($id){
        $thresholds = $this->orderProduct::find($id);
        return $thresholds;
    }

    public function save(array $modelData)
    {
        if(isset($modelData['id'])){
            $this->orderProduct = $this->get($modelData['id']);
        }
        ($modelData['orderNo']??'') && $this->orderProduct->order_no = $modelData['orderNo'];
        ($modelData['productId']??'') && $this->orderProduct->product_id = $modelData['productId'];
        $state = $this->orderProduct->save();
        return $state;
    }

    public function destroy($id)
    {
        return $this->orderProduct::where('id',$id)->delete();
    }

    public function getByOrderNo($orderNo)
    {

        return $this->orderProduct::where('order_no',$orderNo)->get();
    }
}