@extends('layouts.admin')

@section('content')
  <section class="content-header">
    <h1 style="color: black;font-weight:bold;font-size:16px;">
      告警记录
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
                  <div class="box-body">
                      <div class="col-sm-3" style="padding-left: 0px;">
                          <input type="name" class="form-control" value="{{$name}}" id="name" placeholder="无线节点或设备名称" datatype="*" errormsg="请填写信息">
                      </div>
                      <div class="col-sm-3" style="padding-left: 0px;">
                          <div class="input-group">
                              <button type="button" class="btn btn-primary btn-flat search">查询</button>

                          </div>
                      </div>
                  </div>
                  <div class="box-body" style="border-top: 1px solid #f4f4f4;">
                      <table id="example1" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                              <th>编号</th>
                              <th>无线节点</th>
                              <th>机械设备</th>
                              <th>分类</th>
                              <th>等级</th>
                              <th>告警详情</th>
                              <th>生产公司</th>
                              <th>使用公司</th>
                              <th>操作说明</th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($alarms as $key=>$alarm)
                              <tr>
                                  <td>{{$alarm['id']??''}}</td>
                                  <td>{{$alarm['collectorName']??''}}</td>
                                  <td>{{$alarm['equipmentName']??''}}</td>
                                  <td>{{$alarm['categoryName']??''}}</td>
                                  <td>{{$alarm['gradeName']??''}}</td>
                                  <td>{{$alarm['detail']??''}}</td>
                                  <td>{{$alarm['providerName']??''}}</td>
                                  <td>{{$alarm['consumerName']??''}}</td>
                                  <td>{{$alarm['remark']??''}}</td>
                              </tr>
                          @endforeach
                          @if($alarms->total() == 0 )
                              <tr>
                                  <td  colspan="9" align="center"  style="background-color: #ffffff">暂无数据</td>
                              </tr>
                          @endif
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
      $("body").keydown(function() {
          if (event.keyCode == "13") {//keyCode=13是回车键
              var url = '{{route('recover')}}';
              var name = $('#name').val();
              window.location.href = url+"?name="+name;
          }
      });
  </script>
@endsection