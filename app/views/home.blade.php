@extends('layout.frontend')

@section('isi')

    <style>
        .home-product-image{
        	padding:5px;
        }
	
	.home-product-image:hover{
		border: 1px solid black;
	}
	
	.home-product-link:hover{
		text-decoration:none;
	}
	
    </style>

    <link rel="stylesheet" href="{{url('public/css/newstyle.css')}}" type="text/css">

    <div class="custom-carousel">
        <div class="inner"><a id="carousel-link">
                <div id="carousel-1" class="item active" style="background-image: url('public/images/Desert.jpg'); background-size: 1198px 510px;"></div>
                <div id="carousel-2" class="item" style="background-image: url('public/images/Jellyfish.jpg'); background-size: 1198px 510px;"></div>
                <div id="carousel-3" class="item" style="background-image: url('public/images/Koala.jpg'); background-size: 1198px 510px;"></div>
                <div id="carousel-4" class="item" style="background-image: url('public/images/Tulips.jpg'); background-size: 1198px 510px;"></div>
                <div id="carousel-5" class="item" style="background-image: url('public/images/Lighthouse.jpg'); background-size: 1198px 510px;"></div>
            </a></div>
    </div>
    <div class="carousel-navigation-container">
        <ul class="carousel-navigation">
            <li id="carousel-nav-1" data-target="carousel-1" data-href="#promo" class="active">PROMO KAMIS GANTENG</li>
            <li id="carousel-nav-2" data-target="carousel-2" data-href="#newgadget">NEW GADGET NEW YOU</li>
            <li id="carousel-nav-3" data-target="carousel-3" data-href="#voucher">COLD STONE VOUCHER</li>
            <li id="carousel-nav-4" data-target="carousel-4" data-href="#newyear">NEW YEAR NEW STYLE</li>
            <li id="carousel-nav-5" data-target="carousel-5" data-href="#nba">NBA TOP SPENDER</li>
        </ul>
    </div>
    {{--<div class="featured-promo">--}}
        {{--<div class="trow one">--}}
            {{--<div class="tcol one-image">--}}
                {{--<a href="{{URL::to('product')}}">--}}
                    {{--<div class="image" style="background-image: url(public/images/tupperware-brand-logo.jpg)"></div>--}}
                {{--</a>--}}
            {{--</div>--}}
            {{--<div class="tcol two-image">--}}
                {{--<div class="image" style="background-image: url(public/images/tupperware-brand-logo.jpg)">--}}

                {{--</div>--}}
                {{--<div class="image" style="background-image: url(public/images/tupperware-brand-logo.jpg)">--}}

                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="tcol one-image">--}}
                {{--<div class="image" style="background-image: url(public/images/tupperware-brand-logo.jpg)">--}}

                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="trow two">--}}
            {{--<div class="tcol">--}}
                {{--<div class="image" style="background-image: url(public/images/tupperware-brand-logo.jpg)">--}}

                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="tcol">--}}
                {{--<div class="image" style="background-image: url(public/images/tupperware-brand-logo.jpg)">--}}

                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="featured-brand-stores">
        <h3>FEATURED BRAND & STORES</h3>
        <ul class="brand-stores">
            <li>
                <a href="{{URL::to('product')}}">
                    <div class="brand-image" style="background-image: url(public/images/tupperware-brand-logo.jpg)"></div>
                    <div class="brand-caption">Tupperware</div>
                </a>
            </li>
            <li>
                <a href="{{URL::to('product')}}">
                    <div class="brand-image" style="background-image: url(public/images/tupperware-brand-logo.jpg)"></div>
                    <div class="brand-caption">Tupperware</div>
                </a>
            </li>
            <li>
                <a href="{{URL::to('product')}}">
                    <div class="brand-image" style="background-image: url(public/images/tupperware-brand-logo.jpg)"></div>
                    <div class="brand-caption">Tupperware</div>
                </a>
            </li>
            <li>
                <a href="{{URL::to('product')}}">
                    <div class="brand-image" style="background-image: url(public/images/tupperware-brand-logo.jpg)"></div>
                    <div class="brand-caption">Tupperware</div>
                </a>
            </li>
            <li>
                <a href="{{URL::to('product')}}">
                    <div class="brand-image" style="background-image: url(public/images/tupperware-brand-logo.jpg)"></div>
                    <div class="brand-caption">Tupperware</div>
                </a>
            </li>
            <li>
                <a href="{{URL::to('product')}}">
                    <div class="brand-image" style="background-image: url(public/images/tupperware-brand-logo.jpg)"></div>
                    <div class="brand-caption">Tupperware</div>
                </a>
            </li>
        </ul>
    </div>
    <div class="featured-special">
        <h2 style="text-align: left; padding-left: 10px;">Most Popular Product</h2>
        <hr>
        <!--
        <div class="button-bar">
            <a href="#" class="button prev"></a>&nbsp&nbsp
            <a href="#" class="button next"></a>
        </div>
        -->
        <ul class="specials">
            @foreach($most_viewed_products as $product)
                <li class="home-product-image">
                <a href="{{URL::to('product/productDetail?product_id='.$product->id)}}" class="home-product-link">
                    <div class="special-image" style="background-image: url('{{asset('public/'.$product->image_link)}}')">
                        {{--<div class="special-discount">--}}
                            {{--<div class="discount-text">Up to <span class="discount-bold">60% OFF</span></div>--}}
                        {{--</div>--}}
                    </div>
                    <div class="special-caption">
                        {{$product->name}}
                    </div>
                </a>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="featured-special" style="margin-bottom: 20px;">
        <h2 style="text-align: left; padding-left: 10px;">New Arrival</h2>
        <hr>
        <!--
        <div class="button-bar">
            <a href="#" class="button prev"></a>&nbsp&nbsp
            <a href="#" class="button next"></a>
        </div>
        -->
        <ul class="specials">
            @foreach($products as $product)
                <li class="home-product-image">
                <a href="{{URL::to('product/productDetail?product_id='.$product->id)}}" class="home-product-link">
                    <div class="special-image" style="background-image: url('{{asset('public/'.$product->image_link)}}')">
                        {{--<div class="special-discount">--}}
                        {{--<div class="discount-text">Up to <span class="discount-bold">60% OFF</span></div>--}}
                        {{--</div>--}}
                    </div>
                    <div class="special-caption">
                        {{$product->name}}
                    </div>
                    </a>
                </li>

            @endforeach
        </ul>
        {{--<ul class="specials">--}}
            {{--<li>--}}
                {{--<div class="special-image" style="background-image: url(public/images/doll.png)">--}}
                    {{--<div class="special-discount">--}}
                        {{--<div class="discount-text">Up to <span class="discount-bold">60% OFF</span></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="special-caption">Doll</div>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<div class="special-image" style="background-image: url(public/images/doll.png)">--}}
                    {{--<div class="special-discount">--}}
                        {{--<div class="discount-text">Up to <span class="discount-bold">60% OFF</span></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="special-caption">Doll</div>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<div class="special-image" style="background-image: url(public/images/doll.png)">--}}
                    {{--<div class="special-discount">--}}
                        {{--<div class="discount-text">Up to <span class="discount-bold">60% OFF</span></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="special-caption">Doll</div>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<div class="special-image" style="background-image: url(public/images/doll.png)">--}}
                    {{--<div class="special-discount">--}}
                        {{--<div class="discount-text">Up to <span class="discount-bold">60% OFF</span></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="special-caption">Doll</div>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<div class="special-image" style="background-image: url(public/images/doll.png)">--}}
                    {{--<div class="special-discount">--}}
                        {{--<div class="discount-text">Up to <span class="discount-bold">60% OFF</span></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="special-caption">Doll</div>--}}
            {{--</li>--}}
        {{--</ul>--}}
    </div>
@stop