@extends('layouts.admin')

@section('content')
  <section class="content-header">
    <h1>
      用户
      <small>角色管理</small>
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
                  <label for="name" class="col-sm-2 control-label">角色名称</label>

                  <div class="col-sm-10">
                    <input type="name" class="form-control" value="{{$role->name??''}}" id="name" placeholder="角色名称">
                  </div>
                </div>
                <div class="form-group">
                  <label for="description" class="col-sm-2 control-label">角色描述</label>
                  <div class="col-sm-10">
                    <input type="description" class="form-control" value="{{$role->description??''}}" id="description" placeholder="角色描述">
                  </div>
                </div>

              </div>
                <div class="box-header with-border">
                    <h3 class="box-title">权限分配</h3>
                </div>
                <div class="box-body">
                    <h5 class="timeline-header"></h5>
                <div class="row fontawesome-icon-list" style="margin-left: 75px;">
                    @foreach($permissions??[] as $permission)
                    <div class="col-md-3 col-sm-4" >
                        <label>
                            <input type="checkbox" value="{{$permission->id}}" class="flat-red"
                                  @foreach($permissionRoles??[] as $permissionRole)
                                          @if($permission->id == $permissionRole->permission_id)
                                         checked
                                           @endif
                                    @endforeach
                            >
                            {{$permission->display_name}}
                        </label>
                    </div>
                    @endforeach
                </div>
                </div>
{{--                <div class="box-body">
                    <h5 class="timeline-header">用户</h5>
                    <div class="row fontawesome-icon-list">
                        <div class="col-md-3 col-sm-4">
                            <label>
                                <input type="checkbox" class="flat-red" checked>
                                Flat green skin checkbox
                            </label>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <label>
                                <input type="checkbox" class="flat-red" checked>
                                Flat green skin checkbox
                            </label>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <label>
                                <input type="checkbox" class="flat-red" checked>
                                Flat green skin checkbox
                            </label>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <label>
                                <input type="checkbox" class="flat-red" checked>
                                Flat green skin checkbox
                            </label>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <label>
                                <input type="checkbox" class="flat-red" checked>
                                Flat green skin checkbox
                            </label>
                        </div>
                    </div>
                </div>--}}
              <!-- /.box-body -->
              <div class="box-footer">
                <a type="submit" href="{{route('roles')}}" class="btn btn-default">返回</a>
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
         var name,description,permissionIds,permissionIdsStr;
         name = $('#name').val();
         description = $('#description').val();
         permissionIds=[];
         $('input[type="checkbox"]:checked').each(function(){
             permissionIds.push($(this).val());
         });
         permissionIdsStr=permissionIds.join(',');
         $.ajax({
             url:'{{$route}}',
             type:'POST',    //GET
             data:{
                 name:name,description:description,permissionIdsStr:permissionIdsStr
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
                 if(data.responseJSON.errors['description']){
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