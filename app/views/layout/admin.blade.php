<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/css/styleadmin.css')}}" />
<script src="{{asset('public/script/jquery.js')}}"></script>
<script src="{{asset('public/script/bootstrap.min.js')}}"></script>
<script src="{{asset('public/script/scriptadmin.js')}}"></script>
</head>

<body>
	<div class="container-fluid" style="background-color: rgba(62, 50, 46, 0.1)">
    	<!--<div class="col-sm-12 col-xs-12 headerwrap" align="center">
   	    	<img class="" src="{{asset('public/img/header.png')}}" width="700" height="100" />
        </div>-->
        <div class="row">
            <div class="col-sm-4 col-md-3 col-xs-12 sideadminwrap">
                <div class="sideadminheader">
                    <p class="right">Welcome, <a href="#">{{Session::get('admin')}}</a></p>
                    <div class="row">
                        <!--
                        <div class="col-sm-6 col-xs-6 left">
                            <a href="#"><span class="glyphicon glyphicon-envelope"></span><span class="badge">4</span></a>
                        </div>
                    -->
                        <div class="col-sm-6 col-xs-6 right">
                            <a href="{{URL::to('admin/login/doLogout')}}"><button class="btn btn-default">Log out</button></a>
                        </div>
                    </div>
                    <!--
                    <div class="col-sm-12 margin-top-bottom">
                        <input type="search" class="form-control search-bar" placeholder="Search ..." />
                        <button class="btn btn-link search-span"><span class="glyphicon glyphicon-search"></span></button>
                    </div>
                -->
                </div>
                <div class="sideadmin">
                    <a href="{{URL::to('admin/home')}}"><button class="btn btn-block btn-trans"><li>Home Panel</li></button></a>
                    <a href="{{URL::to('admin/admin')}}"><button class="btn btn-block btn-trans"><li>Pengaturan Admin</li></button></a>
                    <button class="btn btn-block btn-trans customertoggle">
                        <li>
                            Pengaturan User <span class="glyphicon glyphicon-plus"></span>	
                        </li>
                    </button>
                	<div class="customersub">
                    <a href="{{URL::to('admin/user')}}"><button class="btn btn-block btn-trans"><li>Pengaturan User</li></button></a>
                        <a href="{{URL::to('admin/user/transaction')}}"><button class="btn btn-block btn-trans"><li>Transaksi User</li></button></a>
                 	</div> 
                    <a href="{{URL::to('admin/transaction/transactionSent')}}"><button class="btn btn-block btn-trans"><li>Pengaturan Transaksi Dikirim</li></button></a>
                    <a href="{{URL::to('admin/transaction/transaction')}}"><button class="btn btn-block btn-trans"><li>Pengaturan Transaksi Belum Dikirim</li></button></a>
                    <a href="{{URL::to('admin/product')}}"><button class="btn btn-block btn-trans"><li>Pengaturan Produk</li></button></a>
                    <!-- <a href="{{URL::to('admin/merchant/insertMerchantLogin')}}"><button class="btn btn-block btn-trans"><li>Pengaturan Merchant</li></button></a> -->
                    <button class="btn btn-block btn-trans merchanttoggle"><li>Pengaturan Merchant <span class="glyphicon glyphicon-plus"></span></li></button>
                        <div class="merchantsub">
                            <a href="{{URL::to('admin/merchant')}}"><button class="btn btn-block btn-trans"><li>Daftar Merchant Login</li></button></a>
                            <a href="{{URL::to('admin/merchant/registration')}}"><button class="btn btn-block btn-trans"><li>Daftar Merchant Register</li></button></a>
                            
                            <!-- <a href="{{URL::to('admin/merchant/insertMerchantLogin')}}"><button class="btn btn-block btn-trans"><li>Merchant Login Pendaftaran</li></button></a>  -->                   
                        </div>
                    <a href="{{URL::to('admin/category')}}"><button class="btn btn-block btn-trans"><li>Pengaturan Category</li></button></a>
                    <a href="{{URL::to('admin/transactionReport')}}"><button class="btn btn-block btn-trans"><li>Laporan Hasil</li></button></a>
                    <!--
                    <a href="admin-produk.html"><button class="btn btn-block btn-trans"><li>Pengaturan Produk</li></button></a>
                    <button class="btn btn-block btn-trans customertoggle"><li>Pengaturan Customer <span class="glyphicon glyphicon-plus"></span>	
                    </li></button>
                    	<div class="customersub">
                        	<a href="admin-customer.html"><button class="btn btn-block btn-trans"><li>Daftar Customer</li></button></a>
						   <a href="admin-customer-transaksi.html"><button class="btn btn-block btn-trans"><li>Customer Transaksi</li></button></a>
                            <a href="admin-customer-cashout.html"><button class="btn btn-block btn-trans"><li>Customer Cashout</li></button></a>
                            <a href="admin-customer-question.html"><button class="btn btn-block btn-trans"><li>Customer Question</li></button></a>
                            <a href="admin-customer-komentar.html"><button class="btn btn-block btn-trans"><li>Customer Komentar</li></button></a>
                            <a href="admin-customer-review.html"><button class="btn btn-block btn-trans"><li>Customer Review</li></button></a>
                     	</div>  	                       
                     
                     <button class="btn btn-block btn-trans merchanttoggle"><li>Pengaturan Merchant <span class="glyphicon glyphicon-plus"></span></li></button>
                     	<div class="merchantsub">
                        	<a href="admin-merchant.html"><button class="btn btn-block btn-trans"><li>Daftar Merchant</li></button></a>
                            <a href="admin-merchant-transaksi.html"><button class="btn btn-block btn-trans"><li>Merchant Transaksi</li></button></a>
                            <a href="admin-merchant-daftar.html"><button class="btn btn-block btn-trans"><li>Merchant Pendaftaran</li></button></a>	                	
                        </div>
                    -->
                    </div>
            </div>

                @yield('isi')

            </div>
    </div>
</body>
</html>