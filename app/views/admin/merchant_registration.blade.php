@extends('admin.templates.layout')


@section('content')
  <section class="content-header">
    <h1>
      Registered Merchant
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Pending Merchant</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="pending-merchant" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Seller</th>
                  <th scope="col">Toko</th>
                  <th scope="col">Telepon</th>
                  <th scope="col">Email</th>
                  <th scope="col">Nama Perusahaan</th>
                  <th scope="col">Nama Pemilik</th>
                  <th scope="col">No KTP</th>
                  <th scope="col">Barang Dikirim Dari</th>
                  <th scope="col">Rekening</th>
                  <th scope="col">Accept</th>
                  <th scope="col">Decline</th>
                </tr>
              </thead>
              <tbody>
              @foreach($merchants as $merchant)
                <tr>
                  <td>{{$merchant->id}}</td>
                  <td>{{$merchant->name}}</td>
                  <td>{{$merchant->shop_name}}</td>
                  <td>{{$merchant->phone_number}}</td>
                  <td>{{$merchant->email}}</td>
                  <td>{{$merchant->company_name}}</td>
                  <td>{{$merchant->person_in_charge}}</td>
                  <td>{{$merchant->ic_number}}</td>
                  <td>{{$merchant->city_from}}</td>
                  <td>{{$merchant->account_number.' / '.$merchant->account_name.' / '.$merchant->account_bank}}</td>
                  <td><a href="#"  onclick="confirmation('doAcceptMerchantRegistration?id=<?php echo $merchant->id; ?>');"><span class="glyphicon glyphicon-ok"></span></a></td>
                  <td><a href="#"  onclick="confirmation('doDeclineMerchantRegistration?id=<?php echo $merchant->id; ?>');"><span class="glyphicon glyphicon-remove"></span></a></td>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div><!-- /.box-body -->
        </div>
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
    function confirmation(link){
      if(confirm("Are you sure?")){
        location.href = link;
      }
      return false;
    }
    $(function () {
      // Activate Sidebar Menu
      $("#menu_merchant_register").closest("li").addClass("active");
      $("#menu_merchant").closest("li").addClass("active");

      $("#pending-merchant").DataTable({
       "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
           scrollX: true
});
    });
  </script>
@endsection
