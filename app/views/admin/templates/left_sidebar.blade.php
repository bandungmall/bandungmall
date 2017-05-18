<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li>
        <a>
          <i class="fa fa-user-secret"></i> <span><strong>{{ Session::get('admin') }}</strong></span>
        </a>
      </li>
      <li>
        <a href="{{ URL::to('admin/login/doLogout') }}">
          <i class="fa fa-sign-out"></i> <span>Logout</span>
        </a>
      </li>

      <li class="header">
        Menu
      </li>
      <li id="menu_home">
        <a href="{{ URL::to('admin/home') }}">
          <i class="fa fa-home"></i> <span>Home</span>
        </a>
      </li>
      <li id="menu_admin">
        <a href="{{ URL::to('admin/admin') }}">
          <i class="fa fa-user-secret"></i> <span>Pengaturan Admin</span>
        </a>
      </li>
      <li id="menu_user" class="treeview">
        <a href="#">
          <i class="fa fa-user"></i> <span>Pengaturan User</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li id="menu_user_user">
            <a href="{{ URL::to('admin/user') }}">
              <i class="fa fa-user"></i> Pengaturan User
            </a>
          </li>
          <li id="menu_user_transaction">
            <a href="{{ URL::to('admin/user/transaction') }}">
              <i class="fa fa-money"></i> Transaksi User
            </a>
          </li>
        </ul>
      </li>
      <li id="menu_transaction" class="treeview">
        <a href="#">
          <i class="fa fa-money"></i> <span>Pengaturan Transaksi</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li id="menu_transaction_success">
            <a href="{{ URL::to('admin/transaction/transactionSent') }}">
              <i class="fa fa-circle"></i> Transaksi Dikirim
            </a>
          </li>
		  <li id="menu_transaction_declined">
            <a href="{{ URL::to('admin/transaction/transactionSentDeclined') }}">
              <i class="fa fa-circle"></i> Transaksi Telat Dikirim
            </a>
          </li>
      <li id="menu_transaction_paid">
            <a href="{{ URL::to('admin/transaction/transactionPaid') }}">
              <i class="fa fa-circle"></i> Transaksi Telah Dibayar
            </a>
          </li>
          <li id="menu_transaction_pending">
            <a href="{{ URL::to('admin/transaction/transactionPending') }}">
              <i class="fa fa-circle"></i> Transaksi Konfirmasi Bayar
            </a>
          </li>
		  <li id="menu_transaction_unpaid">
            <a href="{{ URL::to('admin/transaction/transactionUnpaid') }}">
              <i class="fa fa-circle"></i> Transaksi Belum Bayar
            </a>
          </li>
      <li id="menu_transaction_reject">
            <a href="{{ URL::to('admin/transaction/transactionReject') }}">
              <i class="fa fa-circle"></i> Transaksi Telat Bayar
            </a>
          </li>
        </ul>
      </li>
      <li id="menu_product">
        <a href="{{ URL::to('admin/product') }}">
          <i class="fa fa-circle"></i> <span>Pengaturan Produk</span>
        </a>
      </li>
      <li id="menu_merchant" class="treeview">
        <a href="#">
          <i class="fa fa-users"></i> <span>Pengaturan Merchant</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li id="menu_merchant_login">
            <a href="{{ URL::to('admin/merchant') }}">
              <i class="fa fa-sign-in"></i> Daftar Merchant Login
            </a>
          </li>
          <li id="menu_merchant_register">
            <a href="{{ URL::to('admin/merchant/registration') }}">
              <i class="fa fa-circle"></i> Daftar Merchant Register
            </a>
          </li>
        </ul>
      </li>
      <li id="menu_category">
        <a href="{{ URL::to('admin/category') }}">
          <i class="fa fa-home"></i> <span>Pengaturan Kategori</span>
        </a>
      </li>
      <li id="menu_coupon">
        <a href="{{ URL::to('admin/coupon') }}">
          <i class="fa fa-tags"></i> <span>Pengaturan Kupon</span>
        </a>
      </li>
      <li id="menu_config" class="treeview">
    <a href="#">
          <i class="fa fa-gear"></i> <span>Pengaturan Template</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
    <ul class="treeview-menu">
          <li id="menu_config_colour">
            <a href="{{ URL::to('admin/configColour') }}">
        <i class="fa fa-circle"></i> <span>Template Warna</span>
      </a>
          </li>
          <li id="menu_config_size">
            <a href="{{ URL::to('admin/configSize') }}">
        <i class="fa fa-circle"></i> <span>Template Ukuran</span>
      </a>
          </li>
          <li id="menu_config_description">
            <a href="{{ URL::to('admin/configDescription') }}">
        <i class="fa fa-circle"></i> <span>Template Deskripsi</span>
      </a>
        </ul>
      </li>
      <li id="menu_report" class="treeview">
		<a href="#">
          <i class="fa fa-book"></i> <span>Laporan Hasil</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
		<ul class="treeview-menu">
          <li id="menu_report_pending">
            <a href="{{ URL::to('admin/transactionReportPending') }}">
			  <i class="fa fa-circle"></i> <span>Laporan Hasil Pending</span>
			</a>
          </li>
          <li id="menu_report_reject">
            <a href="{{ URL::to('admin/transactionReportReject') }}">
        <i class="fa fa-circle"></i> <span>Laporan Hasil Reject</span>
      </a>
          </li>
          <li id="menu_report_final">
            <a href="{{ URL::to('admin/transactionReport') }}">
			  <i class="fa fa-circle"></i> <span>Laporan Hasil Akhir</span>
			</a>
          </li>
        </ul>
      </li>

      <li class="header">
        Konten
      </li>
      <li id="menu_banner">
        <a href="{{ URL::to('admin/banner') }}">
          <i class="fa fa-th"></i> <span>Banner</span>
        </a>
      </li>
      <li id="menu_promotions">
        <a href="{{ URL::to('admin/promotions') }}">
          <i class="fa fa-th"></i> <span>Promotions</span>
        </a>
      </li>
      <li id="menu_brands">
        <a href="{{ URL::to('admin/brands') }}">
          <i class="fa fa-th"></i> <span>Brands</span>
        </a>
      </li>
    </ul><!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>
