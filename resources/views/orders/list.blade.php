@extends('layouts.admin')

@section('content')
  <section class="content-header">
      <h1 style="color: black;font-weight:bold;font-size:16px;">
          订单列表
      </h1>
      <ol class="breadcrumbSuXin">
          <li><a href="{{route('admin')}}" style="color:#367fa9"><i class="fa fa-dashboard"></i> 首页</a></li>
          <li class="active">{{$boxTitle}}</li>
      </ol>
  </section>

  <section class="content">

      <div class="row">
          <div class="col-xs-12">
              <div class="box box-solid">


                  <!-- /.tab-content -->

                  <div class="nav-tabs-custom">
                      <ul class="nav nav-tabs">
                          <li @if($parameters['type'] == 1)class="active" @endif><a href="#1" data-toggle="tab">已支付订单</a></li>
                          <li @if($parameters['type'] == 0)class="active" @endif><a href="#2" data-toggle="tab">新订单</a></li>
                          <li @if($parameters['type'] == 2)class="active" @endif><a href="#3" data-toggle="tab">过期订单</a></li>
                      </ul>
                      <div class="tab-content">
                          <div class="@if($parameters['type'] == 1)active @endif tab-pane" id="1">
                              <div class="nav-tabs-custom">
                                  <div class="tab-content">
                                      <div class="active tab-pane" id="timeline">
                                          <!-- /.box-header -->
                                          <div class="">
                                              <table id="example1" class="table table-bordered table-striped">
                                                  <thead>
                                                  <tr>
                                                      <th>订单号</th>
                                                      <th>创建时间</th>
                                                      <th>订单状态</th>
                                                      <th>商品</th>
                                                      <th>金额</th>
                                                      <th>操作</th>
                                                  </tr>
                                                  </thead>

                                                  <tbody>
                                                  @foreach($payOrders as $order)
                                                      <tr{{-- @if($order->status == 1) class= "text-green" @elseif($order->status == 2)class= "text-red" @endif--}}>
                                                          <td>{{$order->order_no}}</td>
                                                          <td>{{$order->create_time??''}}</td>
                                                          <td>@if($order->status == 0)新订单@elseif($order->status == 1)已支付@else过期@endif</td>
                                                          <td>{{$order->total_price??''}}</td>
                                                          <td>{{$order->total_price??''}}</td>
                                                          <td>
                                                              @if($order->status == 0)
                                                                  <a class="btn btn-default btn-flat btn-xs " href={{route('orders.show',['id'=>$order->order_no])}}>查看</a>
                                                              @endif

                                                              <a class="btn btn-default btn-flat btn-xs " href={{route('orders.info',['id'=>$order->order_no])}}>详情</a>
                                                          </td>
                                                      </tr>
                                                  @endforeach
                                                  </tbody>
                                              </table>
                                              {!! $payOrders->appends(['type'=>'1'])->links() !!}
                                          </div>
                                          <!-- /.box-body -->
                                      </div>
                                      <!-- /.box -->
                                  </div>
                              </div>
                          </div>

                          <div class="@if($parameters['type'] == 0)active @endif tab-pane" id="2">
                              <div class="nav-tabs-custom">
                                  <div class="tab-content">
                                      <div class="active tab-pane" id="timeline">
                                          <!-- /.box-header -->
                                          <div class="">
                                              <table id="example1" class="table table-bordered table-striped">
                                                  <thead>
                                                  <tr>
                                                      <th>订单号</th>
                                                      <th>创建时间</th>
                                                      <th>订单状态</th>
                                                      <th>商品</th>
                                                      <th>金额</th>
                                                      <th>操作</th>
                                                  </tr>
                                                  </thead>

                                                  <tbody>
                                                  @foreach($newOrders as $order)
                                                      <tr @if($order->status == 1) class= "text-green" @elseif($order->status == 2)class= "text-red" @endif>
                                                          <td>{{$order->order_no}}</td>
                                                          <td>{{$order->create_time??''}}</td>
                                                          <td>@if($order->status == 0)新订单@elseif($order->status == 1)已支付@else过期@endif</td>
                                                          <td>{{$order->total_price??''}}</td>
                                                          <td>{{$order->total_price??''}}</td>
                                                          <td>
                                                              @if($order->status == 0)
                                                                  <a class="btn btn-default btn-flat btn-xs " href={{route('orders.show',['id'=>$order->order_no])}}>查看</a>
                                                              @endif

                                                              <a class="btn btn-default btn-flat btn-xs " href={{route('orders.info',['id'=>$order->order_no])}}>详情</a>
                                                          </td>
                                                      </tr>
                                                  @endforeach
                                                  </tbody>
                                              </table>
                                              {!! $newOrders->appends(['type'=>'0'])->links() !!}
                                          </div>
                                          <!-- /.box-body -->
                                      </div>
                                      <!-- /.box -->
                                  </div>
                              </div>
                          </div>

                          <div class="@if($parameters['type'] == 2)active @endif tab-pane" id="3">
                              <div class="nav-tabs-custom">
                                  <div class="tab-content">
                                      <div class="active tab-pane" id="timeline">
                                          <!-- /.box-header -->
                                          <div class="">
                                              <table id="example1" class="table table-bordered table-striped">
                                                  <thead>
                                                  <tr>
                                                      <th>订单号</th>
                                                      <th>创建时间</th>
                                                      <th>订单状态</th>
                                                      <th>商品</th>
                                                      <th>金额</th>
                                                      <th>操作</th>
                                                  </tr>
                                                  </thead>

                                                  <tbody>
                                                  @foreach($overdueOrders as $order)
                                                      <tr>
                                                          <td>{{$order->order_no}}</td>
                                                          <td>{{$order->create_time??''}}</td>
                                                          <td>@if($order->status == 0)新订单@elseif($order->status == 1)已支付@else过期@endif</td>
                                                          <td>{{$order->total_price??''}}</td>
                                                          <td>{{$order->total_price??''}}</td>
                                                          <td>
                                                              @if($order->status == 0)
                                                                  <a class="btn btn-default btn-flat btn-xs " href={{route('orders.show',['id'=>$order->order_no])}}>查看</a>
                                                              @endif

                                                              <a class="btn btn-default btn-flat btn-xs " href={{route('orders.info',['id'=>$order->order_no])}}>详情</a>
                                                          </td>
                                                      </tr>
                                                  @endforeach
                                                  </tbody>
                                              </table>
                                              {!! $overdueOrders->appends(['type'=>'2'])->links() !!}
                                          </div>
                                          <!-- /.box-body -->
                                      </div>
                                      <!-- /.box -->
                                  </div>
                              </div>
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



  </script>
@endsection