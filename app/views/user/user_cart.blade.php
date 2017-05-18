@extends('user.templates.layout')

@section('content')
  <!-- CONTENT START -->
  <div class="content"> 
    
    <!--======= SUB BANNER =========-->
    <section class="sub-banner animate fadeIn" data-wow-delay="0.4s" style="border:0 none !important;">
      <div class="container">
        <h4>KERANJANG BELANJA</h4>
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
          <li><a href="#">Beranda</a></li>
          <li class="active">Keranjang Belanja</li>
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
            <li class="col-sm-4 current"> <i class="fa fa-shopping-cart"></i>
              <h6>KERANJANG BELANJA</h6>
            </li>
            
            <!-- CHECK OUT DETAIL -->
            <li class="col-sm-4"> <i class="fa fa-align-left"></i>
              <h6>DETAIL PEMBAYARAN</h6>
            </li>
            
            <!-- ORDER COMPLETE -->
            <li class="col-sm-4"> <i class="fa fa-check"></i>
              <h6>PEMBELIAN SELESAI</h6>
            </li>
          </ul>
        </div>
        
        <!-- Payments Steps -->
        <div class="shopping-cart text-center">
          <div class="cart-head">
            <ul class="row">
              <!-- PRODUCTS -->
              <li class="col-sm-3">
                <h6>PRODUK</h6>
              </li>
              <!-- DETAILS -->
              <li class="col-sm-3">
                <h6>DETAIL</h6>
              </li>
              <!-- QNT -->
              <li class="col-sm-1">
                <h6>JUMLAH</h6>
              </li>
              <!-- DISCOUNT -->
              <li class="col-sm-2">
                <h6>DISKON</h6>
              </li>
              <!-- TOTAL PRICE -->
              <li class="col-sm-2">
                <h6>TOTAL HARGA</h6>
              </li>
              <li class="col-sm-1"> </li>
            </ul>
          </div>

          <?php
            $totalPrice = 0;
            $totalDiscount = 0;
            $finalPrice = 0;
          ?>
          
          @if (is_array($cart_data) || is_object($cart_data))
          @foreach($cart_data as $product_in_cart)
          <!-- Cart Details -->
          <ul class="row cart-details">
            <li class="col-sm-3">
              <div class="media"> 
                <!-- Media Image -->
                <div class="media-left media-middle"> <a href="productDetail/{{$product_in_cart->id}}" class="item-img"> <img class="media-object" src="{{$product_in_cart->image_link}}" alt=""> </a> </div>
                
              </div>
            </li>
            <li class="col-sm-3">
              <div class="media"> 
                
                
                <!-- Item Name -->
                <div class="media-body">
                  <div class="position-center-center">
                    <h6>{{$product_in_cart->name}}</h6>
                    @if( $product_in_cart->discount > 0 && strtotime(date('Y-m-d')) >= strtotime($product_in_cart->discount_date_start)  && strtotime(date('Y-m-d')) <= strtotime($product_in_cart->discount_date_end))
                    <?php
                      $dis_price = $product_in_cart->price - ($product_in_cart->price * ($product_in_cart->discount/100));
                    ?>
                    <div class="text-line"><span>Rp. {{number_format($product_in_cart->price,2,',','.')}}</span></div>
                    <div class="price"><span>Rp. {{number_format($dis_price,2,',','.')}}</span></div>
                    @else
                    <div class="price"><span>Rp. {{number_format($product_in_cart->price,2,',','.')}}</span></div>
                    @endif
                    
                    @if($cart_session[$product_in_cart->id]['size'] != "no_size")
                    <div><span>{{$cart_session[$product_in_cart->id]['size']}}</span></div>
                    @endif

                    @if($cart_session[$product_in_cart->id]['color'] != "no_color")
                    <div><span>{{$cart_session[$product_in_cart->id]['color']}}</span></div>
                    @endif
                  </div>
                </div>
              </div>
            </li>
            
            <!-- QTY -->
            <li class="col-sm-1">
              <div class="position-center-center">
                <h6><?php echo $cart[$product_in_cart['id']]['quantity']?>
                </h6>
              </div>
            </li>
            
            <!-- DISCOUNT -->
            <li class="col-sm-2">
              <div class="position-center-center"> 
                <span> 
                @if( $product_in_cart->discount > 0 && strtotime(date('Y-m-d')) >= strtotime($product_in_cart->discount_date_start)  && strtotime(date('Y-m-d')) <= strtotime($product_in_cart->discount_date_end))
                {{$product_in_cart->discount}}%
                @else
                0%
                @endif
                </span>
              </div>
            </li>
            <!-- TOTAL PRICE -->
            <li class="col-sm-2">
              <div class="position-center-center"> 
                <span><?php
                  $totalPrice = $totalPrice + $product_in_cart->price *  $cart[$product_in_cart['id']]['quantity'];
                  if( $product_in_cart->discount > 0 && strtotime(date('Y-m-d')) >= strtotime($product_in_cart->discount_date_start)  && strtotime(date('Y-m-d')) <= strtotime($product_in_cart->discount_date_end)){ 
                      
                      $totalDiscount = $totalDiscount + ($product_in_cart->discount/100) * $product_in_cart->price * $cart[$product_in_cart['id']]['quantity'];
                      $priceNow = (100 - $product_in_cart->discount) * $product_in_cart->price / 100 ;
                      
                  } else {
                      $priceNow = $product_in_cart->price;

                  }
                  $finalPrice = $finalPrice + $priceNow * $cart[$product_in_cart['id']]['quantity'];
                  echo "Rp. ".number_format(($priceNow * $cart[$product_in_cart['id']]['quantity']),2,',','.');
                ?></span> 
              </div>
            </li>
            
            <!-- EDIT AND REMOVE -->
            <li class="col-sm-1">
              <div class="position-center-center"><a href="cart/delete?product_id={{$product_in_cart->id}}"><i class="fa fa-trash"></i></a> </div>
            </li>
          </ul>
          @endforeach
          @else
            <p><span class="price">Belum terdapat produk silahkan pilih produk yang anda inginkan</span></p>
          @endif

          <!-- BTN INFO -->
          <div class="btn-sec"> 
            <!-- UPDATE KERANJANG BELANJA --> 
            <a href="{{URL::to('/cart/refresh')}}" class="btn btn-dark"> <i class="fa fa-arrow-circle-o-up"></i> UBAH KERANJANG BELANJA </a> 
            <!-- CONTINUE SHOPPING --> 
            <a href="{{URL::to('/')}}" class="btn btn-dark right-btn"> <i class="fa fa-shopping-cart"></i> LANJUTKAN BELANJA </a>
          </div>

          <!-- SHOPPING INFORMATION -->
          <div class="cart-ship-info">
            <div class="row"> 
              
              <!-- ESTIMATE SHIPPING & TAX -->
              <div class="col-sm-8">
                <h6>SUMMARY</h6>
                <div>
                  <table class="table">
                    <tr>
                      <th>TOTAL PRODUK</th>
                      <td> 
                        @if(Session::has('cartQty'))
                          {{Session::get('cartQty')}}       
                        @else
                          0
                        @endif
                      </td>
                    </tr>
                    <!-- <tr>
                      <td>Shipping</td>
                      <td>Tarif JNE</td>
                    </tr> -->
                    <tr>
                      <td>Harga Sebelum Diskon</td>
                      <td>Rp. {{number_format($totalPrice,2,',','.')}}</td>
                    </tr>
                    <tr>
                      <td>Total Diskon</td>
                      <td>{{$totalDiscount}} %</td>
                    </tr>
                  </table>
                </div>
              </div>
              
              <!-- SUB TOTAL -->
              <div class="col-sm-4">
                <div class="grand-total"> <span>SUB TOTAL: Rp. {{number_format($totalPrice,2,',','.')}}</span>
                  <h4>GRAND: <span> Rp. {{number_format($finalPrice,2,',','.')}} </span></h4>
                  
                      <a class="btn" title="checkout" href="{{URL::to('/checkout')}}"> Lanjut ke pembayaran &nbsp; <i class="fa fa-arrow-right"></i> </a>
                    
                  
                  <p>* Informasi Alamat akan berada pada halaman selanjutnya</p>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
  </div>
@endsection