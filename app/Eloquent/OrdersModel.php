<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/5/10
 * Time: 上午10:10
 */
namespace App\Eloquent;

class OrdersModel extends AppModel
{
    public $timestamps = false;
    protected $table = 'orders';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','order_no','total_price','status','user_id','company_id','create_time','operate_time','delete_time'
    ];

    public function scopeOrderNo($query,$orderNo){
        $query->where('order_no', '=', $orderNo);
    }

    public function orderProducts(){
        return $this->hasMany('App\Eloquent\OrderProductModel','order_no','order_no');
    }
}