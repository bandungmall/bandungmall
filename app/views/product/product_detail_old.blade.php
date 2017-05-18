@extends('layout.frontend')

@section('isi')

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
    <div id="bordered">
        <div class="row">
            <div class="col-sm-4">
                <!-- <img class="img-responsive" id="main_image" src="{{asset('public/'.$product[0]->image_link)}}" width="850" height="850" /> -->

                <div class="magnify">
                    <div id="large_div" class="large" style="background: url('{{asset('public/'.$product[0]['image_link'])}}') no-repeat;"></div>
                    <img class="small" src="{{asset('public/'.$product[0]['image_link'])}}"/>
                </div>

                <div id="similar-product" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <a href="#" onclick="return false;"><img class="productdetailthumbsnailimage" id="small_image" style="display:inline-block;" src="{{asset('public/'.$product[0]->image_link)}}" alt="" width="100px"></a>
                            @foreach($product_images as $image)
                                <a href="#" onclick="return false;"><img class="productdetailthumbsnailimage" id="small_image" style="display:inline-block;" src="{{asset('public/'.$image->image_link)}}" alt="" width="100px"></a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4" style="padding:0px 10px">
                <h4>{{$product[0]->name}}</h4>
                <p>{{$product[0]->brand}}</p>
                <hr />
                @if($product[0]->discount ==NULL || $product[0]->discount_date_start > date("Y-m-d") || $product[0]->discount_date_end < date("Y-m-d"))
                    <h1>Rp. {{number_format($product[0]->price, 0, '', '.');}} ,-<h1>
                            @else
                                <h1 style="text-decoration:line-through;">Rp. {{number_format($product[0]->price, 0, '', '.');}} ,-</h1>
                                <?php $temp = $product[0]->price - ($product[0]->price * $product[0]->discount)/100 ?>
                                <h1>Rp. {{number_format($temp, 0, '', '.');}} ,-</h1>
                            @endif
                            <p>{{$product[0]->description}}</p>
                            <hr />
                            <h6>Spesifikasi:</h6>
                            <ul>
                                <table>
                                    <col width="100">
                                    <col width="20">
                                    <col width="100">
                                    @foreach($product_specs as $product_spec)
                                        <tr>
                                            <td><li>{{$product_spec->spec_name}}</li></td>
                                            <td> : </td>
                                            <td>{{$product_spec->spec_detail}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </ul>
                            <p></p>
            </div>
            <div class="col-sm-4">
                <form role="form" action="{{URL::to('cart/add')}}" method="post">
                    <div class="form-group">
                        <label for="qty">Qty:</label>
                        <input type="hidden" name="product_id" value="{{$product[0]->id}}" />
                        <input type="number" name="quantity" class="form-control" id="qty" min="1" max="{{$product[0]->quantity}}" value="1" required/>
                    </div>
                    <button type="submit" class="btn btn-info">Beli</button>
                </form>
            </div>
        </div>
        <div class="col-sm-12" style="padding-top:100px; min-height:400px;">
            <h4>Produk Terkait</h4>
            <hr />
            <!--IMG-->
            <div class="row">
                <div class="row" style="padding:15px" align="left">
                    @foreach($products as $product)
                        <div class="col-sm-3 col-xs-6 produk">
                            <img class="img-responsive" src="{{asset('public/'.$product->image_link)}}" width="850" height="850" />
                            <a href="{{URL::to('product/productDetail?product_id='.$product->id)}}"><p style="font-family:radja;font-size:24px">{{$product->name}}</p></a>
                            <p style="color:#666;font-family:radja">{{$product->brand}}</p>
                            @if($product->discount ==NULL)
                                <p>Rp. {{number_format($product->price, 0, '', '.');}} ,-</p>
                            @else
                                <p style="text-decoration:line-through;">Rp. {{$product->price}} ,-</p>
                                <?php $temp = $product->price - ($product->price * $product->discount)/100 ?>
                                <p>Rp. {{number_format($temp, 0, '', '.');}} ,-</p>
                            @endif
                            <div id="buybutton">
                                <form action="cart/add" method="post">
                                    <input type="hidden" name="product_id" value="{{$product->id}}"/>
                                    <input type="hidden" name="quantity" value="1"/>
                                    <button class="btn btn-link btn-block" id="add_to_cart" type="submit"><span class="glyphicon glyphicon-shopping-cart"></span> BELI</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!--END IMG-->
        </div>
        <!--
        <div class="col-sm-12" id="commentbox">
            <h4>Comments</h4>
            <hr />
            <textarea class="col-sm-12" rows="4" name="comment" placeholder="Masukkan komentar"></textarea>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        -->
    </div>

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
