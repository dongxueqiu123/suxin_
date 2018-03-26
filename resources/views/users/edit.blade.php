@extends('layouts.admin')

@section('content')
  <section class="content-header">
    <h1>
      用户
      <small>用户管理</small>
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
                  <label for="name" class="col-sm-2 control-label">用户名称</label>

                  <div class="col-sm-10">
                    <input type="name" class="form-control" value="{{$user->name??''}}" id="name" placeholder="用户名称">
                  </div>
                </div>
                <div class="form-group">
                  <label for="email" class="col-sm-2 control-label">用户邮箱</label>

                  <div class="col-sm-10">
                    <input type="email" class="form-control" value="{{$user->email??''}}" id="email" placeholder="用户邮箱">
                  </div>
                </div>
                  <div class="form-group">
                      <label for="password" class="col-sm-2 control-label">用户密码</label>
                      <div class="col-sm-10">
                          <input type="password" class="form-control" value="{{$user->password??''}}" id="password" placeholder="用户密码">
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="password" class="col-sm-2 control-label">确认密码</label>
                      <div class="col-sm-10">
                          <input type="password" class="form-control" value="{{$user->password??''}}" id="password_confirmation" placeholder="确认密码">
                      </div>
                  </div>
                  @if(!empty($roles??[]))
                      <div class="form-group">
                          <label for="abbreviation" class="col-sm-2 control-label">公司管理员</label>
                          <div class="col-sm-10">
                              <select class="form-control select2 roleId"  style="width: 100%;">
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
              <div class="box-footer">
                <a type="submit" href="{{route('users')}}" class="btn btn-default">返回</a>
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
                     layer.alert(data.responseJSON.errors['password']['0'])
                 }else if(data.responseJSON.errors['password_confirmation']){
                     layer.alert(data.responseJSON.errors['password_confirmation']['0'])
                 }else if(data.responseJSON.errors['roleId']){
                     layer.alert(data.responseJSON.errors['roleId']['0'])
                 }

             }
         });
         return false;
     });
  </script>
@endsection