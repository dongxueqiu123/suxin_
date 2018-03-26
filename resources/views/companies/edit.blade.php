@extends('layouts.admin')

@section('content')
  <section class="content-header">
    <h1>
      公司
      <small>公司管理</small>
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
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">公司名称</label>

                  <div class="col-sm-10">
                    <input type="name" class="form-control" value="{{$company->name??''}}" id="name" placeholder="公司名称">
                  </div>
                </div>
                <div class="form-group">
                  <label for="abbreviation" class="col-sm-2 control-label">公司简称</label>

                  <div class="col-sm-10">
                    <input type="abbreviation" class="form-control" value="{{$company->abbreviation??''}}" id="abbreviation" placeholder="公司简称">
                  </div>
                </div>
                  @if(!empty($users??[]))
                  <div class="form-group">
                      <label for="abbreviation" class="col-sm-2 control-label">公司管理员</label>
                      <div class="col-sm-10">
                      <select class="form-control select2 userId"  style="width: 100%;">
                          @foreach($users??[] as $user)
                          <option value="{{$user->id}}">{{$user->name}}</option>
                          @endforeach
                      </select>
                      </div>
                  </div>
                  @endif
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a type="submit" href="{{route('companies')}}" class="btn btn-default">返回</a>
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
         var name,abbreviation,userId;
         name = $('#name').val();
         abbreviation = $('#abbreviation').val();
         userId = $('.userId').val();
         $.ajax({
             url:'{{$route}}',
             type:'POST',    //GET
             async:true,    //或false,是否异步
             data:{
                 name:name,abbreviation:abbreviation,userId:userId
             },
             timeout:5000,    //超时时间
             dataType:'json',
             success:function(data,textStatus,jqXHR){
                 window.location.href = data.route
             },
             error:function(data){
                 if(data.responseJSON.errors['name']){
                     layer.alert(data.responseJSON.errors['name']['0']);
                 }else if(data.responseJSON.errors['abbreviation']){
                     layer.alert(data.responseJSON.errors['abbreviation']['0']);
                 }
             }
         })
         return false;
     });
  </script>
@endsection