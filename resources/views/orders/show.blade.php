@extends('layouts.admin')

@section('content')
  <section class="content-header">
      <h1>
          <small>订单列表</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> 后台首页</a></li>
          <li class="active">{{$boxTitle}}</li>
      </ol>
  </section>

  <section class="content">

      <div class="row">
          <div class="col-xs-12">
              <div class="box box-solid">

                  <div class="box-header with-border">
                      <h3 class="box-title">我的商品</h3>
                  </div>
                  <div class="box-body">
                      <table class="table table-bordered table-striped">
                          <thead>
                          <tr>
                              <th>图片</th>
                              <th>名称</th>
                              <th>价格</th>
                              <th>操作</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($orderProducts as $orderProduct)
                          <tr class="product">
                              <td> @if($orderProduct->product->img??'')<img style="height: 40px;" src="{{asset($orderProduct->product->img)??''}}">@else <img style="height: 40px;" src="{{asset('images/hot.png')}}"> @endif</td>
                              <td>{{$orderProduct->product->name}}</td>
                              <td>
                               <span style="text-decoration:line-through;" class="text-red">
                                  ¥{{$orderProduct->product->price_original}}</span>
                                  <span style=" margin-left: 10px;" class="text-green">
                                  ¥<span class="product-money">{{$orderProduct->product->price}}</span></span>
                              </td>
                              <td><a class="btn btn-danger btn-xs delete" orderNo="{{$order->order_no??''}}" orderId="{{$order->id??''}}" orderProductId="{{$orderProduct->id}}">删除</a></td>
                          </tr>
                          @endforeach
                          </tbody>
                      </table>
                  </div>

                  <div class="box-header with-border">
                      <h3 class="box-title">支付方式</h3>
                  </div>
                  <div class="box-body">
                      <div class="form-group">
{{--                          <label style="float: left;margin-left: 50px;" >
                              <input type="radio" name="payment" value="3">&nbsp;&nbsp;<img style="height: 40px;" src="{{asset('images/weixin.jpg')}}">
                          </label>--}}
                          <label style="float: left;margin-left: 50px;">
                              <input type="radio" checked name="payment" value="{{$alipayId}}">&nbsp;&nbsp;<img style="height: 40px;" src="{{asset('images/alipay.jpg')}}">
                          </label>
         {{--                 <label style="float: left;margin-left: 50px;">
                              <input type="radio" name="payment" value="{{$unionId}}">&nbsp;&nbsp;<img style="height: 40px;" src="{{asset('images/union.jpg')}}">
                          </label>--}}
                      </div>
                  </div>

                  <div class="box-header with-border">
                      <h3 class="box-title">结算信息</h3>
                  </div>
                  <div class="box-body">
                      <div class="form-group" >
                        <div style="width: 100%;height:20px;margin:0 10px 10px 0;">
                           <span style="float: right;"> 最终订单金额：￥{{$order->total_price??'0.00'}}</span>
                        </div>
                          <div style="float: right;">
                             <input type="submit" class="btn btn-danger pull-right btn-block btn-sm pay" value="提交订单">
                          </div>
                      </div>
                  </div>


              </div>
          </div>
      </div>
    <!-- /.row -->
  </section>
  <script src="{{asset('layer/layer.js')}}"></script>
  <script>

      $('.delete').click(function () {
          var orderNo,orderId,orderProductId;
          orderNo =  $(this).attr('orderNo');
          orderId =  $(this).attr('orderId');
          orderProductId =  $(this).attr('orderProductId');
          layer.confirm('是否删除？', {
              btn: ['删除','取消'] //按钮
          }, function(){
              $.ajax({
                  url:'{{$route}}',
                  type:'POST',    //GET
                  async:true,    //或false,是否异步
                  data:{
                      orderNo:orderNo,
                      orderId:orderId,
                      orderProductId:orderProductId
                  },
                  timeout:5000,    //超时时间
                  dataType:'json',
                  success:function(data,textStatus,jqXHR){
                      window.location.href = data.route;
                  }
              })
          }, function(){
              layer.close();
          });
          return false;
      });

      $('.pay').on('click',function(){
          var orderNo,type;
          orderNo = '{{$order->order_no??''}}';
          type    =  $('input[name="payment"]:checked').val();
          $.ajax({
              url:'{{route('api.orders.getBeUseInfo')}}',
              type:'POST',    //GET
              async:true,    //或false,是否异步
              data:{
                  orderNo:orderNo,
                  type:type
              },
              timeout:5000,    //超时时间
              dataType:'json',
              success:function(data,textStatus,jqXHR){
                  if(data.state == 200){
                      window.location.href= data.url;
                  }else if (data.state  == 0){
                      var info ='商品'+data.info+'已经购买';
                      layer.confirm(info, {
                          btn: ['确定'] //按钮
                      })
                  }
              }
          })
      });

  </script>
@endsection