@extends('admin.templates.layout')

@section('content')
  <section class="content-header">
    <h1>
      Notifikasi
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
    <!-- Notifikasi -->
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-user"></i> Notifikasi User</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
              <table style="text-transform: capitalize;" id="listNotifUser" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Transaksi ID</th>
                    <th scope="col">Transaksi Waktu</th>
                    <th scope="col">Notifikasi</th>
                  </tr>
                </thead>
                <tbody>
                {{--*/ $x = 1 /*--}}
                @foreach($transaction_notifications as $notif)
                  <tr>
                    <td>{{$x}}</td>
                    <td>#{{ $notif->transaction_id }}</td>
                    <td><small><strong>{{ date_format(new datetime($notif->created_at), 'g:ia jS F Y') }}</strong></small></td>
                  <td>{{ $notif->notification }}</td>
                  </tr>
                  {{--*/ $x++ /*--}}
                @endforeach
                </tbody>
              </table>
          </div><!-- /.box-footer -->
        </div><!-- /.box -->
      </div>
    </div>
    <div class="row">
    <!-- Notifikasi -->
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-users"></i> Notifikasi Merchant</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
              <table style="text-transform: capitalize;" id="listNotifMerchant" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Transaksi ID</th>
                    <th scope="col">Transaksi Waktu</th>
                    <th scope="col">Notifikasi</th>
                  </tr>
                </thead>
                <tbody>
                <?php $x=1;?>
                @foreach($transaction_detail_notifications as $notif)
                  <tr>
                    <td>{{$x}}</td>
                    <td>#{{ $notif->transaction_id }}</td>
                    <td><small><strong>{{ date_format(new datetime($notif->created_at), 'g:ia jS F Y') }}</strong></small></td>
                  <td>{{ $notif->notification }}</td>
                  </tr>
                  <?php $x++;?>
                @endforeach
                </tbody>
              </table>
          </div><!-- /.box-footer -->
        </div><!-- /.box -->
      </div>
    </div>

   

  </section><!-- /.content -->
@endsection


@section('javascript')
  <!-- Page script -->
  <script>
    $(function () {
      // Activate Sidebar Menu
      $("#menu_home").closest("li").addClass("active");
      $("#listNotifUser").DataTable({
       "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
           scrollX: true
      });
      $("#listNotifMerchant").DataTable({
       "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
           scrollX: true
      });
    });
  </script>
@endsection
