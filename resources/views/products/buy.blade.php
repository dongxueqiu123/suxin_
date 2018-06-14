@extends('layouts.admin')

@section('content')
    <style type="text/css">
        td {
            text-align:center; /*设置水平居中*/
            vertical-align:middle;/*设置垂直居中*/
        }

    </style>
  <section class="content-header">
      <h1 style="color: black;font-weight:bold;font-size:16px;">
          购买商品
      </h1>
      <ol class="breadcrumbSuXin">
          <li><a href="{{route('admin')}}" style="color:#367fa9"><i class="fa fa-dashboard"></i> 首页</a></li>
          <li class="active">{{$boxTitle??''}}</li>
      </ol>
  </section>

  <section class="content">
      <div class="row">
          <!-- /.box-header -->
          @foreach($products as $key => $product)
              @if($key<=3)
          <div class="col-md-3">
              <div class="box box-solid">
                  <div class="box-body">
                      <div class="row">
                          <div class="col-md-12" >
                              <a href="{{route('buyProducts.show',['id'=>$product->id])}}">
                                  <img style="width: 100%;" @if($product->img??'') src="{{asset($product->img)??''}}"@else src="{{asset('images/hot.png')}}" @endif>
                              </a>
                          </div>
                      </div>
                  </div>

                  <div class="box-footer no-padding">
                      <ul class="nav nav-pills nav-stacked">
                          <li><a href="{{route('buyProducts.show',['id'=>$product->id])}}">{{$product->name}}</a></li>

                          <li><a href="#" style="height: 40px;">

                                  <span  class="text-green pull-right">
                                  ¥{{$product->price}}</span>
                                  <span  style="text-decoration:line-through; margin-right: 10px;" class="pull-right text-red" >
                                  ¥{{$product->price_original}}
                                  </span>
                              </a></li>

                          <li>
                              <a href="#" style="height: 40px;">
                                  <button type="button" class=" buy btn-danger pull-right"  value="{{$product->id}}">购买</button>
                                  <button type="button" class="cart btn-warning pull-right" style="margin-right: 10px;" value="{{$product->id}}">加入购物车</button>

                              </a></li>

                      </ul>
                  </div>

              </div>
          </div>
              @endif
          @endforeach

      </div>


      <div class="row">
          <div class="col-xs-12">
              <div class="box box-solid">

                  <div class="nav-tabs-custom">
                      <div class="tab-content check-every">
                          <div class="active tab-pane" id="timeline">
                              <!-- /.box-header -->
                              <div class="">
                                  <table id="example1" class="table table-bordered table-striped">

                                      <tbody>
                                      @foreach($products as $key => $product)
                                          @if($key > 3)
                                      <tr class="product" >
                                          <td ><a href="{{route('buyProducts.show',['id'=>$product->id])}}"><img style="width: 120px;" @if($product->img??'') src="{{asset($product->img)??''}}" @else src="{{asset('images/hot.png')}}" @endif></a></td>
                                          <td><a href="{{route('buyProducts.show',['id'=>$product->id])}}">{{$product->name}}</a></td>
                                          <td>
                                  <span  class="pull-right text-green">
                                  ¥{{$product->price}}</span>
                                              <span  style="text-decoration:line-through; margin-right: 10px;" class="pull-right text-red">
                                  ¥{{$product->price_original}}</span>
                                          </td>
                                          <td >
                                              <button type="button" class="cart  btn-warning" value="{{$product->id}}">加入购物车</button>
                                              <button type="button" class="buy btn-danger"  value="{{$product->id}}">购买</button>
                                          </td>
                                      </tr>
                                          @endif
                                      @endforeach
                                      </tbody>
                                  </table>

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
        $('.cart').on('click',function(){
            $.ajax({
                url:'{{$cartsRoute}}',
                type:'POST',    //GET
                data:{
                    productId:$(this).val(),
                },
                timeout:5000,    //超时时间
                dataType:'json',
                success:function(data){
                    if(data.state == 201){
                        layer.alert(data.info,function(index){
                                window.location.href = data.route;
                            }
                        )
                    }else{
                        layer.alert(data.info,function(index){
                            window.location.href = data.route;
                        })
                    }
                },
                error:function(data){
                    if(data.responseJSON.errors['productId']){
                        layer.alert(data.responseJSON.errors['productId']['0'])
                    }
                }
            });
        })

        $('.buy').on('click',function(){
            $.ajax({
                url:'{{$ordersRoute}}',
                type:'POST',    //GET
                data:{
                    productStr:$(this).val(),
                },
                timeout:5000,    //超时时间
                dataType:'json',
                success:function(data){
                    window.location.href = data.route;
                },
                error:function(data){
                    if(data.responseJSON.errors['productId']){
                        layer.alert(data.responseJSON.errors['productId']['0'])
                    }
                }
            });
        })
    </script>
@endsection