@extends('layouts.admin')

@section('content')
  <section class="content-header">
    <h1>
      <small>告警记录</small>
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

          <!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
              <tr>
                  <th>编号</th>
                  <th>分类</th>
                  <th>等级</th>
                  <th>告警详情</th>
                  <th>状态</th>
                  <th>操作说明</th>
                  <th>无线节点</th>
                  <th>机械设备</th>
                  <th>生产公司</th>
                  <th>使用公司</th>
                  <th>操作</th>
              </tr>
              </thead>
              <tbody>
              @foreach($alarms as $key=>$alarm)

              <tr @if($alarm->status ==0)style="color: red;"@elseif($alarm->status ==1) style="color:green;" @elseif($alarm->status ==2) style="color:orange;" @endif>
                  <td>{{$alarm->id}}</td>
                  <td>{{$alarm->category}}</td>
                  <td>{{$alarm->grade}}</td>
                  <td>{{$alarm->detail}}</td>
                  <td>@if($alarm->status == 0)
                          待处理
                      @elseif($alarm->status == 1)
                          恢复
                      @elseif($alarm->status == 2)
                          删除
                      @endif
                  </td>
                  <td>{{$alarm->remark}}</td>
                  <td>{{$alarm->collector->name??'暂无'}}</td>
                  <td>{{$alarm->equipment->name??'暂无'}}</td>
                  <td>{{$alarm->provider->name??'暂无'}}</td>
                  <td>{{$alarm->consumer->name??'暂无'}}</td>
                <td>
                    @if($alarm->status == 0)
                        <a class="btn btn-danger btn-xs restore" url="{{ route('api.alarms.edit',['id'=>$alarm->id])}}">恢复</a>
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
                      remark:value,status:2
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