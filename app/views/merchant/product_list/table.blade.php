<!-- <h2 class="page-header">Detail Produk</h2> -->

 <div class="row">
  <div class="col-xs-12">
    <!-- Detail Produk -->
    <div class="box">
      <div class="box-body">
        <table id="products" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th scope="col">Nomor SKU</th>
              <th scope="col">Nama</th>
              <th scope="col">Merk</th>
              <th scope="col">Kategori</th>
              <th scope="col">Harga</th>
              <th scope="col">Qty(pcs)</th>
              <th scope="col">Ukuran</th>
              <th scope="col">Warna</th>
              <th scope="col">Berat</th>
              <th scope="col">Tampilkan</th>
              <th scope="col">Opsi</th>
            </tr>
          </thead>
          <tbody>
          <?php 
            $x = 0;
          ?>
          @foreach($products as $product)
            <tr>
              <td>{{ $product->id }}</td>
              <td>{{ $product->name }}</td>
              <td>{{ $product->brand }}</td>
              @if($product->level == 4)
                <td>{{ $products_grand[$x]->crname.'/'.$products_grand[$x]->cpname.'/'.$products_grand[$x]->ccname.'/'.$products_grand[$x]->cgcname }}</td>
              @else
                <td>{{ $product->crname.'/'.$product->cpname.'/'.$product->ccname }}</td>
              @endif
              <?php
               $harga = 0;
               if(!empty($product->discount) || $product->discount_date_start > date("Y-m-d") || $product->discount_date_end < date("Y-m-d")) $harga = $product->price - ($product->price*$product->discount)/100;
               else $harga = $product->price;
              ?>
              <td>Rp. {{ number_format($harga, 0, '', '.') }}</td>
              <td>{{ $product->quantity }}</td>
              <td>
                @if($product->size === '0')
                  No size
                @else
                  {{$product->size}}
                @endif
              </td>
              <td>{{ $product->color }}</td>
              <td>{{ $product->weight }} gram</td>
              @if($product->is_active =='yes')
                <td><span class="glyphicon glyphicon-ok"></span></td>
              @else
                <td><span class="glyphicon glyphicon-remove"></span></td>
              @endif
              <td>
                <a class="btn btn-default" href="{{ URL::to('merchant/editProduct/' . $product->id) }}"><i class="fa fa-pencil-square-o"></i> Edit</button>
                <a class="btn btn-danger" href="{{ URL::to('merchant/deleteProduct/doDeleteProduct/' . $product->id) }}"><i class="fa fa-trash"></i> Hapus</button>
              </td>
            </tr>
            <?php $x++;?>
          @endforeach
          </tbody>
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.Detail Produk -->

  </div><!-- /.col -->
</div><!-- /.row -->
