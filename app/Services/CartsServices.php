<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/5/8
 * Time: 下午4:04
 */
namespace App\Services;

use App\Eloquent\CartsModel;
class CartsServices extends ServicesAdapte
{
    public function __construct(){
        $this->init();
    }

    private $carts;
    public function init(){
        $this->carts = new CartsModel();
    }

    public function getList(int $pageSize = 0,
                            array $queryArray = [],
                            bool $queryBelongsTo = true,
                            bool $queryChildren = true, $ext = []){

        $query = $this->carts->nothing()->deleteTime();
        foreach($queryArray as $key => $value){
           if($key == 'productId'){
               $query->productId($value);
           }elseif($key == 'userId'){
               $query->userId($value);
           }elseif($key == 'companyId'){
               $query->companyId($value);
           }
        }
        $liaisons = $pageSize === 0?$query->get(): $query->paginate($pageSize);
        return $liaisons;
    }

    public function get($id){
        $thresholds = $this->carts::find($id);
        return $thresholds;
    }

    public function getCount(){
        $count = $this->carts::deleteTime()->count();
        return $count;
    }

    public function save(array $modelData)
    {
        if(isset($modelData['id'])){
            $this->carts = $this->get($modelData['id']);
        }
        ($modelData['productId']??'') && $this->carts->product_id = $modelData['productId'];
        $this->carts->user_id = \Auth::user()->id;
        $this->carts->company_id = (\Auth::user()->company->id??0);
        ($modelData['deleteTime']??'') && $this->carts->delete_time = $modelData['deleteTime'];
        $state = $this->carts->save();
        return $state;
    }
}