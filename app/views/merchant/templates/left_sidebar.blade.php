<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li>
        <a>
          <i class="fa fa-user"></i> <span><strong>{{ Session::get('merchant_email') }}</strong></span>
        </a>
      </li>
      <li>
        <a href="{{ URL::to('merchant/login/doLogout') }}">
          <i class="fa fa-sign-out"></i> <span>Logout</span>
        </a>
      </li>

      <li class="header">
        Menu
      </li>
      <li id="menu_info">
        <a href="{{ URL::to('merchant/info') }}">
          <i class="fa fa-info-circle"></i> <span>Informasi Merchant</span>
        </a>
      </li>
      <li id="menu_order">
        <a href="{{ URL::to('merchant/order') }}">
          <i class="fa fa-shopping-cart"></i> <span>Order</span>
          <!-- TODO: <span class="label label-danger pull-right">6</span> -->
        </a>
      </li>
      <li id="menu_product" class="treeview">
        <a href="#">
          <i class="fa fa-tags"></i> <span>Produk</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li id="menu_product_list">
            <a href="{{ URL::to('merchant/productList') }}">
              <i class="fa fa-list-ul"></i> Daftar Produk
            </a>
          </li>
          <li id="menu_add_product">
            <a href="{{ URL::to('merchant/addProduct') }}">
              <i class="fa fa-plus-circle"></i> Tambah Produk
            </a>
          </li>
        </ul>
      </li>
      <li id="menu_report">
        <a href="#">
          <i class="fa fa-bar-chart"></i> <span>Laporan</span>
        </a>
      </li>
    </ul><!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
