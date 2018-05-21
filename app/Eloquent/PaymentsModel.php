<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/5/17
 * Time: 下午5:38
 */
namespace App\Eloquent;

class PaymentsModel extends AppModel
{
    public $timestamps = false;
    protected $table = 'payments';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id','pay_type','order_no','total_amount','trade_no','notify_info'
    ];

    public function scopeOrderNo($query,$orderNo)
    {
      $query->where('order_no','=',$orderNo);
    }
}