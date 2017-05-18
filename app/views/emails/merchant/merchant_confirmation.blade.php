<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Untitled Document</title>
</head>
<style>
body{
	font-family:Arial, Helvetica, sans-serif;	
}

a{
	color:#0066FF;
	text-decoration:none;
	
}

table td,table th{
	text-align:center;	
	border:1px solid #000;
	height:40px;
	font-size:16px;
	color:#666666;
}

table th{
	color:#FFF;
	background:#000;	
}

</style>
<body>
	<div style="margin:50px;padding:20px;border:1px solid #000">
    	<div>
   	    	<a href="home.html"><img src="{{asset('public/img/tokcer.png')}}" width="1250" height="180" /></a>
            <hr />
        </div>
        <div>
        	<div>
            	<p>Kepada(merchant),<br />
					Kami telah menerima orderan dari customer, Silahkan lakukan pengiriman barang dalam waktu 7 hari.</p>
            </div>
            <p>
                <strong>Kode pembelian:</strong> {{$transaction_details[0]->transaction_id}}<br />
                <strong>Tanggal pembelian:</strong> {{date_format($transaction_details[0]->created_at, 'g:ia jS F Y')}}<br />
                <strong>Status:</strong> Sudah dibayar
            </p>
            <div align="center">
            <?php $subtotal = 0; ?>
               	<table width="80%" align="center" style="border-collapse:collapse;margin-top:20px">
                	<tr>
                    	<th>Produk</th>
                    	<th>Nama</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Total</th>
                	</tr>
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
            <div align="center">
            	<div style="width:80%">
                	<div style="background:#000;color:#FFF;padding:5px">
                		<h4>Informasi Pengiriman</h4>
                	</div>
                    <div align="left" style="padding:5px 30px;border:1px solid #000">
                    	<p>{{$address->address}}<br />
                            {{$address->city}}<br />
                            {{$address->postal_code}}<br />
                            {{$address->phone_number}} atas nama {{$address->name}}
                        </p>
                    </div>
                </div>
            </div>
        	<!-- <p>Silahkan konfirmasi setelah melakukan pengiriman <a href="#">disini.</a></p> -->
        </div>
        <div style="padding-top:30px">
        	<hr />
        	<div align="center" style="width:100%;padding-top:15px">
            	<div style="display:inline;text-align:center">
       	    		<a href="#"><img  src="{{asset('public/img/sos/facebook.png')}}" width="64" height="64" /></a>
                </div>
                <div style="display:inline;text-align:center">
       	    		<a href="#"><img  src="{{asset('img/sos/twitter.png')}}" width="64" height="64" /></a>
               	</div>
                <div style="display:inline;text-align:center">
       	    		<a href="#"><img  src="{{asset('img/sos/insta.png')}}" width="64" height="64" /></a>  
               	</div>                               
            </div>
            <div align="center">
            	<div style="padding-top:20px">
            		<p>Punya pertanyaan atau keluhan?<br />
						Silahkan hubungi kami.<br />
						Email: support@bandungmall.co.id<br />
						Telp: +6289 6102 8889</p>
				</div>
                <div style="padding-top:20px">
                	<p>@2015 bandungmall.co.id | NAstudio <br />
						Setra Duta K4 No.45 Cemara 1,Bandung, Jawa Barat
                	</p>
                </div>
            </div>
        </div>
   	</div>
</body>
</html>