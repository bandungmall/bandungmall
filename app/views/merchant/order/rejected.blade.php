
<!-- Approved Orders -->
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Order Ditolak</h3>
  </div><!-- /.box-header -->
  <div class="box-body">
    <table id="order-rejected" class="table table-bordered table-hover">
      <thead>
        <tr>
          <th scope="col">Order ID</th>
          <th scope="col">Nama Customer</th>
          <th scope="col">Kurir/Paket</th>
          <th scope="col">Status</th>
          <th scope="col">Opsi</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($rejected_transactions as $transaction)
        <tr>
          <td>{{ $transaction->id }}
          <td>{{ $transaction->first_name }}&nbsp{{ $transaction->last_name }}</td>
          <td>.{{ $transaction->shipping_choice }}/{{ $transaction->shipping_type }}</td>
          @if(isset($transaction->resi))
            <td class="alert-success">Dikirim</td>
          @else
            <td class="alert-danger">Belum dikirim</td>
          @endif
          <td class="nols">
              <a href="{{ URL::to('merchant/rejectedOrderDetail/'.$transaction->id) }}"><li><span class="glyphicon glyphicon-file"></span> Detail</li></a>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div><!-- /.box-body -->
</div><!-- /.Approved Orders -->