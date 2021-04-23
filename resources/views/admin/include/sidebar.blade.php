@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();
@endphp


<aside class="main-sidebar sidebar-dark-primary elevation-4">
<!-- Brand Logo -->
<a href="{{route('admin.dashboard')}}" class="brand-link">
    <img src="{{asset('Source/back')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Lexadev</span>
</a>
<!-- Sidebar -->
<div class="sidebar">
<!-- Sidebar user panel (optional) -->
<div class="user-panel mt-3 pb-3 mb-3 d-flex">
    <div class="image">
        <img src="{{asset('Source/back/dist/img/profile')}}/{{Auth::guard('admin')->user()->image}}" class="img-circle elevation-2" alt="User Image">
    </div>
    <div class="info">
        <a href="{{route('admin.dashboard')}}" class="d-block">{{Auth::guard('admin')->user()->name}}</a>
    </div>
</div>
<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
        with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{route('admin.dashboard')}}" class="nav-link {{($route == 'admin.dashboard') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard

                </p>
            </a>
        </li>
        @foreach ($menus as $menu )
        @isset(Auth::guard('admin')->user()->role->parmission['parmission'][$menu->menu])
            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon {{$menu->icon_left}}"></i>
                <p>
                    {{$menu->menu}}
                    <i class="right {{$menu->icon_right}}"></i>
                </p>
                </a>
                @foreach(\App\Models\SubMenu::where('menu_id',$menu->id)->get() as $sbmenu)
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{url($sbmenu->slug)}}" class="nav-link">
                            <i class="{{$sbmenu->icon}}"></i>
                            <p>{{$sbmenu->title}}</p>
                            </a>
                      </li>

                  </ul>
                  @endforeach

            </li>
            @endisset
        @endforeach

        {{--  @foreach ($menus as $menu)
            <li class="nav-item">
                @isset(Auth::guard('admin')->user()->role->parmission['parmission'][$menu->menu])
                    <a class="nav link">
                        < class="{{$menu->icon_left}}"></>
                        <p>
                            {{$menu->menu}}
                            <i class="right {{$menu->icon_right}}"></i>
                        </p>
                    </a>
                @endisset

                @foreach(\App\Models\SubMenu::where('menu_id',$menu->id)->get() as $sm)
                    <ul class="nav nav-treeview">
                        @isset(Auth::guard('admin')->user()->role->parmission['parmission']['role']['list'])
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="far fa-circle text-danger nav-icon"></i>
                                    <p>{{$sm->title}}</p>
                                </a>
                            </li>
                        @endisset
                    </ul>
                @endforeach
            </li>
        @endforeach  --}}



        <li class="nav-item">
            <a href="{{route('admin.logout')}}" class="nav-link">
                <i class="fas fa-sign-out-alt"></i>
                <p>
                    Logout

                </p>
            </a>
        </li>


    </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>
