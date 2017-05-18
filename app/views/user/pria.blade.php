@extends('user.templates.layout')

@section('stylesheet')

@endsection

@section('content')

<div class="container main-container headerOffset globalPaddingBottom">

    <!-- Main component call to action -->
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="home-intro">
                <h2>Discover a Better Shopping <span>Experience</span> - clothes, fashion & more </h2>
            </div>
            <hr>
        </div>
    </div>
    <!-- Most popular -->
    <section class="section-hero white-bg" id="product-category">
    <div class="container">
      <div class="hero-section-header ">
        <h3 class="section-title style2 text-center"><span>Kategori Pria</span></h3>
      </div>

      <div class="section-content">
        <div class="row has-equal-height-child">
        @foreach ($products as $product)
        	<div class="item itemauto col-lg-3 col-md-3 col-sm-6 col-xs-6">
              <div class="product">
                <div class="imageHover">
                  <div id="carousel-id-3" class="carousel slide carousel-fade" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                      <div class="item active">
                        <a href="{{ URL::to('product?category_id=' . $product->id) }}">
                          <img src="{{ asset('public/assets/user/images/brand/1.gif') }}" alt="img" class="img-responsive" >
                        </a>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
        @endforeach
        </div>
    </div>
    </div>
  	</section>



    <!-- Most popular -->
    <section class="section-hero white-bg" id="section-category">
    <div class="container">
      <div class="hero-section-header ">
        <h3 class="section-title style2 text-center"><span>Most Popular</span></h3>
      </div>

      <div class="section-content">
        <div class="row has-equal-height-child">

          @forelse ($most_viewed_products as $product)
            <div class="item itemauto col-lg-3 col-md-3 col-sm-6 col-xs-6">
              <div class="product">
                <div class="imageHover">
                  <div id="carousel-id-2" class="carousel slide carousel-fade" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                      <div class="item active">
                        <a href="{{ URL::to('productDetail?product_id=' . $product->id) }}">
                          <img src="{{ asset($product->image_link) }}" alt="img" class="img-responsive">
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="description">
                    <h4><a href="{{ URL::to('productDetail?product_id=' . $product->id) }}"> {{ $product->name }} </a></h4>

                    <p class="text-center">Rp {{ $product->price }}</p>
                  </div>
                </div>
              </div>
            </div>
          @empty
            <p class="lead text-center">Belum ada produk</p>
          @endforelse
        </div>
      </div>
    </div>
  </section>
</div>
@endsection

