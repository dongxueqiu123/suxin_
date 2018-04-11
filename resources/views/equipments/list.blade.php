@extends('layouts.admin')

@section('content')
  <section class="content-header">
      <h1>
          <small>机械设备管理</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="{{route('admin')}}"><i class="fa fa-home"></i> 首页</a></li>
          <li class="active">{{$boxTitle}}</li>
      </ol>
  </section>

  <section class="content">
      <div class="row">
          <div class="col-xs-12">
          <div class="box box-solid">
              <div class="box-header">
                  <a href="{{route('equipments.store')}}" class="btn btn-default pull-left"><i class="fa fa-fw fa-plus"></i>新增机械</a>
              </div>
      <div class="nav-tabs-custom">
      {{--    <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">使用设备</a></li>
              <li><a href="#timeline" data-toggle="tab">生产设备</a></li>
          </ul>--}}
          <div class="tab-content">

              <div class="active tab-pane" id="timeline">

                      <!-- /.box-header -->
                      <div class="">
                          <table id="example1" class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                  <th>序号</th>
                                  <th>机械设备</th>
                                  <th>生产公司</th>
                                  <th>使用公司</th>
                                  <th>更新时间</th>
                                  <th>编辑</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($providerEquipments as $key=>$providerEquipment)
                                  <tr>
                                      <td>{{$key+1}}</td>
                                      <td>{{$providerEquipment->name}}</td>
                                      <td>{{$providerEquipment->provider->name}}</td>
                                      <td>{{$providerEquipment->consumer->name}}</td>
                                      <td>{{$providerEquipment->operate_time}}</td>
                                      <td>
                                          <a class="btn btn-primary btn-xs " href={{route('equipments.edit',['id'=>$providerEquipment->id])}}>编辑</a>
                                          <a class="btn btn-danger btn-xs delete" url="{{ route('api.equipments.delete',['id'=>$providerEquipment->id])}}" >删除</a>
                                      </td>
                                  </tr>
                              @endforeach
                              </tbody>
                          </table>
                      </div>
                      <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
              </div>
          </div>
          <!-- /.tab-content -->
      </div>
          </div>
      </div>
    <!-- /.row -->
  </section>
  <script src="{{asset('layer/layer.js')}}"></script>
  <script>
      $('.delete').click(function () {
          var url;
          url = $(this).attr('url');
          layer.confirm('是否删除？', {
              btn: ['删除','取消'] //按钮
          }, function(){
              $.ajax({
                  url:url,
                  type:'POST',    //GET
                  async:true,    //或false,是否异步
                  data:{
                  },
                  timeout:5000,    //超时时间
                  dataType:'json',
                  success:function(data,textStatus,jqXHR){
                      window.location.href = data.route;
                  }
              })
          }, function(){
              layer.close();
          });
          return false;
      });
  </script>
@endsection