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
                  <div class="box-body">
                      <div class="col-sm-3">
                          <input type="name" class="form-control" value="{{$name}}" id="name" placeholder="无线节点或设备名称" datatype="*" errormsg="请填写信息">
                      </div>
                      <div class="col-sm-3">
                          <div class="input-group">
                              <button type="button" class="btn btn-primary btn-flat search">查询</button>

                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <div class="row">
          <div class="col-xs-12">
              <div class="box box-solid">
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
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($alarms as $key=>$alarm)
                              <tr style="color:green;">
                                  <td>{{$alarm['id']??''}}</td>
                                  <td>{{$alarm['categoryName']??''}}</td>
                                  <td>{{$alarm['gradeName']??''}}</td>
                                  <td>{{$alarm['detail']??''}}</td>
                                  <td>恢复</td>
                                  <td>{{$alarm['remark']??''}}</td>
                                  <td>{{$alarm['collectorName']??''}}</td>
                                  <td>{{$alarm['equipmentName']??''}}</td>
                                  <td>{{$alarm['providerName']??''}}</td>
                                  <td>{{$alarm['consumerName']??''}}</td>
                              </tr>
                          @endforeach
                          </tbody>
                      </table>
                      {!! $alarms->appends(['name'=>$name])->links() !!}
                  </div>
              </div>
          </div>
      </div>
  </section>
  <script src="{{asset('layer/layer.js')}}"></script>
  <script>
      $('.search').click(function(){
          var url = '{{route('recover')}}';
          var name = $('#name').val();
          window.location.href = url+"?name="+name;
      })

  </script>
@endsection