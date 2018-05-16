@extends('layouts.admin')

@section('content')
    <style type="text/css">
        td {
            text-align:center; /*设置水平居中*/
            vertical-align:middle;/*设置垂直居中*/
        }

    </style>
  <section class="content-header">
      <h1>
          <small>购买商品</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> 后台首页</a></li>
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
                          <td colspan ="2" ><button type="button" class="cart btn btn-warning"  style="float: left;margin-right: 20px;" value="{{$product->id}}">加入购物车</button>
                              <button type="button" class="buy btn btn-danger"  style="float: left" value="{{$product->id}}">立即购买</button>
                          </td>
                      </tr>
                  </table>
              </div>
          </div>
          </div>



      <div class="col-md-12">
          <div class="box box-solid">
              <div class="mailbox-read-message">
                  <p>Hello John,</p>

                  <p>Keffiyeh blog actually fashion axe vegan, irony biodiesel. Cold-pressed hoodie chillwave put a bird
                      on it aesthetic, bitters brunch meggings vegan iPhone. Dreamcatcher vegan scenester mlkshk. Ethical
                      master cleanse Bushwick, occupy Thundercats banjo cliche ennui farm-to-table mlkshk fanny pack
                      gluten-free. Marfa butcher vegan quinoa, bicycle rights disrupt tofu scenester chillwave 3 wolf moon
                      asymmetrical taxidermy pour-over. Quinoa tote bag fashion axe, Godard disrupt migas church-key tofu
                      blog locavore. Thundercats cronut polaroid Neutra tousled, meh food truck selfies narwhal American
                      Apparel.</p>

                  <p>Raw denim McSweeney's bicycle rights, iPhone trust fund quinoa Neutra VHS kale chips vegan PBR&amp;B
                      literally Thundercats +1. Forage tilde four dollar toast, banjo health goth paleo butcher. Four dollar
                      toast Brooklyn pour-over American Apparel sustainable, lumbersexual listicle gluten-free health goth
                      umami hoodie. Synth Echo Park bicycle rights DIY farm-to-table, retro kogi sriracha dreamcatcher PBR&amp;B
                      flannel hashtag irony Wes Anderson. Lumbersexual Williamsburg Helvetica next level. Cold-pressed
                      slow-carb pop-up normcore Thundercats Portland, cardigan literally meditation lumbersexual crucifix.
                      Wayfarers raw denim paleo Bushwick, keytar Helvetica scenester keffiyeh 8-bit irony mumblecore
                      whatever viral Truffaut.</p>

                  <p>Post-ironic shabby chic VHS, Marfa keytar flannel lomo try-hard keffiyeh cray. Actually fap fanny
                      pack yr artisan trust fund. High Life dreamcatcher church-key gentrify. Tumblr stumptown four dollar
                      toast vinyl, cold-pressed try-hard blog authentic keffiyeh Helvetica lo-fi tilde Intelligentsia. Lomo
                      locavore salvia bespoke, twee fixie paleo cliche brunch Schlitz blog McSweeney's messenger bag swag
                      slow-carb. Odd Future photo booth pork belly, you probably haven't heard of them actually tofu ennui
                      keffiyeh lo-fi Truffaut health goth. Narwhal sustainable retro disrupt.</p>

                  <p>Skateboard artisan letterpress before they sold out High Life messenger bag. Bitters chambray
                      leggings listicle, drinking vinegar chillwave synth. Fanny pack hoodie American Apparel twee. American
                      Apparel PBR listicle, salvia aesthetic occupy sustainable Neutra kogi. Organic synth Tumblr viral
                      plaid, shabby chic single-origin coffee Etsy 3 wolf moon slow-carb Schlitz roof party tousled squid
                      vinyl. Readymade next level literally trust fund. Distillery master cleanse migas, Vice sriracha
                      flannel chambray chia cronut.</p>

                  <p>Thanks,<br>Jane</p>
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