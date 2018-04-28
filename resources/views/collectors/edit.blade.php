@extends('layouts.admin')

@section('content')
    <style type="text/css">
        body, html,#allmap {width: 100%;height: 100%;margin:0;font-family:"微软雅黑";}
        .anchorBL{display:none;}
    </style>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=14CImIkoVgUuvMoTPNaFjlCefawkU0LN "></script>
    <section class="content-header">
        <h1>
            <small>无线节点</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> 后台首页</a></li>
            <li class="active">{{$boxTitle}}</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-solid">
                    <form class="form-horizontal" >
                        <div class="box-header with-border">
                            <button type="submit"  class="btn btn-default pull-left btn-flat  sign"><i class="fa fa-fw fa-plus"></i>保存</button>
                            <a type="submit" href="{{route('collectors')}}" class="btn btn-default btn-flat" style="margin-left: 10px"><i class="fa fa-fw fa-history"></i>返回</a>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">名称</label>
                                <div class="col-sm-10">
                                    <input type="name" class="form-control" value="{{$collector->name??''}}" id="name" placeholder="名称" datatype="*" errormsg="请填写信息" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mac" class="col-sm-2 control-label">mac地址</label>
                                <div class="col-sm-10">
                                    <input type="mac" class="form-control" value="{{$collector->mac??''}}" id="mac" placeholder="00-23-5A-15-99-42-11-25"  datatype="*23-23" errormsg="请填写正确的mac地址" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="abbreviation" class="col-sm-2 control-label">公司</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2 company"  style="width: 100%;">
                                        @foreach($companies as $key => $company)
                                            <option @if(($collector->firm_id??'') == $company->id) selected @endif value="{{$company->id}}">{{$company->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group changeEquipment" @if(($collector->equipment_id??'') == '') style="display: none;"@endif>
                                <label for="abbreviation" class="col-sm-2 control-label">机械设备</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2 equipment"  style="width: 100%;">

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mac" class="col-sm-2 control-label">地图</label>
                                <div class="col-sm-10" style="height: 500px; width: 800px;margin-left: 20px;" id="allmap">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="{{asset('layer/layer.js')}}"></script>
    <script src="{{asset('vaildform/validform_min.js')}}"></script>
    <script>
        var province,city,lat,lng,id,collectorId,collectorLng,collectorLat;
        collectorId = '{{$collector->id??''}}';
        collectorLng = '{{$collector->longitude??''}}';
        collectorLat = '{{$collector->latitude??''}}';
        if(collectorId){
            id = collectorId;
        }
        var map = new BMap.Map("allmap");
        if(collectorLng != 0 || collectorLat != 0){
            var point = new BMap.Point(collectorLng,collectorLat);
            map.centerAndZoom(point,12);
            var marker = new BMap.Marker(point);// 创建标注
            map.addOverlay(marker);             // 将标注添加到地图中
        }else{
            var point = new BMap.Point(116.331398,49.897445);
            map.centerAndZoom(point,2);
        }
/*        var geolocation = new BMap.Geolocation();
        geolocation.getCurrentPosition(function(r){
            if(this.getStatus() == BMAP_STATUS_SUCCESS){
                //var mk = new BMap.Marker(r.point);
                //map.addOverlay(mk); //增加点
                map.panTo(r.point);
            }
            else {
                alert('failed'+this.getStatus());
            }
        },{enableHighAccuracy: true})*/

        function showInfo(e){
            map.clearOverlays();
            var marker = new BMap.Marker(e.point);// 创建标注
            map.addOverlay(marker);             // 将标注添加到地图中

            var gc = new BMap.Geocoder();//Geocoder地址编码
            gc.getLocation(e.point, function (rs) {   //getLocation函数用来解析地址信息，分别返回省市区街等 r.point里有经纬度
                var addComp = rs.addressComponents;
                province = addComp.province;//获取省份
                city = addComp.city;//获取城市
                lat = rs.point.lat;
                lng = rs.point.lng;
                var new_point = new BMap.Point(lng,lat);
                map.centerAndZoom(new_point,12);
                district = addComp.district;//区
                street = addComp.street;//街
            });
        }

        map.enableScrollWheelZoom(true);
        map.addEventListener("click", showInfo);


        $(".form-horizontal").Validform({
            btnSubmit: ".sign",
            tipSweep: true,
            tiptype: function (msg, o, cssctl) {
                if (o.type == 3) {//失败
                    layer.alert(msg);
                }
            },
            callback: function (data) {//异步回调函数
                var mac,name,companyId,equipmentId;
                mac = $('#mac').val();
                name = $('#name').val();
                companyId = $('.company').val();
                equipmentId = $('.equipment').val();
                producerId = '1';
                operatorId = '<?php echo Auth::user()->id;?>';
                var data = {
                    mac:mac,
                    name:name,
                    producerId: producerId,
                    firmId:companyId,
                    equipmentId:equipmentId,
                    operatorId:operatorId,
                    id:id,
                    latitude:lat,
                    longitude:lng,
                    cityName:city,
                    provinceName:province
                };
                var jsonData = JSON.stringify(data);
                $.ajax({
                    url:'/console/collector/saveOrUpdate',
                    type:'POST',    //GET
                    contentType: "application/json;charset=utf-8",
                    data:jsonData,
                    timeout:5000,    //超时时间
                    dataType:'json',
                    success:function(data){
                        if(data.info === 'success'){
                            window.location.href = '<?php echo route('collectors'); ?>'
                        }else if(data.info === 'macRepeat'){
                            layer.alert('mac地址重复');
                        }else{
                            layer.alert(data.info)
                        }
                    },
                    error:function(data){
//                        if(data.responseJSON.errors['mac']){
//                            layer.alert(data.responseJSON.errors['mac']['0'])
//                        }else if(data.responseJSON.errors['name']){
//                            layer.alert(data.responseJSON.errors['name']['0'])
//                        }else if(data.responseJSON.errors['companyId']){
//                            layer.alert(data.responseJSON.errors['companyId']['0'])
//                        }
                    }
                });
                return false;
            }
        });

        $('.company').on('change',function(){
            var value = $(this).val();
            $(".changeEquipment").show();
            changeEquipments(value,'');
        });

        if({{$collector->firm_id??0}}){
            changeEquipments({{$collector->firm_id??0}},{{$collector->equipment_id??0}});
        }

        function changeEquipments(companyId,equipmentId){
            $.ajax({
                url:'{{$getEquipmentUrl}}',
                type:'POST',
                data:{
                    companyId:companyId,equipmentId:equipmentId
                },
                timeout:5000,    //超时时间
                dataType:'json',
                success:function(data){
                    if(data.state == '0'){
                        $(".equipment").find("option").remove();
                        $(".equipment").append(data.text);
                    }
                },
                error:function(data){
                }
            });
        }



    </script>
@endsection