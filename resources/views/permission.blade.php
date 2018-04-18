@extends('layouts.admin')

@section('content')
    <section class="content-header">
        <h1>
            <small>权限</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('admin')}}"><i class="fa fa-dashboard"></i> 后台首页</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <!-- /.box-header -->
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h2 class="box-title">您没有访问权限</h2>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

@endsection