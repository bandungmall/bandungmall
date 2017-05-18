<!-- Modal Add address start -->
<form action="{{ URL::to('cart/add') }}" method="POST">
        

              @if($product_cart->discount > 0 && strtotime(date('Y-m-d')) >= strtotime($product_cart->discount_date_start)  && strtotime(date('Y-m-d')) <= strtotime($product_cart->discount_date_end))
                <?php $priceNow = (100 - $product_cart->discount) * $product_cart->price / 100; ?>
                @endif

                <?php $first_image = '';?>
                @foreach($product_cart_images as $product_img)
                <?php
                  if($first_image == ''){
                    $first_image = $product_img['image_link'];
                  } 
                ?>
                @endforeach

              @if(isset($priceNow))
              <input type="hidden" name="price" value="{{$priceNow}}">
              @else 
              <input type="hidden" name="price" value="{{$product_cart->price}}">
              @endif
              
              <input type="hidden" name="product_id" value="{{$product_cart->id}}">
              <input type="hidden" name="product_name" value="{{$product_cart->name}}">
              <input type="hidden" name="images" value="{{$first_image}}">
              <input type="hidden" name="modal" value="yes">

    <div class="modal signUpContent fade" id="ModalAddToCart" tabindex="-1" role="dialog">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header" >
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
                    <h3 class="modal-title-site-cart text-center"> Masukkan data barang 
                    
                    </h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                       @if($errors->any())
                        <h6 class="errorModal" style="margin-left:10px; color:#ff0000">{{$errors->first()}}</h4>
                      @endif
                        <div class="col-sm-12">
                          <div class="item-select"> 
                            <!-- JUMLAH -->
                            <p>JUMLAH</p>
                            <div class="col-sm-2">
                            <button style="margin:0" class="btn btn-primary" id="plusQty">+</button>
                            </div>
                            <div class="col-sm-2">
                            <input class="form-control" type="text" name="quantity" value="1" required>
                            </div>
                            <div class="col-sm-2">
                            <button style="margin:0" class="btn btn-primary" id="minusQty">-</button>
                            </div>
                          </div>
                        </div>

                        <div class="modalCart">

                        </div>
                        
                      </div>
                      <div class="row"> 
                        <!-- QUIENTY -->
                        <div class="col-sm-12">
                          <div class="fun-share">
                            <button type="submit" class="btn btn-large btn-dark">ADD TO CART</button>
                          </div>
                        </div>
                      </div>
                    <!--userForm-->

                </div>
            </div>
            <!-- /.modal-content -->

        </div>
        <!-- /.modal-dialog -->

    </div>
    <!-- /.Modal Login -->
</form>


