@extends('layouts.admin')

@section('content')
    <style>
        @charset "UTF-8";
        *{
            padding: 0;
            margin: 0;
        }
        html,body{
            background: #fff;
        }
        ul {
            list-style: none;
        }
        .clearfix:after {
            content: "";
            display: block;
            height: 0;
            clear: both;
            visibility: hidden;
        }
        .information{
            width: 40%;
            height: 400px;
            margin: 10% auto;
            text-align: center;
            font-size: 26px;
            color: #444;

        }
        .top{
            height: 40px;
            font-size: 24px;
            font-weight: 100;
            line-height: 40px;
        }
        .top i{
            color: #19b313;
            font-size: 40px;
            margin-right: 10px;
        }
        .orders{
            display: block;
            font-size: 18px;
            color: #999;
            margin: 20px auto;
        }
        i{
            font-style: normal;
        }
        .color{
            color: #c32d36;
        }
        .btn{
            width: 257px;
            height: 36px;
            margin: 30px auto;
        }
        .btn li{
            width: 116px;
            height: 34px;
            background: #19b313;
            line-height: 34px;
            -o-border-radius: 4px;
            -webkit-border-radius: 4px;
            -ms-border-radius: 4px;
            -moz-border-radius: 4px;
            -o-box-shadow: 1px 1px 1px #ccc;
            -webkit-box-shadow: 1px 1px 1px #ccc;
            -moz-box-shadow: 1px 1px 1px #ccc;
            float: left;
            font-size: 18px;
            border:1px solid #ccc;
        }
        .btn li:first-child{
            color: #fff;
        }
        .btn li:nth-child(2){
            float: right;
            background: #f5f5f5;
        }
        /*.ioc{
            color: #19b313;
            margin-right: 10px;
            font-size: 50px;
        }*/

        /*@media all and (max-height:760px){
            .bottom{
                width: 31%;
            }
        }*/
    </style>
  <section class="content-header">
      <h1 style="color: black;font-weight:bold;font-size:16px;">
          支付成功
      </h1>
      <ol class="breadcrumbSuXin">
          <li><a href="{{route('admin')}}" style="color:#367fa9"><i class="fa fa-dashboard"></i> 首页</a></li>
          <li class="active">{{$boxTitle}}</li>
      </ol>
  </section>

  <section class="content">
      <div class="box ">
          <div class="information">
              <div class="top"><i class="fa fa-check-circle" aria-hidden="true"></i>支付成功，算法已生效</div>
              <span class="orders">订单号：{{$orderNo}} &nbsp;|&nbsp; 支付金额：<i class="color">{{$amount}}元</i></span>
{{--              <ul class="btn clearfix">
                  <li>继续购物</li>
                  <li>查看订单</li>
              </ul>--}}
          </div>
      </div>
      {{--<div class="row">--}}
          {{--<div class="col-xs-12">--}}
              {{--<div class="box box-solid">--}}

                  {{--<div class="box-header with-border">--}}
                      {{--<h3 class="box-title">我的商品</h3>--}}
                  {{--</div>--}}
                  {{--<div class="box-body">--}}
                      {{--<table class="table table-bordered table-striped">--}}
                          {{--<thead>--}}
                          {{--<tr>--}}
                              {{--<th>图片</th>--}}
                              {{--<th>名称</th>--}}
                              {{--<th>价格</th>--}}
                              {{--<th>操作</th>--}}
                          {{--</tr>--}}
                          {{--</thead>--}}
                          {{--<tbody>--}}
                          {{--@foreach($orderProducts as $orderProduct)--}}
                          {{--<tr class="product">--}}
                              {{--<td> @if($orderProduct->product->iamge??'')<img style="height: 40px;" src="{{asset($orderProduct->product->image)??''}}">@endif</td>--}}
                              {{--<td>{{$orderProduct->product->name}}</td>--}}
                              {{--<td>--}}
                               {{--<span style="text-decoration:line-through;" class="text-red">--}}
                                  {{--¥{{$orderProduct->product->price_original}}</span>--}}
                                  {{--<span style=" margin-left: 10px;" class="text-green">--}}
                                  {{--¥<span class="product-money">{{$orderProduct->product->price}}</span></span>--}}
                              {{--</td>--}}
                              {{--<td><a class="btn btn-danger btn-xs delete" orderNo="{{$order->order_no??''}}" orderId="{{$order->id??''}}" orderProductId="{{$orderProduct->id}}">删除</a></td>--}}
                          {{--</tr>--}}
                          {{--@endforeach--}}
                          {{--</tbody>--}}
                      {{--</table>--}}
                  {{--</div>--}}

                  {{--<div class="box-header with-border">--}}
                      {{--<h3 class="box-title">支付方式</h3>--}}
                  {{--</div>--}}
                  {{--<div class="box-body">--}}
                      {{--<div class="form-group">--}}
                          {{--<label style="float: left;margin-left: 50px;" >--}}
                              {{--<input type="radio" checked name="payment">&nbsp;&nbsp;<img style="height: 40px;" src="{{asset('images/weixin.jpg')}}">--}}
                          {{--</label>--}}
                          {{--<label style="float: left;margin-left: 50px;">--}}
                              {{--<input type="radio" checked name="payment">&nbsp;&nbsp;<img style="height: 40px;" src="{{asset('images/alipay.jpg')}}">--}}
                          {{--</label>--}}
                      {{--</div>--}}
                  {{--</div>--}}

                  {{--<div class="box-header with-border">--}}
                      {{--<h3 class="box-title">结算信息</h3>--}}
                  {{--</div>--}}
                  {{--<div class="box-body">--}}
                      {{--<div class="form-group" >--}}
                        {{--<div style="width: 100%;height:20px;margin:0 10px 10px 0;">--}}
                           {{--<span style="float: right;"> 最终订单金额：￥{{$order->total_price??'0.00'}}</span>--}}
                        {{--</div>--}}
                          {{--<div style="float: right;">--}}
                             {{--<input type="submit" class="btn btn-danger pull-right btn-block btn-sm pay" value="提交订单">--}}
                          {{--</div>--}}
                      {{--</div>--}}
                  {{--</div>--}}


              {{--</div>--}}
          {{--</div>--}}
      {{--</div>--}}
    <!-- /.row -->
  </section>
  <script src="{{asset('layer/layer.js')}}"></script>
  <script>


  </script>
@endsection