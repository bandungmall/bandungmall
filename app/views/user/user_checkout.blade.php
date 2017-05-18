@extends('user.templates.layout')

@section('content')
  <!-- CONTENT START -->
  <div class="content"> 
    
    <!--======= SUB BANNER =========-->
    <section class="sub-banner">
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
            <li class="col-sm-4"> <i class="fa fa-shopping-cart"></i>
              <h6>KERANJANG BELANJA</h6>
            </li>
            
            <!-- CHECK OUT DETAIL -->
            <li class="col-sm-4 current"> <i class="fa fa-align-left"></i>
              <h6>DETAIL PEMBAYARAN</h6>
            </li>
            
            <!-- ORDER COMPLETE -->
            <li class="col-sm-4"> <i class="fa fa-check"></i>
              <h6>PEMBELIAN SELESAI</h6>
            </li>
          </ul>
        </div>

        <!-- Payments Steps -->
        <div class="shopping-cart">

          <!-- SHOPPING INFORMATION -->
          <div class="cart-ship-info">
            <div class="row">

              <div class="col-sm-7">
                <h6>INFORMASI ALAMAT PENGIRIMAN</h6>
                <ul class="row">

                  <!-- ERROR ALAMAT -->
                  @if(!empty($error_alamat))
                    <li style="color:red" class="col-md-12 text-danger">* {{$error_alamat}}</li>
                  @endif

                  <!-- *BILLING ADDRESS -->
                  <li class="col-md-12" id="alamatSelected">
                    <label style="margin-bottom: 5px;"> ALAMAT PENGIRIMAN
                      <span id="billingAddress" style="color:red"></span>
                    </label>
                    @if($user_address)
                    <table style="color:#aaa; font-size: 12px;">
                        <tr>
                          <td>
                            {{$user_address->name}}
                          </td>
                        </tr>
                        <tr>
                          <td>
                            {{$user_address->alamat}} - {{$user_address->kode_pos}}
                          </td>
                        </tr>
                        <tr>
                          <td>
                            {{$user_address->kota}} - {{$user_address->provinsi}}
                          </td>
                        </tr>
                        <tr>
                          <td>
                            No. HP : {{$user_address->nomer_hp}}
                          </td>
                        </tr>
                      </table>
                      @else
                      <table style="color:#aaa; font-size: 12px;">
                        <tr>
                          <td>
                            Alamat belum tersedia
                          </td>
                        </tr>
                      </table>
                      @endif
                  </li>

                </ul>

                <ul class="row">
                  <form class="form-inline" action="page" method="post">
                    <li>
                      <div class="checkbox" style="padding-left:10px">
                        <input id="new_shipping" class="styled" type="checkbox" value="option-b2" name="add">
                        <label for="new_shipping" style="padding-left:30px"> ALAMAT PENGIRIMAN LAIN ? </label>
                      </div>
                    </li>
                    <li id="newShippingAddressBox">
                      <div class="form-group uppercase">
                        <!-- <a class="btn btn-dark" href="{{URL::to('user/address')}}">Buat alamat pengiriman baru</a> -->
                        <form method="POST" action="">
                          <div class="form-group col-sm-12" style="margin-bottom: 10px;">
                            <label style="margin: 0">Nama (* jika alamat akan disimpan di daftar alamat, harap bagian ini diisi)</label>
                            <input type="text" class="form-control" placeholder="Masukkan Nama Alamat" name="name">
                          </div>
                          <div class="form-group col-sm-12" style="margin-bottom: 10px;">
                            <label style="margin: 0">Alamat</label>
                            <textarea style="width:400px; height: 100px; resize: none;" class="form-control" placeholder="Masukkan Nama Alamat" name="alamat"></textarea>
                          </div>
                          <div class="form-group col-sm-6" style="margin-bottom: 10px;">
                            <label style="margin: 0">Provinsi</label>
                            <select class="form-control" name="district" id="provinsi" style="text-transform: capitalize;  width: 300px;">
                                <option value="0" selected>Pilih Provinsi</option>
                                @foreach($areas_provinsi as $area)
                                    <option data-id="{{$area->id}}" value="{{$area->name}}">{{$area->name}}</option>
                                @endforeach
                            </select>
                            <!-- <input type="text" class="form-control" placeholder="Masukkan Nama Alamat" name="provinsi"> -->
                          </div>
                          <div class="form-group col-sm-6" style="margin-bottom: 10px;">
                            <label style="margin: 0">Kota</label>
                            <select class="form-control" name="city" id="kota" style="text-transform: capitalize; width: 300px;">
                                <option value="0" selected>Pilih Kota</option>
                                
                            </select>
                            <!-- <input type="text" class="form-control" placeholder="Masukkan Nama Alamat" name="kota"> -->
                          </div>
                          <div class="form-group col-sm-4" style="margin-bottom: 10px;">
                            <label style="margin: 0">Kode Pos</label>
                            <input type="text" class="form-control" placeholder="Masukkan Kode Pos" name="kode_pos">
                          </div>
                          <div class="form-group col-sm-8" style="margin-bottom: 10px;">
                            <label style="margin: 0">No. HP</label>
                            <input type="text" class="form-control" placeholder="Masukkan No Handphone" name="nomer_hp">
                          </div>

                          <div class="form-group col-sm-12" style="margin-bottom: 10px;">
                            <div class="checkbox">
                              <input id="isSave" class="styled" type="checkbox" name="is_save">
                              <label for="isSave" style="padding-left:30px">
                                Ceklis jika ingin menyimpan alamat ini di daftar alamat
                              </label>
                            </div>
                          </div>

                          <div class="form-group col-sm-12" style="margin-bottom: 10px;">
                            <button id="newAddress" style="margin:0" name="submit" class="btn  btn-lg btn-dark" type="submit" value="Lanjut">Lanjut</button>
                          </div>
                        </form>
                      </div>
                    </li>
                  </form>
                </ul>

                <hr>
                <h6>INFORMASI KUPON</h6>
                <ul class="row">

                  <li class="col-md-12">
                    <label> KODE KUPON <label class="checkKupon"></label>
                      <input id="coupon" type="text" name="code" size="10" placeholder="">
                    </label>
                  </li>

                  <li class="col-md-12">
                    <button class="btn btn-dark" id="checkCoupon" type="submit">Cek Kode</button>
                    <button class="btn btn-info" id="submitCoupon" type="submit" disabled> Pakai Kupon</button>
                  </li>

                </ul>

                

                <hr>
                <h6>INFORMASI KURIR PENGIRIMAN</h6>
                <ul class="row">
                  <li class="col-md-12">
                    @if(!empty($error_kurir))
                      <label style="color:red" class="col-md-12 text-danger">* {{$error_kurir}}</label>
                    @endif
                    <label> PILIH JENIS KURIR
                      <select class="form-control" required aria-required="true" id="SelectKurir" name="SelectKurir" onchange="changeKurir()">
                        <option value="0">Pilih Jenis Kurir</option>
                        <option value="jne">JNE</option>
                        <option value="tiki">TIKI</option>
                      </select>
                    </label>
                  </li>
                  <li class="col-md-12">
                    @if(!empty($error_paket))
                      <label style="color:red" class="col-md-12 text-danger">* {{$error_paket}}</label>
                    @endif
                    <label> PILIH JENIS PAKET
                      <select class="form-control" required aria-required="true" id="SelectPacket" name="SelectPacket" onchange="changePaket()">
                        <option value="0">Pilih Jenis Paket Pengiriman</option>
                      </select>
                    </label>
                  </li>
                </ul>

                <hr>
                <h6>PAYMENT METHOD</h6>
                <ul class="row">
                  <li class="col-md-12">
                    <div class="checkbox">
                      <input id="CashOnDelivery" value="4" class="styled" type="checkbox">
                      <label for="CashOnDelivery"
                        data-toggle="collapse"
                        data-target="#CashOnDeliveryCollapse"
                        aria-expanded="false"
                        aria-controls="CashOnDeliveryCollapse">
                        Pembayaran dilakukan ke rekening <strong>BCA</strong> : no. rek : 2820105586
                        an. <strong>CV Nusantara Artifisial</strong>  
                      </label>
                    </div>
                  </li>
                  <li class="collapse" id="CashOnDeliveryCollapse">
                    <p>Transaksi dan barang akan dikirim setelah Penjual menerima konfirmasi pembayaran anda</p>
                  </li>
                  <li class="col-md-12">
                    <div class="checkbox">
                      <input name="checkboxes" id="checkboxes-1" value="1" required type="checkbox">
                      <label for="checkboxes-1">I have read and agree to the <a href="help">Terms & Conditions</a></label>
                    </div>
                  </li>
                </ul>

                <form action="{{URL::to('/checkout/doCheckoutFinal')}}" method="post">
                  <?php $totalPrice = 0;
                  $totalDiscount = 0;
                  $finalPrice = 0; ?>
                  @if (is_array($cart_data) || is_object($cart_data))
                  @foreach($cart_data as $product_in_cart)
                  <?php
                  $totalPrice = $totalPrice + $product_in_cart->price * $cart[$product_in_cart['id']]['quantity'];
                  if ($product_in_cart->discount_date_start >= date("Y-m-d") && $product_in_cart->discount_date_end <= date("Y-m-d") && $product_in_cart->discount > 0) {

                      $totalDiscount = $totalDiscount + ($product_in_cart->discount / 100) * $product_in_cart->price * $cart[$product_in_cart->id];
                      $priceNow = (100 - $product_in_cart->discount) * $product_in_cart->price / 100;
                  } else {
                      $priceNow = $product_in_cart->price;
                  }
                  $finalPrice = $finalPrice + $priceNow * $cart[$product_in_cart['id']]['quantity'];
                  ?>
                  @endforeach
                  @endif
                  <input name="transaction_total" value = "{{$finalPrice}}" type="hidden">
                  <input name="temp_transaction_total" value = "{{$finalPrice}}" type="hidden">
                  <input name="address" id="address" value="" type="hidden">
                  <input name ="info_kurir" id="info_kurir" value="" type="hidden">
                  <input name="info_paket" id="info_paket" value="" type="hidden">
                  <input name="coupon_id" id="coupon_id" value="0" type="hidden">
                  <input name="discount" value="0" type="hidden">
                  <input name="shipping_price" id="shipping_price" value="0" type="hidden">
                  <input name="cart_data" id="cart_data" value='{{$cart_data}}' type="hidden">
                  <input name="temp_address_is_save" value="no" type="hidden">
                  <input name="temp_address_name" type="hidden">
                  <input name="temp_address_provinsi" type="hidden">
                  <input name="temp_address_kota" type="hidden">
                  <input name="temp_address_alamat" type="hidden">
                  <input name="temp_address_kode_pos" type="hidden">
                  <input name="temp_address_nomer_hp" type="hidden">
                  <button name="submit" class="btn  btn-lg btn-dark" type="submit" value="Order">ORDER</button>
                </form>
              </div>

              <!-- SUB TOTAL -->
              <div class="col-sm-5">
                <div class="order-place">
                  <h5>YOUR ORDER</h5>
                  <div class="order-detail">
                    <p>TOTAL PRODUCTS 
                      <span> 
                        @if(Session::has('cartQty'))
                        {{Session::get('cartQty')}}       
                        @else
                        0
                        @endif
                      </span>
                    </p>
                    <p>SHIPPING <span id="textKurir">Kurir</span></p>
                    <p>HARGA SBLM. DISKON <span>{{{$totalPrice,0}}}</span></p>
                    <p>TOTAL DISKON <span id="total-tax">{{{$totalDiscount,0}}}</span></p>
                    <p>KUPON <span id="info-kupon">Tidak Ada</span></p>
                    <p>POTONGAN KUPON <span id="total-kupon">0</span></p>
                    <p>TOTAL <span id="total-price">{{{$finalPrice,0}}}</span></p>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section ('javascript')


<script>


    $(document).ready(function () {

      <?php if($user_address){?>
      var name = "<?php echo $user_address->kota;?>";
            $.ajax({
                data: 'name='+name,
                url: "checkout/getAddress", 
                success: function(result){
                    $("#address").val(result[0].id);
                }
            });
      <?php }?>

      $("#provinsi").change(function(){
        var id = $(this).children('option:selected').data('id');
        
        $.ajax({
          data: 'id='+id,
          url: "user/address/getKota", 
          success: function(result){  
            var x = 0;
            var html = "<option value='0'>Pilih Kota</option>";
            var length = result['areas_kota'].length;

            $("#kota").empty();

            if(length > 0){
              for(x; x < length-1; x++){

                html += "<option style='text-transform: capitalize;' data-id='"+result.areas_kota[x]['id']+"' value='"+result.areas_kota[x]['name']+"'>"+result.areas_kota[x]['tipe']+" "+result.areas_kota[x]['name']+"</option>";

              }
            }else{
              html += "<option value='0'>Kota Belum Tersedia</option>";
            }

            $("#kota").append(html);    
          }
        });
      });

      $('#kota').change(function(){
        var name = $(this).val();
            $.ajax({
                data: 'name='+name,
                url: "checkout/getAddress", 
                success: function(result){
                    $("#address").val(result[0].id);
                }
            });
      });

      $('#newAddress').click(function(e){
        e.preventDefault();

        var name = $("input[name='name']").val();
            var provinsi = $("#provinsi").val();
            var kota = $("#kota").val();
            var alamat = $("textarea[name='alamat']").val();
            var kode_pos = $("input[name='kode_pos']").val();
            var nomer_hp = $("input[name='nomer_hp']").val();

            $("input[name='temp_address_is_save']").val("no_saved");
            $("input[name='temp_address_name']").val(name);
            $("input[name='temp_address_provinsi']").val(provinsi);
            $("input[name='temp_address_kota']").val(kota);
            $("input[name='temp_address_alamat']").val(alamat);
            $("input[name='temp_address_kode_pos']").val(kode_pos);
            $("input[name='temp_address_nomer_hp']").val(nomer_hp);

        $('#coupon').focus();
      });
    
      $('#checkCoupon').on('click',function(event){
            var coupon_code = $("#coupon").val();
            $.ajax({
                data: 'coupon_code='+coupon_code,
                url: "checkout/checkCoupon", 
                success: function(result){
                    $('.checkKupon').html(result['message']);
                    if(result['message'] == "* Kupon tersedia"){
                        $('.checkKupon').css('color','green');
                        $('#submitCoupon').attr('disabled',false);
                    }else{
                        $('.checkKupon').css('color','red');
                        $('#submitCoupon').attr('disabled',true);
                    }
                }
            });
        });

        $('#submitCoupon').on('click',function(event){
            var coupon_code = $("#coupon").val();
            var total = $('input[name=temp_transaction_total]').val();
            $.ajax({
                data: 'coupon_code='+coupon_code,
                url: "checkout/setCoupon", 
                success: function(result){
                    $('#info-kupon').html(result[0]['kode_coupon']+" (-"+result[0]['potongan']+")");
                    $('.coupon-tax').html(result[0]['potongan']);
                    total = total - result[0]['potongan'];
                    $('#total-price').html(total);
                    $('input[name=coupon_id]').val(result[0]['id']);
                    $('input[name=discount]').val(result[0]['potongan']);
                    $('input[name=transaction_total]').val(total);
                    $('.checkKupon').html('* Kupon terpakai');
                    $('.checkKupon').css('color','blue');
                }
            });
        });

        $('#newShippingAddressBox').hide();
        $('input[name="add"]').on('change', function() {
          if ($('#new_shipping').is(':checked')) {
            $('#alamatSelected').slideUp();
            $('#newShippingAddressBox').slideDown();
          } else {
            $('#alamatSelected').slideDown();
            $('#newShippingAddressBox').slideUp();

            $("input[name='temp_address_is_save']").val("no");
            $("input[name='temp_address_name']").val("");
            $("input[name='temp_address_provinsi']").val("");
            $("input[name='temp_address_kota']").val("");
            $("input[name='temp_address_alamat']").val("");
            $("input[name='temp_address_kode_pos']").val("");
            $("input[name='temp_address_nomer_hp']").val("");

            <?php if($user_address){?>
            var name = "<?php echo $user_address->kota;?>";
            $.ajax({
                data: 'name='+name,
                url: "checkout/getAddress", 
                success: function(result){
                    $("#address").val(result[0].id);
                }
            });
            <?php }?>
          }
        });

        $('#labelSaveAddress').hide();
        $('input[name="is_save"]').on('change', function() {
          if ($(this).is(':checked')) {
            $('#labelSaveAddress').slideDown();
            var name = $("input[name='name']").val();
            var provinsi = $("#provinsi").val();
            var kota = $("#kota").val();
            var alamat = $("textarea[name='alamat']").val();
            var kode_pos = $("input[name='kode_pos']").val();
            var nomer_hp = $("input[name='nomer_hp']").val();

            $("input[name='temp_address_is_save']").val("yes");
            $("input[name='temp_address_name']").val(name);
            $("input[name='temp_address_provinsi']").val(provinsi);
            $("input[name='temp_address_kota']").val(kota);
            $("input[name='temp_address_alamat']").val(alamat);
            $("input[name='temp_address_kode_pos']").val(kode_pos);
            $("input[name='temp_address_nomer_hp']").val(nomer_hp);
            $('#coupon').focus();
            $('#newAddress').addClass('hide');
          } else {
            $('#labelSaveAddress').slideUp();

            var name = $("input[name='name']").val();
            var provinsi = $("#provinsi").val();
            var kota = $("#kota").val();
            var alamat = $("textarea[name='alamat']").val();
            var kode_pos = $("input[name='kode_pos']").val();
            var nomer_hp = $("input[name='nomer_hp']").val();

            $("input[name='temp_address_is_save']").val("no_saved");
            $("input[name='temp_address_name']").val(name);
            $("input[name='temp_address_provinsi']").val(provinsi);
            $("input[name='temp_address_kota']").val(kota);
            $("input[name='temp_address_alamat']").val(alamat);
            $("input[name='temp_address_kode_pos']").val(kode_pos);
            $("input[name='temp_address_nomer_hp']").val(nomer_hp);
            $('#newAddress').removeClass('hide');
          }
        });

        $('input#newAddress').on('ifChanged', function (event) {
            //alert(event.type + ' callback');
            $('#newBillingAddressBox').collapse("show");
            $('#exisitingAddressBox').collapse("hide");

        });

        $('input#exisitingAddress').on('ifChanged', function (event) {
            //alert(event.type + ' callback');
            $('#newBillingAddressBox').collapse("hide");
            $('#exisitingAddressBox').collapse("show");
        });


        $('input#newShippingAddress').on('ifChanged', function (event) {
            //alert(event.type + ' callback');
            $('#newShippingAddressBox').collapse("show");

        });

        $('input#existingShippingAddress').on('ifChanged', function (event) {
            //alert(event.type + ' callback');
            $('#newShippingAddressBox').collapse("hide");

        });


        $('input#creditCard').on('ifChanged', function (event) {
            //alert(event.type + ' callback');
            $('#creditCardCollapse').collapse("toggle");

        });


        $('input#CashOnDelivery').on('ifChanged', function (event) {
            //alert(event.type + ' callback');
            $('#CashOnDeliveryCollapse').collapse("toggle");

        });


    });
    function runAddressId() {
        document.getElementById("address").value = document.getElementById("SelectAddress").value;
        $.ajax({
            url: 'checkout/getAddress',
            data: 'id='+document.getElementById("SelectAddress").value,
            success: function(r){
                if(r.id){
                    var res = "<p style='margin:0'>Provinsi <pre>"+r.district+"</pre></p>"+
                    "<p style='margin:0'>Kota <pre>"+r.city+"</pre></p>"+
                    "<p style='margin:0'>Alamat <pre>"+r.address+"</pre></p>"+
                    "<p style='margin:0'>Kode Pos <pre>"+r.postal_code+"</pre></p>"+
                    "<p style='margin:0'>No Hp <pre>"+r.phone_number+"</pre></p>";
                    $("#billingAddress").attr("style","color:black");
                    $("#billingAddress").html(res);
                }else{
                    $("#billingAddress").attr("style","color:red");
                    $("#billingAddress").html("* Alamat belum dipilih");
                }
            }
        });
    }

    function changeKurir() {
        var kurir = $('#SelectKurir').val();
        var id_address = $("input[name='address']").val();
        $('#info_kurir').val(kurir);

        $.ajax({
            url: 'checkout/getCost',
            data: 'address_id='+id_address+"&info_kurir="+kurir+"&cart_data="+$("#cart_data").val(),
            success: function(r){
                var res = "<option value='0'>Pilih Jenis Paket Pengiriman</option>";

                for (var i = r['content'].length - 1; i >= 0; i--) {
                  console.log(r['content'][i]);
                    if(r['content'][i]['etd'] !== ''){
                        res += "<option value='"+r['content'][i]['cost']+"'>"+r['content'][i]['service']+" ("+r['content'][i]['etd']+" hari)</option>";
                    }
                }
                $("#SelectPacket").html(res);
            }
        });
    }

    function changePaket() {
        document.getElementById("info_paket").value = $("#SelectPacket option:selected").text();
        document.getElementById("textKurir").innerHTML = $("#SelectKurir option:selected").html() +" "+ $("#SelectPacket option:selected").html()+ " : " + document.getElementById("SelectPacket").value;
        document.getElementById("shipping_price").value = document.getElementById("SelectPacket").value;

        var total = parseInt($('input[name=temp_transaction_total]').val());
        var discount = parseInt($('input[name=discount]').val());
        total = (total - discount) + parseInt($('#SelectPacket').val());

        $("input[name=transaction_total]").val(total);
        $("#total-price").html(total);
    }

</script>
@endsection
