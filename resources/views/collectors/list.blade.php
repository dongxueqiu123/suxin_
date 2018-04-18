@extends('layouts.admin')

@section('content')
  <section class="content-header">
      <h1>
          <small>无线节点</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="{{route('admin')}}"><i class="fa fa-home"></i> 后台首页</a></li>
          <li class="active">{{$boxTitle}}</li>
      </ol>
  </section>

  <section class="content">
      <div class="row">
          <div class="col-xs-12">
          <div class="box box-solid">
              <div class="box-header">
                  <a href="{{route('collectors.store')}}" class="btn btn-default pull-left"><i class="fa fa-fw fa-plus"></i>新增无线节点</a>
              </div>
      <div class="nav-tabs-custom">
          <div class="tab-content">
              <div class="active tab-pane" id="timeline">
                      <!-- /.box-header -->
                      <div class="">
                          <table id="example1" class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                  <th>序号</th>
                                  <th>名称</th>
                                  <th>机械设备</th>
                                  <th>公司</th>
                                  <th>网络状态</th>
                                  <th>更新时间</th>
                                  <th>编辑</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($collectors as $key=>$collector)
                                  <?php
                                  $name = $collector->company->name??'';
                                  $providerName = $collector->equipment->provider->name??'';
                                  $consumerName = $collector->equipment->consumer->name??'';
                                  ?>
                                  <tr>
                                      <td>{{$key+1}}</td>
                                      <td>{{$collector->name}}</td>
                                      <td>{{$collector->equipment->name??'暂无'}}</td>
                                      <td>@if($providerName)
                                              {{$providerName}}
                                              @elseif($consumerName)
                                              {{$consumerName}}
                                              @elseif($name)
                                              {{$name}}
                                              @endif
                                          {{--@if($providerName)（生产设备）@elseif($consumerName)（使用设备）@endif--}}</td>
                                      <td>@if($collector->online_flag??'')（在线）@else（离线）@endif</td>
                                      <td>{{$collector->operate_time}}</td>
                                      <td>
                                          <a class="btn btn-primary btn-xs" href={{route('collectors.edit',['id'=>$collector->id])}}>修改{{--<i class="fa fa-edit" style="font-size: 14px;"></i>--}}</a>
                                          <a class="btn btn-danger btn-xs delete" url="{{ route('api.collectors.delete',['id'=>$collector->id])}}" >删除{{--<i class="fa fa-trash-o" style="font-size: 14px;"></i>--}}</a>
                                          @if( Auth::user()->id !==1 )
                                              @permission(['charts'])
                                              <a class="btn btn-warning btn-xs " href={{route('charts.collectorChart',['id'=>$collector->id])}}>图表{{--<i class="fa fa-fw fa-area-chart" style="font-size: 14px;"></i>--}}</a>
                                              @endpermission
                                          @else
                                              <a class="btn btn-warning btn-xs " href={{route('charts.collectorChart',['id'=>$collector->id])}}>图表{{--<i class="fa fa-fw fa-area-chart" style="font-size: 14px;"></i>--}}</a>
                                          @endif
                                      </td>
                                  </tr>
                              @endforeach
                              </tbody>
                          </table>
                          {!! $collectors->links() !!}
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