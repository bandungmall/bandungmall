@extends('admin.templates.layout')

@section('content')
  <div class="col-sm-8 col-md-9 col-xs-12 contentwrap">
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
                    <button style="background-color:#337ab7; color:white;" class="btn btn-category btn-block product_side_bar" id="product_side_bar">Merchant : {{$merchant->shop_name}}</button>
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
                              <td><img class="img-responsive" src="{{asset($detail->image_link)}}" width="50" height="50" /></td>
                              <td>{{$detail->name}}<br />{{$detail->brand}}</td>
                              
                              <td>Rp. {{number_format($detail->price, 0, '', '.');}},-</td>
                              <td>{{$detail->quantity}}</td>
                              <td>Rp. {{number_format($detail->price*$detail->quantity, 0, '', '.');}},-</td>
                              
                              <?php $subtotal += ($detail->price*$detail->quantity)?>
                            </tr>
                          @endif
                        @endforeach
                          <tr>
                              <th colspan="4">Total</th>
                              <td>Rp. {{number_format($subtotal, 0, '', '.');}},-</td>
                          </tr>
              
                          <tr>
                              <th colspan="4">Ongkir</th>
                              <td>Rp. {{number_format($merchant->shipping_price, 0, '', '.');}},-</td>
                          </tr>
                          <tr>
                              <th colspan="4">Total Akhir</th>
                              <th>Rp. {{number_format(($subtotal+$merchant->shipping_price), 0, '', '.');}},-</th>
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

              	@if(isset($user_confirmation_payment))
                <div class="konfirmasi-line">
                    	<div class="row">
                        	<div class="col-sm-10 col-xs-10">
                                <div class="alert"><strong>{{$user_confirmation_payment->first_name.' '.$user_confirmation_payment->last_name}}</strong><br />
                                No rekening: {{$user_confirmation_payment->account_number}}<br />
                                Nominal: Rp. {{number_format($user_confirmation_payment->amount, 0, '', '.');}},-<br />
                                Transfer ke: rekening {{$user_confirmation_payment->account_bank}} CV Nusantara Artifisial<br />
                                Tanggal: {{date_format(new datetime($user_confirmation_payment->created_at), 'g:ia jS F Y')}}</div>
                           	</div>
                            <div class="col-sm-2 col-xs-2">
                            @if($transaction->paid =='no')
                              <div class="alert-danger" align="center">Paid : {{$transaction->paid}}</div>
                            @else
                            	<div class="alert-success" align="center">Paid : {{$transaction->paid}}</div>
                            @endif
                            </div>
                            
                       	</div>
                    @if($transaction->paid =='no')
                      <div class="row">
                      <form action="{{URL::to('admin/merchant/doInformMerchant')}}" method="post">
                      	<input type="hidden" name="merchant_id" value="{{$detail_transactions[0]->merchant_id}}" />
                      	<input type="hidden" name="transaction_id" value="{{$detail_transactions[0]->transaction_id}}" />
                          <div class="col-sm-12" align="right">
                              <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Sudah di transfer</button>
                          </div>
                      </form>
                      </div>
                    @endif
                </div>
                @else
                <div class="konfirmasi-line">
                    	<div class="row">
                        	<h1></h1>
                       	</div>

                </div>
                @endif
            </div>
        </div>
   	</div>
</div>
</div>
@endsection
@section('javascript')
   <script type="text/javascript">
   $(function(){
    $("#menu_user").addClass("active");
    $("#menu_user ul").addClass("menu-open");
    $("#menu_user ul").attr("style","display:block");
    $("#menu_user #menu_user_transaction").addClass("active");

   });
  </script>
@endsection