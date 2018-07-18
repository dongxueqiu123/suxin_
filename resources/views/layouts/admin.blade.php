<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Suxin Admin</title>

    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/admin-lte/dist/css/skins/skin-blue.min.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('bower_components/morris.js/morris.css') }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <script src="{{ asset('js/suxin/jquery-1.9.1.min.js') }}"></script>
    <script src="{{ asset('js/suxin/index.js?v=1') }}"></script>
    <style>
        body,button, input, select, span,tspan,textarea,h1 ,h2, h3, h4, h5, h6 { font-family: Microsoft YaHei,'宋体' , Tahoma, Helvetica, Arial, "\5b8b\4f53", sans-serif;}
        .content{
            padding: 8px 15px;
        }
        input,select,button,a,p{
            font-size: 13px;
        }
        .breadcrumbSuXin>.active {
            color: #777;
        }
        .breadcrumbSuXin>li {
            display: inline-block;
        }
        .content-header>.breadcrumbSuXin {
            /* float: right; */
            background: transparent;
            margin-top: 0;
            margin-bottom: 0;
            /* font-size: 12px; */
            padding: 15px 1px 5px 16px;
            /* position: absolute; */
            /* top: 15px; */
            /* right: 10px; */
            /* border-radius: 2px; */
        }
        .content-header > .breadcrumbSuXin > li > a {
            color: #444;
            text-decoration: none;
            display: inline-block;
        }
        .content-header > .breadcrumbSuXin > li > a > .fa,
        .content-header > .breadcrumbSuXin > li > a > .glyphicon,
        .content-header > .breadcrumbSuXin > li > a > .ion {
            margin-right: 5px;
        }
        .content-header > .breadcrumbSuXin > li + li:before {
            content: '>\00a0';
        }
        @media (max-width: 991px) {
            .content-header > .breadcrumbSuXin {
                position: relative;
                margin-top: 5px;
                top: 0;
                right: 0;
                float: none;
                background: #d2d6de;
                padding-left: 10px;
            }
            .content-header > .breadcrumb li:before {
                color: #97a0b3;
            }
        }
        .box{
            border-radius: 0px;
        }
        .btn {
            font-size: 13px;
        }
        .form-control{
            font-size: 13px;
        }
        .treeview-menu>li>a {
            font-size: 13px;
        }
        .box-header>.fa, .box-header>.glyphicon, .box-header>.ion, .box-header .box-title {
             font-size: 13px;
        }
        .labelList{
            display: inline;
            padding: .2em .6em .2em;
            font-size: 75%;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            background-color: grey;
            border-radius: .25em;
        }
    </style>
</head>
<body class="hold-transition skin-blue sidebar-mini " style="font-size: 13px;">
    <div class="wrapper">
      @include('partials.admin.header')
      @include('partials.admin.sidebar')
      <div class="content-wrapper">
        @yield('content')
      </div>
      @include('partials.admin.footer')
      <div class="control-sidebar-bg"></div>
    </div>
</body>
</html>
