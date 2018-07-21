@extends('layouts.admin')

@section('content')

    <style type="text/css">
        html,body{
            margin:0;
            width:100%;
            height:100%;
            background:#333;
        }
        #map{
            width:100%;
            height:100%;
        }
        #panel {
            position: absolute;
            top:30px;
            left:10px;
            z-index: 999;
            color: #fff;
        }
        #login{
            position:absolute;
            width:300px;
            height:40px;
            left:50%;
            top:50%;
            margin:-40px 0 0 -150px;
        }
        #login input[type=password]{
            width:200px;
            height:30px;
            padding:3px;
            line-height:30px;
            border:1px solid #000;
        }
        #login input[type=submit]{
            width:80px;
            height:38px;
            display:inline-block;
            line-height:38px;
        }
        .anchorBL{
            display:none;
        }
        .inner h3{
            font-size:30px;
        }
    </style>

  <section class="content-header">
{{--    <h1 style="color: black;font-weight:bold;font-size:16px;">
      首页
    </h1>--}}

  </section>

  <section class="content">

    <div class="row">

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3 class="equipmentNum">{{$count['equipmentCountAll']??0}}</h3>
            <p style="font-size: 13px;">机械设备总数</p>
          </div>
          <div class="icon">
            <i class="ion ion-monitor"></i>
          </div>
          <a href="{{route('equipments')}}" class="small-box-footer">更多 <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3 class="equipmentOnlineNum">{{$count['equipmentCount']??0}}</h3>
            <p style="font-size: 13px;">机械设备在线数</p>
          </div>
          <div class="icon">
            <i class="ion ion-wifi"></i>
          </div>
          <a href="{{route('equipments')}}" class="small-box-footer">更多 <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h3 class="collectorNum">{{$count['collectorCountAll']??0}}</h3>
            <p style="font-size: 13px;">无线节点总数</p>
          </div>
          <div class="icon">
            <i class="ion ion-laptop"></i>
          </div>
          <a href="{{route('collectors')}}" class="small-box-footer">更多 <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-green">
          <div class="inner">
            <h3 class="collectorOnlineNum">{{$count['collectorCount']??0}}</h3>
            <p style="font-size: 13px;">无线节点在线数</p>
          </div>
          <div class="icon">
            <i class="ion ion-wifi"></i>
          </div>
          <a href="{{route('collectors')}}" class="small-box-footer">更多 <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

    </div>
    <div class="row">
      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3 class="allWarnTempNum">{{$count['alarmTempCountAll']??0}}</h3>
            <p style="font-size: 13px;">温度告警已处理数</p>
          </div>
          <div class="icon">
            <i class="ion ion-thermometer"></i>
          </div>
          <a href="{{route('recover')}}" class="small-box-footer">更多 <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3  class="unManageWarnTempNum">{{$count['alarmTempCount']??0}}</h3>
            <p style="font-size: 13px;">温度告警待处理数</p>
          </div>
          <div class="icon">
            <i class="ion ion-ios-gear-outline"></i>
          </div>
          <a href="{{route('alarms')}}" class="small-box-footer">更多 <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
          <div class="inner">
            <h3 class="allWarnShakeNum">{{$count['alarmBobCountAll']??0}}</h3>
            <p style="font-size: 13px;">振动告警已处理数</p>
          </div>
          <div class="icon">
            <i class="ion ion-speedometer"></i>
          </div>
          <a href="{{route('recover')}}" class="small-box-footer">更多 <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
          <div class="inner">
            <h3 class="unManageWarnShakeNum">{{$count['alarmBobCount']??0}}</h3>
            <p style="font-size: 13px;">振动告警待处理数</p>
          </div>
          <div class="icon">
            <i class="ion ion-ios-gear"></i>
          </div>
          <a href="{{route('alarms')}}" class="small-box-footer">更多 <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

    </div>

    <div class="row">

      <section class="col-lg-12 connectedSortable">

        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs pull-right">
{{--            <li class="pull-left header" style="width: 100%;font-size: 13px;line-height:25px;"><i class="fa fa-map-marker"></i> 地图</li>--}}
            <div id="map" style="height: 500px; width: 1012px; margin: 0 auto; background-color:#ecf0f5">
                {{--<img src="{{ asset('images/WordMap.gif') }}" style="width:100%;height:auto;">--}}
            </div>
          </ul>
        </div>

      </section>

    </div>

  </section>
    <script src="{{asset('js/echarts.min.js')}}"></script>
    <script src="{{asset('js/china.js')}}"></script>
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript">



        $.ajax({
            url:'{{route('api.home.getMapPoint')}}',
            type:'POST',    //GET
            async:true,    //或false,是否异步
            data:{
            },
            timeout:5000,    //超时时间
            dataType:'json',
            success:function(res,textStatus,jqXHR){
                var len ,geoCoordMap = [];
                len = res['data'].length;
                for(var i = 0; i < len; i++){
                    if(res['data'][i]['latitude'] != 0 || res['data'][i]['longitude'] != 0){
                        geoCoordMap[res['data'][i]['name']]= [res['data'][i]['longitude'],res['data'][i]['latitude']]
                    }
                }

                var myChart = echarts.init(document.getElementById('map'));

                var convertData = function (data) {

                    var res = [];
                    for(var name in geoCoordMap){
                        var geoCoord = geoCoordMap[name];
                        if (geoCoord) {
                            res.push({
                                name: name,
                                value: geoCoord.concat(12)
                            });
                        }
                    }
                    return res;
                };
                var option = {
                    /*                tooltip: {
                    //                    show: false //不显示提示标签
                                        formatter: '{b}', //提示标签格式
                                        backgroundColor:"#ff7f50",//提示标签背景颜色
                                        textStyle:{color:"#fff"} //提示标签字体颜色
                                    },*/
                    geo: {
                        map: 'china',
                        label: {
                            normal: {
                                show: false,//显示省份标签
                                textStyle:{color:"#c71585"}//省份标签字体颜色
                            },
                            emphasis: {//对应的鼠标悬浮效果
                                show: false,
                                textStyle:{color:"#800080"}
                            }
                        },
                        itemStyle: {
                            normal: {
                                borderWidth: .5,//区域边框宽度
                                borderColor: '#ffffff',//区域边框颜色
                                areaColor:"#3887d2",//区域颜色
                            },
                            emphasis: {
                                borderWidth: .5,
                                borderColor: '#ffffff',
                                areaColor:"#70b5ed",
                            }
                        },
                    },
                    series: [
                        {
                            name: 'pm2.5',
                            //type: 'scatter',
                            type: 'effectScatter',
                            coordinateSystem: 'geo',
                            data: convertData([

                            ]),
                            symbolSize: 7,
                            label: {
                                normal: {
                                    show: false
                                },
                                emphasis: {
                                    show: false
                                }
                            },

                            itemStyle: {

                                normal: {
                                    color: '#fad6a2',
                                    shadowBlur: 10,
                                    opacity: 1,

                                },

                            },
                            zlevel: 1
                        }
                    ]
                };

                myChart.setOption(option);
                myChart.on('mouseover', function (params) {
                    var dataIndex = params.dataIndex;
                    console.log(params);
                });

            }
        })




    </script>


@endsection
