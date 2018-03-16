@extends('layouts.account')

@section('content')
  <section class="content-header">
    <h1>
      Dashboard
      <small>Chart Samples</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <section class="content">

    <div class="row">
      <div class="col-sm-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Line Chart</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body chart-responsive">
            <div class="chart" id="line-chart" style="height: 300px;"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Bar Chart</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body chart-responsive">
            <div class="chart" id="bar-chart" style="height: 300px;"></div>
          </div>
        </div>
      </div>
    </div>

  </section>
@endsection