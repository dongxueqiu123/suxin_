<?php
/**
 * Created by PhpStorm.
 * User: dxq
 * Date: 18/5/16
 * Time: 下午4:17
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Yansongda\Pay\Pay;
use Yansongda\Pay\Log;
use App\Services\OrdersServices;
use App\Services\PaymentsServices;
use Illuminate\Http\Request;

class PayController extends Controller
{
    protected $config = [
        'app_id' => '2016091500514921',
        'notify_url' => 'http://4d8687c5.ngrok.io/admin/pay/notify',
        'return_url' => 'http://4d8687c5.ngrok.io/admin/pay/return',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAw7vNsJowz5kKU1nSjIZpGTm7apVEhMYpGPZQ4qp3BnLhm+i+T2OAqAbU7KxOFltxV3SV1ogegPrXCsrNZbAk58mLr3u5vQh5vWtjheWGWRSRPBC/FmSAaGcU4teT2XoDpml11HDz3KFiS5czM0NhC3OvIcM3JIPj+de1rdVI/GCIXpAFmAI5Q3GjRHAzYUczOO0FRP7R5aWfezHIZbAADG31bd0b9q3OMQVBZ4JMBGa4J+JNGWY7awmEAPjTq+RZhsG98HqKWwV9bqJ5avs2WmcYYTYUfNSvG8J85Q3fNzvLhz2IEBj/2Cvp176J2vwl06WSbUUfoweqIJYbUH0P1QIDAQAB',
        // 加密方式： **RSA2**
        //'private_key' => 'MIIEpAIBAAKCAQEAs6+F2leOgOrvj9jTeDhb5q46GewOjqLBlGSs/bVL4Z3fMr3p+Q1Tux/6uogeVi/eHd84xvQdfpZ87A1SfoWnEGH5z15yorccxSOwWUI+q8gz51IWqjgZxhWKe31BxNZ+prnQpyeMBtE25fXp5nQZ/pftgePyUUvUZRcAUisswntobDQKbwx28VCXw5XB2A+lvYEvxmMv/QexYjwKK4M54j435TuC3UctZbnuynSPpOmCu45ZhEYXd4YMsGMdZE5/077ZU1aU7wx/gk07PiHImEOCDkzqsFo0Buc/knGcdOiUDvm2hn2y1XvwjyFOThsqCsQYi4JmwZdRa8kvOf57nwIDAQABAoIBAQCw5QCqln4VTrTvcW+msB1ReX57nJgsNfDLbV2dG8mLYQemBa9833DqDK6iynTLNq69y88ylose33o2TVtEccGp8Dqluv6yUAED14G6LexS43KtrXPgugAtsXE253ZDGUNwUggnN1i0MW2RcMqHdQ9ORDWvJUCeZj/AEafgPN8AyiLrZeL07jJz/uaRfAuNqkImCVIarKUX3HBCjl9TpuoMjcMhz/MsOmQ0agtCatO1eoH1sqv5Odvxb1i59c8Hvq/mGEXyRuoiDo05SE6IyXYXr84/Nf2xvVNHNQA6kTckj8shSi+HGM4mO1Y4Pbb7XcnxNkT0Inn6oJMSiy56P+CpAoGBAO1O+5FE1ZuVGuLb48cY+0lHCD+nhSBd66B5FrxgPYCkFOQWR7pWyfNDBlmO3SSooQ8TQXA25blrkDxzOAEGX57EPiipXr/hy5e+WNoukpy09rsO1TMsvC+v0FXLvZ+TIAkqfnYBgaT56ku7yZ8aFGMwdCPL7WJYAwUIcZX8wZ3dAoGBAMHWplAqhe4bfkGOEEpfs6VvEQxCqYMYVyR65K0rI1LiDZn6Ij8fdVtwMjGKFSZZTspmsqnbbuCE/VTyDzF4NpAxdm3cBtZACv1Lpu2Om+aTzhK2PI6WTDVTKAJBYegXaahBCqVbSxieR62IWtmOMjggTtAKWZ1P5LQcRwdkaB2rAoGAWnAPT318Kp7YcDx8whOzMGnxqtCc24jvk2iSUZgb2Dqv+3zCOTF6JUsV0Guxu5bISoZ8GdfSFKf5gBAo97sGFeuUBMsHYPkcLehM1FmLZk1Q+ljcx3P1A/ds3kWXLolTXCrlpvNMBSN5NwOKAyhdPK/qkvnUrfX8sJ5XK2H4J8ECgYAGIZ0HIiE0Y+g9eJnpUFelXvsCEUW9YNK4065SD/BBGedmPHRC3OLgbo8X5A9BNEf6vP7fwpIiRfKhcjqqzOuk6fueA/yvYD04v+Da2MzzoS8+hkcqF3T3pta4I4tORRdRfCUzD80zTSZlRc/h286Y2eTETd+By1onnFFe2X01mwKBgQDaxo4PBcLL2OyVT5DoXiIdTCJ8KNZL9+kV1aiBuOWxnRgkDjPngslzNa1bK+klGgJNYDbQqohKNn1HeFX3mYNfCUpuSnD2Yag53Dd/1DLO+NxzwvTu4D6DCUnMMMBVaF42ig31Bs0jI3JQZVqeeFzSET8fkoFopJf3G6UXlrIEAQ==',
        'private_key' => 'MIIEpQIBAAKCAQEArUxFzHmjF18/1iPgyjWVjeeTIPPbTucy4bx//kUWfqj5CZPtcZ3K1LDhwUn2RzlALCCO9Yg3RN/mEGnaKTACrhb6Pn8H2MkuXXR/LAHjNCtSaoiGxms8Tes9Mkk743Qp4yp67l7/Fa1fyw/NN9dk84VR1MTk/oK0Cct3paTvlCNrqyHRj4aQvV5obSxuUfLVHZTfS5crQ8xI7+xHaMYIGRpcOB3M4Jf6ohRSHZmn+jN4f9GHH2PBxJqaIOdrPhIYtPr1shAWjJ8muGaipKclNV20r9FfYvRQUCG65eKT+Xpa930TXEGFVuRmMjOFJEXzEbqeZZWTSH5bcMfvILEGzQIDAQABAoIBAQCe8ow6hX5vG2/jqzisfwVTCInL+Z62+huTLF+BCkEdn0H75PAt+3pkJnCJ5pq6rOoNDzfQQEXhKDNN7qioil6K6oxP8hdyYOPj18wkwv5vhSSsjdh/+S9wkEiq7Ly/XHZm4zmplPwGF+T6zN1/UFJJgYiSzJz0S1FygmqVRXhwt6Br7ec7os67wwmXq89ctVXpmPSAyyCAg+cuMAduaye0ijQ8OGkLiAGNoEkExHVX2IGwwPop351TJJQHQQIbiJbYxlFL014k6rOALdI3bFkPbuZngAn2078xi8nIJEOUzjhZ7fiUUpYWL0aDEEgsFCKEx79Cge15CQlaM91e56+JAoGBAOVXMjuz6fZ+RZL0lgh7HSlTS78yTiRJlCUkAXaA9W1eSU0o+rQyB4bLCJ7xjqrhgJdC26HKBOAEHjfRK1MXxCJ0ot5+bNUPiRCdILwu/PSn0mRBeu3XwZLrQLsw230V70AqibeoPWFV5USEiatXDModvg20HPrpcVSJolFkpsp/AoGBAMFxVnC9Vu8+CrJ8WtiWcj24Yt+/nMA7FHo5tshtsZ/8iivLzUILTyjaArPSy+ftvGvxnCY1lV1VDWSnkKXu6S29DAtNRfHAyA/xyUARuVlhFyRIL1dJ1834+OcF6WgGKQSrwXWR+6Ez2aAFLf1I8RsmhWTGWfld8QCEkyFY1pCzAoGBAMCf9UQp/9eWBU/B+QYUidC88oEbeoCGAFUVodjrxbffmoehZLjW0HWJsKr3TpH+J2hksl54dJHHQ640FESNUKJz/pwL6dMmYkQ/BVCp0rKXBmJIkTyVnDOPPmY7Sg8Mzk/BqrxEJZHMeG2NOKhdzBMy2f9eiXzBd/u+QkRE2sZ3AoGBAIWJ8jxd2PfLgqL4idZe9Xp6IXeI1XM21coSsYXng+mH8vKM/KONHxZ6eccdzDnNundiEYOnFfeaUWac7pQ+O6ahjQD4VUKw7Otk5KNgGO4Ewm7/jf7aMSo1p84EHL79Ea/xydmZ73W3T5LSQI9LnXY6v3d0HoSxP0A2RUOOCoFVAoGAKi2sdTiTmnOMxrJbdXPZHKC4p3+AEEMaUSLpyizyuo1HG1LZL27ZwN7gXhqdCqJmxokn3VB44P2+BNTc9Nwg4HitpYNRivoWV+EiQnHPZNgyte/T7iTzDRJbIYiYT9fFPJc7zurKcPz3kWfISfGlR20ICvsADDTmAggr9yRcqaU=',
        'log' => [ // optional
            'file' => './logs/alipay.log',
            'level' => 'debug'
        ],
        'mode' => 'dev', // optional,设置此参数，将进入沙箱模式
    ];

    public function __construct(){
        $this->ordersServices   = new OrdersServices();
        $this->paymentsServices = new PaymentsServices();
    }

    public function index($orderNo, Request $request)
    {
        $order =  $this->ordersServices->getByOrderNo($orderNo);
        $orderProducts = $this->ordersServices->isCanUse($orderNo);
        if($order->status != 0 || !($orderProducts->isEmpty())){
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
}