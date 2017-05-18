<!-- Order Baru -->
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Order Baru</h3>
  </div><!-- /.box-header -->
  <div class="box-body">
    <table id="order-pending" class="table table-bordered table-hover">
      <thead>
        <tr>
          <th scope="col">Order ID</th>
          <th scope="col">Nama Customer</th>
          <!-- <th scope="col">Total</th> -->
          <th scope="col">Kurir/Paket</th>
          <th scope="col">Opsi</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($transactions as $transaction)
        <tr>
          <td>{{ $transaction->id }}</td>
          <td>{{ $transaction->first_name }}&nbsp{{ $transaction->last_name }}</td>
          <td>.{{ $transaction->shipping_choice }}/{{$transaction->shipping_type}}</td>
          <td class="nols">
              <a href="{{ URL::to('merchant/orderDetail/'.$transaction->id) }}"><li><span class="glyphicon glyphicon-file"></span> Detail</li></a>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div><!-- /.box-body -->
</div><!-- /.Order Baru -->
