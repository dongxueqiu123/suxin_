@extends('layouts.admin')

@section('content')
  <section class="content-header">
    <h1>
      设备管理
      <small>机械设备管理</small>
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
                  <label for="name" class="col-sm-2 control-label">设备名称</label>

                  <div class="col-sm-10">
                    <input type="name" class="form-control" value="{{$equipment->name??''}}" id="name" placeholder="设备名称">
                  </div>
                </div>

                  <div class="form-group">
                      <label for="abbreviation" class="col-sm-2 control-label">生产厂商</label>
                      <div class="col-sm-10">
                          <select class="form-control select2 providerId"  style="width: 100%;">

                              @foreach($companies??[] as $company)
                                  <option @if(($equipment->provider_id??'') == $company->id) selected @endif value="{{$company->id}}">{{$company->name}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="abbreviation" class="col-sm-2 control-label">使用厂商</label>
                      <div class="col-sm-10">
                          <select class="form-control select2 consumerId"  style="width: 100%;">

                              @foreach($companies??[] as $company)
                                  <option @if(($equipment->consumer_id??'') == $company->id) selected @endif value="{{$company->id}}">{{$company->name}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>
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
         var name,providerId,consumerId;
         name = $('#name').val();
         providerId = $('.providerId').val();
         consumerId = $('.consumerId').val();
         $.ajax({
             url:'{{$route}}',
             type:'POST',    //GET
             data:{
                 name:name,providerId:providerId,consumerId:consumerId
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
                 }else if(data.responseJSON.errors['providerId']){
                     layer.alert(data.responseJSON.errors['providerId']['0'])
                 }else if(data.responseJSON.errors['consumerId']){
                     layer.alert(data.responseJSON.errors['consumerId']['0'])
                 }
             }
         });
         return false;
     });
  </script>
@endsection