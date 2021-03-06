<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/css/style.css')}}" />
<script src="{{asset('public/script/jquery.js')}}"></script>
<script src="{{asset('public/script/bootstrap.min.js')}}"></script>
<script src="{{asset('public/script/script.js')}}"></script>
</head>

<body>
    <!--HEADER-->
    <div class="container-fluid" align="center">
    
        <div class="row" id="header">
            <div class="col-sm-12">
                <a href="#">tokocerdas.com</a> Merchant Area
            </div>
        </div>
        <hr style="border-top:1px solid #000" />
        
        
        <nav class="nav navbar-default" id="menubar" style="padding:0px;margin:0px;background-color:#000">
           <a href="{{URL::to('merchant/info')}}"><li class="hoverer col-sm-2"><button type="button" class="btn btn-toolbar btn-block">Info Merchant</button></li></a>
           <a href="{{URL::to('merchant/order')}}"><li class="hoverer col-sm-2"><button type="button" class="btn btn-toolbar btn-block">Orderan</button></li></a>
           <a href="{{URL::to('merchant/acceptedOrder')}}"><li class="hoverer col-sm-2"><button type="button" class="btn btn-toolbar btn-block">Orderan Diterima</button></li></a>
           <a href="{{URL::to('merchant/productList')}}"><li class="hoverer col-sm-2"><button type="button" class="btn btn-toolbar btn-block">List Produk</button></li></a>
          <!-- <a href="{{URL::to('merchant/message')}}"><li class="hoverer col-sm-2"><button type="button" class="btn btn-toolbar btn-block">Message Customer <span class="badge">5</span></button></li></a> -->
           <a href="{{URL::to('merchant/report')}}"><li class="hoverer col-sm-2"><button type="button" class="btn btn-toolbar btn-block">Laporan Hasil</button></li></a>
           <a href="{{URL::to('merchant/login/doLogout')}}"><li class="hoverer col-sm-2"><button type="button" class="btn btn-toolbar btn-block">Logout</button></li></a>
        </nav>
        
        </div>
    </div>
    <!--END HEADER-->

@yield('isi')

    <div class="container-fluid" id="footer">
        <div class="col-sm-12">
            <hr style="border-top:1px solid #000" />    
            <div id="upfooter" class="row" align="left">
                <div class="col-sm-3" id="footsquare">
                    <h1>BANTUAN</h1>
                    <a href="{{URL::to('help#help1')}}">Pembayaran</a><br />
                    <a href="{{URL::to('help#help2')}}">Pengiriman</a><br />
                    <a href="{{URL::to('help#help3')}}">Check Pesanan</a><br />
                    <a href="{{URL::to('help#help4')}}">Permasalahan Produk</a><br />
                    <a href="{{URL::to('help#help5')}}">Cara Berbelanja</a><br />
                    <a href="{{URL::to('help#help6')}}">Keuntungan Berbelanja</a><br />
                    <a href="{{URL::to('help#help7')}}">Hubungi Kami</a><br />
                </div>
                <div class="col-sm-3" id="footsquare">
                    <h1>INFO</h1>
                    <a href="{{URL::to('about')}}">Tentang tokocerdas.com</a><br />
                    <a href="{{URL::to('termOfUse')}}">Syarat & Ketentuan</a><br />
                    <a href="{{URL::to('privacyPolicy')}}">Kebijakan Privasi</a><br />
                    <a href="brand.html">Daftar Brand</a><br />
                    <a href="merchant-home.html">Area Merchant</a><br />
                    
                </div>
                <div class="col-sm-3" id="footsquare">
                    <h1>MEDIA</h1>
                    <a href="#"><img src="{{asset('public/img/sos/facebook.png')}}" width="50" height="50" /></a>
                    <a href="#"><img src="{{asset('public/img/sos/twitter.png')}}" width="50" height="50" /></a>
                    <a href="#"><img src="{{asset('public/img/sos/insta.png')}}" width="50" height="50" /></a>
                </div>
                <div class="col-sm-3" id="footsquare">
                    <h1>MOBILE</h1>
                    <a href="#">Coming soon!</a><br />
                    
                </div>
            
            </div>
            <hr style="margin:0px; border-top:1px solid #000" />
            <div id="upfooter" class="row">
                <div class="col-sm-6" id="footsquare" align="center">
                    <h1>PEMBAYARAN</h1>
                    <div class="row">
                        <div class="col-xs-offset-3 col-xs-3">
                            <img class="img-responsive" src="{{asset('public/img/bca.png')}}" width="96" height="60" />
                        </div>
                        <div class="col-xs-3">
                            <img class="img-responsive" src="{{asset('public/img/mandiri.png')}}" width="96" height="60" />
                        </div>
                    </div>
                </div>
                <div class="col-sm-6" id="footsquare" align="center">
                    <h1>DELIVERY</h1>
                    <div class="row">
                        <div class="col-xs-offset-3 col-xs-3">
                            <img class="img-responsive" src="{{asset('public/img/jne.png')}}" width="96" height="60" />
                        </div>
                        <div class="col-xs-3">
                            <img class="img-responsive" src="{{asset('public/img/tiki.png')}}" width="96" height="60" />
                        </div>
                    </div>
                </div>
            </div>
            <div id="downfooter" class="col-sm-12" align="center">
                <p>Copyright © 2015 tokocerdas.com All Right Reserved.</p>
            </div> 
        </div>
    </div>
</body>
</html>
