@extends('layouts.admin')

@section('content')
  <section class="content-header">
      <h1>
          <small>商品</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> 后台首页</a></li>
          <li class="active">{{$boxTitle??''}}</li>
      </ol>
  </section>

  <section class="content">
      <div class="row">
          <div class="col-xs-12">
          <div class="box box-solid">
              <div class="box-header">
                  <a href="{{route('products.store')}}" class="btn btn-default pull-left"><i class="fa fa-fw fa-plus"></i>新增商品</a>
              </div>
      <div class="nav-tabs-custom">
          <div class="tab-content">
              <div class="active tab-pane" id="timeline">
                      <!-- /.box-header -->
                      <div class="">
                          <table id="example1" class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                  <th>名称</th>
                                  <th>价格</th>
                                  <th>原价</th>
                                  <th>缩略图</th>
                                  <th>是否上架</th>
                                  <th>单位</th>
                                  <th>描述</th>
                                  <th>编辑</th>
                              </tr>
                              </thead>

                              <tbody>
                              @foreach($products as $product)
                                  <tr>
                                      <td><a href="{{route('buyProducts.show',['id'=>$product->id])}}">{{$product->name}}</a></td>
                                      <td>{{$product->price??''}}</td>
                                      <td>{{$product->price_original??''}}</td>
                                      <td><img style="height: 40px;"@if($product->img??'') src="{{asset($product->img)??''}}"@else src="{{asset('images/hot.png')}}" @endif></td>
                                      <td>@if($product->is_alive == 1) 是  @else 否 @endif </td>
                                      <td>{{$product->detail->unit??''}}</td>
                                      <td>{{$product->detail->description??''}}</td>
                                      <td>
                                          <a class="btn btn-primary btn-xs " href={{route('products.edit',['id'=>$product->id])}}>编辑</a>
                                          <a class="btn btn-danger btn-xs delete" url="{{ route('api.products.delete',['id'=>$product->id])}}" >删除</a>
                                      </td>
                                  </tr>
                              @endforeach
                              </tbody>
                          </table>
                          {!! $products->links() !!}
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
      $('.delete').click(function () {
          var url;
          url = $(this).attr('url');
          layer.confirm('是否删除？', {
              btn: ['删除','取消'] //按钮
          }, function(){
              $.ajax({
                  url:url,
                  type:'POST',    //GET
                  async:true,    //或false,是否异步
                  data:{
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
  </script>
@endsection