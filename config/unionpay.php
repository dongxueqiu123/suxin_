<?php
return [
	'merchant_id'           => '777290058159887',//银联商家编码
	'cert_path'             => asset('unionpay/testcerts/700000000000001_acp.pfx'),//证书路径
	'cert_pwd'              => '000000',//证书密码
	'cert_dir'              => public_path().'/unionpay/testcerts' ,//证书地址
	'wap_return_url'        => 'http://bcd24b96.ngrok.io/admin/pay/unionReturn',//同步回调地址，前端地址
	'wap_notify_url'        => 'http://bcd24b96.ngrok.io/admin/pay/unionNotify',//异步回调地址，后台地址
	'app_notify_url'        => '',//异步回调地址，后台地址
];