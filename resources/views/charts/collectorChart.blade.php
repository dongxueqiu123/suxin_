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
      <small>无线节点数据图</small>
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
                  <div class="box-body">

                      <div class="col-sm-3">
                      <select class="form-control select2 collector"  style="width: 100%;">
                          @foreach($collectors??[] as $collectorValue)
                              <option @if(($collectorValue->id??'') == $collector->id) selected @endif value="{{route('charts.collectorChartRealTime',['id'=>$collectorValue->id])}}">{{$collectorValue->name}}</option>
                          @endforeach
                      </select>
                      </div>
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

                      <h3 class="box-title">{{$collector->name}}加速度数据图</h3>

                      <div class="box-tools pull-right">

                      </div>
                  </div>
                  <div class="box-body">
                      <div id="containerSpeed"  style="height: 300px; width: 800px;  margin: auto;"></div>
                      <div style="display:none;" id="containerSpeedData">{{$speedData}}</div>
                  </div>
                  <!-- /.box-body-->
              </div>
              <!-- /.box -->

          </div>
          <!-- /.col -->
      </div>

      <div class="row">
          <div class="col-xs-12">
              <!-- interactive chart -->
              <div class="box box-solid">
                  <div class="box-header with-border">
                      <i class="fa fa-bar-chart-o"></i>

                      <h3 class="box-title">{{$collector->name}}温度数据图</h3>

                      <div class="box-tools pull-right">

                      </div>
                  </div>
                  <div class="box-body">
                      <div id="container"  style="height: 300px; width: 800px;  margin: auto;"></div>
                      <div style="display:none;" id="containerData">{{$data}}</div>
                  </div>
                  <!-- /.box-body-->
              </div>
              <!-- /.box -->

          </div>
          <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
          <div class="col-xs-12">
              <!-- interactive chart -->
              <div class="box box-solid">
                  <div class="box-header with-border">
                      <i class="fa fa-bar-chart-o"></i>

                      <h3 class="box-title">{{$collector->name}}湿度数据图</h3>

                      <div class="box-tools pull-right">

                          {{--                          <div class="btn-group changeButton"  data-toggle="btn-toggle">
                                                        <button type="button" class="btn btn-default btn-xs temperature active" value="ex_temp">温度</button>
                                                        <button type="button" class="btn btn-default btn-xs speed" value="acc_peak" >加速度</button>
                                                    </div>--}}
                      </div>
                  </div>
                  <div class="box-body">
                      <div id="containerHumidity"  style="height: 300px; width: 800px;  margin: auto;"></div>
                      <div style="display:none;" id="containerHumidityData">{{$humidityData}}</div>
                  </div>
                  <!-- /.box-body-->
              </div>
              <!-- /.box -->

          </div>
          <!-- /.col -->
      </div>

  </section>

  <script type="text/javascript">


      var myTime ,time ,curTime ,max ,startDateTime ,collectorId ,status ,name;

      myTime = $.myTime;
      Highcharts.setOptions({
          global: {
              useUTC: false
          }
      });

      Highcharts.chart('container', {
          chart: {
              type: 'spline',
              animation: Highcharts.svg, // don't animate in old IE
              marginRight: 10,
              events: {
                  load: function () {
                      // set up the updating of the chart each second
                      var series = this.series[0];
                      setInterval(function (){
                          collectorId = '{{$collector->id}}';
                          status = 'ex_temp';
                          time = new Date();
                          curTime = myTime.CurTime();
                          max = myTime.UnixToDate(curTime,true,(new Date().getTimezoneOffset()/-60));
                          startDateTime = myTime.UnixToDate(curTime-8,true,(new Date().getTimezoneOffset()/-60));
                          $('.startTime').val(startDateTime);
                          url =  getUrl(status,collectorId,startDateTime,max,myTime);
                          $.getJSON(
                              url,
                              function (data) {
                                  var newData = getData(data['data'],1);

                                  var length = newData.length;

                                  for(dataKey = 0 ; dataKey < length; dataKey++){
                                      console.log(newData[dataKey][0]);
                                      console.log(newData[dataKey][1]);
                                      series.addPoint([newData[dataKey][0], newData[dataKey][1]], true, true);
                                  }
                              }
                          );
                      }, 9000);
                  }
              }
          },
          title: {
              text: ''
          },
          xAxis: {
              type: 'datetime',
              tickPixelInterval: 150
          },
          yAxis: {
              title: {
                  text: '℃'
              },
              plotLines: [{
                  value: 0,
                  width: 1,
                  color: '#808080'
              }]
          },
          credits: {
              enabled: false //不显示LOGO
          },
          tooltip: {
              formatter: function () {
                  return '<b>' + this.series.name + '</b><br/>' +
                      Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                      Highcharts.numberFormat(this.y, 1);
              }
          },
          legend: {
              enabled: false
          },
          exporting: {
              enabled: false
          },
          series: [{
              name: '温度',
              lineWidth: 1,
              data: (function () {
                  // generate an array of random data
                  data =$('#containerData').html();

                  return getData(JSON.parse( data),1);
              }())
          }]
      });


      Highcharts.chart('containerSpeed', {
          chart: {
              type: 'spline',
              animation: Highcharts.svg, // don't animate in old IE
              marginRight: 10,
              events: {
                  load: function () {
                      // set up the updating of the chart each second
                      var series = this.series[0];
                      setInterval(function (){
                          collectorId = '{{$collector->id}}';
                          status = 'acc_peak';
                          time = new Date();
                          curTime = myTime.CurTime();
                          max = myTime.UnixToDate(curTime,true,(new Date().getTimezoneOffset()/-60));
                          startDateTime = myTime.UnixToDate(curTime-8,true,(new Date().getTimezoneOffset()/-60));
                          $('.startTime').val(startDateTime);
                          url =  getUrl(status,collectorId,startDateTime,max,myTime);
                          $.getJSON(
                              url,
                              function (data) {
                                  var newData = getData(data['data'],1);

                                  var length = newData.length;

                                  for(dataKey = 0 ; dataKey < length; dataKey++){
                                      console.log(newData[dataKey][0]);
                                      console.log(newData[dataKey][1]);
                                      series.addPoint([newData[dataKey][0], newData[dataKey][1]], true, true);
                                  }
                              }
                          );
                      }, 9000);
                  }
              }
          },
          title: {
              text: ''
          },
          xAxis: {
              type: 'datetime',
              tickPixelInterval: 150
          },
          yAxis: {
              title: {
                  text: 'm/s²'
              },
              plotLines: [{
                  value: 0,
                  width: 1,
                  color: '#808080'
              }]
          },
          credits: {
              enabled: false //不显示LOGO
          },
          tooltip: {
              formatter: function () {
                  return '<b>' + this.series.name + '</b><br/>' +
                      Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                      Highcharts.numberFormat(this.y, 1);
              }
          },
          legend: {
              enabled: false
          },
          exporting: {
              enabled: false
          },
          series: [{
              lineWidth: 1,
              name: '加速度',
              data: (function () {
                  // generate an array of random data
                  data =$('#containerSpeedData').html();

                  return getData(JSON.parse( data),1);
              }())
          }]
      });


      Highcharts.chart('containerHumidity', {
          chart: {
              type: 'spline',
              animation: Highcharts.svg, // don't animate in old IE
              marginRight: 10,
              events: {
                  load: function () {
                      // set up the updating of the chart each second
                      var series = this.series[0];
                      setInterval(function (){
                          collectorId = '{{$collector->id}}';
                          status = 'in_hum';
                          time = new Date();
                          curTime = myTime.CurTime();
                          max = myTime.UnixToDate(curTime,true,(new Date().getTimezoneOffset()/-60));
                          startDateTime = myTime.UnixToDate(curTime-8,true,(new Date().getTimezoneOffset()/-60));
                          $('.startTime').val(startDateTime);
                          url =  getUrl(status,collectorId,startDateTime,max,myTime);
                          $.getJSON(
                              url,
                              function (data) {
                                  var newData = getData(data['data'],1);

                                  var length = newData.length;

                                  for(dataKey = 0 ; dataKey < length; dataKey++){
                                      console.log(newData[dataKey][0]);
                                      console.log(newData[dataKey][1]);
                                      series.addPoint([newData[dataKey][0], newData[dataKey][1]], true, true);
                                  }
                              }
                          );
                      }, 9000);
                  }
              }
          },
          title: {
              text: ''
          },
          xAxis: {
              type: 'datetime',
              tickPixelInterval: 150
          },
          yAxis: {
              title: {
                  text: '%rh'
              },
              plotLines: [{
                  value: 0,
                  width: 1,
                  color: '#808080'
              }]
          },
          credits: {
              enabled: false //不显示LOGO
          },
          tooltip: {
              formatter: function () {
                  return '<b>' + this.series.name + '</b><br/>' +
                      Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                      Highcharts.numberFormat(this.y, 1);
              }
          },
          legend: {
              enabled: false
          },
          exporting: {
              enabled: false
          },
          series: [{
              name: '湿度',
              lineWidth: 1,
              data: (function () {
                  // generate an array of random data
                  data =$('#containerHumidityData').html();

                  return getData(JSON.parse( data),1);
              }())
          }]
      });

      function getData(data,n) {
          var dataKey, length, pointDate;
          length = data.length;
          for(dataKey = 0 ; dataKey < length; dataKey++){
              data[dataKey][0] = data[dataKey][0].replace(/T/, " ");
              data[dataKey][0] = data[dataKey][0].replace(/Z/, "");
              pointDate = new Date(data[dataKey][0]);
              data[dataKey][0] = pointDate.getTime()-n*new Date().getTimezoneOffset()*60*1000-8*60*60*1000;
          }
          return data;
      }

      function getUrl(status,collectorId,startTime,endTime,myTime){
          var startUnix = myTime.DateToUnix(startTime);
          var endUnix = myTime.DateToUnix(endTime);
          var startDate = myTime.UnixToDate(startUnix,true,8);
          var endDate = myTime.UnixToDate(endUnix,true,8);
          return '/console/influx/timeseries/'+status+'/'+collectorId+'?startTime='+startDate+'&endTime='+endDate+'/';
      }

      $('.collector').on('change',function(){

          window.location.href = $(this).val();
      });
  </script>
@endsection