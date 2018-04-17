<header class="header">
  <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
          <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                  <span class="sr-only">Toggle Navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a href="{{ url('/') }}">
                <img class="navbar-brand" style="height: 96px" src="{{ asset('images/logo.jpg') }}">
              </a>
          </div>

          <div class="collapse navbar-collapse" id="app-navbar-collapse">
              <ul class="nav navbar-nav navbar-right">
                <li class="<?php echo (isset($action) && $action === 'home') ? 'active' : ''?>"><a href="<?php echo url('/').'/'.app()->getLocale() ?>">@lang('header.menu.home_lnk')</a></li>
                <li class="<?php echo (isset($action) && $action === 'sensors') ? 'active' : ''?>"><a href="<?php echo url('/').'/'.app()->getLocale().'/sensors' ?>">@lang('header.menu.sensors_lnk')</a></li>
                <li class="<?php echo (isset($action) && $action === 'connectivity') ? 'active' : ''?>"><a href="<?php echo url('/').'/'.app()->getLocale().'/connectivity' ?>">@lang('header.menu.connectivity_lnk')</a></li>
                <li class="<?php echo (isset($action) && $action === 'cloud') ? 'active' : ''?>"><a href="<?php echo url('/').'/'.app()->getLocale().'/cloud' ?>">@lang('header.menu.industrial_lnk')</a></li>
                <li class="<?php echo (isset($action) && $action === 'analytics') ? 'active' : ''?>"><a href="<?php echo url('/').'/'.app()->getLocale().'/analytics' ?>">@lang('header.menu.analytics_lnk')</a></li>
                <li class="<?php echo (isset($action) && $action === 'contact_us') ? 'last active' : 'last'?>"><a href="<?php echo url('/').'/'.app()->getLocale().'/contact_us' ?>">@lang('header.menu.contact_us')</a></li>
                <li class="langs">
                    <ul>
                    @guest
                    <li class="<?php echo (isset($action) && $action === 'login') ? 'active' : ''?>"><a href="<?php echo url('/').'/'.app()->getLocale().'/login' ?>">@lang('auth.login_lnk')</a></li>
                    <li>@lang('auth.or')</li>
                    <li class="<?php echo (isset($action) && $action === 'register') ? 'active' : ''?>"><a href="<?php echo url('/').'/'.app()->getLocale().'/register' ?>">@lang('auth.register_lnk')</a></li>
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                            @if (Auth::user()->role === 1)
                                <a href="<?php echo url('/').'/admin' ?>">@lang('auth.dashboard_lnk')</a>
                            @else
                                <a href="<?php echo url('/').'/admin' ?>">@lang('auth.dashboard_lnk')</a>
                            @endif
                            </li>
                            <li>
                                @if (Auth::user()->role === 1)
                                    <a href="{{route('charts.collectorChartRealTime',['id'=>3])}}">@lang('auth.live_data')</a>
                                @else
                                    <a href="{{route('charts.collectorChartRealTime',['id'=>3])}}">@lang('auth.live_data')</a>
                                @endif
                            </li>
                            <li>
                                @if (Auth::user()->role === 1)
                                    <a href="{{route('users.edit',['id'=>Auth::user()->id])}}">@lang('auth.change_password')</a>
                                @else
                                    <a href="{{route('users.edit',['id'=>Auth::user()->id])}}">@lang('auth.change_password')</a>
                                @endif
                            </li>
                            <li>
                                <a href="<?php echo url('/').'/'.app()->getLocale().'/logout' ?>"
                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    @lang('auth.logout_lnk')
                                </a>
                                <form id="logout-form" action="<?php echo url('/').'/'.app()->getLocale().'/logout' ?>" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endguest
                    </ul>
                    <ul>
                        <li><a href="<?php echo url('/ch'); ?>"><img width="32px" src="{{ asset('images/ch_flag.png') }}"></a></li>
                        <li>|</li>
                        <li><a href="<?php echo url('/en'); ?>"><img width="32px" src="{{ asset('images/usa_flag.png') }}"></a></li>
                    </ul>
                </li>
              </ul>
          </div>
      </div>
  </nav>
</header>