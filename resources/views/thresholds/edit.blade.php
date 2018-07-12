@extends('layouts.admin')

@section('content')
  <section class="content-header">
    <h1 style="color: black;font-weight:bold;font-size:16px;">
      添加告警
    </h1>
    <ol class="breadcrumbSuXin">
      <li><a href="{{route('admin')}}" style="color:#367fa9"><i class="fa fa-dashboard"></i> 首页</a></li>
      <li class="active">{{$boxTitle}}</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-xs-12">

          <!-- /.box-header -->
          <div class="box box-solid">
              <form class="form-horizontal" >
            <div class="box-header with-border">
                <div class="box-footer">
                    <button type="submit"  class="btn btn-default pull-left btn-flat  sign"><i class="fa fa-fw fa-plus"></i>保存</button>
                    <a type="submit" href="{{route('thresholds')}}" class="btn btn-default btn-flat" style="margin-left: 10px"><i class="fa fa-fw fa-history"></i>返回</a>
                </div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
              <div class="box-body">

                  <div class="form-group">
                      <label for="name" class="col-sm-2 control-label">公司</label>
                      <div class="col-sm-5">
                          <select class="form-control select2 company"  style="width: 100%;">
                              @foreach($companies??[] as $key => $company)
                                  <option @if(($company['id']??'') == ($threshold['firmId']??'')) selected @endif value="{{$company['id']}}">{{$company['name']}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="form-group changeEquipment">
                      <label for="name" class="col-sm-2 control-label">机械设备</label>
                      <div class="col-sm-5">
                          <select class="form-control select2 equipment"  style="width: 100%;">

                          </select>
                      </div>
                  </div>

                  <div class="form-group changeCollector">
                      <label for="name" class="col-sm-2 control-label">无线节点</label>
                      <div class="col-sm-5">
                          <select class="form-control select2 collector"  style="width: 100%;">

                          </select>
                      </div>
                  </div>
                  <div class="form-group " >
                      <label for="abbreviation" class="col-sm-2 control-label">分类</label>
                      <div class="col-sm-5">
                          <select class="form-control select2 category"  style="width: 100%;">
                              @foreach($categories??[] as $key =>$category)
                                  <option @if(($threshold['category']??'') == $key) selected @endif value="{{$key}}" name="{{$category['unit']}}">{{$category['name']}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="form-group " >
                      <label for="abbreviation" class="col-sm-2 control-label">等级</label>
                      <div class="col-sm-5">
                          <select class="form-control select2 grade"  style="width: 100%;">
                              @foreach($grades??[] as $key =>$grade)
                                  <option @if(($threshold['grade']??'') == $key) selected @endif value="{{$key}}">{{$grade}}</option>
                              @endforeach
                          </select>
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="lowLimit" class="col-sm-2 control-label">阈值下线</label>
                      <div class="col-sm-5">
                          <input type="lowLimit" class="form-control" value="{{$threshold['lowlimit']??''}}" id="lowLimit" placeholder="下限（-999~999）"  datatype="/^-?[1-9]{0,3}(\.\d+)?$|^-?0(\.\d+)?$|^-?[1-9]{1}[0-9]{0,2}(\.\d+)?$/" errormsg="请设正确的阈值下线" >
                      </div>
                      <div class="help-block unit">℃</div>
                  </div>

                  <div class="form-group">
                      <label for="topLimit" class="col-sm-2 control-label">阈值上线</label>
                      <div class="col-sm-5">
                          <input type="topLimit" class="form-control" value="{{$threshold['toplimit']??''}}" id="topLimit" placeholder="上限（-999~999）" datatype="/^-?[1-9]{0,3}(\.\d+)?$|^-?0(\.\d+)?$|^-?[1-9]{1}[0-9]{0,2}(\.\d+)?$/"  errormsg="请设正确的阈值上线" >
                      </div>
                      <div class="help-block unit">℃</div>
                  </div>
                  <legend> <span></span><span id="boardCounts"></span></legend>
                  <div class="form-group">
                      <label for="serial" class="col-sm-2 col-xs-12">
                      </label>
                      <div class="col-md-6 col-sm-8 col-xs-12">
                          <a href="javascript:void(0);" class="btn btn-default btn-flat addLiaisons"  style="">
                              <i class="fa fa-fw fa-plus"></i>
                              增加联系人
                          </a>
                      </div>
                      <div class="help-block"></div>
                  </div>

                  <div class="form-group">
                      <label for="topLimit" class="col-sm-2 control-label">联系人</label>
                      <div class="col-sm-5">
                          <div class="box-body no-padding">
                              <table class="table addTr">
                                  <tr>
                                      <th>姓名</th>
                                      <th>电话</th>
                                      <th>邮箱</th>
                                      <th style="width: 50px">操作</th>
                                  </tr>
           {{--                       <tr>
                                      <td>董董董</td>
                                      <td>18205190915</td>
                                      <td>344748243@qq.com</td>
                                      <td><a class="btn btn-default btn-flat btn-xs delete" url="">删除</a></td>
                                  </tr>
                                  <tr>
                                      <td>董董董</td>
                                      <td>18205190915</td>
                                      <td>344748243@qq.com</td>
                                      <td><a class="btn btn-default btn-flat btn-xs delete" url="">删除</a></td>
                                  </tr>--}}
                                  <tr id="1">
                                      <td><input type="text" style="width: 70px; border: 0px;" class="name" value="董一"></td>
                                      <td><input type="text" style="width: 90px; border: 0px;" class="phone" value="18205190915"></td>
                                      <td><input type="text" style="width: 135px; border: 0px;" class="email" value="344748243@qq.com"></td>
                                      <td><a class="btn btn-default btn-flat btn-xs delete" url="">删除</a></td>
                                  </tr>
                                  <tr id="2">
                                      <td><input type="text" style="width: 70px; border: 0px;" class="name" value="大山"></td>
                                      <td><input type="text" style="width: 90px; border: 0px;" class="phone" value="18205190915"></td>
                                      <td><input type="text" style="width: 135px; border: 0px;" class="email" value="344748243@qq.com"></td>
                                      <td><a class="btn btn-default btn-flat btn-xs delete" url="">删除</a></td>
                                  </tr>
                              </table>
                          </div>
                      </div>

                  </div>

              </div>

            </form>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <script src="{{asset('layer/layer.js')}}"></script>
  <script src="{{asset('vaildform/validform_min.js')}}"></script>
  <script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
  <script>
      $('.select2').select2();
      var ids = [];
      $(".form-horizontal").Validform({
          btnSubmit: ".sign",
          tipSweep: true,
          tiptype: function (msg, o, cssctl) {
              if (o.type == 3) {//失败
                  layer.alert(msg);
              }
          },
          callback: function (data) {//异步回调函数
              var companyId,equipmentId,collectorId,category,grade,lowLimit,topLimit,tableInput=[],info=[];
              companyId   = $('.company').val();
              equipmentId = $('.equipment').val();
              collectorId = $('.collector').val();
              category  = $('.category').val();
              grade     = $('.grade').val();
              lowLimit  = $('#lowLimit').val();
              topLimit  = $('#topLimit').val();

              $('.addTr tr').each(function (index,tr) {
                  if(index>0){
                      //console.log($(tr).find('.name').val());
                      var id = $(tr).attr('id');
                      if(id != 0){
                          tableInput.push({'id':id,'name':$(tr).find('.name').val(),'phone':$(tr).find('.phone').val(),'email':$(tr).find('.email').val()});
                      }else{
                          tableInput.push({'name':$(tr).find('.name').val(),'phone':$(tr).find('.phone').val(),'email':$(tr).find('.email').val()});
                      }
                      tableInput.concat(ids);
                  }
              });

              $.ajax({
                  url:'{{$route}}',
                  type:'POST',    //GET
                  data:{
                      firmId:companyId,equipmentId:equipmentId,collectorId:collectorId,category:category,grade:grade,lowLimit:lowLimit,topLimit:topLimit,list:tableInput
                  },
                  timeout:5000,    //超时时间
                  dataType:'json',
                  success:function(data){
                      if(data.code === '0'){
                          window.location.href = data.route
                      }else{
                          layer.alert(data.info)
                      }
                  },
                  error:function(data){
                  }
              });
              return false;
          }
      });


     $('.company').on('change',function(){
         var value = $(this).val();
         $(".changeEquipment").show();
         $(".changeCollector").show();
         changeEquipments(value,'');
         changeCollectors(value,'','');
     });

     $('.equipment').on('change',function(){
         var companyId = $(".company").find("option:selected").val();
         var value = $(this).val();
         $(".changeCollector").show();
         changeCollectors(companyId,value,'');
     });

     var company,equipment,collector;
     equipment = '{{$threshold['equipmentId']??''}}';
     collector = '{{$threshold['collectorId']??''}}';
     company = '{{$threshold['firmId']??''}}';
     if(company){
         changeEquipments(company,equipment);
         if(equipment){
             changeCollectors(company,equipment,collector);
         }
     }else{
         company = '{{$companies['0']['id']??''}}';
         changeEquipments(company,equipment);
         changeCollectors(company,equipment,collector);
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

     function changeCollectors(companyId,equipmentId,collectorId){
         $.ajax({
             url:'{{$getCollectorUrl}}',
             type:'POST',
             data:{
                 companyId:companyId,equipmentId:equipmentId,collectorId:collectorId
             },
             timeout:5000,    //超时时间
             dataType:'json',
             success:function(data){
                 if(data.state == '0'){
                     $(".collector").find("option").remove();
                     $(".collector").append(data.text);
                 }
             },
             error:function(data){
             }
         });
     }

     $('.category').change(function(){
         var unit = $(".category").find("option:selected").attr('name');
         $('.unit').html(unit);
     });
      var unit = $(".category").find("option:selected").attr('name');
      $('.unit').html(unit);

      $(document).on('click','.delete',function(){
          ids.push({'id':$(this).parent().parent().attr('id')});
          $(this).parent().parent().html('');
      });

      $('.addLiaisons').click(function(){
         var html = '<tr id="0">' +
             '<td><input type="text" style="width: 70px;" class="name" ></td>' +
             '<td><input type="text" style="width: 90px;" class="phone" ></td>' +
             '<td><input type="text" style="width: 135px;" class="email"  ></td>' +
             '<td><a class="btn btn-default btn-flat btn-xs delete" url="">删除</a></td>' +
             '</tr>';
          $(".addTr").append(html);
      });

      $(document).on('mouseleave','.name',function(){

      })
  </script>
@endsection