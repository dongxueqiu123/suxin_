@extends('layouts.admin')

@section('content')
  <section class="content-header">
      <h1 style="color: black;font-weight:bold;font-size:16px;">
          告警方式
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
                  <a href="{{route('liaisons.store')}}" class="btn btn-default btn-flat pull-left"><i class="fa fa-fw fa-plus"></i>新增方式</a>
              </div>
      <div class="nav-tabs-custom">

          <div class="tab-content">

              <div class="active tab-pane" id="activity">
                          <!-- /.box-header -->
                          <div class="">
                              <table id="example1" class="table table-bordered table-striped">
                                  <thead>
                                  <tr>
                                      <th>电子邮箱</th>
                                      <th>手机号码</th>
                                      <th>无线节点</th>
                                      <th>机械设备</th>
                                      <th>公司</th>
                                      <th>更新时间</th>
                                      <th>编辑</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($liaisons??[] as $key=>$liaison)
                                      <tr>
                                          <td>{{$liaison->email}}</td>
                                          <td>{{$liaison->mobile}}</td>
                                          <td>{{$liaison->collector->name??'暂无'}}</td>
                                          <td>{{$liaison->equipment->name??'暂无'}}</td>
                                          <td>{{$liaison->company->name??'暂无'}}</td>
                                          <td>{{$liaison->operate_time}}</td>
                                          <td>
                                              <a class="btn btn-default btn-flat btn-xs " href={{route('liaisons.edit',['id'=>$liaison->id])}}>编辑</a>
                                              <a class="btn btn-default btn-flat btn-xs delete" url="{{ route('api.liaisons.delete',['id'=>$liaison->id])}}" >删除</a>
                                          </td>
                                      </tr>
                                  @endforeach
                                  </tbody>
                              </table>
                              {!! $liaisons->links() !!}
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