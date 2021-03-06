@extends('layouts.admin')

@section('content')
  <section class="content-header">
    <h1 style="color: black;font-weight:bold;font-size:16px;">
        角色
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
              <a href="{{route('roles.store')}}" class="btn btn-default btn-flat pull-left "><i class="fa fa-fw fa-plus"></i>新增角色</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>名称</th>
                <th>描述</th>
                <th>更新时间</th>
                <th>编辑</th>
              </tr>
              </thead>
              <tbody>
              @foreach($roles as $key=>$role)
              <tr>
                <td>{{$role['name']}}
                </td>
                <td>{{$role['description']}}</td>
                <td>{{date('Y-m-d H:i:s',$role['updatedAt']/1000)}}</td>
                <td>
                  <a class="btn btn-default btn-flat btn-xs " href={{route('roles.edit',['id'=>$role['id']])}}>编辑</a>
                  <a class="btn btn-default btn-flat btn-xs delete" url="{{ route('api.roles.delete',['id'=>$role['id']])}}" >删除</a>
                </td>
              </tr>
              @endforeach
              @if($roles->total() == 0 )
                  <tr>
                      <td  colspan="4" align="center"  style="background-color: #ffffff">暂无数据</td>
                  </tr>
              @endif
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