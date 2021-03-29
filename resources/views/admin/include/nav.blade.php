<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
          </li>
          <div class="container-title">
              {{-- <div class="row">
                  <marquee> Selamat Datang {{Auth::guard('admin')->user()->name}} Di Sistem Akademik STIE-IGI </marquee>
              </div> --}}
          </div>

      </ul>
      </ul>
      <ul class="navbar-nav ml-auto">
          <!-- Messages Dropdown Menu -->

          <!-- Notifications Dropdown Menu -->

          <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                  <img src="{{asset('Source/back/dist/img')}}/{{Auth::guard('admin')->user()->image}}" class="user-image img-circle elevation-2" alt="User Image">
                  <span class="d-none d-md-inline">{{Auth::guard('admin')->user()->name}}</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <!-- User image -->
                  <li class="user-header bg-primary">
                    <img src="{{asset('Source/back/dist/img')}}/{{Auth::guard('admin')->user()->image}}" class="user-image img-circle elevation-2" alt="User Image">

                      <p>
                        {{Auth::guard('admin')->user()->name}} - {{Auth::guard('admin')->user()->email}}
                         <small>Join {{ \Carbon\Carbon::parse(Auth::guard('admin')->user()->created_at)->format('d/m/Y')}}</small>
                      </p>
                  </li>

                  <!-- Menu Footer-->
                  <li class="user-footer">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                      <a href="{{route('admin.logout')}}" class="btn btn-default btn-flat float-right">Sign out</a>
                  </li>
              </ul>
          </li>

      </ul>
  </nav>
