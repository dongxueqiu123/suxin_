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

    const ALI_PAY    = 1;
    const WEIXIN_PAY = 2;
    const UNION_PAY  = 3;
    const PAYMENTS   = ['1'=>'支付宝' ,'2'=>'微信' ,'3'=>'银联'];
    const UNKNOWN    = '未知';

    protected $fillable = [
        'id','pay_type','order_no','total_amount','trade_no','notify_info'
    ];

    public function scopeOrderNo($query,$orderNo)
    {
      $query->where('order_no','=',$orderNo);
    }

    public function getAlipayId(){
        return self::ALI_PAY;
    }

    public function getWeiXinId(){
        return self::WEIXIN_PAY;
    }

    public function getUnionPayId(){
        return self::UNION_PAY;
    }

    public function getPayName($payId){
          foreach (self::PAYMENTS as $id=>$name){
                 if($id == $payId){
                     return $name;
                 }
          }
          return  self::UNKNOWN;
    }

    public function getPayTypeAttribute($value)
    {
        return $this->getPayName($value);
    }

}