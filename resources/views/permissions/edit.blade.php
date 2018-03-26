@extends('layouts.admin')

@section('content')
  <section class="content-header">
    <h1>
      用户
      <small>权限管理</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">{{$boxTitle}}</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">

          <!-- /.box-header -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">{{$boxTitle}}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" >
              <div class="box-body">
                <div class="form-group">
                  <label for="display_name" class="col-sm-2 control-label">权限名称</label>

                  <div class="col-sm-10">
                    <input type="display_name" class="form-control" value="{{$permission->display_name??''}}" id="display_name" placeholder="权限名称">
                  </div>
                </div>
                <div class="form-group">
                  <label for="description" class="col-sm-2 control-label">权限描述</label>
                  <div class="col-sm-10">
                    <input type="description" class="form-control" value="{{$permission->description??''}}" id="description" placeholder="权限描述">
                  </div>
                </div>
                  <div class="form-group">
                      <label for="name" class="col-sm-2 control-label">权限路由</label>
                      <div class="col-sm-10">
                          <input type="name" class="form-control" value="{{$permission->name??''}}" id="name" placeholder="权限路由">
                      </div>
                  </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a type="submit" href="{{route('permissions')}}" class="btn btn-default">返回</a>
                <button type="submit"  class="btn btn-info pull-right sign">确定</button>
              </div>
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
  <script>
     $('.sign').click(function () {
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
     });
  </script>
@endsection