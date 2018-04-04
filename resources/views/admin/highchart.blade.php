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
              data =[
                  ["2018-04-03T17:26:32Z",28.7]];
              var dataKey,length;
              length = data.length;
              for(dataKey = 0 ; dataKey < length; dataKey++){
                  data[dataKey][0] = data[dataKey][0].replace(/T/, " ");
                  data[dataKey][0] = data[dataKey][0].replace(/Z/, "");
              }
              console.log(data);

              Highcharts.chart('container', {
                  chart: {
                      zoomType: 'x'
                  },
                  title: {
                      text: 'USD to EUR exchange rate over time'
                  },
                  subtitle: {
                      text: document.ontouchstart === undefined ?
                          'Click and drag in the plot area to zoom in' : 'Pinch the chart to zoom in'
                  },
                  xAxis: {
                      type: 'datetime'
                  },
                  yAxis: {
                      title: {
                          text: 'Exchange rate'
                      }
                  },
                  legend: {
                      enabled: false
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
                      name: 'USD to EUR',
                      data: data
                  }]
              });
          }
      );
  </script>
@endsection