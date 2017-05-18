@extends('layout.frontend')

@section('isi')

<style>
	.item-product:hover{
		text-decoration:none;
	}
	
	.item-product-container:hover{
		border: 1px solid black;
	}
	.btn-link:hover{
		text-decoration:none;
	}
</style>

  <div id="bordered">
    <div class="row">
        <div class="col-sm-3" style="padding:30px 30px 0px 0px">
            <!-- <div class="sideproduk">
                @foreach($data_category_parent as $parent)
                <div>
                    <button class="btn btn-category btn-block product_side_bar" id="product_side_bar">{{$parent['name']}}</button>
                    <div id="product_side_bar_child" class="product_side_bar_child">
                    @foreach($data_category_child as $child)
                        @if($child['parent'] ==$parent['id'])
                            <a href="{{URL::to('product?category_id='.$child->id)}}"><li>{{$child['name']}}</li></a>
                        @endif
                    @endforeach
                    </div>
                </div>
                @endforeach
            </div> -->
        </div>
        <div class="col-sm-9">
            <div class="row">
                <div class="col-sm-6">
                    <h3>
                        @if(isset($category))
                            {{$category->name}}
                        @elseif(isset($brand_name))
                            {{$products[0]->brand_name}}
                        @endif
                    </h3>
                </div>

                <div class="col-sm-6" align="right">
                    <form class="form-inline">
                        <label>Filter:</label>
                        <select class="form-control-static" id="sort">
                            <option value="1">A - Z</option>
                            <option value="2">Z - A</option>
                            <option value="3">Harga terendah - tertinggi</option>
                            <option value="4">Harga tertinggi - terendah</option>
                        </select>
                    </form>
                </div>
            </div>
                    <hr />
            <div class="row">
                @foreach($products as $product)
                    <div class="col-sm-3 col-xs-6 col-md-3 col-lg-4">
                        <div class="produk item-product-container" style="height:400px; padding:10px;">
                        <a href="{{URL::to('product/productDetail?product_id='.$product->id)}}" class="item-product">
                            <img class="img-responsive" src="{{asset('public/'.$product->image_link)}}" width="850" height="850" style="height:200px;"/>
                            <p style="font-family:radja;font-size:24px">{{$product->name}}</p>
                            </a>
                            <p style="color:#666;font-family:radja"><a href="{{URL::to('product?brand='.$product->brand)}}">{{$product->brand}}</a></p>
                            @if($product->discount ==NULL || $product->discount_date_start > date("Y-m-d") || $product->discount_date_end < date("Y-m-d"))
                                <p>-</p>
                                <p>Rp. {{number_format($product->price, 0, '', '.');}} ,-</p>
                            @else
                                <p style="text-decoration:line-through;">Rp. {{number_format($product->price, 0, '', '.');}} ,-</p>
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
                    </div>
                @endforeach
            </div>
            <div class="pagination-container clearfix">
                <div class="pull-right">
                    {{ $products->appends(Input::except('page'))->links() }}
                </div><!-- End .pull-right -->
            </div><!-- End pagination-container -->
        </div>
    </div>
  </div>

<script src="{{url('public/izet/bower_components/jquery/dist/jquery.min.js')}}"></script>
<script>

    $(document).ready(function() {
        $('#add_to_cart').click(function(e) {
            window.location.replace("{{URL::to('cart/add?quantity=1&productid=')}}"+search);
        });
        $("#sort").change(function(){
            //alert($("#sort").val());
            @if(NULL !==Input::get('category_id'))
                location.replace("{{URL::to('product?category_id='.Input::get('category_id').'&sort=')}}"+$("#sort").val());
            @elseif(NULL !==Input::get('brand'))
                location.replace("{{URL::to('product?brand='.Input::get('brand').'&sort=')}}"+$("#sort").val());
            @else
                location.replace("{{URL::to('product?sort=')}}"+$("#sort").val());
            @endif
        });
        $("#sort option[value={{Input::get('sort')}}]").prop('selected', true);
    });
</script>
@stop

