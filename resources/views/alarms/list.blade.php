@extends('layouts.admin')

@section('content')
  <section class="content-header">
    <h1>
      <small>告警记录</small>
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

          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                <th>序号</th>
                  <th>分类</th>
                  <th>等级</th>
                  <th>告警详情</th>
                  <th>操作说明</th>
                  <th>采集器</th>
                  <th>机械设备</th>
                <th>生产公司</th>
                <th>使用公司</th>
                <th>编辑</th>
              </tr>
              </thead>
              <tbody>
              @foreach($alarms as $key=>$alarm)
              <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$alarm->category}}</td>
                  <td>{{$alarm->grade}}</td>
                  <td>{{$alarm->detail}}</td>
                  <td>{{$alarm->collector->name??'暂无'}}</td>
                  <td>{{$alarm->equipment->name??'暂无'}}</td>
                  <td>{{$alarm->provider->name??'暂无'}}</td>
                  <td>{{$alarm->consumer->name??'暂无'}}</td>
                  <td>{{$alarm->remark}}</td>
                <td>
                    @if($alarm->status == 2)
                        <a class="btn btn-danger btn-xs restore" url="{{ route('api.alarms.edit',['id'=>$alarm->id])}}">恢复(已删除)</a>
                        @else
                        <a class="btn btn-danger btn-xs delete" url="{{ route('api.alarms.edit',['id'=>$alarm->id])}}">删除</a>
                        @endif
                </td>
              </tr>
              @endforeach
              </tbody>
            </table>
              {!! $alarms->links() !!}
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
                      status:2
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

      $('.restore').click(function () {
          var url;
          url = $(this).attr('url');
          layer.prompt({
              formType: 2,
              title: '说明',
              area: ['300px', '100px'] //自定义文本域宽高
          }, function(value, index, elem){
              $.ajax({
                  url:url,
                  type:'POST',    //GET
                  async:true,    //或false,是否异步
                  data:{
                      remark:value,status:1
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