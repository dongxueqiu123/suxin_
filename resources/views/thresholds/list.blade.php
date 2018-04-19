@extends('layouts.admin')

@section('content')
  <section class="content-header">
      <h1>
          <small>阈值设置</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> 后台首页</a></li>
          <li class="active">{{$boxTitle}}</li>
      </ol>
  </section>

  <section class="content">
      <div class="row">
          <div class="col-xs-12">
          <div class="box box-solid">
              <div class="box-header">
                  <a href="{{route('thresholds.store')}}" class="btn btn-default pull-left"><i class="fa fa-fw fa-plus"></i>新增阈值</a>
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
                                          <td>{{$threshold->lowlimit}}~{{$threshold->toplimit}}</td>
                                          <td>{{$threshold->category??'暂无'}}</td>
                                          <td>{{$threshold->grade??'暂无'}}</td>
                                          <td>{{$threshold->company->name??'暂无'}}</td>
                                          <td>{{$threshold->equipment->name??'暂无'}}</td>
                                          <td>{{$threshold->collector->name??'暂无'}}</td>
                                          <td>{{$threshold->operate_time}}</td>
                                          <td>
                                              <a class="btn btn-primary btn-xs " href={{route('thresholds.edit',['id'=>$threshold->id])}}>编辑</a>
                                              <a class="btn btn-danger btn-xs delete" url="{{ route('api.thresholds.delete',['id'=>$threshold->id])}}" >删除</a>
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