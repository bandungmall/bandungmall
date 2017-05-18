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
                            <li>Nama Penerima: {{$transaction->user_name}}</li>
                            <li>Alamat: {{$transaction->user_address}}</li>
                            <li>Kota: {{$transaction->city}}</li>
                            <li>Kode Pos: {{$transaction->postal_code}}</li>
                            <li>No. Telp: {{$transaction->phone_number}}</li>
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
                        <td><img class="img-responsive" src="{{asset('public/'.$detail->image_link)}}" width="50" height="50" /></td>
                        <td>{{$detail->name}}<br />{{$detail->brand}}</td>
                        <td>Rp. {{number_format($detail->price, 0, '', '.');}},-</td>
                        <td>{{$detail->quantity}}</td>
                        <td>Rp. {{number_format($detail->price*$detail->quantity, 0, '', '.');}},-</td>
                        <?php $subtotal += ($detail->price*$detail->quantity)?>
                      </tr>
                      @endforeach
                        <tr>
                            <th colspan="4">Total</th>
                            <td>Rp. {{number_format($subtotal, 0, '', '.');}},-</td>
                        </tr>
            
                        <tr>
                            <th colspan="4">Ongkir</th>
                            <td>Rp. {{number_format($transaction_details[0]->shipping_price, 0, '', '.');}},-</td>
                        </tr>
                        <tr>
                            <th colspan="4">Total Akhir</th>
                            <th>Rp. {{number_format(($subtotal+$transaction_details[0]->shipping_price), 0, '', '.');}},-</th>
                        </tr>
                        </table>
                      </div>
                      @if(!isset($transaction_resi))
                        <div class="row">
                          <div class="col-xs-12 col-sm-6" style="margin-top:10px">
                            <form action="{{URL::to('merchant/acceptedOrderDetail/doInsertResi')}}" method="post"/>
                              <input type="hidden" value="{{$transaction_details[0]->transaction_id}}" name="transaction_id" />
                              <input type="hidden" value="{{$transaction_details[0]->merchant_id}}" name="merchant_id" />
                              <input type="text" name="resi" class="form-control" placeholder="no resi" style="margin-bottom:5px;" required/>
                              <button type="submit" class="btn btn-success">Submit</button>
                            </form>
                          </div>
                        </div>
                      @else
                        <div class="row">
                          <div class="col-xs-12 col-sm-6" style="margin-top:10px">
                            <h3>Resi Disimpan {{date_format(new datetime($transaction_resi->created_at), 'g:ia jS F Y')}} : {{$transaction_resi->resi}}</h3>
                          </div>
                        </div>
                      @endif
                    </div>
              </div>
           
        </div>
</div>
@stop