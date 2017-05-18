<!-- Main Header -->
<header class="main-header">

  <!-- Logo -->
  <a href="{{ URL::to('admin/home') }}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>AA</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">Admin Area</span>
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
          <!-- Menu Toggle Button -->
          <a href="#">
            <i class="fa fa-user"></i> <span>{{ Session::get('admin') }}</span>
          </a>
        </li>
        <li>
          <a href="{{ URL::to('admin/login/doLogout') }}">
            <i class="fa fa-sign-out"></i> <span>Logout</span>
          </a>
        </li>
        <!-- Control Sidebar Toggle Button -->
<!--         <li>
          <a href="#" data-toggle="control-sidebar">
            <i class="fa fa-bell"></i>
            <span class="label label-warning">4</span>
          </a>
        </li> -->
      </ul>
    </div>
  </nav>
</header>
