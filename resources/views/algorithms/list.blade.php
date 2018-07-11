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
        <h1 style="color: black;font-weight:bold;font-size:16px;">
            算法数据展示
        </h1>
        <ol class="breadcrumbSuXin">
            <li><a href="{{route('admin')}}" style="color:#367fa9"><i class="fa fa-home"></i> 首页</a></li>
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
{{--                      <input type="text" class="demo-input startTime" style="height: 34px;padding-bottom: 5px;" placeholder="开始时间"  id="test2"  >
                      <input type="text" class="demo-input endTime" style="height: 34px;padding-bottom: 5px;" placeholder="截止时间" id="test1">--}}
                      <select class="demo-input select2 method"  data-placeholder="Select a State"  style="width: 20%;">
                          @foreach($algorithms as $name=>$algorithm)
                          <option  value="{{$name}}">{{$algorithm['name']}}</option>
                          @endforeach
                      </select>
                      <select class="demo-input select2 className"  data-placeholder="Select a State"  style="width: 20%;">

                      </select>
                  </div>
              </div>
          </div>
      </div>

      <div class="row">
          <div class="col-xs-12">
              <div class="box box-solid">
                      <div class="box-header with-border">
                          <h3 class="box-title" style="color: black;font-weight:bold;font-size:13px;">算法简介</h3>
                          <div class="box-tools pull-right">

                              <div class="btn-group changeButton"  data-toggle="btn-toggle">
                              </div>
                          </div>
                      </div>
                  <div class="box-body ">
                      &ensp;&ensp;&ensp;&ensp;<span class="infoName">对于给定的 N+1 个点，可以通过牛顿插值法求取经过这些点的N 次多项式。</span>
                  </div>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-xs-12">
              <!-- interactive chart -->
              <div class="box box-solid">
                  <div class="box-header with-border">
                      <h3 class="box-title" style="color: black;font-weight:bold;font-size:13px;">实例演示</h3>
                      <a  class="btn bg-light-blue btn-flat motion" style="margin-left: 10px;">
                          <i class="fa fa-fw fa-paper-plane"></i>
                          点击运行
                      </a>
                      <div class="box-tools pull-right">

                          <div class="btn-group changeButton"  data-toggle="btn-toggle">
                          </div>
                      </div>
                  </div>
                  <div class="box-header with-border">
                      <h3 class="box-title" style="color: black;font-weight:bold;font-size:13px;">输入数据：</h3>
                      <span class="inPutInfo">N+1个观测点</span>
                      <div class="box-tools pull-right">

                          <div class="btn-group changeButton"  data-toggle="btn-toggle">
                          </div>
                      </div>
                  </div>
                  <div class="box-body">
                      <div id="container" style="width: 800px;"></div>
                      {{--                        <div id="fadeOut" class="highcharts-loading" style="position: absolute; background-color: white; opacity: 1; text-align: center; z-index: 10;   margin: auto;  top: 100px; left: 0;  right: 0;   width: 800px; height: 258px;">
                                                  <span class="highcharts-loading-inner" style="font-weight: bold; position: relative; top: 45%; color: gray;">Loading...</span></div>--}}
                  </div>

                  <div class="box-header with-border" style="border-top: 1px solid #f4f4f4;">
                      <h3 class="box-title" style="color: black;font-weight:bold;font-size:13px;">输出数据：</h3>
                      <span class="outPutInfo">N次多项式</span>
                      <div class="box-tools pull-right">
                          <div class="btn-group changeButton"  data-toggle="btn-toggle">
                          </div>
                      </div>
                  </div>
                  <div class="box-body">
                      <div id="container1" style="width: 800px; margin: auto;"></div>
                  </div>
                  <!-- /.box-body-->
              </div>
              <!-- /.box -->

          </div>

      </div>
      <!-- /.row -->

  </section>
    <script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
  <script>
      $('.select2').select2();

      highChart = function(url,isPost){
          if(!isPost){
              highChartInputData([]);
              highChartOutputData([],[]);
              return false;
          }
          $.ajax({
              url:'{{route('algorithms.getData')}}',
              type:'GET',    //GET
              data:{
                  url:url
              },
              timeout:5000,    //超时时间
              dataType:'json',
              success:function(data){
                  highChartInputData(data.data.inputData);
                  highChartOutputData(data.data.outputData,data.data.inputData);
                  $('.inPutInfo').html(data.data.inputExplain);
                  $('.outPutInfo').html(data.data.outputExplain);

/*
                  high.series[0].data[1].select(true,true);
                  high.series[0].data[2].select(true,true);*/
                  return false;
              },
              error:function(data){
              }
          });
          highChartInputData(url);
      };

      function highChartInputData(inputData) {
          Highcharts.chart('container', {
              title: {
                  text: '包含趋势线的散点图'
              },
              credits: {
                  enabled: false //不显示LOGO
              },
              series: [ {
                  type: 'scatter',
                  name: '观测值',
                  data: inputData,
              }]
          });
      }

      function highChartOutputData(outputData,inputData) {
        var chart = Highcharts.chart('container1', {
              title: {
                  text: '包含趋势线的散点图'
              },
              credits: {
                  enabled: false //不显示LOGO
              },
              plotOptions: {
                  spline: {
                      lineWidth: 1,
                      states: {
                          hover: {
                              lineWidth: 1
                          }
                      },
                      marker: {
                          enabled: false
                      },
                  }
              },
              series: [ {
                  //type: 'scatter',
                  type:'line',
                  name: '观测值',
                  data: outputData,
              }]
          });

/*          inputData.forEach(function(value,index,array){
              console.log(value[0]);
              chart.series[0].data[5].select(true,true);
              chart.series[0].data[10].select(true,true);
          });*/
      }

      getOption = function(name){
          $.ajax({
              url:'{{$route}}',
              type:'POST',    //GET
              data:{
                  className:name,
              },
              timeout:5000,    //超时时间
              dataType:'json',
              success:function(data){
                  if(data.code == '0'){
                      $(".className").find("option").remove();
                      $(".className").append(data.info);
                      changeOptionAndText(name);

                  }
              },
              error:function(data){

              }
          });
      };

      var name = $(".method option:selected").val();
      getOption(name);

      $('.method').change(function(){
          var name = $(".method option:selected").val();
          getOption(name);
      });

      $('.className').change(function(){
          changeOptionAndText(name);
      });

      function changeOptionAndText(name){
          var option = $(".className option:selected");
          var className = option.val();
          $('.infoName').html(option.attr('info'));
          $('.inPutInfo').html(option.attr('inPutInfo'));
          $('.outPutInfo').html(option.attr('outPutInfo'));
          highChart(name+'/'+className,false);
      }

      $('.motion').click(function(){
          highChart($(".method option:selected").val()+'/'+$(".className option:selected").val(),true);
      })

  </script>
@endsection