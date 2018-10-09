<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">

    <script type="text/javascript" src="{{ asset('yw/js/rem.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('yw/css/style.css?v=1') }}">
    <title>亚威智云工业互联网平台</title>
    <link rel="stylesheet" href="{{ asset('yw/css/index.css') }}">
    <style>
        .nav {height:5%;line-height:5%;width:100%;background:#121d2c;}
        .nav ul {height:73%;line-height:100%;width:800px;margin:0 auto;}
        .nav ul li {height:100%;line-height:100%;width:200px;display:inline-block; float:left;font-size:14px;font-weight:bold;text-align:center;}
        .nav ul li:hover {background:#2096e8;}
        .nav ul li.selected {background:#2096e8;}
        .nav ul li a {display:inline-block;width:100%;padding-top: 0.08rem;color:#ccdafd;text-decoration:none;}
    </style>
    <script src="{{ asset('js/base.js?v=1') }}"></script>
</head>

<body style="visibility: hidden;">

<div class="nav">
    <ul>
        <li class="selected"><a href="#">首页</a></li>
        <li><a href="<?php echo url('/').'/'.app()->getLocale().'/ywAlgorithm' ?>">机器学习</a></li>
        <li><a href="<?php echo url('/').'/'.app()->getLocale().'/ywMalfunction' ?>">设备管理</a></li>
        <li><a href="#">系统管理</a></li>
    </ul>
</div>
    <div class="container-flex" tabindex="0" hidefocus="true">
        <div class="box-left">
            <div class="left-top">
                <div class="current-num">
                    <div>当前在线用户</div>
                    <p id="user">396</p>
                </div>
            </div>
            <div class="left-center">
                <div class="title-box">
                    <h6>设备种类</h6>
                </div>
                <div class="chart-box pie-chart">
                    <div id="pie"></div>
                    <div>
                        <div class="pie-data">

                        </div>
                    </div>
                </div>
            </div>
            <div class="left-bottom" class="select">
                <div class="title-box">
                    <h6>设备稼动率</h6>
                    <img class="line-img" src="{{ asset('images/line-blue.png') }}" alt="">
                    <button id="filBtn"><img src="{{ asset('yw/images/select_icon.png') }}" alt="">2018-09</button>
                </div>
                <div class="chart-box">
                    <div class="filter-con" id="filCon" data-type="1">

                        <div class="select" tabindex="0" hidefocus="true">
                            <div class="select-div">
                                2018-09
                            </div>
                            <ul class="select-ul">
                                <li class="active" data-value="">2018-09</li>
                                <li data-value="0">2018-08</li>
                                <li data-value="1">2018-07</li>
                            </ul>
                        </div>
                    </div>
                    <div id="gdMap" class="gd-map"></div>
                </div>
            </div>
        </div>
        <div class="box-center">
            <div class="center-top">
                <h1>亚威智云工业互联网平台</h1>
            </div>
            <div class="center-center">
                <div class="weather-box">
                    <div class="data">
                        <p class="time" id="time">00:00:00</p>
                        <p id="date"></p>
                    </div>
                    <div class="weather">
                        <img id="weatherImg" src="{{ asset('yw/images/weather/weather_img01.png')}}" alt="">
                        <div id="weather">
                            <p class="active">多云</p>
                            <p>13-22℃</p>
                            <p>南京市</p>
                        </div>
                    </div>
                </div>
             <!--   <img src="images/line_bg.png" alt="">-->
                <div class="select-box">
 <!--                   <ul id="barType">
                        <li class="active" data-value="1">派件</li>
                        <li data-value="2">寄件</li>
                    </ul>-->
                    <div data-type="2">
<!--                        <div class="select" tabindex="0" hidefocus="true">
                            <div class="select-div">
                                公司
                            </div>
                            <ul class="select-ul company">
                                <li class="active" data-value="">公司</li>
                                <li data-value="1">顺丰</li>
                                <li data-value="2">京东</li>
                                <li data-value="2">EMS</li>
                            </ul>
                        </div>-->
                        <!--<div class="select" tabindex="0" hidefocus="true">
                            <div class="select-div">
                                快件类型
                            </div>
                            <ul class="select-ul">
                                <li class="active" data-value="">快件类型</li>
                                <li data-value="0">文件</li>
                                <li data-value="1">物品</li>
                            </ul>
                        </div>-->
                    </div>
                </div>
            </div>
            <div class="center-bottom">
                <div class="chart-box-map">
                    <div id="chart4" style="width:100%;height:100%;"></div>
                </div>
                <div class="city-data">
             <!--       <div class="city-box">
                        <p id="titleQ"><span>全网</span>到珠海</p>
                        <ul class="city-btn" data-city="1">
                            <li class="active">全网</li>
                            <li>ABCDE</li>
                            <li>FGHIJ</li>
                            <li>KLMNO</li>
                            <li>PQRST</li>
                            <li>UVWXYZ</li>
                        </ul>
                        <ul class="city-div" id="city">

                        </ul>
                    </div>-->
                    <ul class="ranking-box1">
                        <li><span></span>
                            <p>城市</p>
                            <p>设备数量</p>
                        </li>
                        <li><span>1</span>
                            <p>江苏省</p>
                            <p>422</p>
                        </li>
                        <li><span>2</span>
                            <p>上海市</p>
                            <p>115</p>
                        </li>
                        <li><span>3</span>
                            <p>浙江省</p>
                            <p>108</p>
                        </li>
                        <li><span>4</span>
                            <p>山东省</p>
                            <p>102</p>
                        </li>
                        <li><span>5</span>
                            <p>安徽省</p>
                            <p>56</p>
                        </li>
                        <li><span>6</span>
                            <p>其他</p>
                            <p>243</p>
                        </li>
                        <!--                        <li><span>1</span><p>上海</p><p>1sss25(万件)</p></li>-->
                    </ul>

                    <ul class="ranking-box-right">
                        <li><span></span>
                            <p>行业</p>
                            <p>设备数量</p>
                        </li>
                        <li><span>1</span>
                            <p>金属制品业</p>
                            <p>739</p>
                        </li>
                        <li><span>2</span>
                            <p>通用设备制造业</p>
                            <p>105</p>
                        </li>
                        <li><span>3</span>
                            <p>汽车制造业</p>
                            <p>95</p>
                        </li>
                        <li><span>4</span>
                            <p>电子设备制造业</p>
                            <p>52</p>
                        </li>
                        <li><span>5</span>
                            <p>电气机械和器材制造</p>
                            <p>37</p>
                        </li>
                        <li><span>6</span>
                            <p>其他</p>
                            <p>28</p>
                        </li>
                        <!--                        <li><span>1</span><p>上海</p><p>1sss25(万件)</p></li>-->
                    </ul>
                </div>
            </div>
        </div>
        <div class="box-right">
            <div class="right-top">
                <div class="title-box">
                    <h6 id="barTitle">设备产能分析</h6>
                    <img class="line-img" src="images/line-blue.png" alt="">
                    <button data-state=1 id="tabBtn"><img src="images/chart_icon.png" alt=""><span>图表</span></button>
                </div>
<!--                <p class="unit">单位：件</p>-->
                <div class="chart-box">
                    <div id="chart3" style="width:100%;height:100%;"></div>
                </div>
                <div class="data-box" style="display:none;">
                    <table class="table1">
                        <tr>
                            <td colspan="3">通用设备制造</td>
                            <td class="table-data dph-data1">12</td>
                        </tr>
                        <tr class="bg-color">
                            <td colspan="3">汽车及零部件制造</td>
                            <td class="table-data dph-data2">12</td>
                        </tr>
                        <tr>
                            <td colspan="3">电气机械和器材制造</td>
                            <td class="table-data dph-data1">12</td>
                        </tr>
                        <tr>
                            <td  colspan="3">专用设备制造</td>
                            <td class="table-data dph-data1">23</td>
                        </tr>
                        <tr>
                            <td colspan>计算机</td>
                            <td class="table-data dph-data1">12</td>
                            <td >通信设备</td>
                            <td class="table-data dph-data1">2</td>
                        </tr>
                    </table>
                    <table class="table1" style="display:none;">
                        <tr>
                            <td>入库件</td>
                            <td colspan="3" class="table-data mail-data1">1</td>
                        </tr>
                        <tr class="bg-color">
                            <td rowspan="2">在库件</td>
                            <td rowspan="2" class="table-data mail-data2">1</td>
                            <td>正常件</td>
                            <td class="table-data mail-data7">1</td>
                        </tr>
                        <tr class="bg-color">
                            <td>滞留件</td>
                            <td class="table-data mail-data4">1</td>
                        </tr>

                        <tr>
                            <td>出库件</td>
                            <td colspan="3" class="mail-data6">1</td>
                        </tr>
                        <tr class="bg-color">
                            <td>丢失件</td>
                            <td colspan="3" class="mail-data3">1</td>
                        </tr>
                        <tr>
                            <td>撤销件</td>
                            <td colspan="3" class="table-data mail-data5">1</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="right-center">
                <div class="title-box">
                    <p id="switchBtn"><span class="active" data-dataType="income">实时通信报文数量</span></p>
                </div>
                <div class="data-box">
                    <p class="data-number" id="totalProfit">987,632</p>
                    <div class="time-box" id="timeBox">
                        <div class="time-div">
                            <input class="time-input" type="text" value="" id="startTime">
                            <img src="images/selsct_time.png" alt="">
                        </div>
                        <div class="time-div end">
                            <input class="time-input" type="text" value="" id="endTime">
                            <img src="images/selsct_time.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="right-bottom">
                <div class="title-box">
                    <p><span class="active" data-dataType="income">设备运行状况</span></p>
                </div>
                <div id="chart_1" style="width:95%;height:85%; float: left;"></div>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="pop-up">
            <span class="close-pop"></span>
            <h2 class="title">当前设备数</h2>
            <div class="pop-data-box">
                <p>982,456</p>
            </div>
        </div>

        <div class="pop-up">
            <span class="close-pop"></span>
            <h2 class="title">机床占比</h2>
            <div class="chart-box pie-chart">
                <div id="pie1"></div>
                <div>
                    <div class="pie-data">
                    </div>
                </div>
            </div>
        </div>

        <div class="pop-up">
            <span class="close-pop"></span>
            <h2 class="title">设备稼动率 </h2>
            <div class="filter-con pop-filter" style="display:flex" data-type="3">
                <div class="select" tabindex="0" hidefocus="true">
                    <div class="select-div">
                        派件
                    </div>
                    <ul class="select-ul">
                        <li class="active" data-value="1">派件</li>
                        <li data-value="2">寄件</li>
                    </ul>
                </div>
                <div class="select" tabindex="0" hidefocus="true">
                    <div class="select-div">
                        公司
                    </div>
                    <ul class="select-ul company">
                        <li class="active" data-value="">公司</li>
                        <li data-value="1">顺丰</li>
                        <li data-value="2">京东</li>
                        <li data-value="2">EMS</li>
                    </ul>
                </div>
                <div class="select" tabindex="0" hidefocus="true">
                    <div class="select-div">
                        快件类型
                    </div>
                    <ul class="select-ul">
                        <li class="active" data-value="">快件类型</li>
                        <li data-value="0">文件</li>
                        <li data-value="1">物品</li>
                    </ul>
                </div>
            </div>
            <div class="chart-box pop-chart">
                <div id="gdMaps" class="gd-map"></div>
            </div>
        </div>

        <div class="pop-up">
            <span class="close-pop"></span>
            <div class="filter-con pop-filters" style="display:flex" data-type="4">
                <div class="select-pop" tabindex="0" hidefocus="true">
                    <ul id="barTypes">
                        <li class="active" data-value="1">派件</li>
                       <!-- <li data-value="2">寄件</li>-->
                    </ul>
                </div>
                <div class="select" tabindex="0" hidefocus="true">
                    <div class="select-div">
                        公司
                    </div>
                    <ul class="select-ul company">
                        <li class="active" data-value="">公司</li>
                        <li data-value="1">顺丰</li>
                        <li data-value="2">京东</li>
                        <li data-value="2">EMS</li>
                    </ul>
                </div>
                <div class="select" tabindex="0" hidefocus="true">
                    <div class="select-div">
                        快件类型
                    </div>
                    <ul class="select-ul">
                        <li class="active" data-value="">快件类型</li>
                        <li data-value="0">文件</li>
                        <li data-value="1">物品</li>
                    </ul>
                </div>
            </div>
            <div class="cont-div">
                <div class="chart-box pop-charts">
                    <div id="chart4s" style="width:100%;height:95%;"></div>
                </div>
            </div>
            <div class="cont-div">
                <h2 class="title" id="barTitles">派件数据</h2>
                <button class="btn-class" data-state=1 id="tabBtns"><img src="images/chart_icon.png" alt=""><span>图表</span></button>
                <div class="chart-box pop-chart">
                    <div id="chart3s" style="width:100%;height:90%;"></div>
                </div>
                <div class="data-box" style="top:25%;width:8.6rem;display:none;">
                    <table class="table2">
                        <tr>
                            <td>入库件</td>
                            <td colspan="3" class="table-data dph-data1">0</td>
                        </tr>
                        <tr class="bg-color">
                            <td rowspan="2">在库件</td>
                            <td rowspan="2" class="table-data dph-data2">0</td>
                            <td>正常件</td>
                            <td class="table-data dph-data3">0</td>
                        </tr>
                        <tr class="bg-color">
                            <td>滞留件</td>
                            <td class="table-data dph-data5">0</td>
                        </tr>
                        <tr>
                            <td rowspan="2">出库件</td>
                            <td rowspan="2" class="dph-data6">0</td>
                            <td>派送件</td>
                            <td class="table-data dph-data7">0</td>
                        </tr>
                        <tr>
                            <td>自提件</td>
                            <td class="table-data dph-data8">0</td>
                        </tr>
                        <tr class="bg-color">
                            <td>退签件</td>
                            <td colspan="3" class="table-data dph-data9">0</td>
                        </tr>
                        <tr>
                            <td>丢失件</td>
                            <td colspan="3" class="table-data dph-data4">0</td>
                        </tr>
                    </table>
                    <table class="table2" style="display:none;">
                        <tr>
                            <td>入库件</td>
                            <td colspan="3" class="table-data mail-data1">0</td>
                        </tr>
                        <tr class="bg-color">
                            <td rowspan="2">在库件</td>
                            <td rowspan="2" class="table-data mail-data2">0</td>
                            <td>正常件</td>
                            <td class="table-data mail-data7">0</td>
                        </tr>
                        <tr class="bg-color">
                            <td>滞留件</td>
                            <td class="table-data mail-data4">0</td>
                        </tr>

                        <tr>
                            <td>出库件</td>
                            <td colspan="3" class="mail-data6">0</td>
                        </tr>
                        <tr class="bg-color">
                            <td>丢失件</td>
                            <td colspan="3" class="mail-data3">0</td>
                        </tr>
                        <tr>
                            <td>撤销件</td>
                            <td colspan="3" class="table-data mail-data5">0</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="cont-div">
                <h2 class="title" id="titles"></h2>
                <button class="btn-class" id="dateBtns"><img src="images/data_icon.png" alt="">日期</button>
                <div class="data-box  pop-time">
                    <div class="time-box" id="timeBoxs">
                        <div class="time-div">
                            <input class="time-input" type="text" value="" id="startTimes">
                            <img src="images/selsct_time.png" alt="">
                        </div>
                        <div class="time-div end">
                            <input class="time-input" type="text" value="" id="endTimes">
                            <img src="images/selsct_time.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="pop-data-box" id="totalProfits">
                    <p></p>
                </div>
            </div>
            <div class="pop-data">
                <div class="city-data">
                    <div class="city-box">
                        <p id="titleQs"><span>全网</span>到珠海</p>
                        <ul class="city-btn" data-city="2">
                            <li class="active">全网</li>
                            <li>ABCDE</li>
                            <li>FGHIJ</li>
                            <li>KLMNO</li>
                            <li>PQRST</li>
                            <li>UVWXYZ</li>
                        </ul>
                        <ul class="city-div" id="citys">

                        </ul>
                    </div>
                    <ul class="ranking-box">
                        <li><span></span>
                            <p>城市1</p>
                            <p>派件</p>
                        </li>
                        <!--                        <li><span>1</span><p>上海</p><p>1sss25(万件)</p></li>-->
                    </ul>

                </div>
            </div>
        </div>
        <div class="pop-up">
            <span class="close-pop"></span>
            <h2 class="title">设置</h2>

            <div class="set-div">
                <div class="set-box">
                    <label class="four-f" for="">排班日期</label>
                    <div class="time-div">
                        <input class="time-input" type="text" value="" id="times">
                        <img src="images/selsct_time.png" alt="">
                    </div>
                </div>
                <div class="set-box">
                    <label for="">值班人</label>
                    <input type="text" value="">
                    <button class="plus" id="addT"></button>
                    <button class="mineus" id="mineusT" style="display:none;"></button>
                </div>
                <div class="set-box">
                    <label for="">负责人</label>
                    <input type="text" value="">
                    <button class="plus" id="addL"></button>
                    <button class="mineus" id="mineusL" style="display:none;"></button>
                    <button class="add-btn" id="addSet"><img src="images/plus.png" alt="">添加</button>
                </div>
                <table class="table3">
                    <thead>
                        <tr>
                            <th>值班人</th>
                            <th>排班日期</th>
                            <th>负责人</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody id="tList">
<!--
                        <tr>
                            <td colspan="4">
                                <p style="width:9.6rem;">暂无数据</p>
                            </td>
                        </tr>
-->
                   <tr>
                       <td>1</td>
                       <td>1</td>
                       <td>1</td>
                       <td>1</td>
                   </tr>
                   <tr>
                       <td>1</td>
                       <td>1</td>
                       <td>1</td>
                       <td>1</td>
                   </tr>
                   <tr>
                       <td>1</td>
                       <td>1</td>
                       <td>1</td>
                       <td>1</td>
                   </tr>
                   <tr>
                       <td>1</td>
                       <td>1</td>
                       <td>1</td>
                       <td>1</td>
                   </tr>
                   <tr>
                       <td>1</td>
                       <td>1</td>
                       <td>1</td>
                       <td>1</td>
                   </tr>
                   <tr>
                       <td>1</td>
                       <td>1</td>
                       <td>1</td>
                       <td>1</td>
                   </tr>
                   <tr>
                       <td>1</td>
                       <td>1</td>
                       <td>1</td>
                       <td>1</td>
                   </tr>
                    </tbody>
                </table>
                <div class="pages-div" class="mineus">
                    <button class="prev"></button>
                    <p id="page"><span>0</span>/<span>0</span></p>
                    <button class="next"></button>
                    <input type="number">
                    <button class="skip">跳转</button>
                </div>
            </div>
            <div class="tishi">日期已存在!</div>
            <div class="edit-div" style="display:none;">
                <h4>编辑</h4>
                <span class="close-edit"></span>
                <div class="set-box">
                    <label for="">值班人</label>
                    <input class="input-edit" id="editT" type="text" value="">
                </div>
                <div class="set-box">
                    <label for="">负责人</label>
                    <input class="input-edit" id="editL" type="text" value="">
                </div>
                <div class="set-box edit-box">
                    <button id="qxEdit">取消</button>
                    <button id="qdEdit">确定</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="{{ asset('yw/js/jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('yw/js/layer/layer.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('yw/js/layer/laydate/laydate.js') }}"></script>
<script type="text/javascript" src="{{ asset('yw/js/echarts.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('yw/js/china.js') }}"></script>
<script type="text/javascript" src="{{ asset('yw/js/data/guangdong.js') }}"></script>
<script type="text/javascript" src="{{ asset('yw/js/base.js?v=3') }}"></script>
<script type="text/javascript" src="{{ asset('yw/js/echarts.js') }}"></script>
<script type="text/javascript">
    $('document').ready(function () {
        $("body").css('visibility', 'visible');
        var localData = [$('#teacher').val(), $('#start').val() + '/' + $('#end').val(), $('#leader').val()]
        localStorage.setItem("data", localData);
        $('#conBtn').on('click', function () {
            localData = [$('#teacher').val(), $('#start').val() + '/' + $('#end').val(), $('#leader').val()]
            if (typeof (Storage) !== "undefined") {
                localStorage.setItem("data", localData);
                var arr = localStorage.getItem("data").split(',');
                $('#name_a').html(arr[0]);
                $('#date_a').html(arr[1]);
                $('#lea_a').html(arr[2]);
            }
        })
        $('#fangda').on('click', function () {
            if ($(this).siblings('ul').is(":hidden")) {
                $(this).addClass('active').siblings('ul').show();
            } else {
                $(this).removeClass('active').siblings('ul').hide();
            }
        })

        $('.modal-btn>li').on('click', function () {
            var index = $(this).index();
            if (index <= 2) {
                $('.container').attr('style', 'visibility: visible').find('.pop-up').eq(index).attr('style', 'visibility: visible').siblings().attr('style', 'visibility: hidden');
            } else if (index > 2 && index < 5) {
                $('.container').attr('style', 'visibility: visible').find('.pop-up').eq(3).attr('style', 'visibility: visible').siblings().attr('style', 'visibility: hidden');
                if (index != 3) {
                    $('.pop-data .ranking-box').hide();
                } else {
                    $('.pop-data .ranking-box').show();
                }
                $('.cont-div').eq(index - 3).attr('style', 'visibility: visible').siblings('.cont-div').attr('style', 'visibility: hidden');
            } else if (index == 5) {
                $('.container').attr('style', 'visibility: visible').find('.pop-up').eq(3).attr('style', 'visibility: visible').siblings().attr('style', 'visibility: hidden');
                $('.pop-data .ranking-box').hide();
                if ($('#switchBtn').find('.active').data('datatype') == "income") {
                    $('#titles').html('收入数据');
                    $('#totalProfits').html('123,456.5元');
                    $('.cont-div').eq(2).attr('style', 'visibility: visible').siblings('.cont-div').attr('style', 'visibility: hidden');
                } else if ($('#switchBtn').find('.active').data('datatype') == 'expend') {
                    $('#titles').html('支出数据');
                    $('#totalProfits').html('32,111.4元');
                    $('.cont-div').eq(2).attr('style', 'visibility: visible').siblings('div').attr('style', 'visibility: hidden');
                }
            }
        })
    })
</script>
<script>
    var myChart = echarts.init(document.getElementById('chart4'));
    // 此版本通过设置geoindex && seriesIndex: [1] 属性来实现geo和map共存，来达到hover散点和区域显示tooltip的效果
    // 默认情况下，map series 会自己生成内部专用的 geo 组件。但是也可以用这个 geoIndex 指定一个 geo 组件。这样的话，map 和 其他 series（例如散点图）就可以共享一个 geo 组件了。并且，geo 组件的颜色也可以被这个 map series 控制，从而用 visualMap 来更改。
    // 当设定了 geoIndex 后，series-map.map 属性，以及 series-map.itemStyle 等样式配置不再起作用，而是采用 geo 中的相应属性。
    // http://echarts.baidu.com/option.html#series-map.geoIndex
    // 并且加了pin气泡图标以示数值大小

    //var name_title = "亚威测试地图"
    //var subname = '这是副标题，随便要不要的'
    var nameColor = "#fff"
    var name_fontFamily = '等线'
    var subname_fontSize = 15
    var name_fontSize = 18
    var mapName = 'china'
    var data = [
        {name:"江苏",value:422},
        {name:"浙江",value:115},
        {name:"湖南",value:108},
        {name:"河南",value:102},
        {name:"河北",value:56},
        {name:"湖北",value:53},

		{name:"福建",value:12},
		{name:"黑龙江",value:6},
		{name:"吉林",value: 12},
		{name:"辽宁",value:5},
		{name:"陕西",value:10},
		{name:"四川",value:12},
		{name:"山西",value:4},
		{name:"甘肃",value:6},
		{name:"青海",value:2},
		{name:"贵州",value:10},
		{name:"广西",value:15},
		{name:"广东",value:16},
		{name:"云南",value:10},
		{name:"江西",value:12}
    ];

    var geoCoordMap = {};
    var toolTipData = [
        {name:"江苏",value:[{name:"城市",value:"江苏"},{name:"设备数量",value:289}]},
        {name:"浙江",value:[{name:"城市",value:"浙江"},{name:"设备数量",value:231}]},
        {name:"湖南",value:[{name:"城市",value:"湖南"},{name:"设备数量",value:212}]},
        {name:"河南",value:[{name:"城市",value:"河南"},{name:"设备数量",value:117}]},
        {name:"河北",value:[{name:"城市",value:"河北"},{name:"设备数量",value:45}]},
        {name:"湖北",value:[{name:"城市",value:"湖北"},{name:"设备数量",value:40}]},

		{name:"福建",value:[{name:"城市",value:"福建"},{name:"设备数量",value:12}]},
		{name:"黑龙江",value:[{name:"城市",value:"黑龙江"},{name:"设备数量",value:6}]},
		{name:"吉林",value:[{name:"城市",value:"吉林"},{name:"设备数量",value:12}]},
		{name:"辽宁",value:[{name:"城市",value:"辽宁"},{name:"设备数量",value:5}]},
		{name:"陕西",value:[{name:"城市",value:"陕西"},{name:"设备数量",value:10}]},
		{name:"四川",value:[{name:"城市",value:"四川"},{name:"设备数量",value:12}]},
		{name:"山西",value:[{name:"城市",value:"山西"},{name:"设备数量",value:4}]},
		{name:"甘肃",value:[{name:"城市",value:"甘肃"},{name:"设备数量",value:6}]},
		{name:"青海",value:[{name:"城市",value:"青海"},{name:"设备数量",value:2}]},
		{name:"宁夏",value:[{name:"城市",value:"宁夏"},{name:"设备数量",value:2}]},
		{name:"贵州",value:[{name:"城市",value:"贵州"},{name:"设备数量",value:10}]},
		{name:"广西",value:[{name:"城市",value:"广西"},{name:"设备数量",value:15}]},
		{name:"广东",value:[{name:"城市",value:"广东"},{name:"设备数量",value:16}]},
		{name:"云南",value:[{name:"城市",value:"云南"},{name:"设备数量",value:10}]},
		{name:"江西",value:[{name:"城市",value:"江西"},{name:"设备数量",value:12}]}
    ];

    /*获取地图数据*/
    myChart.showLoading();
    var mapFeatures = echarts.getMap(mapName).geoJson.features;
    myChart.hideLoading();
    mapFeatures.forEach(function(v) {
        // 地区名称
        var name = v.properties.name;
        // 地区经纬度
        geoCoordMap[name] = v.properties.cp;
    });

    var max = 480,
        min = 9; // todo
    var maxSize4Pin = 100,
        minSize4Pin = 20;

    var convertData = function(data) {
        var res = [];
        for (var i = 0; i < data.length; i++) {
            var geoCoord = geoCoordMap[data[i].name];
            if (geoCoord) {
                res.push({
                    name: data[i].name,
                    value: geoCoord.concat(data[i].value),
                });
            }
        }
        console.log(res);
        return res;
    };
    option = {
        /**
         title: {
					text: name_title,
					subtext: subname,
					x: 'center',
					textStyle: {
						color: nameColor,
						fontFamily: name_fontFamily,
						fontSize: name_fontSize
					},
					subtextStyle:{
						fontSize:subname_fontSize,
						fontFamily:name_fontFamily
					}
				},
         **/
        tooltip: {
            trigger: 'item',
            formatter: function(params) {
                if (typeof(params.value)[2] == "undefined") {
                    var toolTiphtml = ''
                    for(var i = 0;i<toolTipData.length;i++){
                        if(params.name==toolTipData[i].name){
                            toolTiphtml += toolTipData[i].name+':<br>'
                            for(var j = 0;j<toolTipData[i].value.length;j++){
                                toolTiphtml+=toolTipData[i].value[j].name+':'+toolTipData[i].value[j].value+"<br>"
                            }
                        }
                    }
                    console.log(toolTiphtml)
                    return toolTiphtml;
                } else {
                    var toolTiphtml = ''
                    for(var i = 0;i<toolTipData.length;i++){
                        if(params.name==toolTipData[i].name){
                            toolTiphtml += toolTipData[i].name+':<br>'
                            for(var j = 0;j<toolTipData[i].value.length;j++){
                                toolTiphtml+=toolTipData[i].value[j].name+':'+toolTipData[i].value[j].value+"<br>"
                            }
                        }
                    }
                    console.log(toolTiphtml)
                    return toolTiphtml;
                }
            }
        },
        visualMap: {
            show: false,
            min: 0,
            max: 200,
            left: 'left',
            top: 'bottom',
            text: ['高', '低'], // 文本，默认为数值文本
            calculable: true,
            seriesIndex: [1],
            inRange: {
                // color: ['#3B5077', '#031525'] // 蓝黑
                //color: ['#ffc0cb', '#800080'] // 红紫
                // color: ['#3C3B3F', '#605C3C'] // 黑绿
                // color: ['#0f0c29', '#302b63', '#24243e'] // 黑紫黑
                //color: ['#23074d', '#cc5333'] // 紫红
                //color: ['#00467F', '#A5CC82'] // 蓝绿
                // color: ['#1488CC', '#2B32B2'] // 浅蓝
                color : ['#36bd96'] // 自定义
            }
        },
        geo: {
            show: true,
            roam: true,
            map: mapName,
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
                    areaColor: 'transparent',
                    borderColor: '#0e94eb',
                    shadowBlur: 10,
                    shadowColor: '#0e94ea'
                },
                emphasis: {
                    areaColor: 'transparent'
                }
            }
        },
        series: [
            {
                type: 'map',
                map: mapName,
                geoIndex: 0,
                aspectScale: 0.75, //长宽比
                showLegendSymbol: false, // 存在legend时显示
                label: {
                    normal: {
                        show: false
                    }
                },
                roam: false,
                itemStyle: {
                    normal: {
                        areaColor: '#031525',
                        borderColor: '#3B5077',
                    },
                    emphasis: {
                        areaColor: '#2B91B7'
                    }
                },
                animation: false,
                data: data
            },
            {
                name: '点',
                type: 'scatter',
                coordinateSystem: 'geo',
                symbol: 'pin', //气泡
                symbolSize: function(val) {
                    var a = (maxSize4Pin - minSize4Pin) / (max - min);
                    var b = minSize4Pin - a * min;
                    b = maxSize4Pin - a * max;
                    return a * val[2] + b;
                },
                label: {
                    normal: {
                        formatter: '{@[2]}',
                        show: true,
                        textStyle: {
                            color: '#fff',
                            fontSize: 9,
                        }
                    }
                },
                zlevel: 6,
                data: convertData(data),
            }
        ]
    };
    myChart.setOption(option);

	window.addEventListener('resize', function () {
        myChart.resize();
    });

</script>
<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart;
    var data1;
    var data2;
    // 指定图表的配置项和数据
    require(
        [
            'echarts',
        ],
        function (ec) {
            // 基于准备好的dom，初始化echarts图表
            myChart = echarts.init(document.getElementById('gdMap'));
            option = {
                title: {
                    text: '平台/区域',
                    textStyle: {
                        color: '#cce0ff',
                        fontSize: 12
                    },
                    top: '1',
                    left: '10'

                },
                tooltip: {
                    trigger: 'axis',
                    axisPointer: {
                        type: 'cross',
                        label: {
                            backgroundColor: '#6a7985'
                        }
                    }
                },
                legend: {
                    data: ['平台平均', '江苏平均'],
                    right: "10%",
                    textStyle: {
                        color: '#cce0ff'
                    }
                },
                toolbox: {},
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis: [
                    {
                        type: 'category',
                        boundaryGap: false,
                        data: ['01', '05', '10', '15', '20', '25', '30'],
                        axisLabel: {
                            color: '#cce0ff'
                        },
                        axisLine: {
                            lineStyle: {
                                color: '#1d4a6e'
                            }
                        },
                        splitLine: {
                            lineStyle: {
                                color: '#1d4a6e'
                            }
                        }
                    }
                ],
                yAxis: [
                    {
                        type: 'value',
                        axisLabel: {
                            color: '#cce0ff'
                        },
                        axisLine: {
                            lineStyle: {
                                color: '#1d4a6e'
                            }
                        },
                        splitLine: {
                            lineStyle: {
                                color: '#1d4a6e'
                            }
                        },
                        min:0,
                        max:100,
                        interval:20
                    }
                ],
                series: [
					{
                        name: '江苏平均',
                        type: 'line',
                        itemStyle: {
                            normal: {
                                color: "#36bd96",
                                borderWidth: 2,
                            }
                        },
                        data: [51, 52, 49, 52, 50, 48, 50]
                    },
                    {
                        name: '平台平均',
                        type: 'line',
                        itemStyle: {
                            normal: {
                                color: "#2096e8",
                                borderWidth: 2,
                            }
                        },
                        data: [35, 34, 36, 35, 34, 33, 36]
                    }
                ]
            };

            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);
        }
    );
    window.setInterval(function () {
		data1 = getRandomArr(50,65);
        data2 = getRandomArr(30,55);
        refreshData(data1,data2);
    }, 300000);
    function randomFn(min,max){
        return Math.floor(Math.random()*(max-min))+min;
    }
    function getRandomArr(max,min){
        var arr = [];
        while(arr.length<7){
            var aa = randomFn(min,max);
            var onOff = true;
            for(var i=0;i<arr.length;i++){
                if (arr[i]==aa){
                    onOff =false;
                    break;
                }else{
                    onOff = true;
                }
            }
            if (onOff) {
                arr.push(aa);
            }
        }

        return arr;
    }
    function refreshData(data1,data2) {
        if (!myChart) {

            return;
        }

        //更新数据
        var option = myChart.getOption();
        option.series[0].data = data1;

        option.series[1].data = data2;
        myChart.setOption(option);
    }
</script>
<script type="text/javascript">
    var price,random,totalPrice;
    setInterval("showLogin()","5000");
    function showLogin()
    {
        price = $('#totalProfit').html();
        random = Math.random()*5;
        totalPrice = parseInt(price.replace(/,/g,''))+parseInt(random);
        $('#totalProfit').html(format_number(totalPrice));
    }

    setInterval("showUsers()","600000");
    function showUsers()
    {
        price = $('#user').html();
        random = RandomNumBoth(-10,10);
        totalPrice = parseInt(price.replace(/,/g,''))+parseInt(random);
        $('#user').html(format_number(totalPrice));
    }
    function RandomNumBoth(Min,Max){
        var Range = Max - Min;
        var Rand = Math.random();
        var num = Min + Math.round(Rand * Range); //四舍五入
        return num;
    }
    function format_number(n){
        var b=parseInt(n).toString();
        var len=b.length;
        if(len<=3){return b;}
        var r=len%3;
        return r>0?b.slice(0,r)+","+b.slice(r,len).match(/\d{3}/g).join(","):b.slice(r,len).match(/\d{3}/g).join(",");
    }

</script>
</html>