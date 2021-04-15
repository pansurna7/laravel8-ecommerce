
@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp


<aside class="main-sidebar sidebar-dark-primary elevation-4 position-fixed">
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
            <img src="{{asset('Source/back/dist/img')}}/{{Auth::guard('admin')->user()->image}}" class="img-circle elevation-2" alt="User Image">
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
            <li class="nav-item {{($prefix == '/category') ? 'menu-open' : ''}} ">

                <a href="#" class="nav-link {{($route == 'category.manage') ? 'active' : '' }}">
                    <i class="fas fa-bars"></i>
                    <p>
                        Category
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('category.manage')}}" class="nav-link {{($route == 'category.manage') ? 'active' : '' }} ">
                            <i class="far fa-circle text-danger nav-icon"></i>
                            <p>Manage</p>
                        </a>
                    </li>

                </ul>

            </li>

            <li class="nav-item {{($prefix == '/items') ? 'menu-open' : ''}}">
                <a href="#" class="nav-link {{($route == 'items.manage') ? 'active' : '' }}">
                    <i class="fas fa-bars"></i>
                    <p>
                        Item
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('items.manage')}}" class="nav-link {{($route == 'items.manage') ? 'active' : '' }}">
                            <i class="far fa-circle text-danger nav-icon"></i>
                            <p>Manage</p>
                        </a>
                    </li>

                </ul>

            </li>
            @isset(auth()->guard('admin')->user()->role->parmission['parmission']['parmission']['list'])
            <li class="nav-item {{($prefix=='/role')? 'menu-open':''}} ">
                <a href="{{route('role.index')}}" class="nav-link {{($route == 'role.index') ? 'active' : '' }}">
                    <i class="fas fa-bars"></i>
                    <p>
                        ACL
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('role.index')}}" class="nav-link {{($route=='role.index') ? 'active':''}}">
                            <i class="far fa-circle text-danger nav-icon"></i>
                            <p>Role</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{route('parmission.index')}}" class="nav-link {{($route=='parmission.index') ? 'active':''}}">
                            <i class="far fa-circle text-danger nav-icon"></i>
                            <p>Parmission</p>
                        </a>
                    </li>
                </ul>
                @endisset





            </li>

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
<!--
<li class="nav-item {{($prefix == '/category') ? 'menu-open' : ''}} ">

    <a href="#" class="nav-link {{($route == 'category.manage') ? 'active' : '' }}">
        <i class="fas fa-bars"></i>
        <p>
            Category
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('category.manage')}}" class="nav-link {{($route == 'category.manage') ? 'active' : '' }} ">
                <i class="far fa-circle text-danger nav-icon"></i>
                <p>Manage</p>
            </a>
        </li>

    </ul>

</li>

<li class="nav-item {{($prefix == '/items') ? 'menu-open' : ''}}">
    <a href="#" class="nav-link {{($route == 'items.manage') ? 'active' : '' }}">
        <i class="fas fa-bars"></i>
        <p>
            Item
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('items.manage')}}" class="nav-link {{($route == 'items.manage') ? 'active' : '' }}">
                <i class="far fa-circle text-danger nav-icon"></i>
                <p>Manage</p>
            </a>
        </li>

    </ul>

</li>

<li class="nav-item {{($prefix=='/role')? 'menu-open':''}}
    {{($prefix=='/parmission')? 'menu-open':''}}
    {{($prefix=='/user')? 'menu-open':''}}
    {{($prefix=='/menu')? 'menu-open':''}}">
    <a href="{{route('role.index')}}" class="nav-link {{($route == 'role.index') ? 'active' : '' }}">
        <i class="fas fa-bars"></i>
        <p>
            ACL
            <i class="right fas fa-chevron-circle-down"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        @isset(Auth::guard('admin')->user()->role->parmission['parmission']['role']['list'])
            <li class="nav-item">
                <a href="{{route('role.index')}}" class="nav-link {{($route=='role.index') ? 'active':''}}">
                    <i class="far fa-circle text-danger nav-icon"></i>
                    <p>Role</p>
                </a>
            </li>
        @endisset
        @isset(Auth::guard('admin')->user()->role->parmission['parmission']['parmission']['list'])
            <li class="nav-item">
                <a href="{{route('parmission.index')}}" class="nav-link {{($route=='parmission.index') ? 'active':''}}">
                    <i class="far fa-circle text-danger nav-icon"></i>
                    <p>Parmission</p>
                </a>
            </li>
        @endisset

        @isset(Auth::guard('admin')->user()->role->parmission['parmission']['user']['list'])
            <li class="nav-item">
                <a href="{{route('all-user')}}" class="nav-link {{($route=='all-user') ? 'active':''}}">
                    <i class="far fa-circle text-danger nav-icon"></i>
                    <p>User</p>
                </a>
            </li>
        @endisset

        @isset(Auth::guard('admin')->user()->role->parmission['parmission']['menu']['list'])
            <li class="nav-item">
                <a href="{{route('menu.index')}}" class="nav-link {{($route=='menu.index') ? 'active':''}}">
                    <i class="far fa-circle text-danger nav-icon"></i>
                    <p>Menu</p>
                </a>
            </li>
        @endisset
    </ul>


</li>

 -->
