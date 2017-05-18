@extends('merchant.templates.layout')

@section('stylesheet')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('public/assets/merchant/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection


@section('content')
  <section class="content-header">
    <h1>
      Order
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        @include('merchant.order.new')
        @include('merchant.order.approved')
		@include('merchant.order.rejected')
		@include('merchant.order.sent')
    @include('merchant.order.received')
      </div><!-- /.col -->
    </div><!-- /.row -->
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
      $("#menu_order").closest("li").addClass("active");

      $("#order-pending").DataTable({
        "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
    scrollX: true
      });
      $("#order-approved").DataTable({
        "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
    scrollX: true
      });
      $("#order-rejected").DataTable({
        "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
    scrollX: true
      });
      $("#order-sent").DataTable({
        "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
    scrollX: true
      });
      $("#order-received").DataTable({
        "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
    scrollX: true
      });
    });
  </script>
@endsection
