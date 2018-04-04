@extends('layouts.admin')

@section('content')
  <section class="content-header">
    <h1>
      设备管理
      <small>采集设备管理</small>
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
                    <input type="name" class="form-control" value="{{$collector->name??''}}" id="name" placeholder="设备名称">
                  </div>
                </div>

                  <div class="form-group">
                      <label for="mac" class="col-sm-2 control-label">mac地址</label>
                      <div class="col-sm-10">
                          <input type="mac" class="form-control" value="{{$collector->mac??''}}" id="mac" placeholder="00-23-5A-15-99-42-11-25">
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="abbreviation" class="col-sm-2 control-label">生产厂商</label>
                      <div class="col-sm-10">
                          <select class="form-control select2 pattern"  style="width: 100%;">
                              <option @if(($collector->pattern??'') == '1') selected @endif  value="1">厂家</option>
                              <option @if(($collector->pattern??'')  == '2') selected @endif value="2">机械设备</option>
                          </select>
                      </div>
                  </div>

                  <div class="form-group company" >
                      <label for="abbreviation" class="col-sm-2 control-label">使用厂商</label>
                      <div class="col-sm-10">
                          <select class="form-control select2 patternId"  style="width: 100%;">
{{--                              @foreach($equipments??[] as $equipment)
                                  <option @if(($equipment->id??'') == ($collector->pattern_id??'')) selected @endif value="{{$equipment->id}}">{{$equipment->name}}</option>
                              @endforeach--}}
                          </select>
                      </div>
                  </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a type="submit" href="{{route('collectors')}}" class="btn btn-default">返回</a>
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
         var mac,name,pattern,patternId;
         mac = $('#mac').val();
         name = $('#name').val();
         pattern = $('.pattern').val();
         patternId = $('.patternId').val();
         $.ajax({
             url:'{{$route}}',
             type:'POST',    //GET
             data:{
                 mac:mac,name:name,pattern:pattern,patternId:patternId
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


     $('.pattern').on('change',function(){
         var value = $(this).val();
         var patternId = $('#patternId').val();
         changePattern(value,patternId);
     });

     changePattern({{$collector->pattern??1}},$('.patternId').val());

     function changePattern(pattern,patternId){
         $.ajax({
             url:'/api/admin/thresholds/getPatterns',
             type:'POST',    //GET
             data:{
                 pattern:pattern,patternId:patternId
             },
             timeout:5000,    //超时时间
             dataType:'json',
             success:function(data){
                 if(data.state == '0'){
                     $(".patternId").find("option").remove();
                     $(".patternId").append(data.text);
                 }
             },
             error:function(data){
             }
         });
     }

  </script>
@endsection