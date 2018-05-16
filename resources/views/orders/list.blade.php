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
                                      @foreach($orders as $order)
                                          <tr @if($order->status == 1) class= "text-green" @elseif($order->status == 2)class= "text-red" @endif>
                                              <td>{{$order->order_no}}</td>
                                              <td>{{$order->create_time??''}}</td>
                                              <td>@if($order->status == 0)新订单@elseif($order->status == 1)已支付@else过期@endif</td>
                                              <td>{{$order->total_price??''}}</td>
                                              <td>{{$order->total_price??''}}</td>
                                              <td>
                                                  @if($order->status == 0)
                                                  <a class="btn btn-primary btn-xs " href={{route('orders.show',['id'=>$order->order_no])}}>查看</a>
                                                  @endif
                                              </td>
                                          </tr>
                                      @endforeach
                                      </tbody>
                                  </table>
                                  {!! $orders->links() !!}
                              </div>
                              <!-- /.box-body -->
                          </div>
                          <!-- /.box -->
                      </div>
                  </div>
                  <!-- /.tab-content -->
              </div>
          </div>
      </div>
    <!-- /.row -->
  </section>
  <script src="{{asset('layer/layer.js')}}"></script>
  <script>



  </script>
@endsection