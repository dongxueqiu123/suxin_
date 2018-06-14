@extends('layouts.admin')

@section('content')
  <section class="content-header">
      <h1 style="color: black;font-weight:bold;font-size:16px;">
          订单详情
      </h1>
      <ol class="breadcrumbSuXin">
          <li><a href="{{route('admin')}}" style="color:#367fa9"><i class="fa fa-dashboard"></i> 首页</a></li>
          <li class="active">{{$boxTitle}}</li>
      </ol>
  </section>

  <section class="content">
      <div class="row">
          @foreach($orders??[] as $order)
      <div class="col-md-12">
          <div class="box box-solid">
              <div class="box-header with-border">
                  <span class="box-title">订单号：{{$order->order_no??''}}</span>
                  @if(($order->status??'') == 0)

                      <span class="box-title" style="margin-left:30px;">状态：新订单</span>
                  @elseif(($order->status??'') == 1)

                      <span class="box-title text-green" style="margin-left:30px">状态：已付款</span>
                  @else

                      <span class="box-title text-red" style="margin-left:30px;">状态：失效订单</span>
                  @endif
                  <span class="box-title"  style="margin-left:30px;">金额：￥{{$order->total_price??'0.00'}}</span>
                  <span class="box-title text-green"  style="margin-left:30px;">方式：{{$order->payment->pay_type??'未知'}}</span>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                  <table class="table table-bordered">
                      <tr>
                          <th style="width: 100px">序号</th>
                          <th>商品图片</th>
                          <th>商品名称</th>
                          <th style="width: 180px">商品价格</th>
                      </tr>
                      @foreach($order->orderProducts??[] as $key=>$orderProduct)
                      <tr>
                          <td>{{$key+1}}.</td>
                          <td> @if($orderProduct->product->img??'')<img style="height: 40px;" src="{{asset($orderProduct->product->img)??''}}">@else <img style="height: 40px;" src="{{asset('images/hot.png')}}"> @endif</td>
                          <td>
                             {{$orderProduct->product->name}}
                          </td>
                          <td>
                              <span style="text-decoration:line-through;" class="text-red">
                                  ¥{{$orderProduct->product->price_original}}</span>
                              <span style=" margin-left: 10px;" class="text-green">
                                  ¥<span class="product-money">{{$orderProduct->product->price}}
                                  </span></span>
                          </td>
                      </tr>
                      @endforeach

                  </table>
              </div>
          </div>
          <!-- /.box -->


          <!-- /.box -->
      </div>
          @endforeach
      </div>
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
          var orderNo;
          orderNo =  '{{$order->order_no??''}}';
          $.ajax({
              url:'{{route('api.orders.getBeUseInfo')}}',
              type:'POST',    //GET
              async:true,    //或false,是否异步
              data:{
                  orderNo:orderNo,
              },
              timeout:5000,    //超时时间
              dataType:'json',
              success:function(data,textStatus,jqXHR){
                  if(data.state == 200){

                      window.location.href='{{route('pay.alipay',['id'=>$order->order_no??''])}}';
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