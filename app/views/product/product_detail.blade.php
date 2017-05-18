@extends('layout.frontend')

@section('isi')

    <link rel="stylesheet" href="{{asset('public/izet/bower_components/normalize-css/normalize.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/izet/bower_components/bootstrap/dist/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/izet/bower_components/bootstrap/dist/css/bootstrap-theme.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/izet/assets/css/style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/izet/assets/css/product.css')}}" type="text/css">

<style>
  .magnify {width: 300px; margin: 50px auto; position: relative;}

  /*Lets create the magnifying glass*/
  .large {
    width: 200px; height: 200px;
    position: absolute;
    border-radius: 100%;
    
    /*Multiple box shadows to achieve the glass effect*/
    box-shadow: 0 0 0 7px rgba(255, 255, 255, 0.85), 
    0 0 7px 7px rgba(0, 0, 0, 0.25), 
    inset 0 0 40px 2px rgba(0, 0, 0, 0.25);
    
    /*Lets load up the large image first*/
    
    
    /*hide the glass by default*/
    display: none;
  }

  /*To solve overlap bug at the edges during magnification*/
  .small { display: inline-block; width: 300px}
</style>

<section class="content-section product-section">
    <div class="content-row map">
        <ul class="map-list">
            <li>{{$category['category_parent_name']}}</li>
            <li><a href="{{URL::to('product?category_id='.$category['category_id'])}}" >{{$category['category_name']}}</a></li>
        </ul>
    </div>
    <div class="content-row product">
        <div class="content-column column-product">
            <div class="product-wrapper">
                <div class="product-column image-gallery">
                    <ul class="image-list">
                        {{--<li style="background-image: url(assets/images/Desert.jpg)" data-src="assets/images/Desert.jpg" class="active"></li>--}}
                        {{--<li style="background-image: url(assets/images/Koala.jpg)" data-src="assets/images/Koala.jpg"></li>--}}
                        {{--<li style="background-image: url(assets/images/Tulips.jpg)" data-src="assets/images/Tulips.jpg"></li>--}}
                        <li>
                            <a href="#" onclick="return false;"><img class="productdetailthumbsnailimage" id="small_image" style="display:inline-block;" src="{{asset('public/'.$product[0]->image_link)}}" alt="" width="100px"></a>
                        </li>
                        @foreach($product_images as $image)
                            <li>
                                <a href="#" onclick="return false;"><img class="productdetailthumbsnailimage" id="small_image" style="display:inline-block;" src="{{asset('public/'.$image->image_link)}}" alt="" width="100px"></a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="product-column image-preview">
                    {{--<div id="product-image" class="image" style="background-image: url(assets/images/Desert.jpg"></div>--}}
                    <div class="magnify">
                        <div id="large_div" class="large" style="background: url('{{asset('public/'.$product[0]['image_link'])}}') no-repeat;"></div>
                        <img class="small" src="{{asset('public/'.$product[0]['image_link'])}}"/>
                    </div>
                </div>
                <div class="product-column product-info">
                    <div class="product-name">{{$product[0]->name}}</div>
                    <div class="product-brand">Brand: <a href>{{$product[0]->brand}}</a></div>
                    <hr>
                    <?php $price = $product[0]->price; ?>
                    @if($product[0]->discount ==NULL || $product[0]->discount_date_start > date("Y-m-d") || $product[0]->discount_date_end < date("Y-m-d"))
                        <div class="product-discount">
                            <div class="product-discount-price">Rp {{number_format($product[0]->price, 0, '', '.');}}</div>
                            {{--<div class="product-discount-installment">CICILAN 0%</div>--}}
                        </div>
                    @else
                        <div class="product-price slash">Rp {{number_format($product[0]->price, 0, '', '.');}}</div>
                        <div class="product-discount">
                            <?php $price = $product[0]->price - ($product[0]->price * $product[0]->discount)/100 ?>
                            <div class="product-discount-price">Rp {{number_format($price, 0, '', '.');}}</div>
                            <div class="product-discount-off">{{$product[0]->discount}}% OFF</div>
                            {{--<div class="product-discount-installment">CICILAN 0%</div>--}}
                        </div>
                    @endif
                    {{--<div class="product-rewards">Rewards: <a href>3,000 poin</a></div>--}}
                    <div class="product-installment">
                        <div class="installment-row">
                            <div>Cicilan 0% - 6 bln</div>
                            <div>Rp {{number_format($price/6, 0, '', '.');}}</div>
                            <div>/bulan</div>
                        </div>
                        <div class="installment-row">
                            <div>Cicilan 0% - 12 bln</div>
                            <div>Rp {{number_format($price/12, 0, '', '.');}}</div>
                            <div>/bulan</div>
                        </div>
                    </div>
                    <div class="product-shipper">
                        <div class="shipper-info">Disediakan dan dikirimkan oleh <b>onlineshop.com</b></div>
                    </div>
                    <div class="product-detail">
                        <h4 class="title">Detail Produk</h4>
                        <ul class="details">
                            @foreach($product_specs as $product_spec)
                                <li>{{$product_spec->spec_name}}: {{$product_spec->spec_detail}}</li>
                            @endforeach
                        </ul>
                        {{--<div class="bold">Garansi resmi TAM 1 Tahun</div>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="content-column column-order">
            <div class="order">
                @if($product[0]->quantity >0)
                    <div class="order-availability">Stok tersedia</div>
                @endif
                <form action="{{url('cart/add')}}" method="post">
                    <input type="hidden" name="product_id" value="{{$product[0]->id}}"/>
                    <div class="order-quantity">
                        <span class="order-quantity-text">Jumlah</span>
                        <input class="order-quantity-input" type="number" name="quantity" min="1" value="1">
                    </div>
                    <div class="order-buy-button">

                        <button style="color: #FFF;" class="btn-link btn-block" id="add_to_cart" type="submit">
                            <span class="glyphicon glyphicon-shopping-cart"></span>
                            BELI
                        </button>

                    </div>
                </form>
                {{--<div class="order-wishlist-button">--}}
                    {{--<span class="glyphicon glyphicon-heart"></span>--}}
                    {{--Tambahkan ke Wishlist--}}
                {{--</div>--}}
            </div>
            <div class="also-buy">
                <h3 class="also-buy-title">Customer yang melihat produk ini juga membeli</h3>
                @foreach($products as $p)
                    <div class="suggested-product">
                        <div class="product-image" style="background-image: url('{{asset('public/'.$p->image_link)}}')"></div>
                        <div class="product-info">
                            <div class="product-name"><a href="{{URL::to('product/productDetail?product_id='.$p->id)}}">{{$p->name}}</a></div>
                            <div class="product-price">Rp {{number_format($p->price, 0, '', '.');}}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <hr>
    <div class="content-row product-description">
        <h3 class="title">Deskripsi Produk</h3>
        <div class="description">
            {{$product[0]->description}}
        </div>
    </div>
</section>

    <script src="{{asset('public/izet/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/izet/assets/js/script.js')}}"></script>
    <script src="{{asset('public/izet/assets/js/product.js')}}"></script>

<script src="{{url('public/izet/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {

  var native_width = 0;
    var native_height = 0;

    //Now the mousemove function
    $(".magnify").mousemove(function(e){
      //When the user hovers on the image, the script will first calculate
      //the native dimensions if they don't exist. Only after the native dimensions
      //are available, the script will show the zoomed version.
      if(!native_width && !native_height)
      {
        //This will create a new image object with the same image as that in .small
        //We cannot directly get the dimensions from .small because of the 
        //width specified to 200px in the html. To get the actual dimensions we have
        //created this image object.
        var image_object = new Image();
        image_object.src = $(".small").attr("src");
        
        //This code is wrapped in the .load function which is important.
        //width and height of the object would return 0 if accessed before 
        //the image gets loaded.
        native_width = image_object.width;
        native_height = image_object.height;
      }
      else
      {
        //x/y coordinates of the mouse
        //This is the position of .magnify with respect to the document.
        var magnify_offset = $(this).offset();
        //We will deduct the positions of .magnify from the mouse positions with
        //respect to the document to get the mouse positions with respect to the 
        //container(.magnify)
        var mx = e.pageX - magnify_offset.left;
        var my = e.pageY - magnify_offset.top;
        
        //Finally the code to fade out the glass if the mouse is outside the container
        if(mx < $(this).width() && my < $(this).height() && mx > 0 && my > 0)
        {
          $(".large").fadeIn(100);
        }
        else
        {
          $(".large").fadeOut(100);
        }
        if($(".large").is(":visible"))
        {
          //The background position of .large will be changed according to the position
          //of the mouse over the .small image. So we will get the ratio of the pixel
          //under the mouse pointer with respect to the image and use that to position the 
          //large image inside the magnifying glass
          var rx = Math.round(mx/$(".small").width()*native_width - $(".large").width()/2)*-1;
          var ry = Math.round(my/$(".small").height()*native_height - $(".large").height()/2)*-1;
          var bgp = rx + "px " + ry + "px";
          
          //Time to move the magnifying glass with the mouse
          var px = mx - $(".large").width()/2;
          var py = my - $(".large").height()/2;
          //Now the glass moves with the mouse
          //The logic is to deduct half of the glass's width and height from the 
          //mouse coordinates to place it with its center at the mouse coordinates
          
          //If you hover on the image now, you should see the magnifying glass in action
          $(".large").css({left: px, top: py, backgroundPosition: bgp});
        }
      }
    })


    //bar bar hilangin bug
    $(".magnify").mouseout(function(e){
      if(!native_width && !native_height)
      {
        var image_object = new Image();
        image_object.src = $(".small").attr("src");

        native_width = image_object.width;
        native_height = image_object.height;
      }
      else
      {
        var magnify_offset = $(this).offset();
        var mx = e.pageX - magnify_offset.left;
        var my = e.pageY - magnify_offset.top;
        if(mx < $(this).width() && my < $(this).height() && mx > 0 && my > 0)
        {
          $(".large").fadeIn(100);
        }
        else
        {
          $(".large").fadeOut(100);
        }
        if($(".large").is(":visible"))
        {
          var rx = Math.round(mx/$(".small").width()*native_width - $(".large").width()/2)*-1;
          var ry = Math.round(my/$(".small").height()*native_height - $(".large").height()/2)*-1;
          var bgp = rx + "px " + ry + "px";
          
          var px = mx - $(".large").width()/2;
          var py = my - $(".large").height()/2;

          $(".large").css({left: px, top: py, backgroundPosition: bgp});
        }
      }
    })

  $('.productdetailthumbsnailimage').click(function() {
        var loc = $(this).attr("src");
        $('.large').css("background", "url('"+loc+"') no-repeat");
        $('.small').attr("src",loc);
    });
});
</script>

@stop