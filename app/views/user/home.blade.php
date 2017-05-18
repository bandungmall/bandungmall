@extends('user.templates.layout')

@section('content')

  <!--======= HOME MAIN SLIDER =========-->
  <section class="home-slider">
    <div class="tp-banner-container">
      <div class="tp-banner-fix" >
        <ul>
		@foreach ($banners as $banner)
			<li data-transition="random" data-slotamount="7"><img src="{{ asset($banner->image_url) }}" data-bgposition="center center" alt="" /></li>
        @endforeach
        </ul>
      </div>
    </div>
  </section>

  <!-- CONTENT START -->
  <div class="content"> 
    
    <!--======= FEATURED BRANDS =========-->
    @if (!$brands->isEmpty())
    <section class="section-p-60px our-clients" style="display:none;">
      <div class="container"> 
        <!--  Tittle -->
        <div class="tittle animate" data-wow-delay="0.4s">
          <h5>FEATURED BRANDS</h5>
        </div>
        
        <!--  Client Logo Slider -->
        <div class="client-slide animate" data-wow-delay="0.4s">
          @foreach ($brands as $brand)
          <div class="slide" style="max-height:100px; max-width:100px;">
            <a href="{{ URL::to($brand->target_url) }}">
              <img src="{{ asset($brand->image_url) }}" alt="{{ $brand->name }}" title="{{ $brand->name }}" class="img-responsive">
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </section>
    @endif
	
	<!--======= PROMOTIONS =========-->
    @if ($promotions->count() >= 5)
    <section class="section-p-30px grid-collection">
      <div class="container">
        <ul class="row">
          
          <!-- ADD 1 -->
          <li class="col-sm-4">
            <div class="inn-sec animate fadeInLeft" data-wow-delay="0.6s"> <a href="{{ $promotions[0]->target_url }}"> {{ HTML::image($promotions[0]->image_url, 'a picture', array('class' => 'img-responsive')) }}
              
              </a> </div>
            
            <!-- ADD 2 -->
            <div class="inn-sec animate fadeInLeft" data-wow-delay="0.6s"> <a href="{{ $promotions[3]->target_url }}">
            {{ HTML::image($promotions[3]->image_url, 'a picture', array('class' => 'img-responsive')) }}
              </a> </div>
          </li>
          
          <!-- ADD 3 -->
          <li class="col-sm-4 animate fadeIn" data-wow-delay="0.6s">
            <div class="inn-sec trd"> <a href="{{ $promotions[1]->target_url }}"> 
            {{ HTML::image($promotions[1]->image_url, 'a picture', array('class' => 'img-responsive')) }}
              </a> </div>
          </li>
          
          <!-- ADD 1 -->
          <li class="col-sm-4">
            <div class="inn-sec animate fadeInRight" data-wow-delay="0.6s"> <a href="{{ $promotions[2]->target_url }}"> 
            {{ HTML::image($promotions[2]->image_url, 'a picture', array('class' => 'img-responsive')) }}
              </a> </div>
            
            <!-- ADD 2 -->
            <div class="inn-sec last animate fadeInRight" data-wow-delay="0.6s"> <a href="{{ $promotions[4]->target_url }}">
            {{ HTML::image($promotions[4]->image_url, 'a picture', array('class' => 'img-responsive')) }}
              </a> </div>
          </li>
        </ul>
      </div>
    </section>
    @endif
	
    <!--======= PARALLAX =========-->
    <section class="parallex" data-stellar-background-ratio="0.7" style="background-image: url('{{ asset('public/assets/user/images/parallax/parallax.jpg') }}');display:none;"> 
      <div class="overlay">
        <div class="container">
          <h2 class="animate" data-wow-delay="0.2s" style="color:#fff">BANDUNGMALL</h2>
          <h2 class="animate" data-wow-delay="0.25s" style="color:#fff">KIBLATNYA DUNIA FASHION</h2>
          <h3 class="animate" data-wow-delay="0.3s" style="color:#fff"> Belanja dan dapatkan produk menarik dengan harga baik setiap hari </h3>
          <a class="btn btn-discover animate" data-wow-delay="0.35s" > <i class="fa fa-shopping-cart"></i> SHOP NOW </a>
        </div>
      </div>
    </section>

    <!--======= MOST POPULAR =========-->
    <section class="section-p-30px new-arrival ">
      <div class="container"> 
        
        <!--  Tittle -->
        <div class="tittle animate" data-wow-delay="0.4s">
          <h5>MOST POPULAR</h5>
        </div>
        <div class="popurlar_product animate product-column" data-wow-delay="0.4s">
          <ul class="row">

            @forelse ($most_viewed_products as $product)
            <!--  New Arrival  -->
            <li class="col-sm-3">
              <div class="items-in"> 
                <!-- Image -->
				<a href="{{ URL::to('productDetail/' . $product->id) }}">
                <img src="{{ asset($product->image_link) }}" alt="Image">
				</a>
                <!-- Hover Details -->
                <div class="over-item" style="display:none;visibility:0;">
                  <ul class="animated">
                    <li class="full-w"> <a id="addCart-{{$product->id}}" href="#" onclick="addToCart({{$product->id}})" data-toggle="modal" data-target="#ModalAddToCart" data-id="{{$product->id}}" class="btn"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp;ADD TO CART</a></li>
                        <li class="full-w"> <a href="productDetail/{{$product->id}}" class="btn"><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;DETAIL PRODUCT</a></li>
                  </ul>
                </div>
                <!-- Item Name -->
                <div class="details-sec"> <a href="{{ URL::to('productDetail/' . $product->id) }}">{{ $product->name }}</a> <span class="font-montserrat">Rp {{ number_format($product->price,2,',','.') }}</span> </div>
				<div class="details-sec"> <a href="{{ URL::to('productDetail/' . $product->id) }}"  class="btn btn-black"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp;BELI</a></div>
			  </div>
            </li>
            @empty
              <p class="lead text-center">Belum ada produk</p>
            @endforelse

          </ul>
        </div>
      </div>
    </section>

    <!--======= NEW ARRIVAL =========-->
    <section class="section-p-30px new-arrival ">
      <div class="container"> 
        
        <!--  Tittle -->
        <div class="tittle animate" data-wow-delay="0.4s">
          <h5>NEW ARRIVAL</h5>
        </div>
        <div class="popurlar_product animate product-column" data-wow-delay="0.4s">
          <ul class="row">

            @forelse ($products as $product)
            <!--  New Arrival  -->
            <li class="col-sm-3">
              <div class="items-in"> 
                <!-- Image -->
				<a href="{{ URL::to('productDetail/' . $product->id) }}">
                <img src="{{ asset($product->image_link) }}" alt="Image"> 
				</a>
                <!-- Hover Details -->
                <div class="over-item" style="display:none;">
                  <ul class="animated">
                    <li class="full-w"> <a href="#" id="addCart-{{$product->id}}" onclick="addToCart({{$product->id}})" data-toggle="modal" data-target="#ModalAddToCart" class="btn"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp;ADD TO CART</a></li>
                        <li class="full-w"> <a href="productDetail/{{$product->id}}" class="btn"><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;DETAIL PRODUCT</a></li>
                  </ul>
                </div>
                <!-- Item Name -->
                <div class="details-sec"> <a href="{{ URL::to('productDetail/' . $product->id) }}">{{ $product->name }}</a> <span class="font-montserrat">Rp {{ number_format($product->price,2,',','.') }}</span> </div>
				<div class="details-sec"> <a href="{{ URL::to('productDetail/' . $product->id) }}"  class="btn btn-black"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp;BELI</a></div>
			  </div>
            </li>
            @empty
              <p class="lead text-center">Belum ada produk</p>
            @endforelse

          </ul>
        </div>
      </div>
    </section>

  </div>

@endsection


@section('javascript')
<!-- include custom script for only homepage  -->
<script src="{{ asset('public/assets/user/js/home.js') }}"></script>

<script type="text/javascript">

$("#owl-brand").owlCarousel({ 
        items:10,   
        itemsDesktop : [1199,10],
        itemsDesktopSmall : [980,9],
        itemsTablet: [768,5],
        itemsTabletSmall: false,
        itemsMobile : [479,4]
});
  
</script>

@endsection
