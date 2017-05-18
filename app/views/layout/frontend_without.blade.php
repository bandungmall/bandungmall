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
</head>
<body>
<div class="custom-container">
    <header class="header-section" style="background-image:url('public/images/test.jpg')">
        <div class="header-navigation">
            <div class="logo-container">
                <!-- <div class="logo"><a href="{{URL::to('home')}}">Tokocerdas</a></div> -->
		<a href="{{URL::to('home')}}"><img width="200px" height="60px" src="{{asset('public/img/tokcer.png')}}" /></a>
            </div>
            <div class="search-container">
            </div>
            <div class="user-navigation">
                <a href="{{URL::to('cart')}}">
                    <div class="nav-icon">
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                        {{--<div class="nav-count">--}}
                        {{--<div class="nav-count-text">0</div>--}}
                        {{--</div>--}}
                    </div>
                    <div class="caption">
                        Cart
                    </div>
                </a>
                {{--<a href="#wishlist">--}}
                {{--<div class="nav-icon">--}}
                {{--<span class="glyphicon glyphicon-heart"></span>--}}
                {{--</div>--}}
                {{--<div class="caption">--}}
                {{--Wishlist--}}
                {{--</div>--}}
                {{--</a>--}}
                <a href="{{url('user/login')}}">
                    <div class="nav-icon">
                        <span class="glyphicon glyphicon-user"></span>
                    </div>
                    <div class="caption">
                        Masuk | Daftar
                    </div>
                </a>
            </div>
        </div>
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
                        0812 1238 1823
                    </li>
                    <li>
                        <span class="glyphicon glyphicon-envelope"></span>
                        customer.care@online.com
                    </li>
                </ul>
            </div>
            <div style="display: table-cell"></div>
        </div>
    </footer>
</div>

<div id="sticky-header" class="sticky-header-container" style="background-image:url('public/images/test.jpg')">
    <div class="header-navigation sticky-header">
        <div class="logo-container">
            <div class="logo">Tokocerdas</div>
        </div>
        <div class="search-container">
            <div class="input-container">
                <div class="search-input">
                    <input class="search-input" type="text" placeholder="Cari produk atau brand">
                </div>
                <div class="search-icon">
                    <span class="glyphicon glyphicon-search" aria-hidden="true">
                </div>
            </div>
        </div>
        <div class="user-navigation">
            <a href="{{URL::to('cart')}}">
                <div class="nav-icon">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                    {{--<div class="nav-count">--}}
                    {{--<div class="nav-count-text">0</div>--}}
                    {{--</div>--}}
                </div>
                <div class="caption">
                    Cart
                </div>
            </a>
            {{--<a href="#wishlist">--}}
            {{--<div class="nav-icon">--}}
            {{--<span class="glyphicon glyphicon-heart"></span>--}}
            {{--</div>--}}
            {{--<div class="caption">--}}
            {{--Wishlist--}}
            {{--</div>--}}
            {{--</a>--}}
            <a href="{{url('user/login')}}">
                <div class="nav-icon">
                    <span class="glyphicon glyphicon-user"></span>
                </div>
                <div class="caption">
                    Masuk | Daftar
                </div>
            </a>
        </div>
    </div>
</div>

<script src="{{url('public/izet/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script src="{{url('public/izet/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<script src="{{url('public/izet/assets/js/script.js')}}"></script>
<script src="{{url('public/izet/assets/js/category.js')}}"></script>
</body>
</html>