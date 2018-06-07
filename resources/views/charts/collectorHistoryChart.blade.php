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
    <script src="{{ asset('highcharts/code/modules/boost.js') }}"></script>
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
                         <input type="text" class="demo-input startTime" style="height: 34px;padding-bottom: 5px;" placeholder="开始时间"  id="test2"  >
                        <input type="text" class="demo-input endTime" style="height: 34px;padding-bottom: 5px;" placeholder="截止时间" id="test1">
                        <select class="demo-input select2 method"  data-placeholder="Select a State"  style="width: 20%;">
                            <option  value="acc_peak">峰值加速度</option>
                            <option  value="ex_temp">温度</option>
                            <option  value="in_hum">湿度</option>
                        </select>
                        <select class="demo-input select2 collector"  data-placeholder="Select a State"  style="width: 20%;">
                            @foreach($collectors as $collectorInfo)
                            <option @if($collector->id == $collectorInfo->id) selected @endif value="{{$collectorInfo->id}}" >{{$collectorInfo->name}}</option>
                            @endforeach
                        </select>
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
                        <div id="fadeOut" class="highcharts-loading" style="position: absolute; background-color: white; opacity: 1; text-align: center; z-index: 10;   margin: auto;  top: 100px; left: 0;  right: 0;   width: 800px; height: 258px;">
                            <span class="highcharts-loading-inner" style="font-weight: bold; position: relative; top: 45%; color: gray;">Loading...</span></div>
                    </div>
                    <!-- /.box-body-->
                </div>
                <!-- /.box -->

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <script type="text/javascript">
        $('.select2').select2();

        var myTime ,time ,curTime ,max ,startDateTime ,collectorId ,startTime ,endTime ,method;
        collectorId = '{{$collector->id}}';
        name = '加速度';
        currentCharts();
        //执行一个laydate实例
        laydate.render({
            elem: '#test1' //指定元素
            ,type: 'datetime'
            ,value: max
            ,max : max
            ,done: function(value, date, endDate){
                startTime = $('.startTime').val();
                changeHighChart(startTime,value)

            }
        });

        laydate.render({
            elem: '#test2' //指定元素
            ,type: 'datetime'
            ,value: startDateTime
            ,max : max
            ,done: function(value, date, endDate){
                endTime = $('.endTime').val();
                changeHighChart(value,endTime)
                /*                var unixTime = myTime.DateToUnix(value);
                                var dateTime = myTime.UnixToDate(unixTime-300,true,8);
                                if(!value){
                                    dateTime = '';
                                }
                                $('.startTime').val(dateTime);*/
            }
        });
        Highcharts.setOptions({
            global: {
                useUTC: false
            }
        });

        $('.method').change(function(){
            startTime = $('.startTime').val();
            endTime = $('.endTime').val();
            changeHighChart(startTime,endTime)
        });

        $('.collector').change(function(){
            startTime = $('.startTime').val();
            endTime = $('.endTime').val();
            changeHighChart(startTime,endTime)
        });

        function currentCharts(){
            myTime = $.myTime;
            time = new Date();
            curTime = myTime.CurTime();
            max = myTime.UnixToDate(curTime,true,8);
            startDateTime = myTime.UnixToDate(curTime-300,true,8);
            changeHighChart(startDateTime,max);
        }

        function changeHighChart(startTime,endTime){
            $('#fadeOut').fadeIn();
            method = $('.method').val();
            methodName = $('.method option:selected').html();
            collectorId = $('.collector').val();
            name = $('.collector option:selected').html();
            $('#fadeOut').fadeOut(3000);
            highCharts(collectorId,startTime,endTime,method,methodName,name);
        }


        function countIntervalAndTimes(startTime,endTime){
            var differenceTime,times = 1,interval = 1,result=[];
            differenceTime = endTime-startTime;
            if(differenceTime <= 60*60){
                interval = Math.ceil(differenceTime/60);//分钟
            }else if(differenceTime > 60*60 && differenceTime <= 60*240){ //60-240分钟每次请求60分钟
                times = Math.ceil(differenceTime/(60*60));
                interval = 60;
            }else if(differenceTime > 60*240 && differenceTime <= 60*240*4){ //4-16小时每次请求4小时
                times = Math.ceil(differenceTime/(60*240));
                interval = 240;
            }else if(differenceTime > 60*240*4 && differenceTime <= 60*240*4*4){ //16-64小时每次请求16分钟
                times = Math.ceil(differenceTime/(60*240*4));
                interval = 240*4;
            }else if(differenceTime > 60*240*4*4){ //大于64小时每次请求64小时
                times = Math.ceil(differenceTime/(60*240*4*4));
                interval = 240*4*4;
            }
            console.log(times);
            result['interval'] = interval;
            result['times']    = times;
            return result;
        }

        function getUrlAndTimes(collectorId,endTime,method,interval){

            return 'https://www.suxiniot.com/console/influx/timeseries/period/'+method+'/'+collectorId+'?endTime='+(endTime+(new Date().getTimezoneOffset()*60))*1000 +'&period='+interval;
        }

        function highCharts(collectorId,startTime,endTime,method,methodName,name){
            title = '采集器'+name+'变化';
            yAxisTitle = name+'变化';
            seriesName = name;

            chart = Highcharts.chart('container', {
                title: {
                    text: name+methodName+'数据图',
                    style: {
                        fontSize: '13'
                    },
                },
                xAxis: {
                    title: {
                        text: '时间'
                    },
                    type: 'datetime',
                    tickPixelInterval: 150,
                    dateTimeLabelFormats: {
                        day: '%Y-%m-%d'
                    }
                },
                yAxis: {
                    title: {
                        text: methodName
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

                    name: seriesName,
                    data: (function () {
                        accs = [];
                        result = countIntervalAndTimes(myTime.DateToUnix(startTime),myTime.DateToUnix(endTime));
                        for(var i = 0 ; i < result['times']; i++){
                            $.ajax({
                                url:getUrlAndTimes(collectorId,myTime.DateToUnix(endTime)-i*result['interval']*60,method,result['interval']),
                                type:'GET',    //GET
                                async:false,    //或false,是否异步
                                timeout:5000,    //超时时间
                                dataType:'json',
                                success:function(data,textStatus,jqXHR){
                                    if(data['data']){
                                        accs = data['data'].concat(accs)
                                    }
                                }
                            })
                        }
                        var interval = new Date().getTimezoneOffset()*60*1000;
                        for(var i = 0 ; i < accs.length; i++){
                            timestamp = accs[i][0];
                            accs[i][0] = timestamp - interval;
                        };
                        return accs;
                    }())
                }]
            });
        }
    </script>
@endsection