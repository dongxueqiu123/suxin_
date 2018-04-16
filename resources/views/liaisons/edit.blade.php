@extends('layouts.admin')

@section('content')
  <section class="content-header">
    <h1>
      <small>告警联系人</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin')}}"><i class="fa fa-home"></i> 首页</a></li>
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
                <a type="submit" href="{{route('liaisons')}}" class="btn btn-default btn-flat" style="margin-left: 10px"><i class="fa fa-fw fa-history"></i>返回</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

              <div class="box-body">

                  <div class="form-group">
                      <label for="name" class="col-sm-2 control-label">公司</label>
                      <div class="col-sm-10">
                          <select class="form-control select2 company"  style="width: 100%;">
                              @foreach($companies??[] as $key => $company)
                                  <option @if(($company->id??'') == ($liaison->firm_id??'')) selected @endif value="{{$company->id}}">{{$company->name}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="form-group changeEquipment" @if(!($liaison->equipment_id??'') && !($liaison->collector_id??'')) style="display: none" @endif>
                      <label for="name" class="col-sm-2 control-label">机械设备</label>
                      <div class="col-sm-10">
                          <select class="form-control select2 equipment"  style="width: 100%;">

                          </select>
                      </div>
                  </div>

                  <div class="form-group changeCollector" @if(!($liaison->equipment_id??'') && !($liaison->collector_id??'')) style="display: none" @endif>
                      <label for="name" class="col-sm-2 control-label">无线节点</label>
                      <div class="col-sm-10">
                          <select class="form-control select2 collector"  style="width: 100%;">

                          </select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="lowLimit" class="col-sm-2 control-label">手机号码</label>
                      <div class="col-sm-10">
                          <input type="lowLimit" class="form-control" value="{{$liaison->mobile??''}}" id="mobile" placeholder="手机号码" datatype="m" errormsg="请填写正确的手机号码" >
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="topLimit" class="col-sm-2 control-label">电子邮箱</label>
                      <div class="col-sm-10">
                          <input type="topLimit" class="form-control" value="{{$liaison->email??''}}" id="email" placeholder="电子邮箱" datatype="e" errormsg="请填写正确的电子邮箱" >
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
              var companyId,equipmentId,collectorId,mobile,email;
              companyId   = $('.company').val();
              equipmentId = $('.equipment').val();
              collectorId = $('.collector').val();
              mobile    = $('#mobile').val();
              email  = $('#email').val();
              $.ajax({
                  url:'{{$route}}',
                  type:'POST',    //GET
                  data:{
                      companyId:companyId,equipmentId:equipmentId,collectorId:collectorId,mobile:mobile,email:email
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
                      if(data.responseJSON.errors['mobile']){
                          layer.alert(data.responseJSON.errors['mobile']['0'])
                      }else if(data.responseJSON.errors['email']){
                          layer.alert(data.responseJSON.errors['email']['0'])
                      }else if(data.responseJSON.errors['companyId']){
                          layer.alert(data.responseJSON.errors['companyId']['0'])
                      }else if(data.responseJSON.errors['equipmentId']){
                          layer.alert(data.responseJSON.errors['equipmentId']['0'])
                      }
                  }
              });
              return false;
          }
      });
     $('.sign').click(function () {

     });

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
     equipment = '{{$liaison->equipment_id??''}}';
     collector = '{{$liaison->collector_id??''}}';
     company = '{{$liaison->firm_id??''}}';

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