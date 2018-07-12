@extends('layouts.admin')

@section('content')
  <section class="content-header">
      <h1 style="color: black;font-weight:bold;font-size:16px;">
          添加告警
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
                  <a href="{{route('thresholds.store')}}" class="btn btn-default btn-flat pull-left"><i class="fa fa-fw fa-plus"></i>新增告警</a>
              </div>
      <div class="nav-tabs-custom">

          <div class="tab-content">

              <div class="active tab-pane" id="activity">

                          <!-- /.box-header -->
                          <div class="">
                              <table id="example1" class="table table-bordered table-striped">
                                  <thead>
                                  <tr>
                                      <th>阈值</th>
                                      <th>分类</th>
                                      <th>等级</th>
                                      <th>公司</th>
                                      <th>机械设备</th>
                                      <th>无线节点</th>
                                      <th>更新时间</th>
                                      <th>编辑</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($thresholds??[] as $key=>$threshold)
                                      <tr>
                                          <td>{{$threshold['lowlimit']}}{{$threshold['categoryUnit']}}~{{$threshold['toplimit']}}{{$threshold['categoryUnit']}}</td>
                                          <td>{{$threshold['categoryName']??'暂无'}}</td>
                                          <td>{{$threshold['gradeName']??'暂无'}}</td>
                                          <td>{{$threshold['companyName']??'暂无'}}</td>
                                          <td>{{$threshold['equipmentName']??'暂无'}}</td>
                                          <td>{{$threshold['collectorName']??'暂无'}}</td>
                                          <td>{{date('Y-m-d H:i:s',$threshold['operateTime']/1000)}}</td>
                                          <td>
                                              <a class="btn btn-default btn-flat btn-xs " href={{route('thresholds.edit',['id'=>$threshold['id']])}}>编辑</a>
                                              <a class="btn btn-default btn-flat btn-xs delete" url="{{ route('api.thresholds.delete',['id'=>$threshold['id']])}}" >删除</a>
                                          </td>
                                      </tr>
                                  @endforeach
                                  </tbody>
                              </table>
                              {!! $thresholds->links() !!}
                          </div>
                          <!-- /.box-body -->
                      </div>
                      <!-- /.box -->

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