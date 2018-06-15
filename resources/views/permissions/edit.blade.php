@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1 style="color: black;font-weight:bold;font-size:16px;">
           权限
        </h1>
        <ol class="breadcrumbSuXin">
            <li><a href="{{route('admin')}}"  style="color:#367fa9"><i class="fa fa-dashboard"></i> 首页</a></li>
            <li class="active">{{$boxTitle}}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- /.box-header -->
                <div class="box box-solid">
                    <form class="form-horizontal" >

                        <div class="box-header with-border">
                            <button type="submit"  class="btn btn-default pull-left btn-flat  sign"><i class="fa fa-fw fa-plus"></i>保存</button>
                            <a type="submit" href="{{route('permissions')}}" class="btn btn-default btn-flat" style="margin-left: 10px"><i class="fa fa-fw fa-history"></i>返回</a>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body">
                            <div class="form-group">
                                <label for="display_name" class="col-sm-2 control-label">名称</label>

                                <div class="col-sm-5">
                                    <input type="display_name" class="form-control" value="{{$permission->display_name??''}}" id="display_name" placeholder="权限名称"  datatype="*" errormsg="请填写信息">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description" class="col-sm-2 control-label">描述</label>
                                <div class="col-sm-5">
                                    <input type="description" class="form-control" value="{{$permission->description??''}}" id="description" placeholder="权限描述"  datatype="*" errormsg="请填写信息">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">路由</label>
                                <div class="col-sm-5">
                                    <input type="name" class="form-control" value="{{$permission->name??''}}" id="name" placeholder="权限路由"  datatype="*" errormsg="请填写信息">
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <!-- /.box-footer -->
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <script src="{{asset('layer/layer.js')}}"></script>
    <script src="{{asset('vaildform/validform_min.js')}}"></script>
    <script>

        $(".form-horizontal").Validform({
            btnSubmit: ".sign",
            tipSweep: true,
            tiptype: function (msg, o, cssctl) {
                if (o.type == 3) {//失败
                    layer.alert(msg);
                }
            },
            callback: function (data) {//异步回调函数
                var name,description,module_types;
                name = $('#name').val();
                description = $('#description').val();
                display_name = $('#display_name').val();
                $.ajax({
                    url:'{{$route}}',
                    type:'POST',    //GET
                    data:{
                        name:name,description:description,display_name:display_name
                    },
                    timeout:5000,    //超时时间
                    dataType:'json',
                    success:function(data){
                        if(data.state === '201'){
                            layer.alert(data.info)
                        }else{
                            window.location.href = data.route
                        }
                    },
                    error:function(data){
                        if(data.responseJSON.errors['display_name']){
                            layer.alert(data.responseJSON.errors['display_name']['0']);
                        }else if(data.responseJSON.errors['description']){
                            layer.alert(data.responseJSON.errors['description']['0']);
                        }else if(data.responseJSON.errors['name']){
                            layer.alert(data.responseJSON.errors['name']['0']);
                        }
                    }
                });
                return false;
            }
        });
    </script>
@endsection