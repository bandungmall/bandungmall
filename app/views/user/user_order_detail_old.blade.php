@extends('layout.frontend')

@section('isi')
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3">
          <div class="sidemenuwrap">
            <ul class="nav nav-pills nav-stacked">
              <li><a href="{{URL::to('user/home')}}">Akun saya</a></li>
              <li><a href="{{URL::to('user/myAccount')}}">Informasi akun saya</a></li>
              <li class="active"><a href="{{URL::to('user/order')}}">Check pesanan</a></li>
              <li><a href="{{URL::to('user/transactionHistory')}}">Riwayat pesanan</a></li>
              <hr />
              {{--<li><a href="{{URL::to('user/downline')}}">Check downline</a></li>--}}
              {{--<li><a href="{{URL::to('user/income')}}">Check penghasilan</a></li>--}}
              <li><a href="{{URL::to('user/doLogout')}}">Log out</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-9">
              <div id="bordered">
                <div class="row">
        	<div class="col-sm-12 customertransaksiwrap">
            	<div class="wrap-header">
            		<h4>Detail Transaksi</h4>
                </div>
                <div class="wrap-content">
                <div id="pesanan">
                <h4>Pesanan #{{$detail_transactions[0]->transaction_id}}</h4>
                <div class="table-responsive">
                  @foreach($merchants as $merchant)
                  <div>
                    <button style="background-color:#337ab7; color:white;" class="btn btn-category btn-block product_side_bar" id="product_side_bar">
                      <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span>
                      Merchant : {{$merchant->shop_name}}
                    </button>
                    <div id="product_side_bar_child" class="product_side_bar_child">
                      <table width="200" border="0" class="table table-condensed table-bordered">
                        <tr>
                          <th scope="col" colspan="2">Barang</th>
                          <th scope="col">Harga</th>
                          <th scope="col">Kuantitas</th>
                          <th scope="col">Subtotal</th>
                        </tr>
                        <?php $totalBerat=0;
                          $subtotal=0;
                        ?>
                        @foreach($detail_transactions as $detail)
                          @if($detail->merchant_id ==$merchant->merchant_id)
                            <tr>
                              <td><img class="img-responsive" src="{{asset('public/'.$detail->image_link)}}" width="50" height="50" /></td>
                              <td>{{$detail->name}}<br />{{$detail->brand}}</td>
                              
                              <td>Rp. {{number_format($detail->price, 0, '', '.');}}</td>
                              <td>{{$detail->quantity}}</td>
                              <td>Rp. {{number_format($detail->price*$detail->quantity, 0, '', '.');}}</td>
                              
                              <?php $subtotal += ($detail->price*$detail->quantity)?>
                            </tr>
                          @endif
                        @endforeach
                          <tr>
                              <th colspan="4">Total</th>
                              <td>Rp. {{number_format($subtotal, 0, '', '.');}}</td>
                          </tr>
              
                          <tr>
                              <th colspan="4">Ongkir</th>
                              <td>Rp. {{number_format($merchant->shipping_price, 0, '', '.');}}</td>
                          </tr>
                          <tr>
                              <th colspan="4">Total Akhir</th>
                              <th>Rp. {{number_format(($subtotal+$merchant->shipping_price), 0, '', '.');}}</th>
                          </tr>
                          <tr>
                              <th>Resi</th>
                              <?php $check = 0 ?>
                              @if(!empty($resi_transactions[0]))
                                @foreach($resi_transactions as $resi)
                                  @if($resi->merchant_id ==$merchant->merchant_id)
                                    <th colspan="4">{{$resi->resi.'<br/>'}}</th>
                                    <?php $check = 1?>
                                  @endif
                                @endforeach
                              @endif
                              @if($check ==0)
                                <th colspan="4">Belum Tersedia</th>
                              @endif
                          </tr>
                          @foreach($transaction_detail_notifications as $notif)
                            @if($notif->merchant_id ==$merchant->merchant_id)
                              <tr>
                                  <th colspan="3">{{$notif->notification}}</th>
                                  <th colspan="2">{{date_format(new datetime($notif->created_at), 'g:ia jS F Y')}}</th>
                              </tr>
                            @endif
                          @endforeach
                      </table>
                    </div>
                  </div>
                  @endforeach
              	</div>

                <table class="table table-condensed table-bordered">
                  <tr>
                      <th>Grand Total</th>
                      <th>Rp. {{number_format(($detail_transactions[0]->total), 0, '', '.');}},-</th>
                  </tr>
                </table>

                <table class="table table-condensed table-bordered">
                  <tr>
                    <th colspan="2" style="background-color:#337ab7; color:white;">
                      Notifikasi Transaksi
                    </th>
                  </tr>
                  @foreach($transaction_notifications as $notif)
                    <tr>
                        <th>{{$notif->notification}}</th>
                        <th>{{date_format(new datetime($notif->created_at), 'g:ia jS F Y')}}</th>
                    </tr>
                  @endforeach
                </table>



                @if(!isset($user_confirmation_payment))
              		<h3>Konfirmasi Pembayaran</h3>
              		<hr />
                  <form action="{{URL::to('user/doInsertPaymentConfirmation')}}" method="post" role="form">
                  	<div class="form-group">
                  		<label for="norek">Bank Rekening:</label>
                  		<input type="text" name="account_bank" class="form-control" id="norek" placeholder="Bank rekening anda" />
                  	</div>
                  	<div class="form-group">
                  		<label for="norek">Nama Rekening:</label>
                  		<input type="text" name="account_name" class="form-control" id="norek" placeholder="Nama rekening anda" />
                  	</div>
                  	<div class="form-group">
                  		<label for="norek">Nomor Rekening:</label>
                  		<input type="text" name="account_number" class="form-control" id="norek" placeholder="Nomor rekening anda" />
                  	</div>
                      <div class="form-group">
      		            <label for="nominal">Nominal:</label>
                      <input type="text" name="amount" class="form-control" id="nominal" placeholder="Nominal yang anda transfer" />
                    </div>
                    <div class="form-group">
    		              <label for="tiperek">Tujuan Transfer:</label>
                      <select name="account_destination" class="form-control" id="tiperek">
                        <option value="bca">BCA CV Nusantara Artifisial</option>
                        <!-- <option value="mandiri">Mandiri PT. goget</option> -->
                      </select>
                    </div>
                    <input type="hidden" name="transaction_id" value="{{$detail_transactions[0]->transaction_id}}" />
                    <button class="btn btn-primary" type="submit">Konfirmasi</button>
                  </form>
                @else
                  <h3>Pembayaran sudah di konfirmasi</h3>
                  <hr />
                  <div class="col-sm-9">
                    <h5>Bank Rekening:</h5>
                    {{$user_confirmation_payment->account_bank}}
                    <h5>Nama Rekening:</h5>
                    {{$user_confirmation_payment->account_name}}
                    <h5>Nomor Rekening:</h5>
                    {{$user_confirmation_payment->account_number}}
                    <h5>Nominal:</h5>
                    Rp. {{number_format($user_confirmation_payment->amount, 0, '', '.');}}
                    <h5>Tujuan Transfer:</h5>
                    {{$user_confirmation_payment->account_destination}}
                  </div>
                @endif
            </div>
        </div>
   	</div>
</div>
              </div>
            </div>
      </div>
    </div>
@stop