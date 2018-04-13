@extends('layouts.admin')

@section('content')
  <section class="content-header">
      <h1>
          <small>机械设备</small>
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
                  <a href="{{route('equipments.store')}}" class="btn btn-default pull-left"><i class="fa fa-fw fa-plus"></i>新增机械设备</a>
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
                                  <th>生产公司</th>
                                  <th>使用公司</th>
                                  <th>更新时间</th>
                                  <th>编辑</th>
                              </tr>
                              </thead>
                              <tbody>
                              @foreach($equipments as $key=>$equipment)
                                  <tr>
                                      <td>{{$key+1}}</td>
                                      <td>{{$equipment->name}}</td>
                                      <td>{{$equipment->provider->name??''}}</td>
                                      <td>{{$equipment->consumer->name??''}}</td>
                                      <td>{{$equipment->operate_time}}</td>
                                      <td>
                                          <a class="btn btn-primary btn-xs " href={{route('equipments.edit',['id'=>$equipment->id])}}>编辑</a>
                                          <a class="btn btn-danger btn-xs delete" url="{{ route('api.equipments.delete',['id'=>$equipment->id])}}" >删除</a>
                                      </td>
                                  </tr>
                              @endforeach
                              </tbody>
                          </table>
                          {!! $equipments->links() !!}
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