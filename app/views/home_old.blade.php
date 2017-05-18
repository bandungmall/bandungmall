@extends('layout.frontend')

@section('isi')
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
    <div class="featured-brand-stores">
        <h3>FEATURED BRAND & STORES</h3>
        <ul class="brand-stores">
            <li>
                <div class="brand-image" style="background-image: url(public/images/tupperware-brand-logo.jpg)"></div>
                <div class="brand-caption">Tupperware</div>
            </li>
            <li>
                <div class="brand-image" style="background-image: url(public/images/tupperware-brand-logo.jpg)"></div>
                <div class="brand-caption">Tupperware</div>
            </li>
            <li>
                <div class="brand-image" style="background-image: url(public/images/tupperware-brand-logo.jpg)"></div>
                <div class="brand-caption">Tupperware</div>
            </li>
            <li>
                <div class="brand-image" style="background-image: url(public/images/tupperware-brand-logo.jpg)"></div>
                <div class="brand-caption">Tupperware</div>
            </li>
            <li>
                <div class="brand-image" style="background-image: url(public/images/tupperware-brand-logo.jpg)"></div>
                <div class="brand-caption">Tupperware</div>
            </li>
            <li>
                <div class="brand-image" style="background-image: url(public/images/tupperware-brand-logo.jpg)"></div>
                <div class="brand-caption">Tupperware</div>
            </li>
        </ul>
    </div>
    <div class="featured-special">
        <h2>Happy New Year 2016</h2>
        <ul class="specials">
            <li>
                <div class="special-image" style="background-image: url(public/images/doll.png)">
                    <div class="special-discount">
                        <div class="discount-text">Up to <span class="discount-bold">60% OFF</span></div>
                    </div>
                </div>
                <div class="special-caption">Doll</div>
            </li>
            <li>
                <div class="special-image" style="background-image: url(public/images/doll.png)">
                    <div class="special-discount">
                        <div class="discount-text">Up to <span class="discount-bold">60% OFF</span></div>
                    </div>
                </div>
                <div class="special-caption">Doll</div>
            </li>
            <li>
                <div class="special-image" style="background-image: url(public/images/doll.png)">
                    <div class="special-discount">
                        <div class="discount-text">Up to <span class="discount-bold">60% OFF</span></div>
                    </div>
                </div>
                <div class="special-caption">Doll</div>
            </li>
            <li>
                <div class="special-image" style="background-image: url(public/images/doll.png)">
                    <div class="special-discount">
                        <div class="discount-text">Up to <span class="discount-bold">60% OFF</span></div>
                    </div>
                </div>
                <div class="special-caption">Doll</div>
            </li>
            <li>
                <div class="special-image" style="background-image: url(public/images/doll.png)">
                    <div class="special-discount">
                        <div class="discount-text">Up to <span class="discount-bold">60% OFF</span></div>
                    </div>
                </div>
                <div class="special-caption">Doll</div>
            </li>
        </ul>
    </div>
    <h2 class="section-title">TRENDING IN CATEGORIES</h2>
    <div class="category-trending">
        {{--<div class="trending-header">--}}
        {{--<ul class="trending-nav">--}}
        {{--<li>HOT DEALS Gadget!!</li>--}}
        {{--<li>Apple Watch Up to 59% OFF</li>--}}
        {{--<li>Cortex MMC</li>--}}
        {{--</ul>--}}
        {{--</div>--}}

        @foreach($data_category_parent as $key=>$parent)
            <div class="trending-content">
                <div class="trending-column trending-subcategories">
                    <a href="category.html"><h3 class="trending-title">{{$parent->name}}</h3></a>
                    <ul>
                        @foreach($data_category_child as $child)
                            @if($child['parent'] ==$parent['id'])
                                <li><a href="{{URL::to('product?category_id='.$child->id)}}"><li>{{$child['name']}}</li></a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="trending-column trending-carousel">
                    <div class="carousel-wrapper">
                        <div class="carousel-inner"><a class="carousel-link">
                                <div id="trending-carousel-1" data-href="#hotdeals" class="carousel-image active" style="background-image: url(public/images/Lighthouse.jpg)"></div>
                                <div id="trending-carousel-2" data-href="#newgadget" class="carousel-image" style="background-image: url(public/images/tupperware-brand-logo.png)"></div>
                                <div id="trending-carousel-3" data-href="#newphone" class="carousel-image" style="background-image: url(public/images/tupperware-brand-logo.png)"></div>
                            </a></div>
                        <div class="carousel-buttons">
                            <div data-target="trending-carousel-1" class="carousel-button active"></div>
                            <div data-target="trending-carousel-2" class="carousel-button"></div>
                            <div data-target="trending-carousel-3" class="carousel-button"></div>
                        </div>
                    </div>
                </div>
                <div class="trending-column trending-banner" style="background-image: url(public/images/tupperware-brand-logo.jpg)"></div>
                <div class="trending-column trending-products">
                    <div class="trending-product">
                        <div class="product-image" style="background-image: url(public/images/doll.png)"></div>
                        <div class="product-info">
                            <div class="product-name">Lenovo P1m</div>
                            <div class="product-price">Cicilan mulai Rp. 87,458/Bulan</div>
                        </div>
                    </div>
                    <div class="trending-product">
                        <div class="product-image" style="background-image: url(public/images/doll.png)"></div>
                        <div class="product-info">
                            <div class="product-name">Lenovo P1m</div>
                            <div class="product-price">Cicilan mulai Rp. 87,458/Bulan</div>
                        </div>
                    </div>
                </div>
                <div class="trending-column trending-products">
                    <div class="trending-product">
                        <div class="product-image" style="background-image: url(public/images/doll.png)"></div>
                        <div class="product-info">
                            <div class="product-name">Lenovo P1m</div>
                            <div class="product-price">Cicilan mulai Rp. 87,458/Bulan</div>
                        </div>
                    </div>
                    <div class="trending-product">
                        <div class="product-image" style="background-image: url(public/images/doll.png)"></div>
                        <div class="product-info">
                            <div class="product-name">Lenovo P1m</div>
                            <div class="product-price">Cicilan mulai Rp. 87,458/Bulan</div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="trending-footer">
            <ul class="trending-brands">
                <li>BRAND & MERCHANT PILIHAN</li>
                <li>Samsung</li>
                <li>Apple</li>
                <li>Xiaomi</li>
                <li>Asus</li>
                <li>Sony</li>
                <li>Channel B</li>
            </ul>
        </div>
    </div>
@stop