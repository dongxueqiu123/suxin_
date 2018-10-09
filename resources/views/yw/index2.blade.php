<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="renderer" content="webkit">
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
<script type="text/javascript" src="{{ asset('yw/js/rem.js') }}"></script>
<link rel="stylesheet" href="{{ asset('yw/css/style2.css?v=2') }}">
<title>亚威智云工业互联网平台</title>
<style>
    .nav {height:5%;line-height:5%;width:100%;background:#121d2c;}
    .nav ul {height:73%;line-height:100%;width:800px;margin:0 auto;}
    .nav ul li {height:100%;line-height:100%;width:200px;display:inline-block; float:left;font-size:14px;font-weight:bold;text-align:center;}
    .nav ul li:hover {background:#2096e8;}
    .nav ul li.selected {background:#2096e8;}
    .nav ul li a {display:inline-block;width:100%;padding-top: 0.08rem;color:#ccdafd;text-decoration:none;}
</style>
</head>
<body style="visibility: hidden;">
<div class="nav">
    <ul>
        <li><a href="<?php echo url('/').'/'.app()->getLocale().'/ywIndex' ?>">首页</a></li>
		<li class="selected"><a href="<?php echo url('/').'/'.app()->getLocale().'/ywAlgorithm' ?>">机器学习</a></li>
        <li><a href="<?php echo url('/').'/'.app()->getLocale().'/ywMalfunction' ?>">设备管理</a></li>
        <li><a href="#">系统管理</a></li>
    </ul>
</div>
<div class="container-flex1" tabindex="0" hidefocus="true">
    <div class="box-left" style="visibility: hidden;">
        <div class="left-top-first"></div>
    </div>
    <div class="box-center">
        <div class="center-top">
            <h1>亚威智云工业互联网平台</h1>
        </div>
    </div>
    <div class="box-right">
        <div class="right-top-first"></div>
    </div>
</div>
<div class="container-flex3" tabindex="0" hidefocus="true">
    <div class="box-left-flex3">

		<div class="left">
			<div style="height: 100%">
				<div class="title-box">
					<h6 >传动结构预测模型</h6>
				</div>
				<div style="margin: auto;">

					<li style="margin: auto;color: #ffffff;text-align: center;padding-top: 0.1rem;height: 140px;width: 50%;float:left;">
						<div id="pie" style="width:100%; height: 140px;">
						</div>
					</li>
					<div style="width: 15%;float: left;">
						<li style="margin: auto;color: #ffffff;text-align: right;font-size: 12px;padding-top: 0.75rem">
							<span style="color: #1f96e8;">PMES</span>
						</li>
						<li style="margin: auto;color: #ffffff;text-align: right;font-size: 12px;padding-top: 0.1rem">
							<span style="color: #1f96e8;width: 50%;">Pearson</span>
						</li>
						<li style="margin: auto;color: #ffffff;text-align: right;font-size: 12px;padding-top: 0.1rem">
							<span style="color: #1f96e8;width: 50%;">Validation</span>
						</li>
					</div>
					<div style="width: 35%;float: left;">
						<li style="margin: auto;color: #ffffff;text-align: left;font-size: 12px;padding-top: 0.75rem;margin-left: 0.1rem" id="moxing1">
							0.13
						</li>
						<li style="margin: auto;color: #ffffff;text-align: left;font-size: 12px;padding-top: 0.1rem;margin-left: 0.1rem" id="moxing2">
							0.50
						</li>
						<li style="margin: auto;color: #ffffff;text-align: left;font-size: 12px;padding-top: 0.1rem;margin-left: 0.1rem">
							10,348
						</li>
					</div>
				</div>
			</div>
		</div>
		<div class="center">
			<div style="height: 100%">
				<div class="title-box">
					<h6>动力结构预测模型</h6>
				</div>
				<div style="margin: auto;">

					<li style="margin: auto;color: #ffffff;text-align: center;padding-top: 0.1rem;height: 140px;width: 50%;float:left;">
						<div id="pie1" style="width:100%; height: 140px;">
						</div>
					</li>
					<div style="width: 15%;float: left;">
						<li style="margin: auto;color: #ffffff;text-align: right;font-size: 12px;padding-top: 0.75rem">
							<span style="color: #1f96e8;">PMES</span>
						</li>
						<li style="margin: auto;color: #ffffff;text-align: right;font-size: 12px;padding-top: 0.1rem">
							<span style="color: #1f96e8;width: 50%;">Pearson</span>
						</li>
						<li style="margin: auto;color: #ffffff;text-align: right;font-size: 12px;padding-top: 0.1rem">
							<span style="color: #1f96e8;width: 50%;">Validation</span>
						</li>
					</div>
					<div style="width: 35%;float: left;">
						<li style="margin: auto;color: #ffffff;text-align: left;font-size: 12px;padding-top: 0.75rem;margin-left: 0.1rem" id="moxing1">
							0.15
						</li>
						<li style="margin: auto;color: #ffffff;text-align: left;font-size: 12px;padding-top: 0.1rem;margin-left: 0.1rem" id="moxing2">
							0.53
						</li>
						<li style="margin: auto;color: #ffffff;text-align: left;font-size: 12px;padding-top: 0.1rem;margin-left: 0.1rem">
							11,241
						</li>
					</div>
				</div>
			</div>
		</div>
		<div class="right">
			<div style="height: 100%">
				<div class="title-box">
					<h6 >支撑结构预测模型</h6>
				</div>
				<div style="margin: auto;">

					<li style="margin: auto;color: #ffffff;text-align: center;padding-top: 0.1rem;height: 140px;width: 50%;float:left;">
						<div id="pie2" style="width:100%; height: 140px;">
						</div>
					</li>
					<div style="width: 15%;float: left;">
						<li style="margin: auto;color: #ffffff;text-align: right;font-size: 12px;padding-top: 0.75rem">
							<span style="color: #1f96e8;">PMES</span>
						</li>
						<li style="margin: auto;color: #ffffff;text-align: right;font-size: 12px;padding-top: 0.1rem">
							<span style="color: #1f96e8;width: 50%;">Pearson</span>
						</li>
						<li style="margin: auto;color: #ffffff;text-align: right;font-size: 12px;padding-top: 0.1rem">
							<span style="color: #1f96e8;width: 50%;">Validation</span>
						</li>
					</div>
					<div style="width: 35%;float: left;">
						<li style="margin: auto;color: #ffffff;text-align: left;font-size: 12px;padding-top: 0.75rem;margin-left: 0.1rem" id="moxing1">
							0.27
						</li>
						<li style="margin: auto;color: #ffffff;text-align: left;font-size: 12px;padding-top: 0.1rem;margin-left: 0.1rem" id="moxing2">
							0.73
						</li>
						<li style="margin: auto;color: #ffffff;text-align: left;font-size: 12px;padding-top: 0.1rem;margin-left: 0.1rem">
							9,321
						</li>
					</div>
				</div>
			</div>
		</div>


    </div>
</div>

<div class="line-box"></div>
<div class="container-flex2" tabindex="0" hidefocus="true">
	<div class="box-2-1"></div>
	<div class="box-2-2"></div>
	<div class="box-2-3"></div>
	<div class="box-2-4"></div>
</div>
<div class="container-flex4 clearfix" tabindex="0" hidefocus="true">

	<div class="box-4-1">
        <div style="width: 50%;float: left">
		<h2 style="width:94%">数据信号</h2>
		<div class="date-list">
			<div class="date-list-z">
				<ul>
					<li><a href="">高频振动</a></li>
					<li><a href="">使用率</a></li>
					<li><a href="">维保历史</a></li>
					<li><a href="">机器特征</a></li>
					<li><a href="">幅度代码</a></li>
					<li><a href="">清洁记录</a></li>
				</ul>
			</div>
			<div class="date-list-y"></div>

		</div>
		</div>
		<h2 style="width: 48%;margin-left: 50%">设备图片</h2>
		<div class="date-list">
			<div class="date-list-z1">
                 <img src="{{asset('yw/images/jc.png')}}" style="width: 100%">
			</div>
			<div style="width: 45%" class="box-4-4">
				<table>
					<tr >
						<th>主要部件</th>
						<th>特征</th>
					</tr>
					<tr>
						<td><a href="">滑块</a></td>
						<td>动力结构</td>

					</tr>
					<tr>
						<td>补偿缸</td>
						<td>支撑结构</td>

					</tr>
					<tr>
						<td>丝杆</td>
						<td>传动结构</td>

					</tr>

				</table>
			</div>
			<div class="date-list-y"></div>

		</div>

		<h2>平均振动（实时）</h2>
		<div class="echarts-box">
			<div id="gdMap" class="gd-map"></div>
		</div>
	</div>
	<div class="box-4-2">
		<h2>高概率故障样本</h2>
		<table>
			<tr >
				<th>特征</th>
				<th>值</th>
				<th>记录值</th>
				<th>故障概率</th>
			</tr>
			<tr>
				<td><a href="">平均循环（上周）</a></td>
				<td>377 - 404</td>
				<td>1,970</td>
				<td>0.2%</td>
			</tr>
			<tr>
				<td><a href="">一 优先代码级 0-2（上个月）</a></td>
				<td>3 - 4</td>
				<td>208</td>
				<td>0.5%</td>
			</tr>
			<tr>
				<td><a href="">一一 传动结构 </a></td>
				<td>Twist Flange</td>
				<td>223</td>
				<td id="test1">0.2%</td>
			</tr>

		</table>
		<table>
			<tr>
				<th>特征</th>
				<th>值</th>
				<th>记录值</th>
				<th>故障概率</th>
			</tr>
			<tr>
				<td><a href="">平均循环（上周）</a></td>
				<td>377 - 404</td>
				<td>1,970</td>
				<td>0.12%</td>
			</tr>
			<tr>
				<td><a href="">一 优先代码级 0-2（上个月）</a></td>
				<td>1 - 3</td>
				<td>307</td>
				<td >0.22%</td>
			</tr>
			<tr>
				<td><a href="">一一 动力结构</a></td>
				<td>Twist Flange</td>
				<td>296</td>
				<td id="test2">0.2%</td>
			</tr>

		</table>
		<table>
			<tr>
				<th>特征</th>
				<th>值</th>
				<th>记录值</th>
				<th>故障概率</th>
			</tr>
			<tr>
				<td><a href="">平均循环（上周）</a></td>
				<td>377 - 404</td>
				<td>1,970</td>
				<td>0.21%</td>
			</tr>
			<tr>
				<td><a href="">一 先代码级 0-2（上个月)</a></td>
				<td>1 - 3</td>
				<td>307</td>
				<td>0.12%</td>
			</tr>
			<tr>
				<td><a href="">一一 支撑结构</a></td>
				<td>Twist Flange</td>
				<td>307</td>
				<td id="test3">0.22%</td>
			</tr>
		</table>
	</div>
</div>
</body>
<script type="text/javascript" src="{{ asset('yw/js/jquery-3.3.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('yw/js/layer/layer.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('yw/js/layer/laydate/laydate.js') }}"></script>
<script type="text/javascript" src="{{ asset('yw/js/echarts.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('yw/js/china.js') }}"></script>
<script type="text/javascript" src="{{ asset('yw/js/echarts.js') }}"></script>
<script type="text/javascript">
    $('document').ready(function () {
        var h = $(window).height();
        $("body").css({'visibility':'visible','height':h,'overflow':'hidden'});
    })
</script>
<script type="text/javascript">
    // 基于准备好的dom，初始化echarts实例
    var myChart;

    var data = [];
    getAcc(9,false);

    require(
        [
            'echarts',
        ],
        function (ec) {
            // 基于准备好的dom，初始化echarts图表
            myChart = echarts.init(document.getElementById('gdMap'));
            option = {
                title: {
                    text: '振动/时间',
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
                    data: ['平均振动'],
                    right: "1%",
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
                        type: 'time',
                        boundaryGap: false,
                        axisLabel: {
                            color: '#cce0ff'
                        },
                        axisLine: {
                            lineStyle: {
                                color: '#1d4a6e'
                            }
                        },
                        splitLine: {
                            show: false,
                            lineStyle: {
                                color: '#1d4a6e'
                            }
                        }
                    }
                ],
                yAxis: [
                    {
                        type: 'value',
                        boundaryGap: [0, '100%'],
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

                    }
                ],
                series: [
                    {
                        name: '平均振动',
                        type: 'line',
                        showSymbol: false,
                        hoverAnimation: false,
                        itemStyle: {
                            normal: {
                                color: "#2096e8",
                                borderWidth: 2,
                            }
                        },
                        //data: [220, 182, 191, 234, 290, 330, 310]
                    }

                ]
            };

            // 使用刚指定的配置项和数据显示图表。
            myChart.setOption(option);
        }
    );


    setInterval(function () {

        getAcc(1,true);

        myChart.setOption({
            series: [{
                data: data
            }]
        });
    }, 4000);



    function getAcc(num,isShift){
        $.ajax({
            url:'{{route('api.algorithm.getAcc')}}',
            type:'POST',    //GET
            data:{
                num:num,
            },
            timeout:5000,    //超时时间
            dataType:'json',
            success:function(info){
                info.reverse()
                for (var i = 0; i < info.length; i++) {
                    console.log(i);
                    if(isShift){
                        data.shift();
                        $('#test1').html(info[i].test1+'%');
                        $('#test2').html(info[i].test2+'%');
                        $('#test3').html(info[i].test3+'%');
					}
                    data.push(randomData(info[i]));
                }
            },
            error:function(info){

            }
        });
    }

    function randomData(info) {
        return {
            name: info.second,
            value: [
                info.second,
                info.acc_peak
            ]
        }
    }
</script>

<script type="text/javascript">
    //柱状图
    var asd =document.getElementById('pie');
    var pieChart = echarts.init(asd);
    var labelTop = {//上层样式
        normal : {
            color :'#99ccff',
            label : {
                show : true,
                position : 'center',
                formatter : '{b}',
                textStyle: {
                    baseline : 'bottom',
                    fontSize:22
                }
            },
            labelLine : {
                show : false
            }
        }
    };
    var labelFromatter = {//环内样式
        normal : {//默认样式
            label : {//标签
                formatter : function (a,b,c){return 100 - c + '%'},
                // labelLine.length：30,  //线长，从外边缘起计算，可为负值
                textStyle: {//标签文本样式
                    color:'black',
                    align :'center',
                    baseline : 'top'//垂直对其方式
                }
            }
        },
    };
    var labelBottom = {//底层样式
        normal : {
            color: '#1f96e8',
            label : {
                show : true,
                position : 'center',
                fontSize:15
            },
            labelLine : {
                show : false
            }
        },
        emphasis: {//悬浮式样式
            color: 'rgba( 0,0,0,0)'
        }
    };
    var radius = [50,60];// 半径[内半径，外半径]

    var pieChartOption = {

        animation:false,
        tooltip : {         // 提示框. Can be overwrited by series or data
            trigger: 'axis',
            //show: true,   //default true
            showDelay: 0,
            hideDelay: 50,
            transitionDuration:0,
            borderRadius : 8,
            borderWidth: 2,
            padding: 10,    // [5, 10, 15, 20]
        },
        series : [
            {
                type : 'pie',
                center : ['50%', '50%'],//圆心坐标（div中的%比例）
                radius : radius,//半径
                x: '0%', // for funnel
                itemStyle : labelTop,//graphStyleA,//图形样式 // 当查到的数据不存在（并非为0），此属性隐藏

                data : [
                    {name:'', value:2,itemStyle : labelTop},
                    {name:'98.36%', value:98, itemStyle : labelBottom}
                ]
            }
        ]
    };
    pieChart.setOption(pieChartOption);
</script>

<script type="text/javascript">
    //柱状图
    var asd =document.getElementById('pie1');
    var pieChart = echarts.init(asd);
    var labelTop = {//上层样式
        normal : {
            color :'#99ccff',
            label : {
                show : true,
                position : 'center',
                formatter : '{b}',
                textStyle: {
                    baseline : 'bottom',
                    fontSize:22
                }
            },
            labelLine : {
                show : false
            }
        }
    };
    var labelFromatter = {//环内样式
        normal : {//默认样式
            label : {//标签
                formatter : function (a,b,c){return 100 - c + '%'},
                // labelLine.length：30,  //线长，从外边缘起计算，可为负值
                textStyle: {//标签文本样式
                    color:'black',
                    align :'center',
                    baseline : 'top'//垂直对其方式
                }
            }
        },
    };
    var labelBottom = {//底层样式
        normal : {
            color: '#1f96e8',
            label : {
                show : true,
                position : 'center',
                fontSize:22
            },
            labelLine : {
                show : false
            }
        },
        emphasis: {//悬浮式样式
            color: 'rgba( 0,0,0,0)'
        }
    };
    var radius = [50,60];// 半径[内半径，外半径]

    var pieChartOption = {

        animation:false,
        tooltip : {         // 提示框. Can be overwrited by series or data
            trigger: 'axis',
            //show: true,   //default true
            showDelay: 0,
            hideDelay: 50,
            transitionDuration:0,
            borderRadius : 8,
            borderWidth: 2,
            padding: 10,    // [5, 10, 15, 20]
        },
        series : [
            {
                type : 'pie',
                center : ['50%', '50%'],//圆心坐标（div中的%比例）
                radius : radius,//半径
                x: '0%', // for funnel
                itemStyle : labelTop,//graphStyleA,//图形样式 // 当查到的数据不存在（并非为0），此属性隐藏

                data : [
                    {name:'', value:2,itemStyle : labelTop},
                    {name:'97.68%', value:98, itemStyle : labelBottom}
                ]
            }
        ]
    };
    pieChart.setOption(pieChartOption);
</script>
<script type="text/javascript">
    //柱状图
    var asd =document.getElementById('pie2');
    var pieChart = echarts.init(asd);
    var labelTop = {//上层样式
        normal : {
            color :'#99ccff',
            label : {
                show : true,
                position : 'center',
                formatter : '{b}',
                textStyle: {
                    baseline : 'bottom',
                    fontSize:22
                }
            },
            labelLine : {
                show : false
            }
        }
    };
    var labelFromatter = {//环内样式
        normal : {//默认样式
            label : {//标签
                formatter : function (a,b,c){return 100 - c + '%'},
                // labelLine.length：30,  //线长，从外边缘起计算，可为负值
                textStyle: {//标签文本样式
                    color:'black',
                    align :'center',
                    baseline : 'top'//垂直对其方式
                }
            }
        },
    };
    var labelBottom = {//底层样式
        normal : {
            color: '#1f96e8',
            label : {
                show : true,
                position : 'center',
                fontSize:22
            },
            labelLine : {
                show : false
            }
        },

        emphasis: {//悬浮式样式
            color: 'rgba( 0,0,0,0)'
        }
    };
    var radius = [50,60];// 半径[内半径，外半径]

    var pieChartOption = {

        animation:false,
        tooltip : {         // 提示框. Can be overwrited by series or data
            trigger: 'axis',
            //show: true,   //default true
            showDelay: 0,
            hideDelay: 50,
            transitionDuration:0,
            borderRadius : 8,
            borderWidth: 5,
            padding: 10,    // [5, 10, 15, 20]
        },
        series : [
            {
                type : 'pie',
                center : ['50%', '50%'],//圆心坐标（div中的%比例）
                radius : radius,//半径
                x: '0%', // for funnel
                itemStyle : labelTop,//graphStyleA,//图形样式 // 当查到的数据不存在（并非为0），此属性隐藏
                data : [
                    {name:'', value:2,itemStyle : labelTop},
                    {name:'92.92%', value:98, itemStyle : labelBottom}
                ]
            }
        ]
    };
    pieChart.setOption(pieChartOption);
</script>
</html>