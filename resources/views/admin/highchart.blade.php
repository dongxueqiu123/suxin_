@extends('layouts.admin')

@section('content')
    <style type="text/css">
        body, html{width: 100%;height: 100%;margin:0;font-family:"微软雅黑";}

    #container {
      min-width: 300px;
      max-width: 800px;
      height: 300px;
      margin: 1em auto;
    }

    #csv {
      display: none;
    }
  </style>
  <script src="{{ asset('highcharts/code/highcharts.js') }}"></script>
  <script src="{{ asset('highcharts/code/modules/windbarb.js') }}"></script>
  <script src="{{ asset('highcharts/code/modules/exporting.js') }}"></script>
  <section class="content-header">
    <h1>
      Dashboard
      <small>Chart Samples</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>


  <section class="content">
      <div class="row">

        <div id="container" style="min-width: 310px; width: 800px; height: 00px; margin: 0 auto"></div>

          <div style="display:none;" id="containerData">{{$data}}</div>
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
                          collectorId = 3;
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
                                  var newData = getData(data['data']);

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
              text: 'Live random data'
          },
          xAxis: {
              type: 'datetime',
              tickPixelInterval: 150
          },
          yAxis: {
              title: {
                  text: 'Value'
              },
              plotLines: [{
                  value: 0,
                  width: 1,
                  color: '#808080'
              }]
          },
          tooltip: {
              formatter: function () {
                  return '<b>' + this.series.name + '</b><br/>' +
                      Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' +
                      Highcharts.numberFormat(this.y, 2);
              }
          },
          legend: {
              enabled: false
          },
          exporting: {
              enabled: false
          },
          series: [{
              name: 'Random data',
              data: (function () {
                  // generate an array of random data
                  data =$('#containerData').html();

                  return getData(JSON.parse( data));
              }())
          }]
      });


      function getData(data) {
          var dataKey, length, pointDate;
          length = data.length;
         for(dataKey = 0 ; dataKey < length; dataKey++){
             data[dataKey][0] = data[dataKey][0].replace(/T/, " ");
             data[dataKey][0] = data[dataKey][0].replace(/Z/, "");
             pointDate = new Date(data[dataKey][0]);
             data[dataKey][0] = pointDate.getTime()-2*new Date().getTimezoneOffset()*60*1000-8*60*60*1000;
         }
         return data;
      }

      function getUrl(status,collectorId,startTime,endTime,myTime){
          var startUnix = myTime.DateToUnix(startTime);
          var endUnix = myTime.DateToUnix(endTime);
          var startDate = myTime.UnixToDate(startUnix,true,8);
          var endDate = myTime.UnixToDate(endUnix,true,8);
          return '/console/influx/timeseries/'+status+'/'+collectorId+'/'+startDate+'/'+endDate+'/';
      }
  </script>
@endsection