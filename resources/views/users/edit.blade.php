@extends('layouts.admin')

@section('content')
  <section class="content-header">
    <h1>
      <small>用户</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin')}}"><i class="fa fa-home"></i> 后台首页</a></li>
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
                <a type="submit" href="{{route('users')}}" class="btn btn-default btn-flat" style="margin-left: 10px"><i class="fa fa-fw fa-history"></i>返回</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">名称</label>

                  <div class="col-sm-10">
                    <input type="name" class="form-control" value="{{$user->name??''}}" id="name" placeholder="名称" datatype="*" errormsg="请填写信息">
                  </div>
                </div>
                <div class="form-group">
                  <label for="email" class="col-sm-2 control-label">邮箱</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control" value="{{$user->email??''}}" id="email" placeholder="邮箱"  datatype="e" errormsg="请填写正确的电子邮箱" >
                  </div>
                </div>
                  <div class="form-group">
                      <label for="password" class="col-sm-2 control-label">密码</label>
                      <div class="col-sm-10">
                          <input type="password" name="password111" class="form-control" value="{{$user->password??''}}" id="password" placeholder="密码" datatype="*6-100" errormsg="密码最少为6位" >
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="password" class="col-sm-2 control-label">确认密码</label>
                      <div class="col-sm-10">
                          <input type="password" name="password_confirmation" recheck="password111" class="form-control" value="{{$user->password??''}}" id="password_confirmation" placeholder="确认密码">
                      </div>
                  </div>
                  @if(!empty($roles??[]))
                      <div class="form-group">
                          <label for="abbreviation" class="col-sm-2 control-label">角色</label>
                          <div class="col-sm-10">
                              <select class="form-control select2 roleId"  style="width: 100%;"  datatype="*" errormsg="请选择角色" nullmsg="请选择管理员">
                                  @if(empty($roleUser))
                                      <option  value="">请选择</option>
                                      @endif
                                  @foreach($roles??[] as $role)
                                      <option @if(($roleUser->role_id??'') == $role->id) selected @endif value="{{$role->id}}">{{$role->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                      </div>
                  @endif
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
              var name,email,password,password_confirmation,roleId;
              name = $('#name').val();
              email = $('#email').val();
              password = $('#password').val();
              password_confirmation = $('#password_confirmation').val();
              roleId = $('.roleId').val();
              $.ajax({
                  url:'{{$route}}',
                  type:'POST',    //GET
                  data:{
                      name:name,email:email,password:password,password_confirmation:password_confirmation,roleId:roleId
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
                      if(data.responseJSON.errors['name']){
                          layer.alert(data.responseJSON.errors['name']['0'])
                      }else if(data.responseJSON.errors['email']){
                          layer.alert(data.responseJSON.errors['email']['0'])
                      }else if(data.responseJSON.errors['password']){
                          layer.alert('请填写相同的密码')
                      }else if(data.responseJSON.errors['password_confirmation']){
                          layer.alert('请填写相同的密码')
                      }else if(data.responseJSON.errors['roleId']){
                          layer.alert(data.responseJSON.errors['roleId']['0'])
                      }

                  }
              });
              return false;
          }
      });
  </script>
@endsection