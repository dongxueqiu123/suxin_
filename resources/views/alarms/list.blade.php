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
                              <td width="10%"><span class="btn btn-default btn-flat btn-xs showOrHide " state="hide"><span class="glyphicon glyphicon-plus"></span> 查看</span></td>
                          </tr>
                          </tbody>
                      </table>

                      <div class="box-body" style="display:none">
                          <ul class="timeline timeline-inverse" style="margin-bottom: 1px;">
                              <li class="time-label">
                        <span class="bg-light-blue" style="border-radius: 0;">
                          {{date('Y-m-d',$alarm['alarmTime']/1000)}}
                        </span>
                              </li>
                          <table class="table table-bordered" style="width: 95%; margin-left: 5%">
                              <tr>
                                  <td >状态</td>
                                  <td>等级</td>
                                  <td>告警详情</td>
                                  <td>最近告警时间</td>
                                  <td>操作</td>
                              </tr>
                              <tr >
                                  <td>待处理</td>
                                  <td>{{$alarm['gradeName']}}</td>
                                  <td>{{$alarm['detail']}}</td>
                                  <td>{{date('Y-m-d H:i:s',$alarm['alarmTime']/1000)}}</td>
                                  <td><span class="btn btn-default btn-flat btn-xs restore" alarmId={{$alarm['id']}}  collectorId={{$alarm['collectorId']}} alarmCategory={{$alarm['category']}}>解决</span></td>
                              </tr>
                          </table>
                          </ul>
                      </div>

                      @endforeach
                      {!! $alarms->links() !!}
                  </div>
              </div>
          </div>
      </div>

  </section>

  <script src="{{asset('layer/layer.js')}}"></script>
  <script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
  <script>
      $('.select2').select2();

      var cache = layer.cache||{}, skin = function(type){
          return (cache.skin ? (' ' + cache.skin + ' ' + cache.skin + '-'+type) : '');
      };

      layer.prompt = function(options, yes){
          var a="";if(options=options||{},"function"==typeof options&&(t=options),options.area){var o=options.area;a='style="width: '+o[0]+"; height: "+o[1]+';"',delete options.area}
          options = options || {};
          if(typeof options === 'function') yes = options;
          var prompt, content = options.formType == 2 ? '<textarea  placeholder='+ (options.value||'') +' class="layui-layer-input"'+a+">" +'</textarea>' : function(){
              return '<input type="'+ (options.formType == 1 ? 'password' : 'text') +'" class="layui-layer-input" value="'+ (options.value||'') +'">';
          }();
          return layer.open($.extend({
              btn: ['&#x786E;&#x5B9A;','&#x53D6;&#x6D88;'],
              content: content,
              skin: 'layui-layer-prompt' + skin('prompt'),
              success: function(layero){
                  prompt = layero.find('.layui-layer-input');
                  prompt.focus();
              }, yes: function(index){
                  var value = prompt.val();
                  if(value === ''){
                      yes && yes(value, index, prompt);
                  } else if(value.length > (options.maxlength||500)) {
                      layer.tips('&#x6700;&#x591A;&#x8F93;&#x5165;'+ (options.maxlength || 500) +'&#x4E2A;&#x5B57;&#x6570;', prompt, {tips: 1});
                  } else {
                      yes && yes(value, index, prompt);
                  }
              }
          }, options));
      };

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
              value: '已解决（默认字段，可修改）',
              area: ['300px', '100px'] //自定义文本域宽高
          }, function(value, index, elem){
              if(value.length == 0){
                  value = '已解决';
              }

              $.ajax({
                  url:'http://52.80.145.123:8080/console/alarm/updateById',
                  url:'{{route('api.alarms.edit')}}',
                  type:'POST',    //GET
                  async:true,    //或false,是否异步
                  data:{
                      remark:value,
                      status:1,
                      collectorId:collectorId,
                      id:alarmId,
                      category:alarmCategory,
                      operatorId:'{{\Auth::user()->id??0}}'
                  },
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