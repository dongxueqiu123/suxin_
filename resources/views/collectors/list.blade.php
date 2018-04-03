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
          <div class="box">
              <div class="box-header">
                  <h3 class="box-title">{{$boxTitle}}</h3>
                  <a href="{{route('collectors.store')}}" class="btn btn-sm btn-default btn-flat pull-right"><i class="fa fa-fw fa-plus"></i>添加</a>
              </div>
      <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">公司采集设备</a></li>
              <li><a href="#timeline" data-toggle="tab">机械采集设备</a></li>
          </ul>
          <div class="tab-content">

              <div class="active tab-pane" id="activity">

                          <!-- /.box-header -->
                          <div class="box-body">
                              <table id="example1" class="table table-bordered table-striped">
                                  <thead>
                                  <tr>
                                      <th>序号</th>
                                      <th>采集设备名称</th>
                                      <th>公司名称</th>
                                      <th>更新时间</th>
                                      <th>编辑</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($companyCollectors as $key=>$companyCollector)
                                      <tr>
                                          <td>{{$key+1}}</td>
                                          <td>{{$companyCollector->name}}</td>
                                          <td>{{$companyCollector->company->name??'苏欣物联'}}</td>
                                          <td>{{$companyCollector->operate_time}}</td>
                                          <td>
                                              <a class="btn btn-primary btn-xs " href={{route('collectors.edit',['id'=>$companyCollector->id])}}>编辑</a>
                                              <a class="btn btn-danger btn-xs delete" url="{{ route('api.collectors.delete',['id'=>$companyCollector->id])}}" >删除</a>
                                          </td>
                                      </tr>
                                  @endforeach
                                  </tbody>
                              </table>
                          </div>
                          <!-- /.box-body -->
                      </div>
                      <!-- /.box -->


              <div class="tab-pane" id="timeline">

                      <!-- /.box-header -->
                      <div class="box-body">
                          <table id="example1" class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                  <th>序号</th>
                                  <th>采集设备名称</th>
                                  <th>机械名称</th>
                                  <th>公司名称</th>
                                  <th>更新时间</th>
                                  <th>编辑</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($equipmentCollectors as $key=>$equipmentCollector)
                                  <?php
                                  $providerName = $equipmentCollector->equipment->provider->name;
                                  $consumerName = $equipmentCollector->equipment->consumer->name;
                                  ?>
                                  <tr>
                                      <td>{{$key+1}}</td>
                                      <td>{{$equipmentCollector->name}}</td>
                                      <td>{{$equipmentCollector->equipment->name}}</td>
                                      <td>{{$providerName?$providerName:$consumerName}}
                                          （@if($providerName) 生产设备 @elseif($consumerName) 使用设备 @endif）</td>
                                      <td>{{$equipmentCollector->operate_time}}</td>
                                      <td>
                                          <a class="btn btn-primary btn-xs " href={{route('collectors.edit',['id'=>$equipmentCollector->id])}}>编辑</a>
                                          <a class="btn btn-danger btn-xs delete" url="{{ route('api.collectors.delete',['id'=>$equipmentCollector->id])}}" >删除</a>
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