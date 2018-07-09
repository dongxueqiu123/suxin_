@extends('layouts.admin')

@section('content')
  <section class="content-header">
    <h1 style="color: black;font-weight:bold;font-size:16px;">
      用户
    </h1>
    <ol class="breadcrumbSuXin">
        <li><a href="{{route('admin')}}" style="color:#367fa9"><i class="fa fa-dashboard"></i> 首页</a></li>
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

                  <div class="col-sm-5">
                    <input type="name" class="form-control" value="{{$user['name']??''}}" id="name" placeholder="名称" datatype="*" errormsg="请填写名称" nullmsg="请填写名称">
                  </div>
                    <div class="help-block">必填</div>
                </div>
                <div class="form-group">
                  <label for="email" class="col-sm-2 control-label">邮箱</label>

                  <div class="col-sm-5">
                    <input type="email" class="form-control" value="{{$user['email']??''}}" id="email" placeholder="邮箱"  datatype="e" errormsg="请填写正确的电子邮箱" nullmsg="请填写电子邮箱" >
                  </div>
                    <div class="help-block">必填</div>
                </div>
                  <div class="form-group">
                      <label for="password" class="col-sm-2 control-label">密码</label>
                      <div class="col-sm-5">
                          <input type="password" name="password111" class="form-control" value="{{$user['password']??''}}" id="password" placeholder="密码" datatype="*6-100" errormsg="密码最少为6位" nullmsg="请填写密码" >
                      </div>
                      <div class="help-block">必填</div>
                  </div>
                  <div class="form-group">
                      <label for="password" class="col-sm-2 control-label">确认密码</label>
                      <div class="col-sm-5">
                          <input type="password" name="password_confirmation" recheck="password111" class="form-control" value="{{$user['password']??''}}" id="password_confirmation" placeholder="确认密码" nullmsg="请填写密码">
                      </div>
                      <div class="help-block">必填</div>
                  </div>
                  @if(!empty($roles??[]))
                      <div class="form-group">
                          <label for="abbreviation" class="col-sm-2 control-label">角色</label>
                          <div class="col-sm-5">
                              <select class="form-control select2 roleId"  style="width: 100%;"  datatype="*" errormsg="请选择角色" nullmsg="请选择管理员">
                                  @if(empty($user))
                                      <option  value="">请选择</option>
                                      @endif
                                  @foreach($roles??[] as $role)
                                      <option @if(($user['roleId']??'') == $role['id']) selected @endif value="{{$role['id']}}">{{$role['name']}}</option>
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
  <script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
  <script>
      $('.select2').select2();
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
                      name:name,email:email,password:password,confirmPassword:password_confirmation,roleId:roleId
                  },
                  timeout:5000,    //超时时间
                  dataType:'json',
                  success:function(data){
                      if(data.state === '0'){
                          window.location.href = data.route
                      }else{
                          layer.alert(data.info)
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