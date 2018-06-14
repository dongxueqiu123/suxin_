@extends('layouts.admin')

@section('content')
    <link rel="stylesheet" href="{{asset('imgCropping/css/cropper.min.css')}}">
    <link rel="stylesheet" href="{{asset('imgCropping/css/ImgCropping.css')}}">
    <link href="{{asset('jqueryMove/css/lanrenzhijia.css')}}" type="text/css" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('kindeditor/themes/default/default.css')}}" />
    <link rel="stylesheet" href="{{asset('kindeditor/plugins/code/prettify.css')}}" />
    <style>
        * {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .fa-box:hover {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            transform: translate3d(0, -2px, 0);
        }
        .fa-box {
            position: relative;
            max-height: 480px;
            overflow: hidden;
            text-align: center;
        }


        .fa-box .hover .hover-content, .fa-box:hover .hover-content{
            display: block;
            top: 6px;
        }

        .hover-content {
            position: absolute;
            top: -1150px;
            right: 0;
            height: 42px;
            line-height: 42px;
            transition: all .2s;
            width: 100%;
        }

        .hover-content span {
            display: inline-block;
            border-radius: 2px;
            font-size: 14px;
            height: 40px;
            line-height: 40px;
            cursor: pointer;
            width: 92px;
            text-align: center;
        }

        .hover-content .collect {
            float: left;
            border: 1px solid #d2d2d2;
            background: #fff;
            margin-left: 8px;
        }
    </style>
    <section class="content-header">
        <h1 style="color: black;font-weight:bold;font-size:16px;">
            商品
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
                    <form class="form-horizontal" >
                        <div class="box-header with-border">
                            <button type="submit"  class="btn btn-default pull-left btn-flat  sign"><i class="fa fa-fw fa-plus"></i>保存</button>
                            <a type="submit" href="{{route('products')}}" class="btn btn-default btn-flat" style="margin-left: 10px"><i class="fa fa-fw fa-history"></i>返回</a>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">名称</label>
                                <div class="col-sm-10">
                                    <input type="name" class="form-control" value="{{$product->name??''}}" id="name" placeholder="名称" datatype="*" errormsg="请填写信息" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mac" class="col-sm-2 control-label">价格</label>
                                <div class="col-sm-10">
                                    <input type="price" class="form-control" value="{{$product->price??''}}" id="price" placeholder="价格(精确到分)"   datatype="/^[0-9]+(.[0-9]{2})?$/" errormsg="请输入正确的价格" nullmsg="请输入价格" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="abbreviation" class="col-sm-2 control-label">原价</label>
                                <div class="col-sm-10">
                                    <input type="priceOriginal" class="form-control" value="{{$product->price_original??''}}" id="priceOriginal" placeholder="原价(精确到分)"   datatype="/^[0-9]+(.[0-9]{2})?$/" errormsg="请输入正确的价格" nullmsg="请输入原价" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="abbreviation" class="col-sm-2 control-label">图片</label>
                                <div class="col-sm-10">
                                    <button type="button" id="replaceImg" class="btn btn-default btn-flat">添加图片</button>
                                    <div class="appendPic">
                                        @foreach($product->img_thumbs??[] as $img_thumb)
                                        <div class="fa-box" style="width: 200px;border: solid 1px #555;padding: 5px;margin: 10px 10px;float: left;">
                                            <img  src="{{asset($img_thumb??'')}}" width="188"  >
                                            <div class="hover-content">
                                                <span class="collect">删除</span>
                                            </div>
                                        </div>
                                        @endforeach
                                </div>
                            </div>
                            </div>
                            <div class="form-group">
                                <label for="abbreviation" class="col-sm-2 control-label">是否上架</label>
                                <div class="col-sm-10">
                                    <label>
                                    <input type="radio" name="isAlive" value="1" class="minimal-red" @if(($product->is_alive??'1') == 1 ) checked @endif>
                                    是
                                    </label>
                                    &nbsp&nbsp&nbsp&nbsp
                                    <label>
                                    <input type="radio" name="isAlive" value="0" class="minimal-red" @if(($product->is_alive??'0') == '0' ) checked @endif>
                                    否
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="abbreviation" class="col-sm-2 control-label">单位</label>
                                <div class="col-sm-10">
                                    <input type="unit" class="form-control" value="{{$product->detail->unit??''}}" id="unit" placeholder="单位" datatype="*" errormsg="请填写信息" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="abbreviation" class="col-sm-2 control-label">描述</label>
                                <div class="col-sm-10">
                                    		<textarea  id="description" name="content1" style="width:700px;height:200px;visibility:hidden;">
                                        <?php echo htmlspecialchars($product->detail->description??''); ?>
                                   </textarea>
{{--                                    <input type="description" class="form-control" value="{{$product->detail->description??''}}" id="description" placeholder="描述" datatype="*" errormsg="请填写信息" >--}}
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div style="display: none" class="tailoring-container">
            <div class="black-cloth" onclick="closeTailor(this)"></div>
            <div class="tailoring-content">
                <div class="tailoring-content-one">
                    <label title="上传图片" for="chooseImg" class="btn btn-default btn-flat choose-btn">
                        <input type="file" accept="image/jpg,image/jpeg,image/png" name="file" id="chooseImg" class="hidden" onchange="selectImg(this)">
                        选择图片
                    </label>
                    <div class="close-tailoring"  onclick="closeTailor(this)">×</div>
                </div>
                <div class="tailoring-content-two">
                    <div class="tailoring-box-parcel">
                        <img id="tailoringImg">
                    </div>
                    <div class="preview-box-parcel">
                        <p>图片预览：</p>
                        <div class="square previewImg"></div>
                        <div class="circular previewImg"></div>
                    </div>
                </div>
                <div class="tailoring-content-three">
                    <button class="btn btn-default btn-flat cropper-reset-btn">复位</button>
                    <button class="btn btn-default btn-flat cropper-rotate-btn">旋转</button>
                    <button class="btn btn-default btn-flat cropper-scaleX-btn">换向</button>
                    <button class="btn btn-default btn-flat sureCut" id="sureCut">确定</button>
                </div>
            </div>
        </div>
    </section>
    <script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>
    <script src="{{asset('jqueryMove/js/jquery.easing.1.3.js')}}"></script>
    <script src="{{asset('jqueryMove/js/jquery.zalki_hover_img.min-0.2.js')}}"></script>
    <script src="{{asset('layer/layer.js')}}"></script>
    <script src="{{asset('vaildform/validform_min.js')}}"></script>
    <script src="{{asset('imgCropping/js/cropper.min.js')}}"></script>
    <script src="{{asset('kindeditor/kindeditor-all.js')}}"></script>
    <script src="{{asset('kindeditor/lang/zh-CN.js')}}"></script>
    <script src="{{asset('kindeditor/plugins/code/prettify.js')}}"></script>
    <script>

        KindEditor.ready(function(K) {
            var editor1 = K.create('textarea[name="content1"]', {
                cssPath : '{{asset('kindeditor/plugins/code/prettify.css')}}',
                uploadJson : '{{route('api.products.storeImage')}}',
                allowFileManager : true,
                afterCreate : function() {
                    this.sync();
                },
                afterBlur:function(){
                    this.sync();
                }
            });
            prettyPrint();
        });

        $(window).load(function(){
            $('.main_box').ZalkiHoverImg(
            );
        });

        //弹出框水平垂直居中
        (window.onresize = function () {
            var win_height = $(window).height();
            var win_width = $(window).width();
            if (win_width <= 768){
                $(".tailoring-content").css({
                    "top": (win_height - $(".tailoring-content").outerHeight())/2,
                    "left": 0
                });
            }else{
                $(".tailoring-content").css({
                    "top": (win_height - $(".tailoring-content").outerHeight())/2,
                    "left": (win_width - $(".tailoring-content").outerWidth())/2
                });
            }
        })();

        //弹出图片裁剪框
        $("#replaceImg").on("click",function () {
            $(".tailoring-container").toggle();
        });


        //图像上传
        function selectImg(file) {

            if (!file.files || !file.files[0]){
                return;
            }
            var reader = new FileReader();
            reader.onload = function (evt) {
                console.log(evt);
                var replaceSrc = evt.target.result;
                 $('#image').prop('src',replaceSrc);
                //更换cropper的图片
               $('#tailoringImg').cropper('replace', replaceSrc,false);//默认false，适应高度，不失真
            };
            reader.readAsDataURL(file.files[0]);
        }
        //cropper图片裁剪
        $('#tailoringImg').cropper({
            aspectRatio: 1.5/1,//默认比例
            preview: '.previewImg',//预览视图
            guides: false,  //裁剪框的虚线(九宫格)
            autoCropArea: 0.5,  //0-1之间的数值，定义自动剪裁区域的大小，默认0.8
            movable: false, //是否允许移动图片
            dragCrop: true,  //是否允许移除当前的剪裁框，并通过拖动来新建一个剪裁框区域
            movable: true,  //是否允许移动剪裁框
            resizable: true,  //是否允许改变裁剪框的大小
            zoomable: false,  //是否允许缩放图片大小
            mouseWheelZoom: false,  //是否允许通过鼠标滚轮来缩放图片
            touchDragZoom: true,  //是否允许通过触摸移动来缩放图片
            rotatable: true,  //是否允许旋转图片
            crop: function(e) {
                // 输出结果数据裁剪图像。
            }
        });
        //旋转
        $(".cropper-rotate-btn").on("click",function () {
            $('#tailoringImg').cropper("rotate", 45);
        });
        //复位
        $(".cropper-reset-btn").on("click",function () {
            $('#tailoringImg').cropper("reset");
        });
        //换向
        var flagX = true;
        $(".cropper-scaleX-btn").on("click",function () {
            if(flagX){
                $('#tailoringImg').cropper("scaleX", -1);
                flagX = false;
            }else{
                $('#tailoringImg').cropper("scaleX", 1);
                flagX = true;
            }
            flagX != flagX;
        });

        //裁剪后的处理
        $("#sureCut").on("click",function () {
            if ($("#tailoringImg").attr("src") == null ){
                return false;
            }else{
                var cas = $('#tailoringImg').cropper('getCroppedCanvas');//获取被裁剪后的canvas
               //  base64url = cas.toDataURL('image/png'); //转换为base64地址形式
                var dataurl = cas.toDataURL('image/png'); //base64图片数据
                appendTo(dataurl);
                 //$("#finalImg").prop("src",dataurl);//显示为图片的形式
                //关闭裁剪框
                closeTailor();

            }
        });
        //关闭裁剪框
        function closeTailor() {
            $(".tailoring-container").toggle();
        }
        var appendTo = function(image) {
            $('<div class="fa-box" style="width: 200px;border: solid 1px #555;padding: 5px;margin: 10px 10px;float: left;"><img  src="' +
                image +
                '" width="188" ><div class="hover-content">' +
                '<span class="collect ">删除</span></div></div>').appendTo('.appendPic');

        }
        $(".form-horizontal").Validform({
            btnSubmit: ".sign",
            tipSweep: true,
            tiptype: function (msg, o, cssctl) {
                if (o.type == 3) {//失败
                    layer.alert(msg);
                }
            },
            callback: function (data) {//异步回调函数
                var name,price,priceOriginal,isAlive,unit,description,dataUrl,finalImages;
                finalImages=[];
                name  = $('#name').val();
                price = $('#price').val();
                priceOriginal = $('#priceOriginal').val();
                isAlive  =  $("input[name='isAlive']:checked").val();
                unit     = $('#unit').val();
                description  = $('#description').val();
                console.log(description);
                $('.appendPic').find('img').each(function(i,val){
                    finalImages.push($(val).attr('src'));
                });
                finalImagesStr=finalImages.join('|');
                $.ajax({
                    url:'{{$route}}',
                    type:'POST',    //GET
                    data:{
                        name:name,
                        price:price,
                        priceOriginal:priceOriginal,
                        isAlive:isAlive,
                        unit:unit,
                        description:description,
                        finalImagesStr:finalImagesStr,
                    },
                    timeout:5000,    //超时时间
                    dataType:'json',
                    success:function(data){
                        window.location.href = data.route;
                    },
                    error:function(data){
                        if(data.responseJSON.errors['name']){
                            layer.alert(data.responseJSON.errors['name']['0'])
                        }else if(data.responseJSON.errors['price']){
                            layer.alert(data.responseJSON.errors['price']['0'])
                        }else if(data.responseJSON.errors['priceOriginal']){
                            layer.alert(data.responseJSON.errors['priceOriginal']['0'])
                        }else if(data.responseJSON.errors['isAlive']){
                            layer.alert(data.responseJSON.errors['isAlive']['0'])
                        }
                    }
                });
                return false;
            }
        })

        $(document).on('click','.collect',function(){
            $(this).parent().parent().remove();
        })
    </script>

@endsection