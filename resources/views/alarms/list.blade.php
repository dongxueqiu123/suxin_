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
                      <table class="table table-bordered table-striped">
                          <thead>
                          <tr>
                              <th width="20%">无线节点</th>
                              <th width="20%">机械设备</th>
                              <th width="20%">生产公司</th>
                              <th width="20%">使用公司</th>
                              <th width="10%">分类</th>
                              <th width="10%">操作</th>
                          </tr>
                          </thead>
                      </table>
                      @foreach($alarms as $key=>$alarm)
                      <table class="table table-bordered table-striped">
                          <tbody>
                          <tr>
                              <td width="20%">{{$alarm['collectorName']}}</td>
                              <td width="20%">{{$alarm['equipmentName']}}</td>
                              <td width="20%">{{$alarm['providerName']}}</td>
                              <td width="20%">{{$alarm['consumerName']}}</td>
                              <td width="10%">{{$alarm['categoryName']}}</td>
                              <td width="10%"><span class="btn btn-danger btn-xs showOrHide " state="hide"><span class="glyphicon glyphicon-plus"></span> 查看</span></td>
                          </tr>
                          </tbody>
                      </table>
                      <div class="box-body" style="display:none">
                          <table class="table table-bordered">
                              <tr>
                                  <th >状态</th>
                                  <th>等级</th>
                                  <th>操作说明</th>
                                  <th>告警详情</th>
                                  <th>解决时间</th>
                                  <th>开始告警时间</th>
                                  <th>最近告警时间</th>
                                  <th>操作</th>
                              </tr>
                              <tr style="color: #db4c3f">
                                  <td>待处理</td>
                                  <td>{{$alarm['gradeName']}}</td>
                                  <td></td>
                                  <td>{{$alarm['detail']}}</td>
                                  <td></td>
                                  <td>2018-12-21 12:12:12</td>
                                  <td>{{date('Y-m-d H:i:s',$alarm['alarmTime']/1000)}}</td>
                                  <td><span class="btn btn-danger btn-xs restore" alarmId={{$alarm['id']}}  collectorId={{$alarm['collectorId']}} alarmCategory={{$alarm['category']}}>解决</span></td>
                              </tr>
{{--                              <tr style="color: #00ad9c">
                                  <td>恢复</td>
                                  <td>重要</td>
                                  <td>此报警已经解决</td>
                                  <td>2018-05-22 17:15:36加速度峰值4.431055m/s^2</td>
                                  <td>2018-12-21 12:12:12</td>
                                  <td></td>
                                  <td></td>
                                  <td>已解决</td>
                              </tr>
                              <tr style="color: #00ad9c">
                                  <td>恢复</td>
                                  <td>重要</td>
                                  <td>此报警已经解决</td>
                                  <td>2018-05-22 17:15:36加速度峰值4.431055m/s^2</td>
                                  <td>2018-12-21 12:12:12</td>
                                  <td></td>
                                  <td></td>
                                  <td>已解决</td>
                              </tr>
                              <tr style="color: #00ad9c">
                                  <td>恢复</td>
                                  <td>重要</td>
                                  <td>此报警已经解决</td>
                                  <td>2018-05-22 17:15:36加速度峰值4.431055m/s^2</td>
                                  <td>2018-12-21 12:12:12</td>
                                  <td ></td>
                                  <td></td>
                                  <td>已解决</td>
                              </tr>--}}
                          </table>
                      </div>
                      @endforeach
                  </div>
              </div>
          </div>
      </div>

  </section>

  <script src="{{asset('layer/layer.js')}}"></script>
  <script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
  <script>
      $('.select2').select2();

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
          var collectorId,alarmId,alarmCategory;
          collectorId = $(this).attr('collectorId');
          alarmId = $(this).attr('alarmId');
          alarmCategory = $(this).attr('alarmCategory');
          layer.prompt({
              formType: 2,
              title: '说明',
              value: '此故障已解决',
              area: ['300px', '100px'] //自定义文本域宽高
          }, function(value, index, elem){
              var data = {
                  remark:value,
                  status:1,
                  collectorId:collectorId,
                  id:alarmId,
                  category:alarmCategory,
                  operatorId:'{{\Auth::user()->id??0}}'
              };
              var jsonData = JSON.stringify(data);
              $.ajax({
                  url:'http://52.80.145.123:8080/console/alarm/updateById',
                  type:'POST',    //GET
                  contentType: "application/json;charset=utf-8",
                  async:true,    //或false,是否异步
                  data:jsonData,
                  timeout:5000,    //超时时间
                  dataType:'json',
                  success:function(data,textStatus,jqXHR){
                      if(data.code == 0){
                          window.location.reload();
                      }
                      return false;
                  }
              })
          }, function(){
              layer.close();
          });
          return false;
      });

      $('.showOrHide').click(function(){
          var state,show,hide;
          show = 'show';
          hide = 'hide';
          state = $(this).attr('state');
          if(state == hide){
              $(this).attr('state',show);
              $(this).html('<span class="glyphicon glyphicon-minus"></span> 收起</span>');
              $(this).parents('.table').next('.box-body').show();
          }else if(state == show){
              $(this).attr('state',hide);
              $(this).html('<span class="glyphicon glyphicon-plus"></span> 查看</span>');
              $(this).parents('.table').next('.box-body').hide();
          }
      });
  </script>
@endsection