@extends('layouts.admin')

@section('content')
  <section class="content-header">
    <h1 style="color: black;font-weight:bold;font-size:16px;">
      角色
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
                      <a type="submit" href="{{route('roles')}}" class="btn btn-default btn-flat" style="margin-left: 10px"><i class="fa fa-fw fa-history"></i>返回</a>

                  </div>

                  <div class="box-body">
                      <div class="form-group">
                          <label for="name" class="col-sm-2 control-label">名称</label>

                          <div class="col-sm-10">
                              <input type="name" class="form-control" value="{{$role->name??''}}" id="name" placeholder="角色名称"  datatype="*" errormsg="请填写信息">
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="description" class="col-sm-2 control-label">描述</label>
                          <div class="col-sm-10">
                              <input type="description" class="form-control" value="{{$role->description??''}}" id="description" placeholder="角色描述"  datatype="*" errormsg="请填写信息">
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
          }
      })

  </script>
@endsection