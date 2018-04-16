@extends('layouts.admin')

@section('content')
  <style type="text/css">
    #container {
      min-width: 300px;
      max-width: 800px;
      height: 300px;
      margin: 1em auto;
    }

    #csv {
      display: none;
    }
    .demo-input{padding-left: 10px; height: 28px;  min-width: 162px; line-height: 28px; border: 1px solid #e6e6e6;  background-color: #fff;  border-radius: 2px;}
    .demo-footer{padding: 50px 0; color: #999; font-size: 14px;}
    .demo-footer a{padding: 0 5px; color: #01AAED;}
  </style>
  <script src="{{ asset('highcharts/code/highcharts.js') }}"></script>
  <script src="{{ asset('highcharts/code/modules/windbarb.js') }}"></script>
  <script src="{{ asset('highcharts/code/modules/exporting.js') }}"></script>
  <script src="{{ asset('laydate/laydate.js') }}"></script>
  <section class="content-header">
    <h1>
      <small>采集器数据图</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin')}}"><i class="fa fa-home"></i> 首页</a></li>
        <li class="active">{{$boxTitle}}</li>
    </ol>
  </section>

  <section class="content">

{{--    <div class="row">
        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    </div>--}}
      <div class="row">
          <div class="col-xs-12">
              <div class="box box-solid">
                  <div class="box-body">
                      <input type="hidden" class="collectorId" value="{{$collector->id}}">
                      <input type="text" class="demo-input startTime" placeholder="开始时间" readonly="readonly"  >
                      <input type="text" class="demo-input endTime" placeholder="截止时间" id="test1">
{{--                      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">
                          查询
                      </button>--}}
                      <a class="btn btn-default btn-xs find" >查询</a>
                  </div>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-xs-12">
              <!-- interactive chart -->
              <div class="box box-solid">
                  <div class="box-header with-border">
                      <i class="fa fa-bar-chart-o"></i>

                      <h3 class="box-title">采集器数据图</h3>

                      <div class="box-tools pull-right">

                          <div class="btn-group changeButton"  data-toggle="btn-toggle">
                              <button type="button" class="btn btn-default btn-xs temperature active" value="ex_temp">温度</button>
                              <button type="button" class="btn btn-default btn-xs speed" value="acc_peak" >加速度</button>
                          </div>
                      </div>
                  </div>
                  <div class="box-body">
                      <div id="container" style="height: 300px;"></div>
                  </div>
                  <!-- /.box-body-->
              </div>
              <!-- /.box -->

          </div>
          <!-- /.col -->
      </div>
      <!-- /.row -->

  </section>
  <script type="text/javascript">
      var myTime ,time ,curTime ,max ,startDateTime ,collectorId ,status ,name;
      collectorId = $('.collectorId').val();
      status =  $('.changeButton').find('.active').val();
      name = $('.changeButton').find('.active').html();
      myTime = $.myTime;
      time = new Date();
      curTime = myTime.CurTime();
      max = myTime.UnixToDate(curTime,true,(new Date().getTimezoneOffset()/-60));
      startDateTime = myTime.UnixToDate(curTime-300,true,(new Date().getTimezoneOffset()/-60));
      $('.startTime').val(startDateTime);
      highCharts(getUrl(status,collectorId,startDateTime,max,myTime),name);
      //执行一个laydate实例
      laydate.render({
          elem: '#test1' //指定元素
          ,type: 'datetime'
          ,value: time
          ,max : max
          ,done: function(value, date, endDate){

              var unixTime = myTime.DateToUnix(value);
              var dateTime = myTime.UnixToDate(unixTime-300,true,8);
              if(!value){
                  dateTime = '';
              }
              $('.startTime').val(dateTime);
          }
      });

      $("button").on('click',function(){
          var name ,status ,startTime ,endTime;
          if(!$(this).hasClass('active')){
              $(this).addClass('active')
          }
          $(this).siblings().removeClass('active');
          name = $(this).html();
          status = $(this).val();
          startTime = $('.startTime').val();
          endTime = $('.endTime').val();
          highCharts(getUrl(status,collectorId,startTime,endTime,myTime),name);

      });

      $('.find').on('click',function(){
          var startTime ,endTime ,status ,name;
          startTime = $('.startTime').val();
          endTime = $('.endTime').val();
          status =  $('.changeButton').find('.active').val();
          name = $('.changeButton').find('.active').html();
          highCharts(getUrl(status,collectorId,startTime,endTime,myTime),name);
      });

      function getUrl(status,collectorId,startTime,endTime,myTime){
          var startUnix = myTime.DateToUnix(startTime);
          var endUnix = myTime.DateToUnix(endTime);
          var startDate = myTime.UnixToDate(startUnix,true,8);
          var endDate = myTime.UnixToDate(endUnix,true,8);
          return '/console/influx/timeseries/'+status+'/'+collectorId+'/'+startDate+'/'+endDate+'/';
      }

      function highCharts(route,name){
          $.getJSON(route, function (result)  {
                  var data = result['data'];
                  var dataKey, length, pointDate, title, yAxisTitle, seriesName;
                  length = data.length;
                  title = '采集器五分钟'+name+'变化';
                  yAxisTitle = name+'变化';
                  seriesName = name;
                  for(dataKey = 0 ; dataKey < length; dataKey++){
                      data[dataKey][0] = data[dataKey][0].replace(/T/, " ");
                      data[dataKey][0] = data[dataKey][0].replace(/Z/, "");
                      pointDate = new Date(data[dataKey][0]);
                      data[dataKey][0] = pointDate.getTime()+new Date().getTimezoneOffset()*-60;
                  }
                  Highcharts.chart('container', {
                      chart: {
                          zoomType: 'x'
                      },
                      title: {
                          text: title
                      },
                      xAxis: {
                          type: 'datetime'
                      },
                      yAxis: {
                          title: {
                              text: yAxisTitle
                          }
                      },
                      legend: {
                          enabled: false
                      },
                      credits: {
                          enabled: false //不显示LOGO
                      },
                      plotOptions: {
                          area: {
                              fillColor: {
                                  linearGradient: {
                                      x1: 0,
                                      y1: 0,
                                      x2: 0,
                                      y2: 1
                                  },
                                  stops: [
                                      [0, Highcharts.getOptions().colors[0]],
                                      [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                                  ]
                              },
                              marker: {
                                  radius: 2
                              },
                              lineWidth: 1,
                              states: {
                                  hover: {
                                      lineWidth: 1
                                  }
                              },
                              threshold: null
                          }
                      },

                      series: [{
                          type: 'area',
                          name: seriesName,
                          data: data
                      }]
                  });
              }
          );
      }

  </script>
@endsection