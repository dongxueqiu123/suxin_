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
        <li><a href="{{route('admin')}}"><i class="fa fa-home"></i> 后台首页</a></li>
        <li class="active"></li>
    </ol>
  </section>

  <section class="content">


      <div class="row">
          <div class="col-xs-12">
              <div class="box box-solid">
                  <div class="box-body">
                      <b>
                      均方根值可以作为轴承故障预测特征信息，并能提前预测出轴承故障，具有较高的预测精度。
                      </b>
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

                      <h3 class="box-title">均方根值输入轴</h3>

                      <div class="box-tools pull-right">
                      </div>
                  </div>
                  <div class="box-body">
                      <div id="containerSpeed" style="height: 300px; width: 800px;  margin: auto;"></div>
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

                      <h3 class="box-title">均方根值输出轴</h3>

                      <div class="box-tools pull-right">

{{--                          <div class="btn-group changeButton"  data-toggle="btn-toggle">
                              <button type="button" class="btn btn-default btn-xs temperature active" value="ex_temp">温度</button>
                              <button type="button" class="btn btn-default btn-xs speed" value="acc_peak" >加速度</button>
                          </div>--}}
                      </div>
                  </div>
                  <div class="box-body">
                      <div id="containerOut"  style="height: 300px; width: 800px;  margin: auto;"></div>

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
              <div class="box box-solid">
                  <div class="box-body">
                      <b>
                      时域平均值对原始数据进行降噪处理，得到周期性旋转数据，通过图形化展示可以快速判断轴承故障，也可以作为复杂故障诊断的基础。
                      </b>
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

                      <h3 class="box-title">时域平均值输入轴</h3>

                      <div class="box-tools pull-right">

                          {{--                          <div class="btn-group changeButton"  data-toggle="btn-toggle">
                                                        <button type="button" class="btn btn-default btn-xs temperature active" value="ex_temp">温度</button>
                                                        <button type="button" class="btn btn-default btn-xs speed" value="acc_peak" >加速度</button>
                                                    </div>--}}
                      </div>
                  </div>
                  <div class="box-body">
                      <div id="containerHumidity"  style="height: 300px; width: 800px;  margin: auto;"></div>
                      <div style="display:none;" id="containerHumidityData"></div>
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

                      <h3 class="box-title">时域平均值输出轴</h3>

                      <div class="box-tools pull-right">

                          {{--                          <div class="btn-group changeButton"  data-toggle="btn-toggle">
                                                        <button type="button" class="btn btn-default btn-xs temperature active" value="ex_temp">温度</button>
                                                        <button type="button" class="btn btn-default btn-xs speed" value="acc_peak" >加速度</button>
                                                    </div>--}}
                      </div>
                  </div>
                  <div class="box-body">
                      <div id="containerHumiditySend"  style="height: 300px; width: 800px;  margin: auto;"></div>
                  </div>
                  <!-- /.box-body-->
              </div>
              <!-- /.box -->

          </div>
          <!-- /.col -->
      </div>
  </section>

  <script type="text/javascript">


      $(function() {
          $(document).ready(function() {
              Highcharts.setOptions({
                  global: {
                      useUTC: false
                  }
              });
              var chart;
              var data = [3.6E-4,4.76E-4,4.77E-4,4.55E-4,5.09E-4,6.58E-4,3.82E-4,4.22E-4,6.85E-4,5.65E-4,3.75E-4,4.92E-4,4.82E-4,5.01E-4,4.3E-4,6.96E-4,3.78E-4,4.45E-4,6.5E-4,5.84E-4,3.4E-4,4.79E-4,4.59E-4,5.08E-4,4.42E-4,6.76E-4,3.7E-4,4.64E-4,5.11E-4,7.28E-4,3.43E-4,5.51E-4,3.84E-4,5.05E-4,3.76E-4,8.05E-4,3.68E-4,5.62E-4,4.41E-4,7.7E-4,4.24E-4,5.85E-4,3.44E-4,4.52E-4,3.42E-4,8.62E-4,4.08E-4,4.66E-4,4.31E-4,7.81E-4,3.66E-4,5.41E-4,3.52E-4,4.26E-4,3.43E-4,8.56E-4,4.25E-4,4.75E-4,4.28E-4,7.41E-4,3.73E-4,5.17E-4,3.91E-4,4.57E-4,3.78E-4,8.58E-4,4.56E-4,4.4E-4,4.05E-4,7.29E-4,3.98E-4,4.53E-4,4.45E-4,4.2E-4,3.85E-4,5.86E-4,4.71E-4,4.11E-4,5.58E-4,5.46E-4,3.83E-4,4.25E-4,4.45E-4,3.63E-4,4.33E-4,6.39E-4,4.34E-4,4.16E-4,5.22E-4,5.65E-4,3.89E-4,3.99E-4,4.71E-4,4.0E-4,3.99E-4,5.88E-4,4.82E-4,3.76E-4,5.84E-4,6.1E-4,3.98E-4,3.97E-4,4.62E-4,4.5E-4,3.94E-4,6.39E-4,4.84E-4,3.7E-4,5.44E-4,6.59E-4,4.24E-4,3.92E-4,4.33E-4,4.42E-4,3.7E-4,6.44E-4,5.34E-4,4.29E-4,5.8E-4,7.13E-4,4.02E-4,4.55E-4,4.59E-4,4.3E-4,4.17E-4,6.45E-4,4.61E-4,4.09E-4,4.84E-4,6.9E-4,4.29E-4,4.36E-4,4.28E-4];
              var data1 = [7.16E-4,8.78E-4,7.19E-4,8.02E-4,7.66E-4,6.33E-4,6.95E-4,9.69E-4,8.65E-4,6.21E-4,7.19E-4,8.36E-4,6.09E-4,8.34E-4,7.72E-4,7.52E-4,6.51E-4,7.96E-4,8.02E-4,6.03E-4,6.86E-4,8.21E-4,6.97E-4,8.8E-4,8.11E-4,8.1E-4,6.59E-4,9.81E-4,7.57E-4,7.21E-4,7.37E-4,7.13E-4,6.31E-4,6.89E-4,7.62E-4,6.45E-4,7.38E-4,8.84E-4,8.06E-4,7.44E-4,7.43E-4,9.2E-4,7.54E-4,8.52E-4,8.75E-4,6.29E-4,6.88E-4,8.99E-4,7.1E-4,6.04E-4,7.47E-4,7.81E-4,6.65E-4,8.4E-4,8.12E-4,7.33E-4,7.11E-4,9.58E-4,8.34E-4,5.81E-4,8.34E-4,7.89E-4,7.27E-4,8.39E-4,8.89E-4,6.89E-4,6.89E-4,9.51E-4,6.83E-4,6.93E-4,6.72E-4,7.57E-4,7.48E-4,6.95E-4,8.13E-4,6.55E-4,7.54E-4,9.93E-4,8.54E-4,8.01E-4,7.76E-4,8.86E-4,7.25E-4,7.92E-4,8.19E-4,6.68E-4,7.0E-4,8.26E-4,7.01E-4,5.69E-4,7.68E-4,8.1E-4,8.21E-4,8.6E-4,8.71E-4,7.81E-4,6.37E-4,0.001,7.75E-4,6.0E-4,7.28E-4,7.14E-4,6.74E-4,7.36E-4,8.44E-4,7.45E-4,7.58E-4,8.77E-4,7.8E-4,7.39E-4,7.27E-4,8.63E-4,7.18E-4,7.14E-4,8.48E-4,6.35E-4,6.66E-4,8.65E-4,7.97E-4,6.95E-4,8.16E-4,7.99E-4,7.0E-4,8.11E-4,7.84E-4,6.66E-4,6.62E-4,8.49E-4,8.11E-4,6.37E-4,7.13E-4,8.68E-4,7.27E-4];
              chart = new Highcharts.Chart({
                  chart: {
                      renderTo: 'containerSpeed',
                      type: 'spline',
                      animation: Highcharts.svg,
                      // don't animate in old IE
                      marginRight: 10,
                      events: {
                          load: function() {}
                      }
                  },
                  title: {
                      text: ''
                  },
                  credits: {
                      enabled: false //不显示LOGO
                  },
                  xAxis: {
                      title: {
                          text: '时间(min)'
                      },
                      type: 'datetime',
                      tickPixelInterval: 150
                  },
                  yAxis: [{
                      title: {
                          text: ''
                      },
                      plotLines: [{
                          value: 0,
                          width: 1,
                          color: '#808080'
                      }]
                  },
                      {
                          title: {
                              text: '加速度(m/s²)'
                          },
                          plotLines: [{
                              value: 0,
                              width: 1,
                              color: '#808080'
                          }]
                      }],
                  tooltip: {
                      formatter: function() {
                          return '<b>' + this.series.name + '</b><br/>' + Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' + Highcharts.numberFormat(this.y, 2);
                      }
                  },

                  exporting: {
                      enabled: false
                  },
                  legend: {
                      align: 'center',
                      verticalAlign: 'top',
                      x: 0,
                      y: 0
                  },
                  series: [{
                      name: '正常',
                      lineWidth: 1,
                      data: (function() { // generate an array of random data
                          var res = getArray(data,2000,120,4);
                          return res;
                      })()
                  },
                      {
                          name: '故障',
                          color:"#ff0000",
                          lineWidth: 1,
                          data: (function() { // generate an array of random data
                               var res = getArray(data1,2000,120,4);
                               return res;
                          })()
                      }]
              }); // set up the updating of the chart each second
              var series = chart.series[0];
              var series1 = chart.series[1];
              setOnce(data,120,series,2001);
              setOnce(data1,120,series1,2000);
          });


          $(document).ready(function() {
              Highcharts.setOptions({
                  global: {
                      useUTC: false
                  }
              });
              var chart;
              var data1 = [3.15E-4,4.73E-4,3.94E-4,4.77E-4,4.41E-4,5.4E-4,3.38E-4,4.39E-4,4.91E-4,5.36E-4,3.5E-4,4.82E-4,4.03E-4,4.49E-4,4.11E-4,5.66E-4,3.56E-4,4.5E-4,4.81E-4,5.05E-4,3.29E-4,5.17E-4,3.84E-4,4.56E-4,3.83E-4,5.22E-4,3.34E-4,4.23E-4,4.73E-4,5.88E-4,3.1E-4,4.94E-4,3.58E-4,4.2E-4,3.63E-4,6.23E-4,3.06E-4,4.54E-4,4.26E-4,6.29E-4,3.88E-4,4.77E-4,3.23E-4,4.59E-4,3.43E-4,6.91E-4,3.61E-4,4.34E-4,4.15E-4,6.62E-4,3.53E-4,5.06E-4,3.43E-4,4.32E-4,3.56E-4,6.5E-4,4.07E-4,4.05E-4,3.89E-4,6.21E-4,3.73E-4,5.0E-4,3.64E-4,4.37E-4,3.36E-4,6.75E-4,4.35E-4,4.25E-4,3.85E-4,5.97E-4,3.9E-4,4.27E-4,4.02E-4,3.92E-4,3.68E-4,5.4E-4,4.48E-4,4.31E-4,4.27E-4,5.64E-4,3.72E-4,4.26E-4,4.18E-4,4.07E-4,4.25E-4,5.82E-4,4.03E-4,4.41E-4,4.34E-4,5.08E-4,3.63E-4,4.13E-4,4.31E-4,4.45E-4,3.91E-4,5.9E-4,4.3E-4,4.33E-4,4.62E-4,5.21E-4,3.99E-4,4.29E-4,4.47E-4,4.2E-4,3.67E-4,5.65E-4,4.32E-4,4.23E-4,4.73E-4,5.68E-4,3.6E-4,4.33E-4,4.16E-4,3.99E-4,3.68E-4,5.71E-4,4.95E-4,4.03E-4,4.64E-4,5.56E-4,3.94E-4,4.55E-4,4.06E-4,4.09E-4,4.05E-4,5.41E-4,4.59E-4,3.8E-4,4.42E-4,5.37E-4,4.22E-4,4.18E-4,4.34E-4];
              var data = [4.35E-4,5.64E-4,4.06E-4,5.04E-4,5.23E-4,4.31E-4,4.16E-4,5.32E-4,5.35E-4,4.54E-4,4.39E-4,5.18E-4,3.96E-4,4.91E-4,4.97E-4,4.96E-4,3.94E-4,5.12E-4,4.56E-4,4.06E-4,4.37E-4,5.49E-4,4.26E-4,4.93E-4,5.42E-4,4.82E-4,3.83E-4,5.83E-4,5.0E-4,4.5E-4,4.09E-4,5.38E-4,4.21E-4,4.78E-4,5.12E-4,4.38E-4,4.01E-4,4.92E-4,5.03E-4,4.4E-4,4.2E-4,5.89E-4,4.65E-4,5.1E-4,5.45E-4,4.44E-4,4.19E-4,5.04E-4,4.66E-4,4.17E-4,4.14E-4,5.45E-4,4.17E-4,5.13E-4,5.13E-4,5.01E-4,4.23E-4,5.7E-4,5.43E-4,4.4E-4,4.38E-4,5.68E-4,4.3E-4,4.66E-4,5.19E-4,4.51E-4,4.09E-4,5.25E-4,4.91E-4,4.45E-4,3.88E-4,5.33E-4,4.3E-4,4.8E-4,5.26E-4,4.42E-4,4.19E-4,5.65E-4,5.05E-4,4.6E-4,4.43E-4,5.38E-4,4.35E-4,5.13E-4,5.08E-4,4.81E-4,3.8E-4,5.18E-4,5.02E-4,4.07E-4,4.21E-4,4.91E-4,4.24E-4,5.02E-4,5.44E-4,4.8E-4,3.78E-4,5.27E-4,5.28E-4,4.18E-4,4.04E-4,5.04E-4,4.17E-4,4.47E-4,4.94E-4,4.47E-4,4.31E-4,5.09E-4,5.0E-4,4.69E-4,4.38E-4,5.55E-4,3.96E-4,4.44E-4,5.58E-4,4.33E-4,4.37E-4,5.2E-4,4.74E-4,4.52E-4,4.25E-4,5.01E-4,4.44E-4,5.02E-4,4.97E-4,4.7E-4,4.11E-4,5.28E-4,5.0E-4,4.39E-4,4.33E-4,5.96E-4,4.37E-4];
              chart = new Highcharts.Chart({
                  chart: {
                      renderTo: 'containerOut',
                      type: 'spline',
                      animation: Highcharts.svg,
                      // don't animate in old IE
                      marginRight: 10,
                      events: {
                          load: function() {}
                      }
                  },
                  title: {
                      text: ''
                  },
                  credits: {
                      enabled: false //不显示LOGO
                  },
                  xAxis: {
                      title: {
                          text: '时间(min)'
                      },
                      type: 'datetime',
                      tickPixelInterval: 150
                  },
                  yAxis: [{
                      title: {
                          text: ''
                      },
                      plotLines: [{
                          value: 0,
                          width: 1,
                          color: '#808080'
                      }]
                  },
                      {
                          title: {
                              text: '加速度(m/s²)'
                          },
                          plotLines: [{
                              value: 0,
                              width: 1,
                              color: '#808080'
                          }]
                      }],
                  tooltip: {
                      formatter: function() {
                          return '<b>' + this.series.name + '</b><br/>' + Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' + Highcharts.numberFormat(this.y, 2);
                      }
                  },
                  legend: {
                      enabled: false
                  },
                  exporting: {
                      enabled: false
                  },
                  legend: {
                      align: 'center',
                      verticalAlign: 'top',
                      x: 0,
                      y: 0
                  },
                  series: [{
                      name: '正常',
                      lineWidth: 1,
                      data: (function() { // generate an array of random data
                          var res = getArray(data,2000,120,4);
                          return res;
                      })()
                  },
                      {
                          name: '故障',
                          color:"#ff0000",
                          lineWidth: 1,
                          data: (function() { // generate an array of random data
                             var res = getArray(data1,2000,120,4);
                              return res;
                          })()
                      }]
              }); // set up the updating of the chart each second
              var series = chart.series[0];
              var series1 = chart.series[1];
             setOnce(data1,120,series1,2000);
              setOnce(data,120,series,2000);

          });

          $(document).ready(function() {
              Highcharts.setOptions({
                  global: {
                      useUTC: false
                  }
              });
              var chart;
              var data1 = [-0.033304, -0.037148, -0.033114, -0.026763, -0.013445, -0.007141, 0.005978, 0.015229, 0.029413, 0.04171, 0.044772, 0.032857, 0.004904, -0.01646, -0.031666, -0.039882, -0.038268, -0.030883, -0.022414, -0.002322, 0.007181, 0.025197, 0.027115, 0.017323, 0.006342, -0.011588, -0.015723, -0.013713, -0.009365, -0.004841, -0.00667, 1.23E-4, 0.00881, 0.010166, 0.015183, 0.011795, -0.001195, -0.007202, -0.015144, -0.01251, -0.010233, -0.005596, 4.9E-4, 0.002087, 0.004303, 0.002619, 0.004356, 0.002818, -0.002473, -0.007026, -0.018402, -0.025704, -0.020078, -0.012526, -0.009342, -0.004758, -0.007088, 0.002887, 0.008171, 0.004782, 6.48E-4, -0.009965, -0.011398, -0.006235, 0.006831, 0.008444, 0.005704, -0.002657, 0.004752, 0.013584, 0.022028, 0.021008, 0.012146, -3.65E-4, -0.014009, -0.028393, -0.025598, -0.015304, 0.00594, 0.01053, 0.016273, 0.008727, 0.015199, 0.014986, 0.014438, -0.002559, -0.017269, -0.02495, -0.026884, -0.018958, -0.009128, 0.01283, 0.02368, 0.029644, 0.026566, 0.017748, 0.012382, 0.006748, 0.002126, -0.005314, -0.02071, -0.020161, -0.009007, 0.009335, 0.027961, 0.03776, 0.033793, 0.020018, 0.009611, 0.005163, 0.003794, -9.5E-4, -0.006858, -0.012517, -0.004331, 0.00533, 0.022135, 0.022311, 0.009838, -0.001438, -0.015037, -0.013484, -0.013072, -0.011115, -0.011785, -0.010506, -0.003982, 0.006807, 0.027274, 0.027747, 0.024793, 0.006648, -0.017656];
              var data = [-0.007386, -0.010508, -0.016698, -0.014292, -0.011421, -0.00239, 0.002017, 0.007834, 0.009487, 0.005931, -0.003336, -0.008765, -0.0165, -0.019599, -0.018129, -0.019333, -0.014871, -0.008072, -0.004172, 0.004873, 0.013463, 0.017451, 0.022347, 0.022768, 0.018829, 0.013599, 0.009654, 0.004607, 0.002032, -0.001348, 5.33E-4, -0.001645, -0.001058, -0.001758, -0.005801, -0.002856, -0.001302, -0.002771, -8.52E-4, -0.00485, -0.006753, -0.007492, -0.007858, -0.006328, -0.00693, -0.007972, -0.006647, -0.008376, -0.009273, -0.011079, -0.009594, -0.005027, -0.002048, 0.001416, 0.001477, 0.003929, 0.006555, 0.008544, 0.008786, 0.010599, 0.01114, 0.011452, 0.012884, 0.009457, 0.006182, -0.001537, -0.007233, -0.008063, -0.004834, -0.00134, 1.75E-4, 0.001454, 0.002109, 0.001897, 0.00485, 0.005864, 0.006914, 0.006457, 0.001766, -0.004636, -0.005666, -0.004783, -0.004797, -0.007264, -0.005627, -0.006311, -0.01037, -0.010546, -0.010545, -0.010902, -0.008651, -0.011444, -0.010379, -0.007302, -0.006122, -0.003367, -2.52E-4, 0.001645, 0.003075, 0.005909, 0.006671, 0.008826, 0.009326, 0.009762, 0.008339, 0.007706, 0.007362, 0.008079, 0.005551, 0.001926, -0.002246, 4.49E-4, -1.45E-4, 0.001484, 0.00456, 0.006479, 0.009587, 0.008177, 0.005695, 0.005574, -7.6E-4, -0.004431, -0.004895, -0.002779, -0.00284, 0.003442, 0.009967, 0.012047, 0.011498, 0.008908, 0.008473, 0.003792, -0.00214];
              chart = new Highcharts.Chart({
                  chart: {
                      renderTo: 'containerHumidity',
                      type: 'spline',
                      animation: Highcharts.svg,
                      // don't animate in old IE
                      marginRight: 10,
                      events: {
                          load: function() {}
                      }
                  },
                  title: {
                      text: ''
                  },
                  credits: {
                      enabled: false //不显示LOGO
                  },
                  xAxis: {
                      title: {
                          text: '时间(min)'
                      },
                      type: 'datetime',
                      tickPixelInterval: 150
                  },
                  yAxis: [{
                      title: {
                          text: ''
                      },
                      plotLines: [{
                          value: 0,
                          width: 1,
                          color: '#808080'
                      }]
                  },
                      {
                          title: {
                              text: '加速度(m/s²)'
                          },
                          plotLines: [{
                              value: 0,
                              width: 1,
                              color: '#808080'
                          }]
                      }],
                  tooltip: {
                      formatter: function() {
                          return '<b>' + this.series.name + '</b><br/>' + Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' + Highcharts.numberFormat(this.y, 2);
                      }
                  },
                  legend: {
                      enabled: false
                  },
                  exporting: {
                      enabled: false
                  },
                  legend: {
                      align: 'center',
                      verticalAlign: 'top',
                      x: 0,
                      y: 0
                  },
                  series: [{
                      name: '正常',
                      lineWidth: 1,
                      data: (function() { // generate an array of random data

                          var res = getArray(data,2000,120,4);
                          return res;
                      })()
                  },
                      {
                          name: '故障',
                          color:"#ff0000",
                          lineWidth: 1,
                          data: (function() { // generate an array of random data
                              var res = getArray(data1,2000,120,4);
                              return res;
                          })()
                      }]
              }); // set up the updating of the chart each second
              var series = chart.series[0];
              var series1 = chart.series[1];
              setOnce(data1,120,series1,2000);
              setOnce(data,120,series,2000);
          });

          $(document).ready(function() {
              Highcharts.setOptions({
                  global: {
                      useUTC: false
                  }
              });
              var chart;
              var data=[-0.01322, -0.01198, -0.0122, -0.013305, -0.004563, -0.002241, 0.001581, 0.002594, 0.003729, 0.002967, 0.001018, 0.001878, 6.68E-4, -5.43E-4, -0.004845, -0.003825, -0.002873, 0.002214, 0.009294, 0.013505, 0.009904, 0.007026, 0.004726, 0.004719, 0.007087, 0.012203, 0.011297, 0.00647, -0.003596, -0.010144, -0.008956, -0.003619, -0.002249, -5.6E-5, -0.004548, -0.005972, -0.008317, -0.006269, -0.007144, -0.00751, -0.008637, -0.006825, -0.003528, -0.003718, -0.00282, -0.005248, -0.006482, -0.005294, -0.002036, 0.003645, 0.00628, 0.005884, 0.002137, 0.001521, 3.71E-4, 4.62E-4, 0.003021, 0.003881, 0.004939, 0.002769, 0.002366, -3.83E-4, -0.003116, -0.004129, -0.003725, 1.3E-5, -2.5E-5, -0.001175, 5.31E-4, -8.02E-4, -0.00317, -0.006573, -0.0017, -0.002051, -6.8E-4, 0.007193, 0.00915, 0.014647, 0.018805, 0.020533, 0.018066, 0.012546, 0.008305, 0.001818, -0.005508, -0.012131, -0.016502, -0.020637, -0.02034, -0.021794, -0.019114, -0.014919, -0.009703, -0.007556, -0.002835, -0.003923, -0.003208, -8.6E-5, 0.003653, 0.007985, 0.011198, 0.008876, 0.00679, 0.004787, 0.003813, 0.006287, 0.012455, 0.013589, 0.011937, 0.011495, 0.010216, 0.007254, 0.005959, 4.32E-4, -0.003733, -0.010784, -0.015421, -0.016053, -0.016281, -0.011081, -0.00556, 5.08E-4, 0.008366, 0.013726, 0.017053, 0.020777, 0.019383, 0.012531, 0.005891, 0.001353, -0.005439, -0.010631, -0.012459];
              var data1=[-0.014445, -0.018267, -0.017453, -0.015892, -0.011628, -0.008681, -0.01012, -0.005247, -0.00291, 6.08E-4, 0.003181, 0.004217, 0.004446, 0.007788, 0.004963, 0.002451, 0.001293, 5.85E-4, -0.003245, -0.003207, -0.002003, -3.21E-4, -0.001455, -0.004212, -0.009816, -0.010988, -0.010082, -0.007562, 0.002603, 0.005671, 0.00871, 0.013446, 0.009646, 0.010255, 0.009395, 0.004385, 0.002382, -0.00581, -0.007768, -0.014293, -0.019029, -0.014316, -0.01175, -0.004897, -0.003237, -0.002468, 0.001004, 0.005618, 0.00957, 0.012174, 0.007301, 0.00322, 0.002055, -0.001714, -9.38E-4, 0.002169, -0.003351, -0.005407, -0.005909, -0.008004, -0.007052, -0.00597, -0.006359, -0.003511, -0.001334, 0.001499, 0.007141, 0.007651, 0.005207, 0.006539, 0.001263, 6.08E-4, 0.006631, 0.008588, 0.005542, 0.003357, 8.52E-4, -0.00259, -0.001958, -0.001295, -0.001767, 6.69E-4, 0.002497, 0.009037, 0.007506, 0.013179, 0.012974, 0.015091, 0.013042, 0.010666, 0.00459, -0.003465, -0.011331, -0.014156, -0.01274, -0.014285, -0.012405, -0.013318, -0.007699, -0.006001, 0.001598, 0.005702, 0.011664, 0.016948, 0.023679, 0.024273, 0.025255, 0.023748, 0.015524, 0.008161, 0.004728, 4.49E-4, -0.002163, -0.004638, -0.008232, -0.008673, -0.009473, -0.014346, -0.011879, -0.017597, -0.017346, -0.016417, -0.004935, 1.36E-4, 0.011238, 0.017199, 0.017291, 0.019347, 0.015768, 0.009821, 0.001545, -0.004105, -0.010882];
              chart = new Highcharts.Chart({
                  chart: {
                      renderTo: 'containerHumiditySend',
                      type: 'spline',
                      animation: Highcharts.svg,
                      // don't animate in old IE
                      marginRight: 10,
                      events: {
                          load: function() {}
                      }
                  },
                  title: {
                      text: ''
                  },
                  credits: {
                      enabled: false //不显示LOGO
                  },
                  xAxis: {
                      title: {
                          text: '时间(min)'
                      },
                      type: 'datetime',
                      tickPixelInterval: 150
                  },
                  yAxis: [{
                      title: {
                          text: ''
                      },
                      plotLines: [{
                          value: 0,
                          width: 1,
                          color: '#808080'
                      }]
                  },
                      {
                          title: {
                              text: '加速度(m/s²)'
                          },
                          plotLines: [{
                              value: 0,
                              width: 1,
                              color: '#808080'
                          }]
                      }],
                  tooltip: {
                      formatter: function() {
                          return '<b>' + this.series.name + '</b><br/>' + Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) + '<br/>' + Highcharts.numberFormat(this.y, 2);
                      }
                  },
                  legend: {
                      enabled: false
                  },
                  exporting: {
                      enabled: false
                  },
                  legend: {
                      align: 'center',
                      verticalAlign: 'top',
                      x: 0,
                      y: 0
                  },
                  series: [{
                      name: '正常',
                      lineWidth: 1,
                      data: (function() { // generate an array of random data

                          var res = getArray(data,2000,120,4);
                          return res;
                      })()
                  },
                      {
                          name: '故障',
                          color:"#ff0000",
                          lineWidth: 1,
                          data: (function() { // generate an array of random data
                              var res = getArray(data1,2000,120,4);
                              return res;
                          })()
                      }]
              }); // set up the updating of the chart each second
              var series = chart.series[0];
              var series1 = chart.series[1];
              setOnce(data1,120,series1,2000);
              setOnce(data,120,series,2000);
          });
      });

      function setOnce(arr,i,series,time){
          var i=i,length=arr.length;
          (function changeTime(){
              setTimeout(function(){
                  var x = (new Date()).getTime();
                  series.addPoint([x, arr[i++]], true, true);
                  if(i==length){
                      i=0;
                      changeTime()
                  }else if(i<length){
                      changeTime()
                  }
              },time)
          }())
      }

      function getArray(data,intervalTime,num,min) {
          var result = [];
          for (dataKey = 0; dataKey < num; dataKey++) {
             result[dataKey] = [(new Date()).getTime()+dataKey*intervalTime-min*60*1000,data[dataKey]];
          }
          return result;
      }

  </script>

@endsection