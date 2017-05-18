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
                <h4>Pesanan #{{$transaction_detail[0]->transaction_id}}</h4>
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
                        @foreach($transaction_detail as $detail)
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
                      <th>Rp. {{number_format(($transaction_detail[0]->total), 0, '', '.');}},-</th>
                  </tr>
                </table>

                <div class="konfirmasi-line">
                      <div class="row">
                        <div class="col-sm-10 col-xs-10">
                            <div class="alert">
                              @foreach($transaction_notifications as $notif)
                                {{date_format(new datetime($notif->created_at), 'g:ia jS F Y')}}</br>
                                {{$notif->notification}}</br></br>
                              @endforeach
                            </div>
                          </div>
                          <div class="col-sm-2 col-xs-2">
                          @if($transaction->paid =='no')
                            <div class="alert-danger" align="center">Paid : {{$transaction->paid}}</div>
                          @else
                            <div class="alert-success" align="center">Paid : {{$transaction->paid}}</div>
                          @endif
                          <br>
                          @if($user_confirmation_payment)
                              <img src="{{asset($user_confirmation_payment->image_link)}}" width="200"/>
                              @endif
                          </div>
                      </div>
                </div>
            </div>
        </div>
   	</div>
</div>
</div>
@endsection
@section('javascript')
   <script type="text/javascript">
   $(function(){
    $("#menu_transaction").addClass("active");
    $("#menu_transaction ul").addClass("menu-open");
    $("#menu_transaction ul").attr("style","display:block");

    $("#listTransaction").DataTable({
       "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]]
    });

    $("#clearFilter").click(function(){
      alert("a");
      
    });
   });
   function confirmation(link){
    if(confirm("Are you sure?")){
      location.href = link;
    }
    return false;
  }
  </script>
@endsection