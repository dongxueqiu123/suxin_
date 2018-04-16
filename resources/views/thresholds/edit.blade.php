@extends('layouts.admin')

@section('content')
  <section class="content-header">
    <h1>
      <small>阈值设置</small>
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
          <div class="box box-solid">
              <form class="form-horizontal" >
            <div class="box-header with-border">
                <div class="box-footer">
                    <button type="submit"  class="btn btn-default pull-left btn-flat  sign"><i class="fa fa-fw fa-plus"></i>保存</button>
                    <a type="submit" href="{{route('thresholds')}}" class="btn btn-default btn-flat" style="margin-left: 10px"><i class="fa fa-fw fa-history"></i>返回</a>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">

                  <div class="form-group">
                      <label for="name" class="col-sm-2 control-label">公司</label>
                      <div class="col-sm-10">
                          <select class="form-control select2 company"  style="width: 100%;">
                              @foreach($companies??[] as $key => $company)
                                  <option @if(($company->id??'') == ($threshold->firm_id??'')) selected @endif value="{{$company->id}}">{{$company->name}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="form-group changeEquipment" @if(!($threshold->equipment_id??'') && !($threshold->collector_id??'')) style="display: none" @endif>
                      <label for="name" class="col-sm-2 control-label">机械设备</label>
                      <div class="col-sm-10">
                          <select class="form-control select2 equipment"  style="width: 100%;">

                          </select>
                      </div>
                  </div>

                  <div class="form-group changeCollector" @if(!($threshold->equipment_id??'') && !($threshold->collector_id??'')) style="display: none" @endif>
                      <label for="name" class="col-sm-2 control-label">无线节点</label>
                      <div class="col-sm-10">
                          <select class="form-control select2 collector"  style="width: 100%;">

                          </select>
                      </div>
                  </div>
                  <div class="form-group " >
                      <label for="abbreviation" class="col-sm-2 control-label">分类</label>
                      <div class="col-sm-10">
                          <select class="form-control select2 category"  style="width: 100%;">
                              @foreach($categories??[] as $key =>$category)
                                  <option @if(($threshold->category??'') == $key) selected @endif value="{{$key}}">{{$category}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="form-group " >
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
                          <input type="lowLimit" class="form-control" value="{{$threshold->lowlimit??''}}" id="lowLimit" placeholder="下限（-999~999）"  datatype="/^-?[1-9]{0,3}(\.\d+)?$|^-?0(\.\d+)?$|^-?[1-9]{1}[0-9]{0,2}(\.\d+)?$/" errormsg="请设正确的阈值下线" >
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="topLimit" class="col-sm-2 control-label">阈值上线</label>
                      <div class="col-sm-10">
                          <input type="topLimit" class="form-control" value="{{$threshold->toplimit??''}}" id="topLimit" placeholder="上限（-999~999）" datatype="/^-?[1-9]{0,3}(\.\d+)?$|^-?0(\.\d+)?$|^-?[1-9]{1}[0-9]{0,2}(\.\d+)?$/"  errormsg="请设正确的阈值上线" >
                      </div>
                  </div>
              </div>

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
              var companyId,equipmentId,collectorId,category,grade,lowLimit,topLimit;
              companyId   = $('.company').val();
              equipmentId = $('.equipment').val();
              collectorId = $('.collector').val();
              category  = $('.category').val();
              grade     = $('.grade').val();
              lowLimit  = $('#lowLimit').val();
              topLimit  = $('#topLimit').val();
              $.ajax({
                  url:'{{$route}}',
                  type:'POST',    //GET
                  data:{
                      companyId:companyId,equipmentId:equipmentId,collectorId:collectorId,category:category,grade:grade,lowLimit:lowLimit,topLimit:topLimit
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
                      if(data.responseJSON.errors['category']){
                          layer.alert(data.responseJSON.errors['category']['0'])
                      }else if(data.responseJSON.errors['grade']){
                          layer.alert(data.responseJSON.errors['grade']['0'])
                      }else if(data.responseJSON.errors['companyId']){
                          layer.alert(data.responseJSON.errors['companyId']['0'])
                      }else if(data.responseJSON.errors['equipmentId']){
                          layer.alert(data.responseJSON.errors['equipmentId']['0'])
                      }
                  }
              });
              return false;
          }
      })


     $('.company').on('change',function(){
         var value = $(this).val();
         $(".changeEquipment").show();
         $(".changeCollector").show();
         changeEquipments(value,'');
         changeCollectors(value,'','');
     });

     $('.equipment').on('change',function(){
         var companyId = $(".company").find("option:selected").val();
         var value = $(this).val();
         $(".changeCollector").show();
         changeCollectors(companyId,value,'');
     });

     var company,equipment,collector;
     equipment = '{{$threshold->equipment_id??''}}';
     collector = '{{$threshold->collector_id??''}}';
     company = '{{$threshold->firm_id??''}}';
     if(company){
         changeEquipments(company,equipment);
         if(equipment){
             changeCollectors(company,equipment,collector);
         }
     }


     function changeEquipments(companyId,equipmentId){
         $.ajax({
             url:'{{$getEquipmentUrl}}',
             type:'POST',
             data:{
                 companyId:companyId,equipmentId:equipmentId
             },
             timeout:5000,    //超时时间
             dataType:'json',
             success:function(data){
                 if(data.state == '0'){
                     $(".equipment").find("option").remove();
                     $(".equipment").append(data.text);
                 }
             },
             error:function(data){
             }
         });
     }

     function changeCollectors(companyId,equipmentId,collectorId){
         $.ajax({
             url:'{{$getCollectorUrl}}',
             type:'POST',
             data:{
                 companyId:companyId,equipmentId:equipmentId,collectorId:collectorId
             },
             timeout:5000,    //超时时间
             dataType:'json',
             success:function(data){
                 if(data.state == '0'){
                     $(".collector").find("option").remove();
                     $(".collector").append(data.text);
                 }
             },
             error:function(data){
             }
         });
     }
  </script>
@endsection