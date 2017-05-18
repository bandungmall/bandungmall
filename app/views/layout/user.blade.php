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
<script>
$(document).ready(function() {
    $('#search_button').click(function(e) {
        var search = document.getElementsByName("search_bar")[0].value;
        window.location.replace("{{URL::to('product?search=')}}"+search);
    });
});
</script>
</head>

<body>
    <!--HEADER-->
    <div class="container-fluid">
    
        <div class="row" id="header">
            <div class="col-sm-12">
                <a href="{{URL::to('home')}}"><img class="img-responsive" src="{{asset('public/img/header.png')}}" width="1400" height="400" /></a>
            </div>
        
        </div>
        <hr style="border-top:1px solid #000" />
        
        
        <nav class="nav navbar-default" id="menubar" style="padding:0px;margin:0px;background-color:#000">
            
                <li class="hoverer col-sm-3 col-xs-12"><button type="button" class="btn btn-toolbar btn-block">Semua Produk<span class="caret"></span></button></li>
           <div class="col-sm-6 col-xs-12" id="search">
                
                    <div class="col-sm-8 col-xs-8">
                    <input type="search" name="search_bar" id="searchbar" class="form-control" placeholder="Pencarian produk" />
                    </div>
                    <div class="col-sm-4 col-xs-4">
                    <button id="search_button" name="search_button" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-search"></span> Search</button>
                    </div>
                
           </div>
           
           <div class="col-sm-3 col-xs-12" align="center">
                <div class="col-sm-6">
                   
                </div>
                <div class="col-sm-6" id="login">
                    @if(!Auth::check())
                        <div class="col-sm-6" id="loginhover">
                            <button class="btn btn-link btn-block" data-toggle="modal" data-target="#loginsub"><span class="glyphicon glyphicon-user"></span></button>
                        </div>
                    @else
                        <div class="col-sm-6" id="loginhover">
                            <button class="btn btn-link btn-block" data-toggle="modal" data-target="#loginedsub"><span class="glyphicon glyphicon-user"></span></button>
                            <!--<button class="btn btn-link btn-block" onclick="location.href='{{URL::to('/user/doLogout')}}';"><span class="glyphicon glyphicon-user">L</span></button>-->
                        </div>
                    @endif
                    <div class="col-sm-6" id="carthover">
                        <!--<button class="btn btn-link btn-block" data-toggle="modal" data-target="#cartsub"><span class="glyphicon glyphicon-shopping-cart"></span></button>-->
                        <button class="btn btn-link btn-block" data-toggle="modal" onclick="location.href='{{URL::to('/cart')}}';"><span class="glyphicon glyphicon-shopping-cart"></span></button>
                    </div>
                    
                </div>
           </div>
        
        </nav>
        <div class="row" style="padding:0px;margin:0px">
            <div class="col-sm-3 submenu" align="right">
                <ul>
                    <a href="aksesorishp.html"><li id="acchover">Aksesories HP</li></a>
                    <a href="makanan.html"><li id="mknhover">Makanan Ringan</li></a>
                    </ul>
            </div>
            <div id="accsub" class="col-sm-9 subsubmenu" align="left">
                <div class="row">
                    <div class="col-sm-3">
                            <a href="#"><li>Powerbank</li></a>
                            <a href="#"><li>Charger</li></a>
                            <a href="#"><li>Battery</li></a>
                            <a href="#"><li>Phone Case</li></a>
                            <a href="#"><li>Screen Protector</li></a>
                            <a href="#"><li>Headset</li></a>
                            <a href="#"><li>Handsfree</li></a>
                            <a href="#"><li>Speaker</li></a>
                            <a href="#"><li>Selfie Stick</li></a>
                        
                    </div>
                    <div class="col-sm-9" align="center" style="border-left:1px solid #000;background:#FFF;height:450px">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <a href="#"><img class="img-responsive" src="{{asset('public/images/banner4.jpg')}}" width="360" height="450" /></a>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <a href="#"><img class="img-responsive" src="{{asset('public/images/slider1.png')}}" width="360" height="210" style="padding:7px 0px" /></a>
                            
                                <a href="#"><img class="img-responsive" src="{{asset('public/images/slide13.jpg')}}" width="360" height="210" style="padding:7px 0px"/></a>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>
            <div id="mknsub" class="col-sm-9 subsubmenu" align="left">
                <div class="row">
                    <div class="col-sm-3">
                            <a href="#"><li>Chips</li></a>
                            <a href="#"><li>Chocolate</li></a>
                            <a href="#"><li>Candy</li></a>
                            <a href="#"><li>Cookies</li></a>
                            <a href="#"><li>Soft Cakes</li></a>
                    </div>
                    <div class="col-sm-9" align="center" style="border-left:1px solid #000;background:#FFF;height:450px">
                        <a href="#"><img class="img-responsive" src="{{asset('public/images/slide13.jpg')}}" width="420" height="236" style="margin:15px" /></a>
                        <a href="#"><img class="img-responsive" src="{{asset('public/images/slide11.jpg')}}" width="420" height="236" style="margin:15px"  /></a>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="loginsub" align="left" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3>Login</h3>
                        </div>
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
                                            <!--
                                            <div class="checkbox">
                                                <br />
                                                <label><input type="checkbox" />Ingat saya</label>
                                            </div>
                                        -->
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
                            <form role="form">
                                <p>Belum terdaftar?</p>
                                <button class="btn btn-primary" onclick="location.href='{{URL::to('/user/register')}}';"  type="button">Daftar sekarang</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @if(Auth::check())
                <div class="modal fade" id="loginedsub" align="left" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3>Akun</h3>
                            </div>
                            <div class="modal-body">
                                        <p>Welcome, {{Auth::user()->first_name.' '.Auth::user()->last_name}}</p>
                                        <p class="padbottom alert alert-warning" align="center" ><span class="glyphicon glyphicon-credit-card" style="float:left"></span> RP. {{number_format(Auth::user()->balance, 0, '', '.');}}</p>
                                <div class="row">
                                    <div class="user-menu">
                                        <a href="{{URL::to('user/home')}}"><li>Panel Akun</li></a>
                                        <a href="{{URL::to('user/order')}}"><li>Check Pesanan</li></a>
                                        {{--<a href="{{URL::to('user/cashout')}}"><li>Cashout</li></a>--}}
                                        <a href="{{URL::to('user/doLogout')}}"><li>Logout</li></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="modal fade" id="cartsub" align="left" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h3>Troli</h3>
                        </div>
                        <div class="modal-body">
                            <table width="200" border="0" class="table">
                                  <tr>
                                    <th scope="col" colspan="2">Barang</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Kuantitas</th>
                                    <th scope="col">Subtotal</th>
                                  </tr>
                                  <tr>
                                    <td><img class="img-responsive" src="{{asset('public/produk/TONGSIS STONIC-07 (Hijau).jpg')}}" width="50" height="50" /></td>
                                    <td>Tongsis Pink<br />Stonic</td>
                                    <td>Rp. 110.000,-</td>
                                    <td>1</td>
                                    <td>Rp. 110.000,-</td>
                                  </tr>
                                  <tfoot>
                                    <tr>
                                      <th id="carttotal" colspan="4">Total:</th>
                                      <td>Rp. 110.000,-</td>
                                    </tr>
                                  </tfoot>
                                </table>
                             <div class="row" align="right">
                                <a href="infopengiriman.html"><button class="btn btn-primary" type="button">Bayar</button></a>
                            </div>
                        </div>
                    </div>
            </div>
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
                    <a href="{{URL::to('product')}}">Daftar Brand</a><br />
                    <a href="{{URL::to('merchant/home')}}">Area Merchant</a><br />
                    
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
