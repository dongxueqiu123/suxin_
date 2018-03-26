@extends('layouts.admin')

@section('content')
  <section class="content-header">
    <h1>
      用户
      <small>权限管理</small>
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
            <a href="{{route('permissions.store')}}" class="btn btn-sm btn-default btn-flat pull-right"><i class="fa fa-fw fa-plus"></i>添加</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>序号</th>
                <th>权限名称</th>
                <th>权限说明</th>
                <th>权限路由</th>
                <th>更新时间</th>
                <th>编辑</th>
              </tr>
              </thead>
              <tbody>
              @foreach($permissions as $key=>$permission)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$permission->display_name}}</td>
                <td>{{$permission->description}}</td>
                <td>{{$permission->name}}</td>
                <td>{{$permission->updated_at}}</td>
                <td>
                  <a class="btn btn-primary btn-xs " href={{route('permissions.edit',['id'=>$permission->id])}}>编辑</a>
                  <a class="btn btn-danger btn-xs delete" url="{{ route('api.permissions.delete',['id'=>$permission->id])}}" >删除</a>
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
      <!-- /.col -->
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