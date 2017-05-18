@extends('layout.merchant')

@section('isi')
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div id="bordered">
              <div class="row">
                    <div class="col-sm-12">
                      <div class="order-head">
                            <li>Order ID: {{$transaction->id}}</li>
                            <li>Tanggal Order: {{date_format(new datetime($transaction->created_at), 'g:ia jS F Y')}}</li>
                            <li>Paket Pengiriman: {{$transaction->shipping_choice.'/'.$transaction->shipping_type}}</li>
                            <li>Nama Penerima: {{$transaction->first_name}} {{$transaction->last_name}}</li>
                            <li>Alamat: {{$transaction->user_address}}</li>
                            <li>Kota: {{$transaction->city}}</li>
                            <li>Kode Pos: {{$transaction->postal_code}}</li>
                            <li>No. Telp: {{$transaction->phone_number}}</li>

                            @if($transaction_resi)
                            <li>No. Resi: {{$transaction_resi->resi}}</li>
                            @else
                            <li>Input No. Resi</li>
                            <form class="col-sm-6" action="{{URL::to('merchant/acceptedOrderDetail/doInsertResi')}}" method="post">
                              <input class="form form-control" type="text" name="resi">
                              <input type="hidden" name="transaction_id" value="{{$transaction->id}}">
                              <input type="hidden" name="merchant_id" value="{{$merchant_id}}">
                              <input class="btn btn-primary" type="submit" value="Save">
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                  <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                          <tr>
                            <th scope="col">Foto</th>
                            <th scope="col">Barang</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Total</th>
                          </tr>
                          <?php $totalBerat=0;
                        $subtotal=0;
                      ?>
                      <?php $totalBerat=0;
                        $subtotal=0;
                      ?>
                      @foreach($transaction_details as $detail)
                      <tr>
                        <td><img class="img-responsive" src="{{asset(''.$detail->image_link)}}" width="50" height="50" /></td>
                        <td>{{$detail->name}}<br />{{$detail->brand}}</td>

                        <td>
                          <?php $temp = $detail->price; ?>
                          <p>Rp. {{number_format($detail->price, 0, '', '.');}} ,-</p>
                        </td>
                                                
                        <td>{{$detail->quantity}}</td>
                        <td>Rp. {{number_format($temp*$detail->quantity, 0, '', '.');}},-</td>
                        <?php $subtotal += ($temp*$detail->quantity)?>
                      </tr>
                      @endforeach
                        <tr>
                            <th colspan="4">Total</th>
                            <td>Rp. {{number_format($subtotal, 0, '', '.');}},-</td>
                        </tr>
						
                        </table>
                      </div>
                    </div>
              </div>
           
        </div>
</div>
@stop