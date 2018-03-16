<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title><?php echo (isset($title) && $title !== "") ? $title : "Suxin"; ?></title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
</head>
<body>
    <div id="back-to-top" class="animate-top"><i class="fa fa-angle-up" aria-hidden="true"></i></div>
    <div id="app" class="flex_page_wrap">
        @include('partials.home.header')
        <div class="flex_content_wr">
            @yield('content')
        </div>
        @include('partials.home.footer')
    </div>
</body>
</html>
