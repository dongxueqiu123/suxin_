<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/5/16
 * Time: 下午4:17
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Log as payLog;
use Yansongda\Pay\Pay;
use Yansongda\Pay\Log;
use App\Services\OrdersServices;
use App\Services\PaymentsServices;
use Illuminate\Http\Request;

class PayController extends Controller
{
    protected $config = [
        'app_id' => '2018052160178127',
        'notify_url' => 'https://www.suxiniot.com/admin/pay/notify',
        'return_url' => 'https://www.suxiniot.com/admin/pay/return',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAgQEll+Rof2YRpZP5ykAyY07Lnpew3VYGsLglygypvn2VDef1pIZf6QyMk/awp7/7Lk7bAvxthg1u6FlEbqXikqH6utzAsk656/qX+CPfr3hdpDKKuMP4p7FQiMn1sYGqs+vHpEofIBN4YuoGi2Y/KGPttgvzhmtrEgc/Ji5eXugHyD8ma/uy+zxCglZPtsZCDBOsnnnAU8oZr+5zrxxIyQ+DlqpOF3ca5AmY2pqPYLbN+71/TskhaWbokkCyw/EuAnd8eZDpoSAcrM9OfWAE6giTjZE1LjkS+/HXDNH81uk2IabkfJTi00hLlGNdFFOQHVgoQGW5cllTCL42ijL0lQIDAQAB',
        // 加密方式： **RSA2**

        'private_key'=>'MIIEpgIBAAKCAQEAwIxTEnlQ+QCXtjzRzhmAlG5FRxIx5O3Mylvq5JgsMgYTpN+dt801n3nLkQVSW2wlk8XlurW/eCGuUEZq77YGdsJsSICVo8I+2HJAgqkrRAErfa4nUO5v6yw+jbYs2fIJxX0bTGKUKaeutEF5fUrGEd8ytoAlfhR3xNmOtdt+VLCGh5U+xmojTrT68hNuFRIa6+hmDkumPdI3ef5QJDj0wF2qrgAC/sYmwTQ8TUQb54hWW/oNCSRxh5N/7oxDowZlXGgCcD8UsYXOvdqc9Ny8LkQPf55TGRxfBt6I+wSE8fQIU3AGlZEZ3/w8zqlIpYd0K2+3UHCbgvLdkWIpslM9IQIDAQABAoIBAQC2N9YiBIc5rnLktrgCqKXDUnvjX3eyY81LsCMiRFSG3rNWc3zpxZ06l+OrEXM4K6eAKmdXA8r4YD97nrhytDt3xlT9ZBq5CAm7gpxESt40FDtZTCfO8mceExf7umzFsMXIjLX52szGgvbVhaT4invZy/VNOwbAQ5R4yT7CIb9zWpp+VqsucKjVU0FDARPpiF3hmWBMfugsiXoPnjI/MK4yjDYdiDyirX3JN2aAF2qCKnli40lSj9YbatL24qiw0AYoiRVVhqFV1yzs5YYcKbUTC8CuP4Ho1cQDpM6VuQAND01o+V7og9fJQ5ppu/6jnGS8z7apAvh3LLIITxBYzGJlAoGBAOsJ3cWJxW/Yj1RxxdZU0q2/zURF94gy9qUABLKthZsJWo7qjfvDv0VERO4Y/QouXdN8U0lbuGXZIp9Ok9s+3GIhRnqFxCkR/QjL2oYkDP9Wef0xolKCJKRm9KyjVVfF8QJ17/71KFUeepr6VlMFOzwsFxS2gDbnKYQdoWOm0BxrAoGBANG4XZaL+RfvuvT2Wh7YjeMOwvZFAL+u0BpnN9Ch4lq2fHqSeDcCH28nXTFJwQjCgtcfDJJT+9ufUD0Y8+5Y+at93qSlWLgqiMyIYF/Z8DzYlBQ8gdglT3y8wyWNW40wTqXBmjMQ+IqExl739MxgT55UM0UWNyJyMy9rojGCLK+jAoGBAJ6XiLHqtXMzn/rtzf1CPOoKOnov78dSBATvzzu1RCqJlDZM5EMWIPCfERfLeqotARhbkmM0ZWcrrWXrAm90qgX4x/KSYfsIbUFLNAdBOhfshOGoZQvhTtIzujLm/wX7xRTQ+YCCcZWFvFroQelA5WhDo8tRHZBuSCAiUizIeTJDAoGBALiIY0EOlPWs6XKWOiIeJmr+GCqd+NSxO0egPwqDBysOm2U28DRm18X0exndbc8JaBtlpKg04c4T1oSMKkc1Xyq4rGlvXCtgsdJWxYZRvAOuBk3wF8havCBj78phIYeQVAOh4M7CRg+MWQhDYdFbhXMpX5uQup7Coas+KA8sHanFAoGBAKWKtZP+9XHqAuH9H+Q93m01C/A0y5KVmdnPb+5+bkyq7byZiBUBoev+cUUcP09wA6A1WMvLlAiZYrXaqLYuhHPO8srC7Q3plKkfosBSipqTneYTiWG2BQUCLNP+wRd5+R2zIiiO7tUl45iY0TVMsbkRz7jnWEMMNzSSdjLNh2TO',
        /**
         * 私钥 MIIEpgIBAAKCAQEAwIxTEnlQ+QCXtjzRzhmAlG5FRxIx5O3Mylvq5JgsMgYTpN+dt801n3nLkQVSW2wlk8XlurW/eCGuUEZq77YGdsJsSICVo8I+2HJAgqkrRAErfa4nUO5v6yw+jbYs2fIJxX0bTGKUKaeutEF5fUrGEd8ytoAlfhR3xNmOtdt+VLCGh5U+xmojTrT68hNuFRIa6+hmDkumPdI3ef5QJDj0wF2qrgAC/sYmwTQ8TUQb54hWW/oNCSRxh5N/7oxDowZlXGgCcD8UsYXOvdqc9Ny8LkQPf55TGRxfBt6I+wSE8fQIU3AGlZEZ3/w8zqlIpYd0K2+3UHCbgvLdkWIpslM9IQIDAQABAoIBAQC2N9YiBIc5rnLktrgCqKXDUnvjX3eyY81LsCMiRFSG3rNWc3zpxZ06l+OrEXM4K6eAKmdXA8r4YD97nrhytDt3xlT9ZBq5CAm7gpxESt40FDtZTCfO8mceExf7umzFsMXIjLX52szGgvbVhaT4invZy/VNOwbAQ5R4yT7CIb9zWpp+VqsucKjVU0FDARPpiF3hmWBMfugsiXoPnjI/MK4yjDYdiDyirX3JN2aAF2qCKnli40lSj9YbatL24qiw0AYoiRVVhqFV1yzs5YYcKbUTC8CuP4Ho1cQDpM6VuQAND01o+V7og9fJQ5ppu/6jnGS8z7apAvh3LLIITxBYzGJlAoGBAOsJ3cWJxW/Yj1RxxdZU0q2/zURF94gy9qUABLKthZsJWo7qjfvDv0VERO4Y/QouXdN8U0lbuGXZIp9Ok9s+3GIhRnqFxCkR/QjL2oYkDP9Wef0xolKCJKRm9KyjVVfF8QJ17/71KFUeepr6VlMFOzwsFxS2gDbnKYQdoWOm0BxrAoGBANG4XZaL+RfvuvT2Wh7YjeMOwvZFAL+u0BpnN9Ch4lq2fHqSeDcCH28nXTFJwQjCgtcfDJJT+9ufUD0Y8+5Y+at93qSlWLgqiMyIYF/Z8DzYlBQ8gdglT3y8wyWNW40wTqXBmjMQ+IqExl739MxgT55UM0UWNyJyMy9rojGCLK+jAoGBAJ6XiLHqtXMzn/rtzf1CPOoKOnov78dSBATvzzu1RCqJlDZM5EMWIPCfERfLeqotARhbkmM0ZWcrrWXrAm90qgX4x/KSYfsIbUFLNAdBOhfshOGoZQvhTtIzujLm/wX7xRTQ+YCCcZWFvFroQelA5WhDo8tRHZBuSCAiUizIeTJDAoGBALiIY0EOlPWs6XKWOiIeJmr+GCqd+NSxO0egPwqDBysOm2U28DRm18X0exndbc8JaBtlpKg04c4T1oSMKkc1Xyq4rGlvXCtgsdJWxYZRvAOuBk3wF8havCBj78phIYeQVAOh4M7CRg+MWQhDYdFbhXMpX5uQup7Coas+KA8sHanFAoGBAKWKtZP+9XHqAuH9H+Q93m01C/A0y5KVmdnPb+5+bkyq7byZiBUBoev+cUUcP09wA6A1WMvLlAiZYrXaqLYuhHPO8srC7Q3plKkfosBSipqTneYTiWG2BQUCLNP+wRd5+R2zIiiO7tUl45iY0TVMsbkRz7jnWEMMNzSSdjLNh2TO
         *
         * 公钥 MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAwIxTEnlQ+QCXtjzRzhmAlG5FRxIx5O3Mylvq5JgsMgYTpN+dt801n3nLkQVSW2wlk8XlurW/eCGuUEZq77YGdsJsSICVo8I+2HJAgqkrRAErfa4nUO5v6yw+jbYs2fIJxX0bTGKUKaeutEF5fUrGEd8ytoAlfhR3xNmOtdt+VLCGh5U+xmojTrT68hNuFRIa6+hmDkumPdI3ef5QJDj0wF2qrgAC/sYmwTQ8TUQb54hWW/oNCSRxh5N/7oxDowZlXGgCcD8UsYXOvdqc9Ny8LkQPf55TGRxfBt6I+wSE8fQIU3AGlZEZ3/w8zqlIpYd0K2+3UHCbgvLdkWIpslM9IQIDAQAB
         */
        'log' => [
            'file' => './logs/alipay.log',
            'level' => 'debug'
        ],
        //'mode' => 'dev', // optional,设置此参数，将进入沙箱模式
    ];

    public function __construct(){
        $this->ordersServices   = new OrdersServices();
        $this->paymentsServices = new PaymentsServices();
    }

    public function index($orderNo, Request $request)
    {
        $order =  $this->ordersServices->getByOrderNo($orderNo);
        $orderProducts = $this->ordersServices->isCanUse($orderNo);
        if(($order->status??null) != 0 || !($orderProducts->isEmpty())){
            return redirect(route('orders'));
        }
        $order = [
            'out_trade_no' => $orderNo,
            'total_amount' => $order->total_price??'',
            'subject' => $orderNo??'',
        ];
        $request->session()->put('orderNo', $orderNo);
        $alipay = Pay::alipay($this->config)->web($order);

        return $alipay->send();// laravel 框架中请直接 `return $alipay`
    }

    public function return(Request $request)
    {
        $data = Pay::alipay($this->config)->verify(); // 是的，验签就这么简单！
        return view('pay.return',
            [
                'boxTitle'=>'支付成功',
                'orderNo' =>$data['out_trade_no']??'',
                'amount' =>$data['total_amount']??'0.00',
            ]
        );

    }

    public function notify(Request $request)
    {
        $alipay = Pay::alipay($this->config);

        try{
            $data = $alipay->verify(); // 是的，验签就这么简单！
            $notify = $data->all();
            if($notify['trade_status'] == 'TRADE_SUCCESS' || $notify['trade_status'] == 'TRADE_FINISHED')
            {
                $order = $this->ordersServices->getByOrderNo($notify['out_trade_no']);
                $modelData['id'] = $order->id;
                $modelData['status'] = 1;
                if($this->ordersServices->save($modelData))
                {
                    $payment = $this->paymentsServices->getByOrderNo($notify['out_trade_no']);
                    if(empty($payment))
                    {
                        $paymentsData['payType']     = 1;
                        $paymentsData['orderNo']     = $notify['out_trade_no'];
                        $paymentsData['totalAmount'] = $notify['buyer_pay_amount'];
                        $paymentsData['tradeNo']     = $notify['trade_no'];
                        $paymentsData['notifyInfo']  = $data;
                        $this->paymentsServices->save($paymentsData);
                    }
                    //增加pements数据
                }
            }
        } catch (Exception $e) {
            // $e->getMessage();
        }

        return $alipay->success();// laravel 框架中请直接 `return $alipay->success()`
    }


    public function unionIndex($orderNo, Request $request)
    {


        $order =  $this->ordersServices->getByOrderNo($orderNo);
        $orderProducts = $this->ordersServices->isCanUse($orderNo);
        if(($order->status??'') != 0 || !($orderProducts->isEmpty())){
            return redirect(route('orders'));
        }

        $unionpay = app('unionpay.wap');
        $unionpay->setOrderId($orderNo);
        $unionpay->setTxnAmt($order->total_price*100??'');
        $unionpay->setTxnTime(date('YmdHis'));

        return $unionpay->consume();
    }

    public function unionReturn(Request $request)
    {
        $payInfo =  $request->all();
        return view('pay.return',
            [
                'boxTitle'=>'支付成功',
                'orderNo' =>$payInfo['orderId']??'',
                'amount' =>$payInfo['settleAmt']/100??'0.00',
            ]
        );

    }

    public function unionNotify(Request $request)
    {
        if (! app('unionpay.mobile')->verify()) {

            return 'fail';
        }
        $payInfo =  $request->all();
        if($payInfo['respCode'] == '00'){
            $order = $this->ordersServices->getByOrderNo($payInfo['orderId']);
            $modelData['id'] = $order->id;
            $modelData['status'] = 1;
            if($this->ordersServices->save($modelData))
            {
                $payment = $this->paymentsServices->getByOrderNo($payInfo['orderId']);
                if(empty($payment))
                {
                    $paymentsData['payType']     = 3;
                    $paymentsData['orderNo']     = $payInfo['orderId'];
                    $paymentsData['totalAmount'] = $payInfo['txnAmt']/100;
                    $paymentsData['tradeNo']     = $payInfo['queryId'];
                    $paymentsData['notifyInfo']  = json_encode($payInfo);
                    $this->paymentsServices->save($paymentsData);
                }

            }
        }
        return 'success';
    }

}