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

    const PAID_ORDER = 1;
    const NEW_ORDER = 0;
    const FAILURE_ORDER = 2;

    protected $fillable = [
        'id','order_no','total_price','status','user_id','company_id','create_time','operate_time','delete_time'
    ];

    public function scopeOrderNo($query,$orderNo){
        $query->where('order_no', '=', $orderNo);
    }

    public function scopeCompanyId($query,$companyId){
        $query->where('company_id', '=', $companyId);
    }

    public function scopeStatus($query,$status){
        $query->where('status', '=', $status);
    }

    public function getPaidStatus(){
        return self::PAID_ORDER;
    }

    public function getNewStatus(){
        return self::NEW_ORDER;
    }

    public function getFailureStatus(){
        return self::FAILURE_ORDER;
    }

    public function orderProducts(){
        return $this->hasMany('App\Eloquent\OrderProductModel','order_no','order_no');
    }

    public function payment(){
        return $this->hasOne('App\Eloquent\PaymentsModel','order_no','order_no');
    }
}