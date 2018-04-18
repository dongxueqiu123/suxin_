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

                        <h3 class="box-title"></h3>

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

                        <h3 class="box-title"></h3>

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

                        <h3 class="box-title"></h3>

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
        var myTime ,time ,curTime ,max ,status ,dateTime ,$time;

        myTime = $.myTime;
        $time = $('time');
        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });

        var collectorId = '{{$collector->id}}';
        var startTimes = {'acc_orig': '', 'ex_temp': '', 'in_hum': ''};
        var flags = {'acc_orig': false, 'ex_temp': false, 'in_hum': false};
        var accs = [];

        changeInflux = function(timestamp) {
            var temp = timestamp.replace(/T/, " ");
            temp = temp.replace(/Z/, "");
            return temp;
        }

        convert = function(category, data) {
            if(flags[category]) {
                console.log(category + "\t" + data.length);
                return [];
            }
            flags[category] = true;
            var size = data.length;
            if(size == 0) {
                return data;
            }
            startTimes[category] = changeInflux(data[size - 1][0]);
            var interval = new Date().getTimezoneOffset()*60*1000+8*60*60*1000;
            var timestamp, pointTime;
            for(var i = 0 ; i < size; i++){
                timestamp = changeInflux(data[i][0]);
                pointTime = new Date(timestamp);
                data[i][0] = pointTime.getTime() - interval;
            }
            return data;
        }

        Highcharts.chart('container', {
            chart: {
                type: 'spline',
                animation: Highcharts.svg, // don't animate in old IE
                marginRight: 10,
                events: {
                    load: function () {
                        var sos = this.series[0];
                        setInterval(
                            function() {
                                $.getJSON(
                                    '/console/influx/timeseries/ex_temp/'+collectorId+'?startTime='+startTimes['ex_temp'],
                                    function(result) {
                                        var data = convert('ex_temp', result['data']);
                                        for(var i = 0 ; i < data.length; i++){
                                            sos.addPoint(data[i], true, true);
                                        }
                                        flags['ex_temp'] = false;
                                    }
                                );
                            }, 3500);
                    }
                }
            },
            title: {
                text: '{{$collector->name}}温度数据图'
            },
            xAxis: {
                title: {
                    text: '时间 (min)'
                },
                type: 'datetime',
                tickPixelInterval: 150
            },
            yAxis: {
                title: {
                    text: '温度 (℃)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            plotOptions: {
                series: {
                    marker: {
                        enabled: false
                    }
                },
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
                    data =$('#containerData').html();
                    return convert('ex_temp', JSON.parse(data));
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
                        var sos = this.series[0];
                        setInterval(
                            function() {
                                $.getJSON(
                                    '/console/influx/timeseries/acc_orig/'+collectorId+'?startTime='+startTimes['acc_orig'],
                                    function(result) {
                                        if(accs.length < 8) {
                                            var data = convert('acc_orig', result['data']);
                                            for(var j = 0; j < data.length; j++) {
                                                accs.push(data.shift());
                                            }
                                        }
                                        if(accs.length >= 8) {
                                            for(var j = 0; j < 8; j++) {
                                                sos.addPoint(accs.shift(), true, true);
                                            }
                                        }
                                        flags['acc_orig'] = false;
                                    }
                                );
                            }, 1000);
                    }
                }
            },
            title: {
                text: '{{$collector->name}}加速度数据图'
            },
            xAxis: {
                title: {
                    text: '时间 (min)'
                },
                type: 'datetime',
                tickPixelInterval: 150
            },
            yAxis: {
                title: {
                    text: '加速度 (m/s²)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            plotOptions: {
                series: {
                    marker: {
                        enabled: false
                    }
                },
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
                    var content = $('#containerSpeedData').html();
                    var data = convert('acc_orig', JSON.parse(content));
                    if(data.length > 16) {
                        for(var i = 0; i < 16; i++) {
                            accs.push(data.pop());
                        }
                    }
                    return data;
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
                        var sos = this.series[0];
                        setInterval(
                            function() {
                                $.getJSON(
                                    '/console/influx/timeseries/in_hum/'+collectorId+'?startTime='+startTimes['in_hum'],
                                    function(result) {
                                        var data = convert('in_hum', result['data']);
                                        for(var i = 0 ; i < data.length; i++){
                                            sos.addPoint(data[i], true, true);
                                        }
                                        flags['in_hum'] = false;
                                    }
                                );
                            }, 3500);
                    }
                }
            },
            title: {
                text: '{{$collector->name}}湿度数据图'
            },
            xAxis: {
                title: {
                    text: '时间 (min)'
                },
                type: 'datetime',
                tickPixelInterval: 150
            },
            yAxis: {
                title: {
                    text: '湿度 (%RH)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            plotOptions: {
                series: {
                    marker: {
                        enabled: false
                    }
                },
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
                    data =$('#containerHumidityData').html();
                    return convert('in_hum', JSON.parse(data));
                }())
            }]
        });

        $('.collector').on('change',function(){
            window.location.href = $(this).val();
        });
    </script>
@endsection
