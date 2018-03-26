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
{{--      <li class="active treeview">
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
      </li>--}}
      @if( Auth::user()->id !==1 )
      @permission(['users','roles','permissions'])
      <li class="@if (in_array($active??'', ['users','roles','permissions'])) active @endif treeview">
        <a href="#">
          <i class="fa fa-users"></i> <span>用户</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          @permission('users')
          <li class="@if (($active??'') === 'users') active @endif"><a href="{{route('users')}}"><i class="fa fa-user"></i> 用户管理</a></li>
          @endpermission
          @permission('roles')
          <li class="@if (($active??'') === 'roles') active @endif"><a href="{{route('roles')}}"><i class="fa ffa-user-plus"></i> 角色管理</a></li>
          @endpermission
          @permission('permissions')
          <li class="@if (($active??'') === 'permissions') active @endif"><a href="{{route('permissions')}}"><i class="fa fa-lock"></i> 权限管理</a></li>
          @endpermission
        </ul>
      </li>
      @endpermission
        @else
        <li class="@if (in_array($active??'', ['users','roles','permissions'])) active @endif treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>用户</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if (($active??'') === 'users') active @endif"><a href="{{route('users')}}"><i class="fa fa-user"></i> 用户管理</a></li>
            <li class="@if (($active??'') === 'roles') active @endif"><a href="{{route('roles')}}"><i class="fa fa-user-plus"></i> 角色管理</a></li>
            <li class="@if (($active??'') === 'permissions') active @endif"><a href="{{route('permissions')}}"><i class="fa fa-lock"></i> 权限管理</a></li>
          </ul>
        </li>
      @endif


      @if( Auth::user()->id !==1 )
      @permission('companies')
      <li class="@if (($active??'') === 'companies') active @endif treeview">
        <a href="#">
          <i class="fa fa-television"></i> <span>公司</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="@if (($active??'') === 'companies') active @endif "><a href="{{route('companies')}}"><i class="fa fa-sticky-note-o"></i> 公司管理</a></li>
        </ul>
      </li>
      @endpermission
      @else
        <li class="@if (($active??'') === 'companies') active @endif treeview">
          <a href="#">
            <i class="fa fa-television"></i> <span>公司</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if (($active??'') === 'companies') active @endif"><a href="{{route('companies')}}"><i class="fa fa-sticky-note-o"></i> 公司管理</a></li>
          </ul>
        </li>
      @endif

      @if( Auth::user()->id !==1 )
        @permission(['test11','test12'])

        <li class="@if (in_array($active??'', ['test11','test12'])) active @endif treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>测试1</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
            @permission('test11')
            <li class="@if (($active??'') === 'test11') active @endif"><a href="{{route('test11')}}"><i class="fa fa-circle-o"></i> 测试栏目1</a></li>
            @endpermission
            @permission('test12')
            <li class="@if (($active??'') === 'test12') active @endif"><a href="{{route('test12')}}"><i class="fa fa-circle-o"></i> 测试栏目2</a></li>
            @endpermission
          </ul>
        </li>
        @endpermission

        @permission('test2')
        <li class="@if (($active??'') === 'test2') active @endif treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i> <span>测试2</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if (($active??'') === 'test2') active @endif "><a href="{{route('test2')}}"><i class="fa fa-circle-o"></i> 测试栏目1</a></li>
          </ul>
        </li>
        @endpermission
      @else
      <li class="@if (in_array($active??'', ['test11','test12'])) active @endif  treeview">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>测试1</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="@if (($active??'') === 'test11') active @endif"><a href="{{route('test11')}}"><i class="fa fa-circle-o"></i> 测试栏目1</a></li>
          <li class="@if (($active??'') === 'test12') active @endif"><a href="{{route('test12')}}"><i class="fa fa-circle-o"></i> 测试栏目2</a></li>
        </ul>
      </li>

      <li class="@if (($active??'') === 'test2') active @endif treeview">
        <a href="#">
          <i class="fa fa-dashboard"></i> <span>测试2</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="active"><a href="{{route('test2')}}"><i class="fa fa-circle-o"></i> 测试栏目1</a></li>
        </ul>
      </li>
      @endif

    </ul>
  </section>

</aside>