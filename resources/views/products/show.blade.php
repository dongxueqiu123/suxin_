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
          <li class="active"></li>
      </ol>
  </section>

  <section class="content">
      <div class="row">
          <div class="col-md-6">
              <div class="box box-solid">
                  <div class="box-body">
                      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                          <ol class="carousel-indicators">
                              @if(empty($product->img_thumbs))
                                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                              @else
                                  @foreach($product->img_thumbs as $key=>$img_thumb)
                                      <li data-target="#carousel-example-generic" data-slide-to="{{$key}}" class="@if($key == 0 )active @endif"></li>
                                  @endforeach
                              @endif
                          </ol>
                          <div class="carousel-inner">
                              @if(empty($product->img_thumbs))
                                  <div class="item  active ">
                                      <img style="width:100%;"  src="{{asset('images/hot.png')}}" >
                                      <div class="carousel-caption">
                                      </div>
                                  </div>
                              @else
                              @foreach($product->img_thumbs as $key=>$img_thumb)
                              <div class="item @if($key == 0 ) active @endif">
                                  <img style="width:100%;" @if($img_thumb??'') src="{{asset($img_thumb)??''}}" @else src="{{asset('images/hot.png')}}" @endif>
                                  <div class="carousel-caption">
                                  </div>
                              </div>
                              @endforeach
                              @endif
{{--                              <div class="item">
                                  <img src="http://placehold.it/900x500/3c8dbc/ffffff&text=I+Love+Bootstrap" alt="Second slide">

                                  <div class="carousel-caption">
                                      Second Slide
                                  </div>
                              </div>
                              <div class="item">
                                  <img src="http://placehold.it/900x500/f39c12/ffffff&text=I+Love+Bootstrap" alt="Third slide">

                                  <div class="carousel-caption">
                                      Third Slide
                                  </div>
                              </div>--}}
                          </div>
                          <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                              <span class="fa fa-angle-left"></span>
                          </a>
                          <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                              <span class="fa fa-angle-right"></span>
                          </a>
                      </div>
                  </div>
              </div>
          </div>

          <div class="col-xs-6">
              <div class="box box-solid">
              <p class="lead" style="margin:0px 10px 10px 10px; padding-top: 10px;">{{$product->name}}</p>
              <div class="table-responsive">
                  <table class="table" style="margin-bottom:0px;">
                      <tr>
                          <th style="width:25%">价格:</th>
                          <td style="float: left">
                          <span  style="text-decoration:line-through; margin-right: 10px;" class=" text-red">
                                  ¥{{$product->price_original}}</span>
                           <span  class=" text-green">
                                  ¥{{$product->price}}</span>
                          </td>
                      </tr>
                      <tr>
                          <th style="width:25%">价格:</th>
                          <td style="float: left">$250.30</td>
                      </tr>
                      <tr>
                          <td colspan ="2" ><button type="button" class="cart btn btn-warning btn-flat"  style="float: left;margin-right: 20px;" value="{{$product->id}}">加入购物车</button>
                              <button type="button" class="buy btn btn-danger btn-flat"  style="float: left" value="{{$product->id}}">立即购买</button>
                          </td>
                      </tr>
                  </table>
              </div>
          </div>
          </div>



      <div class="col-md-12">
          <div class="box box-solid">
              <div class="mailbox-read-message">
                  {{$product->detail->description??'算法（Algorithm）是指解题方案的准确而完整的描述，是一系列解决问题的清晰指令，算法代表着用系统的方法描述解决问题的策略机制。也就是说，能够对一定规范的输入，在有限时间内获得所要求的输出。如果一个算法有缺陷，或不适合于某个问题，执行这个算法将不会解决这个问题。不同的算法可能用不同的时间、空间或效率来完成同样的任务。一个算法的优劣可以用空间复杂度与时间复杂度来衡量。
算法中的指令描述的是一个计算，当其运行时能从一个初始状态和（可能为空的）初始输入开始，经过一系列有限而清晰定义的状态，最终产生输出并停止于一个终态。一个状态到另一个状态的转移不一定是确定的。随机化算法在内的一些算法，包含了一些随机输入。
形式化算法的概念部分源自尝试解决希尔伯特提出的判定问题，并在其后尝试定义有效计算性或者有效方法中成形。这些尝试包括库尔特·哥德尔、Jacques Herbrand和斯蒂芬·科尔·克莱尼分别于1930年、1934年和1935年提出的递归函数，阿隆佐·邱奇于1936年提出的λ演算，1936年Emil Leon Post的Formulation 1和艾伦·图灵1937年提出的图灵机。即使在当前，依然常有直觉想法难以定义为形式化算法的情况。'}}
              </div>
          </div>
      </div>
      </div>
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
                        layer.alert(data.info)
                    }else{
                        layer.alert(data.info)
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