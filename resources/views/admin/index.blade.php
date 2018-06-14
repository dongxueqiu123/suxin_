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
        .anchorBL{display:none;}
    </style>
    <script type="text/javascript" src="https://api.map.baidu.com/api?v=2.0&ak=14CImIkoVgUuvMoTPNaFjlCefawkU0LN "></script>
  <section class="content-header">
    <h1 style="color: black;font-weight:bold;font-size:16px;">
      首页
    </h1>

  </section>

  <section class="content">

    <div class="row">

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3 class="equipmentNum">0</h3>
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
            <h3 class="equipmentOnlineNum">0</h3>
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
            <h3 class="collectorNum">0</h3>
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
            <h3 class="collectorOnlineNum">0</h3>
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
            <h3 class="allWarnTempNum">0</h3>
            <p style="font-size: 13px;">温度告警总数</p>
          </div>
          <div class="icon">
            <i class="ion ion-thermometer"></i>
          </div>
          <a href="{{route('alarms')}}" class="small-box-footer">更多 <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3  class="unManageWarnTempNum">0</h3>
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
            <h3 class="allWarnShakeNum">0</h3>
            <p style="font-size: 13px;">振动告警总数</p>
          </div>
          <div class="icon">
            <i class="ion ion-speedometer"></i>
          </div>
          <a href="{{route('alarms')}}" class="small-box-footer">更多 <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-red">
          <div class="inner">
            <h3 class="unManageWarnShakeNum">0</h3>
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
            <li class="pull-left header" style="width: 100%;font-size: 13px;line-height:25px;"><i class="fa fa-map-marker"></i> 地图</li>
            <div id="map" style="height: 1080px; width: 1012px; margin: 0 auto;">
                {{--<img src="{{ asset('images/WordMap.gif') }}" style="width:100%;height:auto;">--}}
            </div>
          </ul>
        </div>

      </section>

    </div>

  </section>

    <script type="text/javascript">
        var companyId, url, allEquipmentUrl, onlineEquipmentUrl,
        allCollectorUrl, onlineCollectorUrl,allWarnTempNum,unManageWarnTempNum;
        companyId = '{{ $company->id??'1' }}';
        url = '/console';
        allEquipmentUrl = url+'/equipment/countAll?firmId='+companyId;
        $.getJSON(allEquipmentUrl, function(data) {
            if(data['code'] == 0){
               $('.equipmentNum').html(data['data']);
            }
        });

        onlineEquipmentUrl = url+'/equipment/count?firmId='+companyId+'&onlineFlag=1';
        $.getJSON(onlineEquipmentUrl, function(data) {
            if(data['code'] == 0){
                $('.equipmentOnlineNum').html(data['data']);
            }
        });

        allCollectorUrl = url+'/collector/count?firmId='+companyId;
        $.getJSON(allCollectorUrl, function(data) {
            if(data['code'] == 0){
                $('.collectorNum').html(data['data']);
            }
        });

        onlineCollectorUrl = url+'/collector/count?firmId='+companyId+'&onlineFlag=1';
        $.getJSON(onlineCollectorUrl, function(data) {
            if(data['code'] == 0){
                $('.collectorOnlineNum').html(data['data']);
            }
        });

        allWarnTempNum = url+'/alarm/count/1?firmId='+companyId;
        $.getJSON(allWarnTempNum, function(data) {
            if(data['code'] == 0){
                $('.allWarnTempNum').html(data['data']);
            }
        });


        unManageWarnTempNum = url+'/alarm/count/1?firmId='+companyId+'&status=0';
        $.getJSON(unManageWarnTempNum, function(data) {
            if(data['code'] == 0){
                $('.unManageWarnTempNum').html(data['data']);
            }
        });

        allWarnShakeNum = url+'/alarm/count/2?firmId='+companyId;
        $.getJSON(allWarnShakeNum, function(data) {
            if(data['code'] == 0){
                $('.allWarnShakeNum').html(data['data']);
            }
        });

        unManageWarnShakeNum = url+'/alarm/count/2?firmId='+companyId+'&status=0';
        $.getJSON(unManageWarnShakeNum, function(data) {
            if(data['code'] == 0){
                $('.unManageWarnShakeNum').html(data['data']);
            }
        });

        var map = new BMap.Map("map", {});                        // 创建Map实例
        map.centerAndZoom(new BMap.Point(-7.298437,15.892518), 1);     // 初始化地图,设置中心点坐标和地图级别         //启用滚轮放大缩小
        map.disableScrollWheelZoom();
        //map.disableDragging();
        if (document.createElement('canvas').getContext) {
            var  mapStyle ={
                features: ["road", "building","water","land"],//隐藏地图上的poi
                style : "dark"  //设置地图风格为高端黑
            }
            map.setMapStyle(mapStyle);

            var BW            = 0,    //canvas width
                BH            = 0,    //canvas height
                ctx           = null,
                stars         = [],   //存储所有星星对象的数组
                timer         = null, //定时器
                timeLine      = null, //时间轴对象
                rs            = [],   //最新的结果
                isNowTimeData = false, //是否显示当前时间的定位情况
                py            = null, //偏移
                gridWidth     = 10000,//网格的大小
                isOverlay     = false,//是否叠加
                //gridWidth   = 1,//网格的大小
                canvas        = null; //偏移

            function Star(options){
                this.init(options);
            }

            Star.prototype.init = function(options) {
                this.x   = ~~(options.x);
                this.y   = ~~(options.y);
                this.initSize(options.size);
                if (~~(0.5 + Math.random() * 7) == 1) {
                    this.size = 0;
                } else {
                    this.size = this.maxSize;
                }
            }

            Star.prototype.initSize = function(size) {
                var size = ~~(size);
                this.maxSize = size > 6 ? 6 : size;
            }

            Star.prototype.render = function(i) {
                var p = this;

                if(p.x < 0 || p.y <0 || p.x > BW || p.y > BH) {
                    return;
                }

                ctx.beginPath();
                var gradient = ctx.createRadialGradient(p.x, p.y, 0, p.x, p.y, p.size);
                gradient.addColorStop(0, "rgba(7,120,249,1)");
                gradient.addColorStop(1, "rgba(7,120,249,0.3)");
                ctx.fillStyle = gradient;
                ctx.arc(p.x, p.y, p.size, Math.PI*2, false);
                ctx.fill();
                if (~~(0.5 + Math.random() * 7) == 1) {
                    p.size = 0;
                } else {
                    p.size = p.maxSize;
                }
            }

            function render(){
                renderAction();
                setTimeout(render, 180);
            }

            function renderAction() {
                ctx.clearRect(0, 0, BW, BH);
                ctx.globalCompositeOperation = "lighter";
                for(var i = 0, len = stars.length; i < len; ++i){
                    if (stars[i]) {
                        stars[i].render(i);
                    }
                }
            }


            // 复杂的自定义覆盖物
            function ComplexCustomOverlay(point){
                this._point = point;
            }
            ComplexCustomOverlay.prototype = new BMap.Overlay();
            ComplexCustomOverlay.prototype.initialize = function(map){
                this._map = map;
                canvas = this.canvas = document.createElement("canvas");
                canvas.style.cssText = "position:absolute;left:0;top:0;";
                ctx = canvas.getContext("2d");
                var size = map.getSize();
                canvas.width = BW = size.width;
                canvas.height = BH = size.height;
                map.getPanes().labelPane.appendChild(canvas);
                //map.getContainer().appendChild(canvas);
                return this.canvas;
            }
            ComplexCustomOverlay.prototype.draw = function(){
                var map = this._map;
                var bounds = map.getBounds();
                var sw = bounds.getSouthWest();
                var ne = bounds.getNorthEast();
                var pixel = map.pointToOverlayPixel(new BMap.Point(sw.lng, ne.lat));
                py = pixel;
                if (rs.length > 0) {
                    showStars(rs);
                }
            }
            var myCompOverlay = new ComplexCustomOverlay(new BMap.Point(116.407845,39.914101));
            map.addOverlay(myCompOverlay);

            var project = map.getMapType().getProjection();
            var bounds = map.getBounds();
            var sw = bounds.getSouthWest();
            var ne = bounds.getNorthEast();
            sw = project.lngLatToPoint(new BMap.Point(sw.lng, sw.lat));
            ne = project.lngLatToPoint(new BMap.Point(ne.lng, ne.lat));

            //左上角墨卡托坐标点
            var original = {
                x : sw.x,
                y : ne.y
            }

            /**
             * 请求定位数据,并在地图上绘制出
             * @param 请求的时间
             * @param 成功后执行的回调函数
             *
             */
            var requestMgr = {
                request: function (time, successCbk) {
                    var url = '/console/collector/retrieveByFirmId';
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if( xhr.readyState == 4  && xhr.status == 200 ) {
                            var res ,len ,l,points =[];
                            res = JSON.parse(xhr.responseText);
                            len = res['data'].length;
                            l = 0;
                            for(var i = 0; i < len; i++){
                                if(res['data'][i]['latitude'] != 0 || res['data'][i]['longitude'] != 0){
                                    points[l++] = [res['data'][i]['longitude'],res['data'][i]['latitude'],8]
                                }
                            }
                            if (!isOverlay) {
                                rs = points;
                            } else {
                                rs = rs.concat(points);
                                if (rs.length > 10000) {
                                    rs.splice(0, rs.length - 10000);
                                }
                            }
                            showStars(rs);
                            if (successCbk) {
                                successCbk();
                            }
                        }
                    }
                    xhr.open( "GET", url, true );
                    xhr.send( null );
                }
            }

            //显示星星
            function showStars(rs) {
                stars.length = 0;
                var temp = {};
                for (var i = 0, len = rs.length; i < len; i++) {
                    var baiduXY=new BMap.Point(rs[i][0],rs[i][1])
                    var projection2 = map.getMapType().getProjection();
                    var mocaXY = projection2.lngLatToPoint(baiduXY);


                    var item = rs[i];
                    var addNum = gridWidth / 2;
                    var x = item[0] * gridWidth + addNum;
                    var y = item[1] * gridWidth + addNum;
                    x=mocaXY.x;
                    y=mocaXY.y;
                    var point = project.pointToLngLat(new BMap.Pixel(x, y));
                    var px = map.pointToOverlayPixel(point);
                    //create all stars
                    var s = new Star({
                        x: px.x - py.x,
                        y: px.y - py.y,
                        size: item[2]
                    });
                    stars.push(s);
                    //}
                }
                canvas.style.left = py.x + "px";
                canvas.style.top = py.y + "px";
                renderAction();
            }

            render();

            function nowTimeCbk (time) {
                requestMgr.request(time, function(){
                    if (isNowTimeData) {
                        setTimeout(function(){
                            if (isNowTimeData) {
                                startCbk(nowTimeCbk);
                            }
                        }, 1000);
                    }
                });
            }
            function startCbk(cbk){
                var now = new Date();
                var time = {
                    hour   : now.getHours(),
                    minute : now.getMinutes(),
                    second : now.getSeconds()
                };
                if (cbk) {
                    cbk(time);
                }
            };
            startCbk(nowTimeCbk);
        } else {
            alert('请在chrome、safari、IE8+以上浏览器查看');
        }
    </script>

@endsection
