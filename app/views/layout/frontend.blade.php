<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{url('public/izet/bower_components/normalize-css/normalize.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('public/izet/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('public/izet/bower_components/bootstrap/dist/css/bootstrap-theme.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('public/izet/assets/css/style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{url('public/izet/assets/css/category.css')}}" type="text/css">

    <title>Tokocerdas</title>
    
    <style>
    	.nav-menu-link:hover{
    		text-decoration:none;
    	}
    	.logo-link:hover{
    		text-decoration:none;
    	}
    </style>
</head>
<body style="background-color:white;">
<div class="custom-container">
    @if(!Auth::check())
    	<div style="text-align:right; padding-right:15px; padding-top:5px;">
	        <a href="{{url('user/login')}}" style="color: blue; font-size: 16px;">
	            Sign In <span class="glyphicon glyphicon-user" style="color: black;"></span>
	        </a>
	        |
	        <a href="{{url('user/register')}}" style="color: blue; font-size: 16px;">Sign Up</a>
	</div>
    @else
    <div style="text-align:right; padding-right:15px; padding-top:5px;">
        <a href="{{url('user/home')}}">
            <div class="nav-icon">
                <span class="glyphicon glyphicon-user"></span>
            </div>
            <div class="caption">
                User
            </div>
        </a>
	</div>
    @endif
    <hr style="height: 10px;">
    {{--<header class="header-section" style="background-image:url('public/images/test.jpg')">--}}
    <header class="header-section">
        <div class="header-navigation">
            <div class="logo-container">
                <div class="logo">
                	<!-- <a href="{{URL::to('home')}}" class="logo-link">Tokocerdas</a> -->
                	<a href="{{URL::to('home')}}"><img width="200px" height="60px" src="{{asset('public/img/tokcer.png')}}" /></a>
                </div>
                <div id="category-wrapper" class="category-container">
                    <div class="category-heading">
                        KATEGORI BELANJA
                        <span class="glyphicon glyphicon-chevron-down" style="font-size: 8pt; padding-left: 5px;"></span>
                    </div>
                    <div id="category-container" class="category-list-container hidden">
                        <ul id="category-list" class="category-list">
                        @foreach($data_category_parent as $key=>$parent)
                            <li data-target="category-popup-{{$key+1}}">{{$parent->name}}</li>

                            {{--<li data-target="category-popup-{{$key+1}}">--}}
                                {{--<a href="{{URL::to('product?category_id='.$parent->id)}}">--}}
                                {{--{{$parent->name}}--}}
                                {{--</a>--}}
                            {{--</li>--}}
                        @endforeach
                            <a href="{{URL::to('product')}}">
                                <li>
                                    All Categories
                                </li>
                            </a>
                        </ul>
                        @foreach($data_category_parent as $key=>$parent)
                            <div id="category-popup-{{$key+1}}" class="subcategory-container">
                                <div class="subcategory-heading">
                                    {{$parent->name}}
                                </div>
                                <div class="subcategory-list">
                                    <div class="subcategory-column" >
                                    @foreach($data_category_child as $child)
                                        @if($child['parent'] ==$parent['id'])
                                            <div>
                                                <ul>
                                                    <li><a href="{{URL::to('product?category_id='.$child->id)}}"><li>{{$child['name']}}</li></a></li>
                                                </ul>
                                            </div>
                                        @endif
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{--<div id="category-popup-1" class="subcategory-container">--}}
                            {{--<div class="subcategory-heading">--}}
                                {{--Promo & Koleksi Handphone & Tablet--}}
                            {{--</div>--}}
                            {{--<div class="subcategory-list">--}}
                                {{--<div class="subcategory-column">--}}
                                    {{--<div>--}}
                                        {{--<h3>WEARABLE GADGET</h3>--}}
                                        {{--<ul>--}}
                                            {{--<li>Aksesoris Wearable</li>--}}
                                            {{--<li>Activity Trackers & Pedometers</li>--}}
                                            {{--<li>Smartwatch</li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                    {{--<div>--}}
                                        {{--<h3>HANDPHONE</h3>--}}
                                        {{--<ul>--}}
                                            {{--<li>Handphone Lainnya</li>--}}
                                            {{--<li>Windows</li>--}}
                                            {{--<li>Blackberry</li>--}}
                                            {{--<li>Iphone</li>--}}
                                            {{--<li>Android</li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="subcategory-column">--}}
                                    {{--<div>--}}
                                        {{--<h3>AKSESORIS HANDPHONE & TABLET</h3>--}}
                                        {{--<ul>--}}
                                            {{--<li>Memory Card</li>--}}
                                            {{--<li>Aksesoris Lainnya</li>--}}
                                            {{--<li>Speaker Handphone</li>--}}
                                            {{--<li>Baterai</li>--}}
                                            {{--<li>Powerbank</li>--}}
                                            {{--<li>Charge</li>--}}
                                            {{--<li>Skin Protector</li>--}}
                                            {{--<li>Casing</li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="subcategory-column">--}}
                                    {{--<div>--}}
                                        {{--<h3>TABLET</h3>--}}
                                        {{--<ul>--}}
                                            {{--<li>Tablet Lainnya</li>--}}
                                            {{--<li>Ipad</li>--}}
                                            {{--<li>Tablet Android</li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="subcategory-column subcategory-image">--}}
                                    {{--<div class="image" style="background-image: url(assets/images/Desert.jpg)"></div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                    </div>
                </div>
            </div>
            <div class="search-container">
                <form name="myform" method="get" action="{{URL::to('product')}}">
                    <div class="input-container">
                        <div class="search-input">
                            <input class="search-input" name="search" type="text" placeholder="Cari produk atau brand">
                        </div>
                        &nbsp;
                        <div class="search-icon" style="padding-left: 25px; padding-right: 25px; background-color: #0095DB;">
                            <span onclick="myform.submit()" class="glyphicon" aria-hidden="true"/>Search
                        </div>
                    </div>
                </form>
                <!-- <div class="suggestion">
                    <span class="lighter-text">Terpopuler:</span>
                    <ul class="suggestion-list">
                        <li>samsung</li>
                        <li>xiaomi</li>
                        <li>iphone 5s</li>
                        <li>lenovo</li>
                    </ul>
                </div> -->
            </div>
            <div class="user-navigation">
                <a href="{{url('cart')}}">
                    <div class="nav-icon" style="background-color: #FABA02; font-size: 14px; padding: 5px; color: #FFF; padding-left: 25px; padding-right: 25px;">
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                        {{--<div class="nav-count">--}}
                            {{--<div class="nav-count-text">0</div>--}}
                        {{--</div>--}}
                        Shopping Cart
                    </div>
                </a>
            </div>
            {{--<p style="float: right; font-size: 16px; back">--}}
                {{--<a href="{{URL::to('help#help1')}}">How To Order</a>&nbsp;--}}
                {{--<a href="{{URL::to('help#help1')}}">About Us</a>&nbsp;--}}
                {{--<a href="{{URL::to('help#help1')}}">Our Service</a>&nbsp;--}}
                {{--<a href="{{URL::to('help#help1')}}">Contact Us</a>&nbsp;--}}
            {{--</p>--}}
        </div>

        <p style="text-align: right; font-size: 16px; background-color: #2C2C2C; color: white; padding-top: 10px; padding-bottom: 10px; padding-right: 75px;">
            <a class="nav-menu-link" href="{{URL::to('help#help1')}}">How To Order</a>&nbsp;&nbsp;|
            <a class="nav-menu-link" href="{{URL::to('help#help1')}}">About Us</a>&nbsp;&nbsp;|
            <a class="nav-menu-link" href="{{URL::to('help#help1')}}">Our Service</a>&nbsp;&nbsp;|
            <a class="nav-menu-link" href="{{URL::to('help#help1')}}">Contact Us</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </p>
    </header>
    <section class="content-section category-section">
        @yield('isi')
    </section>
    <footer class="footer-section">
        <div class="nav-links">
            <div class="nav-column">
                <h3>BANTUAN</h3>
                <ul class="nav-list links">
                    <a href="{{URL::to('help#help1')}}"><li>Pembayaran</li></a>
                    <a href="{{URL::to('help#help2')}}"><li>Pengiriman</li></a>
                    <a href="{{URL::to('help#help3')}}"><li>Status Pesanan</li></a>
                    <a href="{{URL::to('help#help4')}}"><li>Pengembalian Produk</li></a>
                    <a href="{{URL::to('help#help5')}}"><li>Rewards</li></a>
                    <a href="{{URL::to('help#help6')}}"><li>Cara Berbelanja</li></a>
                    <a href="{{URL::to('help#help7')}}"><li>Hubungi Kami</li></a>
                </ul>
            </div>
            <div class="nav-column">
                <h3>Merchant</h3>
                <ul class="nav-list links">
                    <a href="{{URL::to('merchant')}}"><li>Merchant</li></a>
                    <a href="{{URL::to('merchant/login')}}"><li>Login Merchant</li></a>
                    <a href="{{URL::to('merchant/register')}}"><li>Daftar Merchant</li></a>
                </ul>
            </div>
            <div class="nav-column">
                <h3>CUSTOMER CARE</h3>
                <ul class="nav-list">
                    <li>Buka 24 jam setiap hari</li>
                    <li>
                        <span class="glyphicon glyphicon-earphone"></span>
                        -
                    </li>
                    <li>
                        <span class="glyphicon glyphicon-envelope"></span>
                        admin@tokocerdas.com
                    </li>
                </ul>
            </div>
            <div class="nav-column">
                <h3>Social</h3>
                <ul class="nav-list">
                    <a href="https://www.facebook.com/tokocerdas99/?skip_nax_wizard=true" target="_blank"><li>Facebook</li></a>
                    <!-- <a href="#"><li>Twitter</li></a> -->
                    <a href="https://www.instagram.com/tokocerdas/" target="_blank"><li>Instagram</li></a>
                    <!-- <a href="#"><li>Youtube</li></a> -->
                </ul>
            </div>
            <div style="display: table-cell"></div>
        </div>
    </footer>
</div>

{{--<div id="sticky-header" class="sticky-header-container" style="background-image:url('public/images/test.jpg')">--}}
    {{--<div class="header-navigation sticky-header">--}}
        {{--<div class="logo-container">--}}
            {{--<div class="logo">Tokocerdas</div>--}}
        {{--</div>--}}
        {{--<div class="search-container">--}}
            {{--<div class="input-container">--}}
                {{--<div class="search-input">--}}
                    {{--<input class="search-input" type="text" placeholder="Cari produk atau brand">--}}
                {{--</div>--}}
                {{--<div class="search-icon">--}}
                    {{--<span class="glyphicon glyphicon-search" aria-hidden="true">--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="user-navigation">--}}
            {{--<a href="{{URL::to('cart')}}">--}}
                {{--<div class="nav-icon">--}}
                    {{--<span class="glyphicon glyphicon-shopping-cart"></span>--}}
                    {{--<div class="nav-count">--}}
                        {{--<div class="nav-count-text">0</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="caption">--}}
                    {{--Cart--}}
                {{--</div>--}}
            {{--</a>--}}
            {{--<a href="#wishlist">--}}
                {{--<div class="nav-icon">--}}
                    {{--<span class="glyphicon glyphicon-heart"></span>--}}
                {{--</div>--}}
                {{--<div class="caption">--}}
                    {{--Wishlist--}}
                {{--</div>--}}
            {{--</a>--}}
            {{--@if(!Auth::check())--}}
                {{--<a href="{{url('user/login')}}">--}}
                    {{--<div class="nav-icon">--}}
                        {{--<span class="glyphicon glyphicon-user"></span>--}}
                    {{--</div>--}}
                    {{--<div class="caption">--}}
                        {{--Masuk | Daftar--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--@else--}}
                {{--<a href="{{url('user/home')}}">--}}
                    {{--<div class="nav-icon">--}}
                        {{--<span class="glyphicon glyphicon-user"></span>--}}
                    {{--</div>--}}
                    {{--<div class="caption">--}}
                        {{--User--}}
                    {{--</div>--}}
                {{--</a>--}}
            {{--@endif--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

<script src="{{url('public/izet/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{url('public/izet/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{url('public/izet/assets/js/script.js')}}"></script>
<script src="{{url('public/izet/assets/js/category.js')}}"></script>
</body>
</html>