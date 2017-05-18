@extends('merchant.templates.layout')

@section('stylesheet')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('public/assets/merchant/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection


@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Daftar Produk
    </h1>

    <a href="{{ URL::to('merchant/addProduct') }}" class="btn btn-success" style="position: absolute; top: 15px; right: 15px"><i class="fa fa-plus-circle"></i> Tambah Produk</a>
  </section>

  <!-- Main content -->
  <section class="content">
    {{-- @include('merchant.product_list.boxed') --}}
    @include('merchant.product_list.table')
  </section><!-- /.content -->
@endsection


@section('javascript')
  <!-- DataTables -->
  <script src="{{ asset('public/assets/merchant/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('public/assets/merchant/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
  
  <!-- Page Script -->
  <script>
    $(function () {
      // Activate Sidebar Menu
      $("#menu_product_list").closest("li").addClass("active");
      $("#menu_product").closest("li").addClass("active");

      $("#products").DataTable( {
              "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
    scrollX: true
} );
    });
  </script>
@endsection
