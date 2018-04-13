@extends('layouts.admin')

@section('content')
  <section class="content-header">
    <h1>
      <small>采集器</small>
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

                  <a type="submit" href="{{route('collectors')}}" class="btn btn-default btn-flat" style="margin-left: 10px"><i class="fa fa-fw fa-history"></i>返回</a>
              </div>
            <!-- /.box-header -->
            <!-- form start -->

              <div class="box-body">


                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">名称</label>

                  <div class="col-sm-10">
                    <input type="name" class="form-control" value="{{$collector->name??''}}" id="name" placeholder="名称" datatype="*" errormsg="请填写信息" >
                  </div>
                </div>

                  <div class="form-group">
                      <label for="mac" class="col-sm-2 control-label">mac地址</label>
                      <div class="col-sm-10">
                          <input type="mac" class="form-control" value="{{$collector->mac??''}}" id="mac" placeholder="00-23-5A-15-99-42-11-25"  datatype="*23-23" errormsg="请填写正确的mac地址" >
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="abbreviation" class="col-sm-2 control-label">公司</label>
                      <div class="col-sm-10">
                          <select class="form-control select2 company"  style="width: 100%;">
                              @foreach($companies as $key => $company)
                                  <option @if(($collector->firm_id??'') == $company->id) selected @endif value="{{$company->id}}">{{$company->name}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="form-group changeEquipment" @if(($collector->equipment_id??'') == '') style="display: none;"@endif>
                      <label for="abbreviation" class="col-sm-2 control-label">机械设备</label>
                      <div class="col-sm-10">
                          <select class="form-control select2 equipment"  style="width: 100%;">

                          </select>
                      </div>
                  </div>
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
              var mac,name,companyId,equipmentId;
              mac = $('#mac').val();
              name = $('#name').val();
              companyId = $('.company').val();
              equipmentId = $('.equipment').val();
              $.ajax({
                  url:'{{$route}}',
                  type:'POST',    //GET
                  data:{
                      mac:mac,name:name,companyId:companyId,equipmentId:equipmentId
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
                      if(data.responseJSON.errors['mac']){
                          layer.alert(data.responseJSON.errors['mac']['0'])
                      }else if(data.responseJSON.errors['name']){
                          layer.alert(data.responseJSON.errors['name']['0'])
                      }else if(data.responseJSON.errors['companyId']){
                          layer.alert(data.responseJSON.errors['companyId']['0'])
                      }
                  }
              });
              return false;
          }
      });

     $('.company').on('change',function(){
         var value = $(this).val();
         $(".changeEquipment").show();
         changeEquipments(value,'');
     });

     if({{$collector->firm_id??0}}){
         changeEquipments({{$collector->firm_id??0}},{{$collector->equipment_id??0}});
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


  </script>
@endsection