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
        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    </div>


  </section>
  <script type="text/javascript">

      $.getJSON(
          'https://data.jianshukeji.com/jsonp?filename=json/usdeur.json&callback=?',
          function (data) {
              data =[["2018-04-03T17:26:24Z",28.7],["2018-04-03T17:26:32Z",28.7],["2018-04-03T17:26:40Z",28.7],["2018-04-03T17:26:48Z",28.6],["2018-04-03T17:26:56Z",28.7],["2018-04-03T17:27:04Z",28.7],["2018-04-03T17:27:12Z",28.7],["2018-04-03T17:27:20Z",28.7],["2018-04-03T17:27:28Z",28.6],["2018-04-03T17:27:36Z",28.7],["2018-04-03T17:27:44Z",28.7],["2018-04-03T17:27:52Z",28.7],["2018-04-03T17:28:00Z",28.7],["2018-04-03T17:28:08Z",28.7],["2018-04-03T17:28:16Z",28.7],["2018-04-03T17:28:24Z",28.7],["2018-04-03T17:28:32Z",28.7],["2018-04-03T17:28:40Z",28.6],["2018-04-03T17:28:48Z",28.6],["2018-04-03T17:28:56Z",28.6],["2018-04-03T17:29:04Z",28.7],["2018-04-03T17:29:12Z",28.7],["2018-04-03T17:29:21Z",28.7],["2018-04-03T17:29:28Z",28.6],["2018-04-03T17:29:36Z",28.7],["2018-04-03T17:29:44Z",28.7],["2018-04-03T17:29:52Z",28.6],["2018-04-03T17:30:00Z",28.7]];
              var dataKey, length, pointDate;
              length = data.length;
              for(dataKey = 0 ; dataKey < length; dataKey++){
                  data[dataKey][0] = data[dataKey][0].replace(/T/, " ");
                  data[dataKey][0] = data[dataKey][0].replace(/Z/, "");
                  pointDate = new Date(data[dataKey][0]);
                  data[dataKey][0] = pointDate.getTime()+8*60*60*1000;
              }
              Highcharts.chart('container', {
                  chart: {
                      zoomType: 'x'
                  },
                  title: {
                      text: '采集器五分钟温度变化'
                  },
                  xAxis: {
                      type: 'datetime'
                  },
                  yAxis: {
                      title: {
                          text: '温度变化'
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
                      name: '温度',
                      data: data
                  }]
              });
          }
      );
  </script>
@endsection