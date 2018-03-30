@extends('layouts.admin')

@section('content')
  <section class="content-header">
    <h1>
        告警阈值
      <small>告警阈值管理</small>
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
                  <label for="name" class="col-sm-2 control-label">告警目标</label>
                    <div class="col-sm-10">
                        <select class="form-control select2 pattern"  style="width: 100%;">
                            @foreach($patterns??[] as $key =>$pattern)
                                <option @if(($threshold->pattern??'') == $key) selected @endif value="{{$key}}">{{$pattern}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                  <input type="hidden" id="patternId" value="{{$threshold->pattern_id??'1'}}">
                  <div class="form-group">
                      <label for="name" class="col-sm-2 control-label">目标名称</label>
                      <div class="col-sm-10">
                          <select class="form-control select2 patternId"  style="width: 100%;">

                          </select>
                      </div>
                  </div>

                  <div class="form-group company" >
                      <label for="abbreviation" class="col-sm-2 control-label">分类</label>
                      <div class="col-sm-10">
                          <select class="form-control select2 category"  style="width: 100%;">
                              @foreach($categories??[] as $key =>$category)
                                  <option @if(($threshold->category??'') == $key) selected @endif value="{{$key}}">{{$category}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="form-group company" >
                      <label for="abbreviation" class="col-sm-2 control-label">等级</label>
                      <div class="col-sm-10">
                          <select class="form-control select2 grade"  style="width: 100%;">
                              @foreach($grades??[] as $key =>$grade)
                                  <option @if(($threshold->grade??'') == $key) selected @endif value="{{$key}}">{{$grade}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="lowLimit" class="col-sm-2 control-label">阈值下线</label>
                      <div class="col-sm-10">
                          <input type="lowLimit" class="form-control" value="{{$threshold->lowlimit??''}}" id="lowLimit" placeholder="不设置为极小值">
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="topLimit" class="col-sm-2 control-label">阈值上线</label>
                      <div class="col-sm-10">
                          <input type="topLimit" class="form-control" value="{{$threshold->toplimit??''}}" id="topLimit" placeholder="不设置为极大值">
                      </div>
                  </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a type="submit" href="{{route('thresholds')}}" class="btn btn-default">返回</a>
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
         var pattern,patternId,category,grade,lowLimit,topLimit;
         pattern   = $('.pattern').val();
         patternId = $('.patternId').val();
         category  = $('.category').val();
         grade     = $('.grade').val();
         lowLimit  = $('#lowLimit').val();
         topLimit  = $('#topLimit').val();
         $.ajax({
             url:'{{$route}}',
             type:'POST',    //GET
             data:{
                 pattern:pattern,patternId:patternId,category:category,grade:grade,lowLimit:lowLimit,topLimit:topLimit
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
     changePattern({{$threshold->pattern??1}},$('#patternId').val());
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