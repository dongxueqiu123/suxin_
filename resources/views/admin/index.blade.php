@extends('layouts.admin')

@section('content')
    <style type="text/css">
        body, html,#allmap {width: 100%;height: 100%;margin:0;font-family:"微软雅黑";}
    </style>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=14CImIkoVgUuvMoTPNaFjlCefawkU0LN "></script>
  <section class="content-header">
    <h1>
      <small>首页</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> 首页</a></li>
    </ol>
  </section>

  <section class="content">

    <div class="row">

      <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3 class="equipmentNum">0</h3>
            <p>机械设备总数</p>
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
            <p>机械设备在线数</p>
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
            <p>采集设备总数</p>
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
            <p>采集设备在线数</p>
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
            <p >温度告警总数</p>
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
            <p>温度告警待处理数</p>
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
            <p>震动告警总数</p>
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
            <p>震动告警待处理数</p>
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
            <li class="pull-left header"><i class="fa fa-map-marker"></i> 地图</li>
            <div id="allmap" style="height: 500px;"></div>
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

        // 百度地图API功能
        var map = new BMap.Map("allmap");    // 创建Map实例
        map.centerAndZoom(new BMap.Point(118.78, 32.04), 11);  // 初始化地图,设置中心点坐标和地图级别
        //添加地图类型控件
        map.addControl(new BMap.MapTypeControl({
            mapTypes:[
                BMAP_NORMAL_MAP,
                BMAP_HYBRID_MAP
            ]}));
        map.setCurrentCity("南京");          // 设置地图显示的城市 此项是必须设置的
        map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
    </script>

@endsection
