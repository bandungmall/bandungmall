@extends('layout.frontend')

@section('isi')
    <?php
        $totalBerat=0;
        $subtotal=0;
        $cod=1;
        $cost=0;
    ?>
    
<script src="{{url('public/izet/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <script type="text/javascript">
        
        function getCost(){
            //alert($("input[name=address]:checked").val());
            var address_id = $("input[name=address]:checked").val();
            var info_kurir = $("#infokurir").val();


            //alert('<?php echo json_encode($cart_data); ?>');

            @foreach($cart_data as $data)
                <?php $data->description = ""; ?>
            @endforeach

            $.ajax({
                type: "POST",
                url: "{{URL::to('/checkout/shipping/getCost')}}",
                data: {
                    address_id: address_id,
                    info_kurir: info_kurir,
                    cart_data: '<?php echo json_encode($cart_data); ?>'
                },
                cache: false,
                success: function(res) {
                    if(res.success) {
                        $('#service_option')
                            .find('option')
                            .remove()
                            .end()
                        ;
                        for(i=0; i<res.content.length; i++){
                            var x = document.getElementById("service_option");
                            var option = document.createElement("option");
                            
                            //option.text = res.content[i].service+' est : '+res.content[i].etd+' hari';
                            option.text = res.content[i].service;
                            option.value = res.content[i].cost;
                            x.add(option);
                        }
                        <?php $subtotal = 0;?>
                        @foreach($cart_data as $data)
                            <?php
                                $harga = 0;
                                if(!empty($data->discount) || $data->discount_date_start > date("Y-m-d") || $data->discount_date_end < date("Y-m-d")) $harga = $data->price - ($data->price*$data->discount)/100;
                                else $harga = $data->price;
                                $sub = $harga * $cart[$data->id];
                                $subtotal += $sub;
                            ?>
                        @endforeach

                        var selected = $('#service_option').find('option:selected');
                        $('#info_paket').val(selected.text());
                        $('#shipping_cost').text('Rp. '+selected.val()+",-");
                        $('#total_cost').text('Rp. '+(parseInt({{$subtotal}} - selected.val()*-1))+",-");
                        $('#transaction_total').val((parseInt({{$subtotal}} - selected.val()*-1)));
                    }
                }
            });
        }

        $(document).ready(function(){
            $("input[name=address]:radio").change(function (e) {
                getCost();
            });

            $("#service_option").change(function (e) {
                <?php $subtotal = 0;?>
                @foreach($cart_data as $data)
                    <?php
                        $harga = 0;
                        if(!empty($data->discount)) $harga = $data->price - ($data->price*$data->discount)/100;
                        else $harga = $data->price;
                        $sub = $harga * $cart[$data->id];
                        $subtotal += $sub;
                    ?>
                @endforeach
                var selected = $('#service_option').find('option:selected');
                $('#info_paket').val(selected.text());
                $('#shipping_cost').text('Rp. '+selected.val()+",-");
                $('#total_cost').text('Rp. '+(parseInt({{$subtotal}} - selected.val()*-1))+",-");
                $('#transaction_total').val((parseInt({{$subtotal}} - selected.val()*-1)));
            });

            $("#infokurir").change(function (e) {
                getCost();
            });

        });
    </script>
	<div class="container-fluid">
    	<div class="row">
        	<div class="col-sm-6">
            	<div id="bordered">
                    <h3>Informasi Customer</h3>
                    <hr />
                    @if(empty($user_address))
                        <div class="modal-content" style="margin-bottom:10px;">
                            <div class="modal-body">
                                <form role="form" action="{{URL::to('user/login/doLogin')}}" method="post">
                                    <div class="form-group">
                                        <label for="loginid">Login:</label>
                                        <input type="text" name="email" class="form-control" id="loginid" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="pwdid">Password:</label>
                                        <input type="password" name="password" class="form-control" id="pwdid" required />
                                    </div>
                                     <div class="row">
                                            <div class="col-sm-6">
                                                <div class="checkbox">
                                                    <br />
                                                    <label><input type="checkbox" />Ingat saya</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group" align="right">
                                                    <a href="((URL::to('user/forgotPassword')))">Lupa password?</a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-default">Login</button>
                                        <button type="button" onclick="location.href='{{URL::to('/user/login/fb')}}';" class="btn btn-primary">Login dengan Facebook</button>
                                </form>
                                <hr />
                                <p>Belum terdaftar?</p>
                                <button class="btn btn-primary" onclick="location.href='{{URL::to('/user/register')}}';"  type="button">Daftar sekarang</button>
                            </div>
                        </div>
                    @else
                    <form role="form" action="{{URL::to('checkout/doCheckout')}}" method="post">
                        <div class="radio" id="alamattoggle">
                            @foreach($user_address as $addr)
                                <label><input type="radio" name="address" value="{{$addr['id']}}" required/>
                                    Nama Penerima : {{$addr['name']}}<br />
                                    No Telp       : {{$addr['phone_number']}}<br />
                                    Kota          : {{$addr['city']}}<br />
                                    Alamat        : {{$addr['address']}}
                                </label>
                            @endforeach
                        </div>
                        <a href="{{URL::to('user/myAccount')}}" class="btn btn-primary" />Tambah alamat baru</a>
                    @endif
                        <div class="form-group">
                        	<label for="infokurir">Kurir:</label>
                        	<select name="info_kurir" id="infokurir" class="form-control" required>
                        		<option value="jne">JNE</option>
                            	<option value="tiki">TIKI</option>
                            </select>
                        </div>
                        <div class="form-group">
                        	<label for="infopaket">Paket:</label>
                        	<select name="shipping_price" class="form-control" id="service_option" name="service_option" required>
                            </select>
                        </div>
                        <input type="hidden" name="info_paket" id="info_paket" value="0"/> 
                        <input type="hidden" name="transaction_total" id="transaction_total" value="0"/> 
                        <p class="detail">*Barang dibayar dengan cara transfer ke rekening BCA cv nusantara artifisial</p>
    				    <button type="submit" class="btn btn-primary">Lanjut ke menu konfirmasi</button>
                    </form>
                </div>
          	</div>
            <div class="col-sm-6">
            	<div id="bordered">
            		<h3>Detail Barang</h3>
                    <table width="200" border="0" class="table">
                      <tr>
                      	<th scope="col">Gambar</th>
                        <th scope="col">Nama barang</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Harga</th>
                      </tr>

		              @foreach($cart_data as $data)
			              <tr>
	                      	<td><img class="img-responsive" src="{{asset('public/'.$data->image_link)}}" width="50" height="50" /></td>
	                      	<?php

			                 $harga = 0;
			                 if(!empty($data->discount)) $harga = $data->price - ($data->price*$data->discount)/100;
			                 else $harga = $data->price;
			                 $sub = $harga * $cart[$data->id];
			                ?>
	                        <td>{{$data->name}}</td>
	                        <td>{{$cart[$data->id]}}</td>
	                        <td>Rp. {{number_format($sub, 0, '', '.');}},-</td>
	                      </tr>
			              <?php $subtotal += $sub;?>
			          @endforeach
                      
                      <tfoot>
                      <tr>
                        <th colspan="3">Subtotal</th>
                        <td id="subtotal_cost" >Rp. {{number_format($subtotal/2, 0, '', '.');}},-</td>
                      </tr>
                      <tr>
                        <th colspan="3">Ongkos kirim</th>
                        <td id="shipping_cost">Rp. 0,-</td>
                      </tr>
                      <!--
                      <tr>
                        <th colspan="3">Diskon</th>
                        <td>-</td>
                      </tr>
                      <tr>
                        <th colspan="3">PPN</th>
                        <td>-</td>
                      </tr>
                  	  -->
                      	<tr>
                            <th colspan="3">Total</th>
                            <td id="total_cost">Rp. {{number_format($subtotal/2, 0, '', '.');}},-</td>
                        </tr>
                      </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>    
@stop