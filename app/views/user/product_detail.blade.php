@extends('user.templates.layout')

@section('content')


  <!-- CONTENT START -->
  <div class="content">
    
    <!--======= SUB BANNER =========-->
    <section class="sub-banner animate" data-wow-delay="0.4s" style="border:0 none !important;">
      <div class="container">
        <h4>{{$product->name}}</h4>
        <!-- Breadcrumb -->
        <ol class="breadcrumb">
          <li><a href="index.html">Home</a></li>
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
	<section class="section-p-30px pages-in item-detail-page">
		<div class="container">
			<div class="row"> 
				<!--======= IMAGES SLIDER =========-->
				<div class="col-sm-6 large-detail animate" data-wow-delay="0.4s">
					<div class="images-slider">
					  <ul class="slides">
					  <?php $first_image = '';?>
						@foreach($product_images as $product_img)
						<?php
						  if($first_image == ''){
							$first_image = $product_img['image_link'];
						  } 
						?>
						<li data-thumb="{{$product_img->image_link}}">
						  <img src="{{$product_img->image_link}}" class="img-responsive" alt="img">
						</li>
						@endforeach
					  </ul>
					</div>
				</div>

				<!--======= ITEM DETAILS =========-->
				<div class="col-sm-6 animate" data-wow-delay="0.4s">
					<div class="row">
						<div class="col-sm-12">
						<h5>{{$product->name}}</h5>
						@if($product->discount > 0 && strtotime(date('Y-m-d')) >= strtotime($product->discount_date_start)  && strtotime(date('Y-m-d')) <= strtotime($product->discount_date_end))
						<div style="z-index:1; font-size:9px;" class="hot-tag">{{$product->discount}}% OFF</div>
						@endif
						@if($product->discount > 0 && strtotime(date('Y-m-d')) >= strtotime($product->discount_date_start)  && strtotime(date('Y-m-d')) <= strtotime($product->discount_date_end))
						<?php $priceNow = (100 - $product->discount) * $product->price / 100; ?>
						<span class="text-line">Rp. {{number_format($product->price,2,',','.')}}</span>
						<span class="price">Rp. {{number_format($priceNow,2,',','.')}}</span>
						@else
						<span class="price">Rp. {{number_format($product->price,2,',','.')}}</span>
						@endif
						</div>
						
						<div class="col-sm-12"> 
						<span class="code">PRODUCT CODE: {{$product->id}}{{$product->merchant_id}}{{$product->category_id}}</span>
						<div class="some-info no-border"> <br>
						@if ($product->is_active ==="yes")
						<div class="in-stoke"> <i class="fa fa-check-circle"></i> IN STOCK ({{$product->quantity}} BUAH)</div>
						@else
						<div class="in-stoke"> <i class="fa fa-minus-circle"></i> OUT OF STOCK</div>
						@endif
						<div class="in-stoke"> <i class="fa fa-lock"></i> SECURE ONLINE ORDERING</div>
						</div>
						</div>  
					</div>
					
					<form action="{{ URL::to('cart/add') }}" method="POST">
						@if($errors->any())
						<h6 class="error" style="color:#ff0000">{{$errors->first()}}</h4>
						@endif

						@if(isset($priceNow))
						<input type="hidden" name="price" value="{{$priceNow}}">
						@else 
						<input type="hidden" name="price" value="{{$product->price}}">
						@endif

						<input type="hidden" name="product_id" value="{{$product->id}}">
						<input type="hidden" name="product_name" value="{{$product->name}}">
						<input type="hidden" name="images" value="{{$first_image}}">

						<div class="row">
							@if($product->color != "0")
							<div class="col-sm-12">
							  <div class="item-select"> 
								<!-- COLOR -->
								<p>WARNA</p>
								<select class="selectpicker" name="color" required>
								<option value="0">Pilih Warna</option>
								  <option value="{{$product->color}}">{{$product->color}}</option>
								</select>
							  </div>
							</div>
							@else
							  <input type="hidden" name="color" value="no_color">
							@endif

							<?php $size = explode(",",$product->size); ?>
							@if(!in_array("0",$size))
							<div class="col-sm-12">
							  <div class="item-select">
								<!--  UKURAN -->
								<p>UKURAN</p>
								  
									<select class="selectpicker" name="size" required>
									<option value="0">Pilih Ukuran</option>
									@foreach($size as $val)
									  <option value="{{$val}}">{{$val}}</option>
									@endforeach
									</select>
							  </div>
							</div>
							@else
							  <input type="hidden" name="size" value="no_size">
							@endif
						</div>
						  
						<div class="row"> 
							<div class="col-sm-12">
								<div class="fun-share">
									<button style="margin:0" class="btn btn-dark btn-primary" id="minusQtyDetail">-</button>
									<input class="form-control" type="text" name="quantity" value="1" required>
									<button style="margin:0" class="btn btn-dark btn-primary" id="plusQtyDetail">+</button>
								</div>
							</div>
						</div>
							
						<div class="row"> 
							<!-- QUIENTY -->
							<div class="col-sm-12">
							  <div class="fun-share">
								<button type="submit" class="btn btn-small btn-dark" style="min-width:183px;">BELI</button>
							  </div>
							</div>
						</div>
						
						<!--======= PRODUCT DESCRIPTION =========-->
						<div class="item-decribe animate" data-wow-delay="0.4s">
							<div class="text-center"> 
							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist">
							  <li role="presentation" class="active"><a href="#descr" aria-controls="men" role="tab" data-toggle="tab">DETAILS</a></li>
							</ul>
							</div>
							<!-- Tab panes -->
							<div class="tab-content"> 
							<!-- DETAILS -->
							<div role="tabpanel" class="tab-pane fade in active" id="descr">
							  {{$product->description}}
							  <table class="table">
								<tbody>
								  @if($product->discount > 0 && strtotime(date('Y-m-d')) >= strtotime($product->discount_date_start)  && strtotime(date('Y-m-d')) <= strtotime($product->discount_date_end))
								  <tr>
									<td><strong>Batas Diskon</strong></td>
									<td>{{date('d-M-Y',strtotime($product->discount_date_end))}}</td>
								  </tr>
								  @endif
								</tbody>
							  </table>
							</div>
							<!-- TAGS -->
							<div role="tabpanel" class="tab-pane fade" id="tags"> </div>
							</div>
						</div>				
					</form>
				</div>
				<!--======= ITEM DETAILS =========-->
			</div>
		</div>
	</section>

      <!--======= RELATED PRODUCTS =========-->
      <section class="section-p-60px new-arrival new-arri-w-slide">
        <div class="container"> 
          
          <!--  Tittle -->
          <div class="tittle tittle-2 animate" data-wow-delay="0.4s">
            <h5>YOU MAY ALSO LIKE</h5>
          </div>
          
          <!--  New Arrival Tabs Products  -->
          <div class="popurlar_product client-slide-4 animate" data-wow-delay="0.4s"> 
            
            @forelse ($products as $recomendation)
            <!--  New Arrival  -->
            <div class="items-in"> 
              <!-- Image --> 
              <a href="{{ URL::to('productDetail/' . $recomendation->id) }}"><img src="{{ asset($recomendation->image_link) }}" alt=""></a>
              <!-- Hover Details -->
              <div class="over-item" style="display:none;">
                <ul class="animated">
                  <li class="full-w"> <a href="#" id="addCart-{{$recomendation->id}}"  onclick="addToCart({{$recomendation->id}})" data-toggle="modal" data-target="#ModalAddToCart" class="btn"><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp;&nbsp;ADD TO CART</a></li>
                        <li class="full-w"> <a href="productDetail/{{$recomendation->id}}" class="btn"><i class="fa fa-info"></i>&nbsp;&nbsp;&nbsp;DETAIL PRODUCT</a></li>
                </ul>
              </div>
              <!-- Item Name -->
              <div class="details-sec"> <a href="{{ URL::to('productDetail/' . $recomendation->id) }}">{{ $recomendation->name }}</a> <span class="font-montserrat">Rp {{ number_format($recomendation->price,2,',','.') }}</span> </div>
			  <div class="details-sec"> <a href="{{ URL::to('productDetail/' . $product->id) }}"  class="btn btn-black"></i>&nbsp;&nbsp;&nbsp;BELI</a></div>
			</div>
            @empty
            <p class="lead text-center">Belum ada produk</p>
            @endforelse

          </div>
        </div>
      </section>

    </section>

  </div>
@endsection
@section('javascript')

<script type="text/javascript">
  $(function(){
    $("#plusQtyDetail").click(function(e){
      e.preventDefault();
      var qty = parseInt($("input[name='quantity']").val());
      qty = qty + 1;
      $("input[name='quantity']").val(qty);
    });
    $("#minusQtyDetail").click(function(e){
      e.preventDefault();
      var qty = parseInt($("input[name='quantity']").val());
      qty = qty - 1;
      if(qty < 1) {
        alert('Jumlah tidak boleh kurang dari 1')
        $("input[name='quantity']").val('1');
      }
      else $("input[name='quantity']").val(qty);
    });
  });
</script>


@endsection