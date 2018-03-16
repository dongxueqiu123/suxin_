<aside class="main-sidebar">

  <section class="sidebar">

    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('bower_components/admin-lte/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="active treeview">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>Sample 1</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="#"><i class="fa fa-circle-o"></i> Sample 1-1</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Sample 1-2</a></li>
        </ul>
      </li>
      <li>
        <a href="#">
          <i class="fa fa-envelope"></i> <span>Sample 2</span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-folder"></i> <span>Sample 3</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-circle-o"></i> Invoice</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Profile</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Login</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Register</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> 404 Error</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> 500 Error</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Blank Page</a></li>
          <li><a href="#"><i class="fa fa-circle-o"></i> Pace Page</a></li>
        </ul>
      </li>
    </ul>
  </section>
  
</aside>