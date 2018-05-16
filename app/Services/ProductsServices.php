<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/5/3
 * Time: 上午10:18
 */
namespace App\Services;

use App\Eloquent\ProductsModel;
use App\Services\ProductsDetailsServices;

class ProductsServices extends ServicesAdapte
{
    public function __construct(){
        $this->init();
    }

    private $products;
    public function init(){
        $this->products = new ProductsModel();
        $this->productsDetailsServices = new productsDetailsServices();
    }

    public function getList(int $pageSize = 0,
                            array $queryArray = [],
                            bool $queryBelongsTo = true,
                            bool $queryChildren = true, $ext = []){

        $query = $this->products->nothing()->deleteTime();

        foreach($queryArray as $key => $value){


        }

        $liaisons = $pageSize === 0?$query->get(): $query->paginate($pageSize);
        return $liaisons;
    }

    public function get($id){
        $products = $this->products::find($id);
        return $products;
    }

    public function explodeImages($imageStr ){
        return !empty($imageStr)?explode('|',$imageStr):[];
    }

    public function save(array $modelData){
        if(isset($modelData['id'])){
            $this->products = $this->get($modelData['id']);
        }
        ($modelData['name']??'') && $this->products->name = $modelData['name'];
        ($modelData['price']??'') && $this->products->price = $modelData['price'];
        ($modelData['priceOriginal']??'') && $this->products->price_original = $modelData['priceOriginal'];
        ($modelData['isAlive']??'') && $this->products->is_alive = $modelData['isAlive'];
        ($modelData['deleteTime']??'') && $this->products->delete_time = $modelData['deleteTime'];
        ($modelData['finalImages']??'') && $this->products->img_thumbs = $modelData['finalImages'];
        ($modelData['image']??'') && $this->products->img = $modelData['image'];
/*        $this->products->unit          = $modelData['unit'];
        $this->products->description     = $modelData['description'];*/
        $state = $this->products->save();
        $detail['id']          = $this->products->id;
        ($modelData['unit']??'') && $detail['unit']        = $modelData['unit'];
        ($modelData['description']??'') &&  $detail['description'] = $modelData['description'];
        $this->productsDetailsServices->save($detail);
        return $state;
    }

    public function destroy($id){
        $result = $this->products::where('id',$id)->delete();
        $this->productsDetailsServices->destroy($id);
        return $result;
    }

}