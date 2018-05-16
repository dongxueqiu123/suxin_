<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/5/3
 * Time: 下午3:49
 */
namespace App\Services;


use App\Eloquent\ProductsDetailsModel;

class ProductsDetailsServices extends ServicesAdapte
{
    public function __construct(){
        $this->init();
    }

    private $productsDetails;
    public function init(){
        $this->productsDetails = new ProductsDetailsModel();
    }

    public function get($id){
        $thresholds = $this->productsDetails::find($id);
        return $thresholds;
    }

    public function save(array $modelData){
        if($this->get($modelData['id'])){
            $this->productsDetails = $this->get($modelData['id']);
        }else{
            $this->productsDetails->id = $modelData['id'];
        }
        ($modelData['unit']??'') &&  $this->productsDetails->unit = $modelData['unit'];
        ($modelData['description']??'') &&  $this->productsDetails->description = $modelData['description'];
        $state = $this->productsDetails->save();
        return $state;
    }

    public function destroy($id){
        $result = $this->productsDetails::where('id',$id)->delete();
        return $result;
    }
}