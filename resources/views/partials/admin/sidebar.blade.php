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
{{--      <li class="header">MAIN NAVIGATION</li>--}}
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


      <li class="@if (($active??'') === 'home') active @endif ">
        <a href="{{route('admin')}}">
          <i class="fa fa-dashboard"></i> <span>后台首页</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
      </li>

      @if( Auth::user()->id !==1 )
        @permission(['charts'])
        <li class="@if (in_array($active??'', ['realTime','historyRealTime','algorithms'])) active @endif  treeview">
          <a href="#">
            <i class="fa fa-industry"></i> <span>数据展示</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
            @permission('charts')
            <li class="@if (($active??'') === 'realTime') active @endif"><a href="{{route('charts.collectorChartRealTime',['id'=>0])}}"><i class="fa fa-area-chart"></i> 实时数据</a></li>
            @endpermission
            @permission('charts')
            <li class="@if (($active??'') === 'historyRealTime') active @endif"><a href="{{route('charts.collectorHistoryChart',['id'=>0])}}"><i class="fa fa-bar-chart"></i> 历史数据</a></li>
            @endpermission
            @permission('algorithms')
            <li class="@if (($active??'') === 'algorithms') active @endif"><a href="{{route('algorithms')}}"><i class="fa fa-line-chart"></i> 算法数据</a></li>
            @endpermission
          </ul>
        </li>
@endpermission
      @else
        <li class="@if (in_array($active??'', ['realTime','historyRealTime','algorithms'])) active @endif  treeview">
          <a href="#">
            <i class="fa fa-industry"></i> <span>数据展示</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if (($active??'') === 'realTime') active @endif"><a href="{{route('charts.collectorChartRealTime',['id'=>0])}}"><i class="fa fa-area-chart"></i> 实时数据</a></li>
            <li class="@if (($active??'') === 'historyRealTime') active @endif"><a href="{{route('charts.collectorHistoryChart',['id'=>0])}}"><i class="fa fa-bar-chart"></i> 历史数据</a></li>
            <li class="@if (($active??'') === 'algorithms') active @endif"><a href="{{route('algorithms')}}"><i class="fa fa-line-chart"></i> 算法数据</a></li>
          </ul>
        </li>
      @endif

{{--      @if( Auth::user()->id !==1 )
        @permission(['intelligents'])
        <li class="@if (($active??'') === 'realTime') active @endif">
          <a href="{{route('charts.collectorChartRealTime',['id'=>0])}}">
            <i class="fa fa-area-chart"></i> <span>实时数据</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
        </li>
        <li class="@if (($active??'') === 'historyRealTime') active @endif">
          <a href="{{route('charts.collectorHistoryChart',['id'=>0])}}">
            <i class="fa fa-bar-chart"></i> <span>历史数据</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
        </li>
        @endpermission
      @else
        <li class="@if (($active??'') === 'realTime') active @endif">
          <a href="{{route('charts.collectorChartRealTime',['id'=>0])}}">
            <i class="fa fa-area-chart"></i> <span>实时数据</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
        </li>
        <li class="@if (($active??'') === 'historyRealTime') active @endif">
          <a href="{{route('charts.collectorHistoryChart',['id'=>0])}}">
            <i class="fa fa-bar-chart"></i> <span>历史数据</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
        </li>
      @endif--}}

      @if( Auth::user()->id !==1 )
        @permission(['intelligents'])
        <li class="@if (($active??'') === 'intelligents') active @endif">
          <a href="{{route('intelligents')}}">
            <i class="fa fa-ambulance"></i> <span>智能诊断</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
        </li>
        @endpermission
      @else
        <li class="@if (($active??'') === 'intelligents') active @endif">
          <a href="{{route('intelligents')}}">
            <i class="fa fa-ambulance"></i> <span>智能诊断</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
        </li>
        @endif

      @if( Auth::user()->id !==1 )

        @permission(['equipments','collectors'])
        <li class="@if (in_array($active??'', ['equipments','collectors'])) active @endif treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>设备管理</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
            @permission('equipments')
            <li class="@if (($active??'') === 'equipments') active @endif"><a href="{{route('equipments')}}"><i class="fa fa-subway"></i> 机械设备</a></li>
            @endpermission
            @permission('collectors')
            <li class="@if (($active??'') === 'collectors') active @endif"><a href="{{route('collectors')}}"><i class="fa fa-wifi"></i> 无线节点</a></li>
            @endpermission
          </ul>
        </li>
        @endpermission

        @permission(['thresholds','liaisons','alarms','recover'])
        <li class="@if (in_array($active??'', ['thresholds','liaisons','alarms'])) active @endif treeview">
          <a href="#">
            <i class="fa fa-bell"></i> <span>告警管理</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">

            @permission('thresholds')
            <li class="@if (($active??'') === 'thresholds') active @endif"><a href="{{route('thresholds')}}"><i class="fa fa-cog"></i> 添加告警</a></li>
            @endpermission
            @permission('liaisons')
            <li class="@if (($active??'') === 'liaisons') active @endif"><a href="{{route('liaisons')}}"><i class="fa fa-comments-o"></i> 告警方式</a></li>
            @endpermission
            @permission('alarms')
            <li class="@if (($active??'') === 'alarms') active @endif"><a href="{{route('alarms')}}"><i class="fa fa-warning"></i> 告警记录
                <span class="pull-right-container">
              <small class="label pull-right bg-red">{{ Session::get('alarmCount') }}</small>
            </span>
              </a></li>

            <li class="@if (($active??'') === 'recover') active @endif"><a href="{{route('recover')}}"><i class="fa fa-check-square-o"></i> 解决记录</a></li>
            @endpermission

          </ul>
        </li>
        @endpermission

      @else

        <li class="@if (in_array($active??'', ['equipments','collectors'])) active @endif treeview">
          <a href="#">
            <i class="fa fa-cogs"></i> <span>设备管理</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if (($active??'') === 'equipments') active @endif"><a href="{{route('equipments')}}"><i class="fa fa-subway"></i> 机械设备</a></li>
            <li class="@if (($active??'') === 'collectors') active @endif"><a href="{{route('collectors')}}"><i class="fa fa-wifi"></i> 无线节点</a></li>
          </ul>
        </li>

        <li class="@if (in_array($active??'', ['thresholds','liaisons','alarms','recover'])) active @endif treeview">
          <a href="#">
            <i class="fa fa-bell"></i> <span>告警管理</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if (($active??'') === 'thresholds') active @endif"><a href="{{route('thresholds')}}"><i class="fa fa-cog"></i> 添加告警</a></li>
            <li class="@if (($active??'') === 'liaisons') active @endif"><a href="{{route('liaisons')}}"><i class="fa fa-comments-o"></i> 告警方式</a></li>
            <li class="@if (($active??'') === 'alarms') active @endif"><a href="{{route('alarms')}}"><i class="fa fa-warning"></i>
                告警记录
                <span class="pull-right-container">
              <small class="label pull-right bg-red">{{ Session::get('alarmCount') }}</small>
            </span>
              </a></li>

            <li class="@if (($active??'') === 'recover') active @endif"><a href="{{route('recover')}}"><i class="fa  fa-check-square-o"></i> 解决记录</a></li>
          </ul>
        </li>

      @endif

      @if( Auth::user()->id !==1 )
        @permission('companies')
        <li class="@if (($active??'') === 'companies') active @endif treeview">
          <a href="#">
            <i class="fa fa-institution fa-sitemap"></i> <span>机构管理</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if (($active??'') === 'companies') active @endif "><a href="{{route('companies')}}"><i class="fa fa-institution"></i> 添加公司</a></li>
          </ul>
        </li>
        @endpermission
      @else
        <li class="@if (($active??'') === 'companies') active @endif treeview">
          <a href="#">
            <i class="fa fa-sitemap"></i> <span>机构管理</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if (($active??'') === 'companies') active @endif"><a href="{{route('companies')}}"><i class="fa fa-institution"></i> 添加公司</a></li>
          </ul>
        </li>
      @endif

      @if( Auth::user()->id !==1 )
        @permission(['users','roles','permissions'])
        <li class="@if (in_array($active??'', ['users','roles','permissions'])) active @endif treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>用户管理</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
            @permission('users')
            <li class="@if (($active??'') === 'users') active @endif"><a href="{{route('users')}}"><i class="fa fa-user"></i> 用户</a></li>
            @endpermission
            @permission('roles')
            <li class="@if (($active??'') === 'roles') active @endif"><a href="{{route('roles')}}"><i class="fa ffa-user-plus"></i> 角色</a></li>
            @endpermission
            @permission('permissions')
            <li class="@if (($active??'') === 'permissions') active @endif"><a href="{{route('permissions')}}"><i class="fa fa-lock"></i> 权限</a></li>
            @endpermission
          </ul>
        </li>
        @endpermission
      @else
        <li class="@if (in_array($active??'', ['users','roles','permissions'])) active @endif treeview">
          <a href="#">
            <i class="fa fa-users"></i> <span>用户管理</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if (($active??'') === 'users') active @endif"><a href="{{route('users')}}"><i class="fa fa-user"></i> 用户</a></li>
            <li class="@if (($active??'') === 'roles') active @endif"><a href="{{route('roles')}}"><i class="fa fa-user-plus"></i> 角色</a></li>
            <li class="@if (($active??'') === 'permissions') active @endif"><a href="{{route('permissions')}}"><i class="fa fa-lock"></i> 权限</a></li>
          </ul>
        </li>
      @endif


      @if( Auth::user()->id !==1 )
        @permission(['products','orders','carts','buyProducts','ordersInfo'])
        <li class="@if (in_array($active??'', ['products','orders','carts','buyProducts','ordersInfo'])) active @endif treeview">
          <a href="#">
            <i class="fa fa-gift"></i> <span>在线商城</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
            @permission('products')
            <li class="@if (($active??'') === 'products') active @endif"><a href="{{route('products')}}"><i class="fa fa-truck"></i> 商品管理</a></li>
            @endpermission

            @permission('carts')
            <li class="@if (($active??'') === 'carts') active @endif"><a href="{{route('carts')}}"><i class="fa fa-shopping-cart"></i> 购物车
                <span class="pull-right-container">
              <small class="label pull-right bg-red">{{ Session::get('cartsCount') }}</small>
            </span>
              </a></li>
            @endpermission

            @permission('buyProducts')
            <li class="@if (($active??'') === 'buyProducts') active @endif"><a href="{{route('buyProducts.buy')}}"><i class="fa fa-th-large"></i> 商品列表</a></li>
            @endpermission
            @permission('orders')
            <li class="@if (($active??'') === 'orders') active @endif"><a href="{{route('orders')}}"><i class="fa fa-reorder "></i> 订单列表</a></li>
            @endpermission
            @permission('orders')
            <li class="@if (($active??'') === 'ordersInfo') active @endif"><a href="{{route('orders.info',['id'=>0])}}"><i class="fa fa-cny"></i> 购买记录</a></li>
            @endpermission

          </ul>
        </li>
        @endpermission
      @else
        <li class="@if (in_array($active??'', ['products','orders','carts','buyProducts','ordersInfo'])) active @endif treeview">
          <a href="#">
            <i class="fa fa-gift"></i> <span>在线商城</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
          </a>
          <ul class="treeview-menu">
            <li class="@if (($active??'') === 'products') active @endif"><a href="{{route('products')}}"><i class="fa fa-truck"></i> 商品管理</a></li>
            <li class="@if (($active??'') === 'carts') active @endif"><a href="{{route('carts')}}"><i class="fa fa-shopping-cart"></i> 购物车
                <span class="pull-right-container">
              <small class="label pull-right bg-red">{{ Session::get('cartsCount') }}</small>
            </span>
              </a></li>
            <li class="@if (($active??'') === 'buyProducts') active @endif"><a href="{{route('buyProducts.buy')}}"><i class="fa fa-th-large"></i> 商品列表</a></li>
            <li class="@if (($active??'') === 'orders') active @endif"><a href="{{route('orders')}}"><i class="fa fa-reorder "></i> 订单列表</a></li>
            <li class="@if (($active??'') === 'ordersInfo') active @endif"><a href="{{route('orders.info',['id'=>0])}}"><i class="fa fa-cny"></i> 购买记录</a></li>
          </ul>
        </li>
      @endif


      <li>
        <a href="{{ url('/') }}">
          <i class="fa fa-home"></i> <span>网站首页</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
      </li>
    </ul>
  </section>

</aside>