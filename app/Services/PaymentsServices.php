<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/5/18
 * Time: 上午9:36
 */
namespace App\Services;

use App\Eloquent\PaymentsModel;

class PaymentsServices extends ServicesAdapte
{
    public function __construct(){
        $this->init();
    }

    private $payments;
    public function init()
    {
        $this->payments = new PaymentsModel();
    }

    public function get($id)
    {
        $payments = $this->payments::find($id);
        return $payments;
    }

    public function getByOrderNo($orderNo)
    {
        return $this->payments->nothing()->orderNo($orderNo)->first();
    }

    public function save(array $modelData)
    {
        if($modelData['id']??''){
            $this->payments = $this->get($modelData['id']);
        }
        ($modelData['payType']??'')     &&  $this->payments->pay_type     = $modelData['payType'];
        ($modelData['orderNo']??'')     &&  $this->payments->order_no     = $modelData['orderNo'];
        ($modelData['totalAmount']??'') &&  $this->payments->total_amount = $modelData['totalAmount'];
        ($modelData['tradeNo']??'')     &&  $this->payments->trade_no     = $modelData['tradeNo'];
        ($modelData['notifyInfo']??'')  &&  $this->payments->notify_info  = $modelData['notifyInfo'];
        $state = $this->payments->save();
        return $state;
    }

}