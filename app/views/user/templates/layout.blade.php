<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="{{ asset('public/assets/common/images/icon.png') }}">
<base href='http://bandungmall.co.id/'></base>
<title>Bandungmall - {{ $title or "" }}</title>

<!-- FONTS ONLINE -->
<link href='http://fonts.googleapis.com/css?family=Playfair+Display:400,700,900,400italic,700italic,900italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

<!--MAIN STYLE-->
<link href="{{ asset('public/assets/user/css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('public/assets/user/css/main.css') }}" rel="stylesheet">
<link href="{{ asset('public/assets/user/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('public/assets/user/css/responsive.css') }}" rel="stylesheet">
<link href="{{ asset('public/assets/user/css/animate.css') }}" rel="stylesheet">
<link href="{{ asset('public/assets/user/css/font-awesome.min.css') }}" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="{{ asset('public/assets/user/css/custom.css') }}" rel="stylesheet">

<!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
<link rel="stylesheet" type="text/css" href="{{ asset('public/assets/user/rs-plugin/css/settings.css') }}" media="screen" />

@yield('stylesheet')

<!-- JavaScripts -->
<script src="{{ asset('public/assets/user/js/modernizr.js') }}"></script>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>

@include('user.templates.login_modal')

@include('user.templates.signup_modal')

@include('user.templates.search_modal')

<!-- Page Wrap -->
<div id="wrap"> 
@include('user.templates.header')

@yield('content')
</div>

@include('user.templates.footer')


<!-- Le javascript
================================================== -->

<!-- Wrap End --> 
<script src="{{ asset('public/assets/user/js/jquery-1.11.3.js') }}"></script> 
<script src="{{ asset('public/assets/user/js/wow.min.js') }}"></script> 
<script src="{{ asset('public/assets/user/js/bootstrap.min.js') }}"></script> 
<script src="{{ asset('public/assets/user/js/own-menu.js') }}"></script> 
<script src="{{ asset('public/assets/user/js/owl.carousel.min.js') }}"></script> 
<script src="{{ asset('public/assets/user/js/jquery.magnific-popup.min.js') }}"></script> 
<script src="{{ asset('public/assets/user/js/jquery.flexslider-min.js') }}"></script> 
<script src="{{ asset('public/assets/user/js/jquery.isotope.min.js') }}"></script> 

<!-- SLIDER REVOLUTION 4.x SCRIPTS  --> 
<script type="text/javascript" src="{{ asset('public/assets/user/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script> 
<script type="text/javascript" src="{{ asset('public/assets/user/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script> 
<script src="{{ asset('public/assets/user/js/main.js') }}"></script>

@yield('javascript')

<!--Start of Tawk.to Script-->
<script type="text/javascript">
    <?php
      if($errors->first('modal') == 'yes'){
        ?>
        $("#addCart-{{$errors->first('id')}}").trigger( "click" );
        $(".error").addClass("hide");
        $("#ModalAddToCart").on('hidden.bs.modal', function(){
          $(".errorModal").addClass("hide");
        });
      <?php
      }else{
        ?>
        $(".errorModal").addClass("hide");
        <?php
      }
    ?>

  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/58c601b2ab48ef44ecd65e8f/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();

  $("#formSearch").submit(function(e){
      e.preventDefault();
      var keyword = $("input[name='search']").val();
      var url = window.location.origin+"/product/search/brand/"+keyword;
      window.location = url; 
    });

  $("#plusQty").click(function(e){
      e.preventDefault();
      var qty = parseInt($("input[name='quantity']").val());
      qty = qty + 1;
      $("input[name='quantity']").val(qty);
    });
    $("#minusQty").click(function(e){
      e.preventDefault();
      var qty = parseInt($("input[name='quantity']").val());
      qty = qty - 1;
      if(qty < 1) {
        alert('Jumlah tidak boleh kurang dari 1')
        $("input[name='quantity']").val('1');
      }
      else $("input[name='quantity']").val(qty);
    }); 

  function addToCart(p_id){
    $(".modalCart").empty();

    var id = p_id;
    $.ajax({
      data: 'id='+id,
      url: "getProductId", 
      success: function(result){
        console.log(result);
        var d = new Date();
        var now = d.getTime();

        var discount_start = new Date(result.product_cart.discount_date_start);
        var discount_end = new Date(result.product_cart.discount_date_end);

        if(result.product_cart.discount > 0 && now >= discount_start.getTime()  && now <= discount_end.getTime()){
          var priceNow = (100 - result.product_cart.discount) * result.product_cart.price / 100;
        } else {
          var priceNow = result.product_cart.price;
        }

        var first_images = '';
        var x;
        for (x in result.product_cart_images) { 
            if(first_images === ''){
              first_images = result.product_cart_images[x]['image_link']
            }
        }

        $("input[name='price']").val(priceNow);
        $("input[name='product_id']").val(result.product_cart.id);
        $("input[name='product_name']").val(result.product_cart.name);
        $("input[name='images']").val(first_images);
        $(".modal-title-site-cart").html("Masukkan Data Barang "+result.product_cart.name+" (sisa "+result.product_cart.quantity+" stok)");

        if(result.product_cart.color !== "0") {
          var element = "\n\
          <div class='col-sm-12' style='margin-top:20px;'>\n\
            <div class='item-select'> \n\
                <p>WARNA</p>\n\
                <select class='form-control' name='color' required>\n\
                  <option value='0'>Pilih Warna</option>\n\
                    <option value='"+result.product_cart.color+"'>"+result.product_cart.color+"</option>\n\
                </select>\n\
              </div>\n\
            </div>\n\
          ";
        }else{
          var element = "<input type='hidden' name='color' value='no_color'>";
        }

        $(".modalCart").append(element);

        var arr_size = result.product_cart.size.split(",");
        if(jQuery.inArray( "0", arr_size )) {
          var element = "\n\
          <div class='col-sm-12' style='margin-top:20px;'>\n\
            <div class='item-select'> \n\
                <p>Ukuran</p>\n\
                <select class='form-control' name='size' required>\n\
                  <option value='0'>Pilih Ukuran</option>\n\
                    <option value='"+result.product_cart.size+"'>"+result.product_cart.size+"</option>\n\
                </select>\n\
              </div>\n\
            </div>\n\
          ";
        }else{
          var element = "<input type='hidden' name='size' value='no_size'>";
        }

        $(".modalCart").append(element);
      }
    });
  }
  
</script>

</body>
</html>
