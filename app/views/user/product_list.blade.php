@extends('user.templates.layout')

@include('user.templates.add_to_cart')

@section('content')

  <!-- CONTENT START -->
  <div class="content"> 
    
    <!--======= SUB BANNER =========-->
    <section class="sub-banner animate fadeInUp" data-wow-delay="0.4s">
      <div class="container">
        @if(isset($data_category_child))
          @if($data_category_child->has_grand_child == "yes")
            <h4 style="text-transform: uppercase;">KOLEKSI {{$data_category_grand_child->name}} {{$data_category_root->name}}</h4>
          @else
            <h4 style="text-transform: uppercase;">KOLEKSI {{$data_category_child->name}} {{$data_category_root->name}}</h4>
          @endif
        @else
        <h4>HASIL PENCARIAN</h4>
        @endif
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
          <li><a style="color:#b8b8b8;" href="#">Home</a></li>
          @if(isset($data_category_root))
            <li>
              {{$data_category_root->name}}
            </li>
          @endif

          @if(isset($data_category_parent))
            <li>
              {{$data_category_parent->name}}
            </li>
          @endif

          @if(isset($data_category_child))
            <li class="<?php echo $data_category_child->has_grand_child == 'yes'? '':'active'?>">
              @if($data_category_child->has_grand_child == "yes")
                {{$data_category_child->name}}
              @else 
                <a style="color:#e05757;" href="product/c-{{$data_category_child->id}}">{{$data_category_child->name}}</a>
              @endif
            </li>
          @endif

          @if(isset($data_category_grand_child))
            <li class="active">
              <a style="color:#e05757;" href="product/c-{{$data_category_grand_child->id}}">{{$data_category_grand_child->name}}</a>
            </li>
           @endif
          
        </ol>
      </div>
    </section>

    <!--======= PAGES INNER =========-->
    <section class="section-p-30px pages-in">
      <div class="container">
        <div class="row"> 

          @include('user.left_navbar')

          <!--======= ITEMS =========-->
          <div class="col-sm-9 animate fadeInUp" data-wow-delay="0.2s">
            <div class="items-short-type animate fadeInUp" data-wow-delay="0.4s"> 
              
              <!--======= GRID LIST STYLE =========-->
              <div class="grid-list"> 
                <?php 
                  $url = $_SERVER['REQUEST_URI'];
                  $url = explode("/", $url);
                  
                ?>
                <a href="product/{{$url[3]}}" style="padding-top: 7px;"><i class="fa fa-th-large grid-view" title="Grid"></i></a> 
                <a href="product-list/{{$url[3]}}" style="padding-top: 7px;"><i class="fa fa-th-list list-view" title="List"></i></a> 
              </div>
              
              <!--======= SHOWING =========-->
              <div class="short-by">
                <p>Showing {{$products-> count()}} products</p>
              </div>
            </div>

            <!--======= Products =========-->
            <div class="popurlar_product">
              @if($products->isEmpty())
              <div class="w100 productFilter clearfix">
                <h2>Tidak ada produk ditemukan</h2>
              </div>
              @else
              <ul class="row">
                
                @foreach ($products as $product)
                <!-- New Products -->
                <li class="col-sm-4 animate fadeIn" data-wow-delay="0.4s">
                  <div class="items-in"> 
                    
                    @if($product->discount > 0 && strtotime(date('Y-m-d')) >= strtotime($product->discount_date_start)  && strtotime(date('Y-m-d')) <= strtotime($product->discount_date_end))
                    <div style="z-index:1; font-size:9px;" class="hot-tag">{{$product->discount}}% OFF</div>
                    @endif

                    <!-- Image --> 
                    <img src="{{$product->image_link }}" alt=""> 
                    <!-- Hover Details -->
                    <div class="over-item">
                      <ul class="animated fadeIn">
                        <li class="full-w"> <a href="#" id="addCart-{{$product->id}}" onclick="addToCart({{$product->id}})" data-toggle="modal" data-target="#ModalAddToCart" data-id="{{$product->id}}" class="btn"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp;ADD TO CART</a></li>
                        <li class="full-w"> <a href="productDetail/{{$product->id}}" class="btn"><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;DETAIL PRODUCT</a></li>
                      </ul>
                    </div>
                    <!-- Item Name -->
                    <div class="details-sec"> 
                      <a href="productDetail/{{$product->id}}">{{$product->name}}</a> 
                      <div>{{ $product->brand }}</div>
                      @if($product->discount > 0 && strtotime(date('Y-m-d')) >= strtotime($product->discount_date_start)  && strtotime(date('Y-m-d')) <= strtotime($product->discount_date_end))
                      <?php $priceNow = (100 - $product->discount) * $product->price / 100; ?>
                      <span class="text-line">Rp. {{number_format($product->price,2,',','.')}}</span>
                      <span class="font-montserrat">Rp. {{number_format($priceNow,2,',','.')}}</span>
                      @else
                      <span class="font-montserrat">Rp. {{number_format($product->price,2,',','.')}}</span>
                      @endif
                    </div>
                  </div>
                </li>
                @endforeach

              </ul>
              <?php  
                $search = Input::get('search');
                $category_id = Input::get('category_id');
                if(isset($category_id)){
                  echo $products->appends(array('category_id' => $category_id))->links(); 
                }
                else{
                  echo $products->appends(array('search' => $search))->links();
                }
              ?>
              @endif
            </div>

          </div>
        </div>
      </div>
    </section>

  </div>
  
<!-- Product Details Modal  -->
<div class="modal fade" id="productSetailsModalAjax" tabindex="-1" role="dialog"
     aria-labelledby="productSetailsModalAjaxLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
  
@endsection

@section('javascript')
<!-- include custom script for only homepage  -->
<script src="{{ asset('public/assets/user/js/home.js') }}"></script>


@endsection
