<!-- Header -->
  <header class="header-style-2 header-style-3"> 
    <!-- Top Bar -->
    <div class="top-bar">
      <div class="container"> 
        <!-- Language -->
        <div class="language"><div class="header-center"><a href="{{ URL::to('help') }}">Kontak</a> | <a href="{{ URL::to('help') }}">Cara Beli</a> | <a href="{{ URL::to('help') }}">Konfirmasi Pembayaran</a></div></div>
        <div class="top-links">
          <ul>            
            @if (!Auth::check())
            <li><a href="#" data-toggle="modal" data-target="#ModalLogin">Login</a></li>
            <li><a href="#" data-toggle="modal" data-target="#ModalSignup"> Register </a></li>
            @else
            <li><a href="{{ URL::to('user/myAccount') }}">{{ Auth::user()->first_name. ' ' . Auth::user()->last_name }} <i class="fa fa-cog"></i></a
            ></li>
            <li><a href="{{ URL::to('user/transactionHistory') }}">Tas Belanja Saya <i class="fa fa-shopping-bag"></i></a></li>
            <li><a href="{{ URL::to('user/doLogout') }}">Logout <i class="fa fa-sign-out"></i></a></li>
            @endif
			<li><i class="fa fa-shopping-cart"></i><a href="{{ URL::to('checkout') }}"> Checkout </a></li>
          </ul>
        </div>
      </div>
    </div>
    
    <!-- Logo -->
    <div class="sticky">
    <div class="container">
		<div class="logo">
			<a href="{{ URL::to('/') }}"> 
				<img src="{{ asset('public/assets/common/images/logo-large.png') }}" alt="Bandungmall.co.id" class="hidden-xs" style="max-width:212px;">
				<img src="{{ asset('public/assets/common/images/logo-large.png') }}" alt="Bandungmall.co.id" class="visible-xs-block" style="width: 212px;">         
			</a>
		  </div>
      
      <!-- Nav -->
      <!-- Nav -->
        <nav class="webimenu"> 
          <!-- MENU BUTTON RESPONSIVE -->
          <div class="menu-toggle"> <i class="fa fa-bars"> </i> </div>
          <ul class="ownmenu">
          <?php 
            $arr = array('anak-anak','home & living');
          ?>
          @foreach ($category_root as $root)
            @if(!in_array($root->name, $arr))
              <li id="{{$root->name}}"><a href="{{ URL::to('#') }}" style="text-transform: uppercase;">{{$root->name}}</a>
                <ul class="dropdown"> 
                @foreach($category_parent as $parent) 
                  @if($parent->id_root == $root->id)
                    <li><a href="{{ URL::to('#') }}" style="text-transform: uppercase;">{{$parent->name}}</a>
                      <ul class="dropdown"> 
                        @foreach($category_child as $child) 
                          @if($child->id_parent == $parent->id)
                            <li><a href="<?php echo $child->has_grand_child == 'yes' ? '#':'product/c-'.$child->id ?>" style="text-transform: uppercase;">{{$child->name}}</a>
                              @if($child->has_grand_child == 'yes')
                              <ul class="dropdown"> 
                                @foreach($category_grand_child as $grand_child) 
                                  @if($grand_child->id_child == $child->id)
                                    <li><a href="{{ URL::to('product/gc-'.$grand_child->id) }}" style="text-transform: uppercase;">{{$grand_child->name}}</a>
                                  @endif
                                @endforeach
                              </ul>
                              @endif
                            </li>
                          @endif
                        @endforeach
                      </ul>
                    </li>
                  @endif
                @endforeach
                </ul>
              </li>
            @endif
          @endforeach
          
          <!--======= Shopping Cart =========-->
          <li class="shop-cart"><a href="{{ URL::to('cart') }}"><i class="fa fa-shopping-cart"></i></a> 
            <span class="numb">
              @if(Session::has('cartQty'))
                {{Session::get('cartQty')}}
              @else
                0
              @endif
            </span>
            <ul class="dropdown" style="background:#000; color:#fff;">
              <li>
                @if(Session::has('cartQty'))
                    Terdapat {{Session::get('cartQty')}} barang dalam Cart<br>
                    <?php
                    $cart = Session::get('mycart');
                    $total = 0;
                    $x = 1;

                    foreach ($cart as $key => $value) {
                      $total += $value['price'] * $value['quantity'];
                      echo "
                      <li>
                        <div class='media'>
                          <div class='media-left'>
                            <div class='cart-img'> <a href='#'> <img style='height:100px;' class='media-object img-responsive' src='".$value['images']."' alt='...'> </a> </div>
                          </div>
                          <div class='media-body'>
                            <span class='price'>".$value['quantity']." x Rp. ".number_format($value['price'],2,',','.')."</span>";
                            echo"
                            <span class='qty'>Total: Rp. ".number_format(($value['price'] * $value['quantity']),2,',','.')."</span>
                            <span class='qty'><a style='padding: 0px !important; width: 20px !important; float: right; font-size: 13px; background:none !important; margin-top: -86px; margin-bottom:20px;' href='cart/delete?product_id=".$key."' class='btn btn-danger'>X</a></span>
                        </div>
                      </li>
                      ";
                      $x++;
                      if($x == 3) break;
                    }

                    echo "
                    <li class='no-padding no-border'>
                      <h5 class='text-center'>SUBTOTAL: Rp. ".number_format($total,2,',','.')."</h5>
                    </li>
                    ";

                    if(Session::get('cartQty') != "0") {
                      echo "
                      <li class='no-padding no-border'>
                        <div class='row'>
                          <div style='margin-bottom:10px' class='col-xs-12'> <a href='cart' class='btn btn-1 btn-small'>Lihat Keranjang &nbsp; <i class='fa fa-shopping-cart'></i></a></div>
                          <div class='col-xs-12'> <a href='checkout' class='btn btn-1 btn-small'>Lanjut ke pembayaran &nbsp; <i class='fa fa-arrow-right'></i></a></div>
                        </div>
                      </li>
                      ";  
                    }
                    ?>
                @else
                    <span style="color:#fff">Cart masih kosong</span>
                @endif
              </li>
            </ul>
          </li>
          <!--======= SEARCH ICON =========-->
          <li class="search-nav"><a href="#" class="search-trigger" data-toggle="modal" data-target="#ModalSearch"><i class="fa fa-search"></i></a></li>
        </ul>
      </nav>
    </div>
    </div>
  </header>
  <!-- Header End -->