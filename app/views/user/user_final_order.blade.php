@extends('user.templates.layout')

@section('content')
<!-- CONTENT START -->
  <div class="content"> 
    
    <!--======= SUB BANNER =========-->
    <section class="sub-banner">
      <div class="container">
        <h4>TERIMA KASIH ATAS PEMESANAN <a href="{{URL::to('/user/transactionHistory')}}">#{{$transaction->id}}</a></h4>
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
          <li><a href="{{ URL::to('home')}}">Beranda</a></li>
          <li class="active">Pembelian Selesai</li>
        </ol>
      </div>
    </section>

    <!--======= PAGES INNER =========-->
    <section class="section-p-30px pages-in chart-page">
      <div class="container"> 
        
        <!-- Payments Steps -->
        <div class="payment_steps">
          <ul class="row">
            <!-- KERANJANG BELANJA -->
            <li class="col-sm-4"> <i class="fa fa-shopping-cart"></i>
              <h6>KERANJANG BELANJA</h6>
            </li>
            
            <!-- CHECK OUT DETAIL -->
            <li class="col-sm-4"> <i class="fa fa-align-left"></i>
              <h6>DETAIL PEMBAYARAN</h6>
            </li>
            
            <!-- ORDER COMPLETE -->
            <li class="col-sm-4 current"> <i class="fa fa-check"></i>
              <h6>PEMBELIAN SELESAI</h6>
            </li>
          </ul>
        </div>

        <p class="lead text-center">Barang yang dipesan akan sesegera mungkin dikonfirmasi dan dikirim kepada anda</p>

        <!-- Payments Steps -->
        <div class="shopping-cart text-center">
          <div class="cart-head">
            <ul class="row">
              <!-- PRODUCTS -->
              <li class="col-sm-3">
                <h6>PRODUK</h6>
              </li>
              <li class="col-sm-3">
                <h6>HARGA</h6>
              </li>
              <!-- DETAILS -->
              <li class="col-sm-3">
                <h6>DETAIL</h6>
              </li>
              <li class="col-sm-3">
                <h6>KURIR</h6>
              </li>
            </ul>
          </div>

          @foreach($final_cart as $product)
          <!-- Cart Details -->
          <ul class="row cart-details">
            <li class="col-sm-3">
              <div class="media"> 
                <!-- Media Image -->
                <div class="media-left media-middle"> <a href="{{URL::to('productDetail/'.$product->id)}}" class="item-img"> <img class="media-object" src="{{URL::to($product->image_link)}}" alt=""> </a> </div>
                
              </div>
            </li>
            <li class="col-sm-3">
              <div class="media"> 
                
                
                <!-- Item Name -->
                <div class="media-body">
                  <div class="position-center-center">
                    
                    <div class="price">
                      @if( $product->discount_date_start >= date("Y-m-d") && $product->discount_date_end <= date("Y-m-d") && $product->discount > 0)
                      <span class="price-sales"> 
                          <?php $priceNow = ((100 - $product->discount) * $product->price / 100) + $kurir['harga']; ?> Rp. {{number_format($priceNow,2,',','.')}}
                      </span> <br>
                      @else
                      @endif
                      <span>Rp. {{number_format($transaction->total,2,',','.')}}</span>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="col-sm-3">
              <div class="media"> 

                
                <!-- Item Name -->
                <div class="media-body">
                  <div class="position-center-center">
                    <table style="font-size: 12px;">
                      <tr>
                        <td>Jumlah</td>
                        <td>:</td>
                        <td>{{$final_cart_data[$product->id]['quantity']}}</td>
                      </tr>
                      <tr>
                        <td>Warna</td>
                        <td>:</td>
                        <td>{{$final_cart_data[$product->id]['color']}}</td>
                      </tr>
                      <tr>
                        <td>Ukuran</td>
                        <td>:</td>
                        <td>{{$final_cart_data[$product->id]['size']}}</td>
                      </tr>
                    </table>             
                    
                  </div>
                </div>
              </div>
            </li>
            <li class="col-sm-3">
              <div class="media"> 

                
                <!-- Item Name -->
                <div class="media-body">
                  <div class="position-center-center">
                   <table style="font-size: 12px;">
                      <tr>
                        <td>Kurir</td>
                        <td>:</td>
                        <td style="text-transform: uppercase;">{{$kurir['kurir']}}</td>
                      </tr>
                      <tr>
                        <td>Paket</td>
                        <td>:</td>
                        <td>{{$kurir['paket']}}</td>
                      </tr>
                      <tr>
                        <td>Harga</td>
                        <td>:</td>
                        <td>{{$kurir['harga']}}</td>
                      </tr>
                    </table> 
                  </div>
                </div>
              </div>
            </li>
          </ul>
          @endforeach

          <!-- BTN INFO -->
          <div class="btn-sec"> 
            <!-- UPDATE SHOPPING CART --> 
            <a href="{{URL::to('/user/transactionHistory')}}" class="btn btn-dark"> <i class="fa fa-arrow-circle-o-up"></i> LIHAT PEMESANAN </a> 
            <!-- CONTINUE SHOPPING --> 
            <a href="{{URL::to('/')}}" class="btn btn-dark right-btn"> <i class="fa fa-shopping-cart"></i> LANJUTKAN BELANJA </a>
          </div>



          <!-- SHOPPING INFORMATION -->
          <div class="cart-ship-info">
            <div class="row"> 
              
              <!-- ESTIMATE SHIPPING & TAX -->
              <div class="col-sm-8">
                <p>Total pembelian anda sebesar <strong class="text-info">Rp. {{number_format($transaction->total, 0, '', '.');}},- </strong>(sudah termasuk ongkos kirim)</p>
                    <ul class="padbottom">
                    <li>Silahkan di transfer sebelum ({{ date_format(new datetime($batas_pembayaran), 'g:ia jS F Y') }}) ke salah satu nomor rekening yang tertera dibawah ini.<strong>(BCA)</strong></li>
                    <li>Setelah itu masukkan nomor rekening yang anda gunakan dan nominal yang di transfer pada kotak <strong>Konfirmasi Pembayaran</strong> untuk melanjutkan transaksi.</li>
                <div>
                <h6 style="margin-top:25px">NO. REKENING BANDUNGMALL.COM</h6>
                  <table class="table">
                    <tr>
                      <th scope="row">BCA</th>
                      <td>2820105586</td>
                      <td>an. cv nusantara artifisial</td>
                    </tr>
                  </table>
                </div>
              </div>
              
              <!-- SUB TOTAL -->
              <div class="col-sm-4">
                <div class="grand-total"> 
                  <h4>KONFIRMASI PEMBAYARAN </span></h4>
                  <form action="{{ URL::to('user/doInsertPaymentConfirmation') }}" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <p class="text-left">Upload Bukti:</p>
                      <input type="file" name="images[]" id="images" class="form-control" required/>
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="transaction_id" value="{{$transaction->id}}" />
                      <button style="margin-top:20px;" class="btn" type="submit" title="checkout" href="{{URL::to('/checkout')}}">UPLOAD</button> 
                    </div>
                  </form>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </section>

  </div>
  
@endsection
<script type="text/javascript">
function run(){
    var bank_id = $("#bankSelector").val();
    $.ajax({
        data: 'bank_id='+bank_id,
        url: "getAccountBank", 
        success: function(result){
            if(result.length > 0){
                $("#account_name").val(result[0]['nama_rekening']);
                $("#account_number").val(result[0]['no_rekening']);
            }else{
                $("#account_name").val('');
                $("#account_number").val('');
            }
        }
    });
    document.getElementById("bank_id").value = document.getElementById("bankSelector").value;
}
</script>