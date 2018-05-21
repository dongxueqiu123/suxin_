<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/5/10
 * Time: 上午11:28
 */
namespace App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderProductModel extends AppModel
{
    public $timestamps = false;
    protected $table = 'order_product';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','order_no','product_id'
    ];

    public function scopeOrderNo($query,$orderNo){
        $query->where('order_no', '=', $orderNo);
    }

    public function product(){
        return $this->hasOne('App\Eloquent\ProductsModel','id','product_id');
    }

}