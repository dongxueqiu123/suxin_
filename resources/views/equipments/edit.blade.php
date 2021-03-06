@extends('layouts.admin')

@section('content')
  <section class="content-header">
    <h1 style="color: black;font-weight:bold;font-size:16px;">
      机械设备
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
                <a type="submit" href="{{route('equipments')}}" class="btn btn-default btn-flat" style="margin-left: 10px"><i class="fa fa-fw fa-history"></i>返回</a>
            </div>
            <!-- /.box-header -->
            <!-- form start -->

              <div class="box-body">
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">名称</label>
                  <div class="col-sm-5">
                    <input type="name" class="form-control" value="{{$equipment['name']??''}}" id="name" placeholder="名称" datatype="*" errormsg="请填写名称"  nullmsg="请填写名称" >
                  </div>
                    <div class="help-block">必填</div>
                </div>

                  <div class="form-group">
                      <label for="abbreviation" class="col-sm-2 control-label">生产公司</label>
                      <div class="col-sm-5">
                          <select class="form-control select2 providerId"  style="width: 100%;">

                              @foreach($companies??[] as $company)
                                  <option @if(($equipment['providerId']??'') == $company['id']) selected @endif value="{{$company['id']}}">{{$company['name']}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="abbreviation" class="col-sm-2 control-label">使用公司</label>
                      <div class="col-sm-5">
                          <select class="form-control select2 consumerId"  style="width: 100%;">

                              @foreach($companies??[] as $company)
                                  <option @if(($equipment['consumerId']??'') == $company['id']) selected @endif value="{{$company['id']}}">{{$company['name']}}</option>
                              @endforeach
                          </select>
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
  <script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
  <script>
      $('.select2').select2();
      $(".form-horizontal").Validform({
          btnSubmit:".sign",
          tipSweep: true,
          tiptype:function(msg,o,cssctl){
              if (o.type == 3) {//失败
                  layer.alert(msg);
              }
          },
          callback: function (data) {//异步回调函数
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
                      if(data.code === '0'){
                          window.location.href = data.route
                      }else{
                          layer.alert(data.info)
                      }
                  },
                  error:function(data){

                  }
              });
              return false;
          }
      });


  </script>
@endsection