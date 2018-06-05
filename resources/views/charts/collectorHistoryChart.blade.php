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
                         <input type="text" class="demo-input startTime" placeholder="开始时间"  id="test2"  >
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
        var myTime ,time ,curTime ,max ,startDateTime ,collectorId ,startTime ,endTime ;
        collectorId = '{{$collector->id}}';
        name = '加速度';
        currentCharts();
        //执行一个laydate实例
        laydate.render({
            elem: '#test1' //指定元素
            ,type: 'datetime'
            ,value: time
            ,max : max
            ,done: function(value, date, endDate){

/*                var unixTime = myTime.DateToUnix(value);
                var dateTime = myTime.UnixToDate(unixTime-300,true,8);
                if(!value){
                    dateTime = '';
                }
                $('.startTime').val(dateTime);*/
            }
        });

        laydate.render({
            elem: '#test2' //指定元素
            ,type: 'datetime'
            ,value: time
            ,max : max
            ,done: function(value, date, endDate){

                /*                var unixTime = myTime.DateToUnix(value);
                                var dateTime = myTime.UnixToDate(unixTime-300,true,8);
                                if(!value){
                                    dateTime = '';
                                }
                                $('.startTime').val(dateTime);*/
            }
        });


        $('.find').on('click',function(){
            startTime = $('.startTime').val();
            endTime = $('.endTime').val();
            highCharts(collectorId,startTime,endTime,name);
        });

        function countIntervalAndTimes(startTime,endTime){
            var differenceTime,times = 1,interval = 1,result=[];
            differenceTime = endTime-startTime;
            if(differenceTime <= 300){
                interval = Math.ceil(differenceTime/60);//分钟
            }else if(differenceTime > 300 && differenceTime <= 30*60){
                times = Math.ceil(differenceTime/(60*5));//次数
                interval = 5;//分钟
            }else if(differenceTime > 30*60 && differenceTime <= 60*60){ //30-60分钟每次请求10分钟
                times = Math.ceil(differenceTime/(60*10));
                interval = 10;
            }else if(differenceTime > 60*60 && differenceTime <= 60*240){ //60-240分钟每次请求30分钟
                times = Math.ceil(differenceTime/(60*30));
                interval = 30;
            }else if(differenceTime > 60*240 ){ //大于240分钟每次请求60分钟
                times = Math.ceil(differenceTime/60*60);
                interval = 60;
            }
            result['interval'] = interval;
            result['times']    = times;
            return result;
        }

        function getUrlAndTimes(collectorId,endTime,interval){
            return 'https://www.suxiniot.com/console/influx/timeseries/period/acc_orig/'+collectorId+'?endTime='+(endTime-8*60*60)*1000 +'&period='+interval;
        }

        function highCharts(collectorId,startTime,endTime,name){
            title = '采集器五分钟'+name+'变化';
            yAxisTitle = name+'变化';
            seriesName = name;
            Highcharts.chart('container', {
                chart: {
                    type: 'spline',
                    animation: Highcharts.svg, // don't animate in old IE
                    marginRight: 10,
                    events: {
                        load: function () {
                            var sos = this.series[0];

                            result = countIntervalAndTimes(myTime.DateToUnix(startTime),myTime.DateToUnix(endTime));
                            for(var i = 0 ; i < result['times']; i++){
                                $.getJSON(getUrlAndTimes(collectorId,myTime.DateToUnix(endTime)-i*result['interval']*60,result['interval']), function(result) {
                                        sos.addPoint(result['data'], true, false);
                                    }
                                );
                            }
                        }
                    }
                },
                title: {
                    text: '{{$collector->name}}加速度数据图',
                    style: {
                        fontSize: '13'
                    },
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
                    type: 'area',
                    name: seriesName,
                    data: [],/*(function () {
                                for(dataKey = 0 ; dataKey < length; dataKey++){
                                    data[dataKey][0] = data[dataKey][0]+16*60*60*1000;
                                }
                                return data;
                            }())*/
                }]
            });

        }

        function currentCharts(){
            myTime = $.myTime;
            time = new Date();
            curTime = myTime.CurTime();
            max = myTime.UnixToDate(curTime,true,8);
            startDateTime = myTime.UnixToDate(curTime-300,true,8);
            $('.startTime').val(startDateTime);
            highCharts(collectorId,startDateTime,max,name);
        }

    </script>
@endsection