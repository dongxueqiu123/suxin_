@extends('layouts.admin')

@section('content')
  <section class="content-header">
      <h1 style="color: black;font-weight:bold;font-size:16px;">
          无线节点
      </h1>
      <ol class="breadcrumbSuXin">
          <li><a href="{{route('admin')}}" style="color:#367fa9"><i class="fa fa-dashboard"></i> 首页</a></li>
          <li class="active">{{$boxTitle}}</li>
      </ol>
  </section>

  <section class="content">
      <div class="row">
          <div class="col-xs-12">
          <div class="box box-solid">
              <div class="box-header">
                  <a href="{{route('collectors.store')}}" class="btn btn-default btn-flat pull-left"><i class="fa fa-fw fa-plus"></i>新增无线节点</a>
              </div>
      <div class="nav-tabs-custom">
          <div class="tab-content">
              <div class="active tab-pane" id="timeline">
                      <!-- /.box-header -->
                      <div class="">
                          <table id="example1" class="table table-bordered table-striped">
                              <thead>
                              <tr>
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

                                  <tr>
                                      <td>{{$collector['name']}}</td>
                                      <td>{{$collector['equipmentName']}}</td>
                                      <td>{{$collector['companyName']}}</td>
                                      <td>@if($collector['onlineFlag']??'')（在线）@else（离线）@endif</td>
                                      <td>{{date('Y-m-d H:i:s',$collector['operateTime']/1000)}}</td>
                                      <td>
                                          <a class="btn btn-default btn-flat btn-xs" href={{route('collectors.edit',['id'=>$collector['id']])}}>修改{{--<i class="fa fa-edit" style="font-size: 14px;"></i>--}}</a>
                                          <a class="btn btn-default btn-flat btn-xs delete" url="{{ route('api.collectors.delete',['id'=>$collector['id']])}}" >删除{{--<i class="fa fa-trash-o" style="font-size: 14px;"></i>--}}</a>
                                          @if( Auth::user()->id !==1 )
                                              @permission(['charts'])
                                              <a class="btn btn-default btn-flat btn-xs " href={{route('charts.collectorChart',['id'=>$collector['id']])}}>图表{{--<i class="fa fa-fw fa-area-chart" style="font-size: 14px;"></i>--}}</a>
                                              @endpermission
                                          @else
                                              <a class="btn btn-default btn-flat btn-xs " href={{route('charts.collectorChart',['id'=>$collector['id']])}}>图表{{--<i class="fa fa-fw fa-area-chart" style="font-size: 14px;"></i>--}}</a>
                                          @endif
                                      </td>
                                  </tr>
                              @endforeach
                              @if($collectors->total() == 0 )
                                  <tr>
                                      <td  colspan="6" align="center" style="background-color: #ffffff">暂无数据</td>
                                  </tr>
                              @endif
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