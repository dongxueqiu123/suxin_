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
          <div class="box">
              <div class="box-header">
                  <h3 class="box-title">{{$boxTitle}}</h3>
                  <a href="{{route('thresholds.store')}}" class="btn btn-sm btn-default btn-flat pull-right"><i class="fa fa-fw fa-plus"></i>添加</a>
              </div>
      <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab">生产使用厂家</a></li>
              <li><a href="#timeline" data-toggle="tab">采集设备</a></li>
              <li><a href="#collector" data-toggle="tab">机械设备</a></li>
          </ul>
          <div class="tab-content">

              <div class="active tab-pane" id="activity">

                          <!-- /.box-header -->
                          <div class="box-body">
                              <table id="example1" class="table table-bordered table-striped">
                                  <thead>
                                  <tr>
                                      <th>序号</th>
                                      <th>告警目标</th>
                                      <th>告警分类</th>
                                      <th>告警等级</th>
                                      <th>告警限制</th>
                                      <th>更新时间</th>
                                      <th>编辑</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($companyThresholds??[] as $key=>$companyThreshold)
                                      <tr>
                                          <td>{{$key+1}}</td>
                                          <td>{{$companyThreshold->pattern}}({{$companyThreshold->company->name}})</td>
                                          <td>{{$companyThreshold->category}}</td>
                                          <td>{{$companyThreshold->grade}}</td>
                                          <td>{{$companyThreshold->lowlimit}}~{{$companyThreshold->toplimit}}</td>
                                          <td>{{$companyThreshold->operate_time}}</td>
                                          <td>
                                              <a class="btn btn-primary btn-xs " href={{route('thresholds.edit',['id'=>$companyThreshold->id])}}>编辑</a>
                                              <a class="btn btn-danger btn-xs delete" url="{{ route('api.thresholds.delete',['id'=>$companyThreshold->id])}}" >删除</a>
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
                                  <th>告警目标</th>
                                  <th>告警分类</th>
                                  <th>告警等级</th>
                                  <th>告警限制</th>
                                  <th>更新时间</th>
                                  <th>编辑</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($collectorThresholds??[] as $key=>$collectorThreshold)
                                  <tr>
                                      <td>{{$key+1}}</td>
                                      <td>{{$collectorThreshold->pattern}}({{$collectorThreshold->collector->name}})</td>
                                      <td>{{$collectorThreshold->category}}</td>
                                      <td>{{$collectorThreshold->grade}}</td>
                                      <td>{{$collectorThreshold->lowlimit}}~{{$collectorThreshold->toplimit}}</td>
                                      <td>{{$collectorThreshold->operate_time}}</td>
                                      <td>
                                          <a class="btn btn-primary btn-xs " href={{route('thresholds.edit',['id'=>$collectorThreshold->id])}}>编辑</a>
                                          <a class="btn btn-danger btn-xs delete" url="{{ route('api.thresholds.delete',['id'=>$collectorThreshold->id])}}" >删除</a>
                                      </td>
                                  </tr>
                              @endforeach
                              </tbody>
                          </table>
                      </div>
                      <!-- /.box-body -->
                  </div>

              <div class="tab-pane" id="collector">

                  <!-- /.box-header -->
                  <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                              <th>序号</th>
                              <th>告警目标</th>
                              <th>告警分类</th>
                              <th>告警等级</th>
                              <th>告警限制</th>
                              <th>更新时间</th>
                              <th>编辑</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($equipmentThresholds??[] as $key=>$equipmentThreshold)
                              <tr>
                                  <td>{{$key+1}}</td>
                                  <td>{{$equipmentThreshold->pattern}}({{$equipmentThreshold->equipment->name}})</td>
                                  <td>{{$equipmentThreshold->category}}</td>
                                  <td>{{$equipmentThreshold->grade}}</td>
                                  <td>{{$equipmentThreshold->lowlimit}}~{{$equipmentThreshold->toplimit}}</td>
                                  <td>{{$equipmentThreshold->operate_time}}</td>
                                  <td>
                                      <a class="btn btn-primary btn-xs " href={{route('thresholds.edit',['id'=>$equipmentThreshold->id])}}>编辑</a>
                                      <a class="btn btn-danger btn-xs delete" url="{{ route('api.thresholds.delete',['id'=>$equipmentThreshold->id])}}" >删除</a>
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