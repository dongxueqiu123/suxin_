<header class="main-header">
  <!-- Logo -->
  <a href="#" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>S</b>in</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">Suxin Account</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{ asset('bower_components/admin-lte/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
            <span class="hidden-xs">{{ Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="{{ asset('bower_components/admin-lte/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
              <p>{{ Auth::user()->name }}</p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-right">
                <a class="btn btn-default btn-flat" href="<?php echo url('/').'/'.app()->getLocale().'/logout' ?>"
                    onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                    @lang('auth.logout_lnk')
                </a>
                <form id="logout-form" action="<?php echo url('/').'/'.app()->getLocale().'/logout' ?>" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>