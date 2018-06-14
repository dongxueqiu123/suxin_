@extends('layouts.admin')

@section('content')
  <section class="content-header">
      <h1 style="color: black;font-weight:bold;font-size:16px;">
          购物车
      </h1>
      <ol class="breadcrumbSuXin">
          <li><a href="{{route('admin')}}" style="color:#367fa9"><i class="fa fa-dashboard"></i> 首页</a></li>
          <li class="active">{{$boxTitle}}</li>
      </ol>
  </section>

  <section class="content">
      <div class="row">
          <div class="col-xs-12">
              <div class="">
                  <div class="">
                      <div class="tab-content" style="position: fixed; padding: 0px 0px 0px 10px; bottom: 0px; background: rgb(255, 255, 255); text-align: right; border: 1px solid rgb(204, 204, 204); z-index: 9999; width: 80%;">
                          <div  style="line-height: 34px;text-align: left;float: left;">
                              <span><input type="checkbox" class="check-all">&nbsp全选</span>
                          </div>
                          <div class="pull-right" style="padding: 0;height: 34px;">
                              <a class="btn bg-orange btn-flat pull-left delete"  url="{{ route('api.carts.delete')}}" ids="{{$idStr}}">清空购物车</a>
                              <a class="btn btn-info btn-flat pull-left buy" url="{{ route('api.orders.store')}}" >立即购买</a>
                          </div>
                          <div class="carts-num" style="line-height: 34px;text-align: right;float: right; padding-right: 10px; display:none;">
                              <span id="selectedInfo">已选商品<b style="color:#3280fc" class="count">1</b>件，合计:<b style="color:#3280fc" class="money">￥1</b></span>
                          </div>
                          </div>
                  </div>
              </div>
          </div>
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
                                      <thead>
                                      <tr>
                                          <th>编号</th>
                                          <th>图片</th>
                                          <th>名称</th>
                                          <th>价格</th>
                                          <th>操作</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      @foreach($carts as $cart)
                                      <tr class="product">
                                          <td><input type="checkbox" class="product-check" value="{{$cart->product->id}}">&nbsp{{$cart->product->id}}</td>
                                          <td><img style="height: 40px;"@if($cart->product->img??'') src="{{asset($cart->product->img)??''}}"@else src="{{asset('images/hot.png')}}" @endif></td>
                                          <td>{{$cart->product->name}}</td>
                                          <td>
                                             <span style="text-decoration:line-through;" class="text-red">
                                  ¥{{$cart->product->price_original}}</span>
                                              <span style=" margin-left: 10px;" class="text-green">
                                  ¥<span class="product-money">{{$cart->product->price}}</span></span>
                                          </td>
                                          <td><a class="btn btn-default btn-flat btn-xs delete" url="{{ route('api.carts.delete')}}" ids ='{{$cart->id}}'>删除</a></td>
                                      </tr>
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
      $('.check-all').on('click',function(){
         if($(this).is(':checked')){
             $('input:checkbox').prop("checked", true);
             getNumAndMoney();
         }else{
             $('input:checkbox').removeAttr("checked");
             getNumAndMoney();
         };
      })

      $('.product-check').on('click',function(){
          getNumAndMoney();
      })

      var getNumAndMoney = function () {
          var check =  $(".check-every input[type='checkbox']:checked");
          var money = 0;
          $(".product").each(function(i,val){
              if( $(val).find(".product-check").is(':checked')){
                  money = Number($(val).find('.product-money').html()*100)+Number(money);
              };
          });
          if(money != 0){
              var n =money/100;
              $('.carts-num').show().find('.count').html(check.length).end().find('.money').html('¥'+n.toFixed(2));
          }else{
              $('.carts-num').hide()
          }
      }

      $('.delete').click(function () {
          var url,idStr;
          url = $(this).attr('url');
          idStr =  $(this).attr('ids');
          layer.confirm('是否删除？', {
              btn: ['删除','取消'] //按钮
          }, function(){
              $.ajax({
                  url:url,
                  type:'POST',    //GET
                  async:true,    //或false,是否异步
                  data:{
                      idStr:idStr
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

      $('.buy').click(function(){
          var url,check,productIds,productStr;
          productIds=[];
          check = $(".check-every  input[type='checkbox']:checked");
          check.each(function(i,val){
              console.log($(val).is(':checked'));
              if($(val).is(':checked')){
                  productIds.push($(val).val());
              }
          });
          productStr=productIds.join(',');
          url = $(this).attr('url');

          $.ajax({
              url:url,
              type:'POST',    //GET
              async:true,    //或false,是否异步
              data:{
                  productStr:productStr
              },
              timeout:5000,    //超时时间
              dataType:'json',
              success:function(data,textStatus,jqXHR){
                  window.location.href = data.route;
              }
          })
      })
  </script>
@endsection