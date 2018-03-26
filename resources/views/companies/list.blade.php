@extends('layouts.admin')

@section('content')
  <section class="content-header">
    <h1>
      公司
      <small>公司管理</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">公司列表</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">公司列表</h3>
            <a href="{{route('companies.store')}}" class="btn btn-sm btn-default btn-flat pull-right"><i class="fa fa-fw fa-plus"></i>添加</a>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>序号</th>
                <th>公司名称</th>
                <th>公司缩写</th>
                <th>更新时间</th>
                <th>编辑</th>
              </tr>
              </thead>
              <tbody>
              @foreach($companies as $key=>$company)
              <tr>
                <td>{{$key+1}}</td>
                <td>{{$company->name}}
                </td>
                <td>{{$company->abbreviation}}</td>
                <td>{{$company->updated_at}}</td>
                <td>
                  <a class="btn btn-primary btn-xs " href={{route('companies.edit',['id'=>$company->id])}}>编辑</a>
                  <a class="btn btn-danger btn-xs delete" url="{{ route('api.companies.delete',['id'=>$company->id])}}" >删除</a>
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

      });
  </script>
@endsection