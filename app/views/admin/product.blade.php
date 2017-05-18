@extends('admin.templates.layout')

@section('content')
  <section class="content-header">
    <h1>
      Daftar Produk
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">List Produk</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="accepted-merchant" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col">Merchant</th>
					<th scope="col">Nomor SKU</th>
					<th scope="col">Nama/Merk</th>
					<th scope="col">Kategori</th>
					<th scope="col">Harga</th>
					<th scope="col">Qty(pcs)</th>
					<th scope="col">Berat</th>
					<th scope="col">Tampilkan</th>
					<th scope="col">Hapus</th>
                </tr>
              </thead>
              <tbody>
              @foreach($products as $product)
				<tr>
				  <td>{{$product->merchant_email}}</td>
				  <td>{{$product->id}}</td>
				  <td>{{$product->name.' / '.$product->brand}}</td>
				  <td>{{$product->category_name}}</td>
				  @if($product->discount ==NULL || $product->discount_date_start > date("Y-m-d") || $product->discount_date_end < date("Y-m-d"))
					  <td>Rp. {{number_format($product->price, 0, '', '.');}}</td>
				  @else
					  <?php $temp = $product->price - ($product->price * $product->discount)/100 ?>
					  <td>
						<p style="text-decoration:line-through;">Rp. {{number_format($product->price, 0, '', '.');}}</p>
						<p>Rp. {{number_format($temp, 0, '', '.');}}</p>
					  </td>
				  @endif
				  <td>{{$product->quantity}}</td>
				  <td>{{$product->weight}} gram</td>
				  @if($product->is_active =='yes')
					<td><span class="glyphicon glyphicon-ok"></span></td>
				  @else
					<td><span class="glyphicon glyphicon-remove"></span></td>
				  @endif
				  <td><a data-toggle="modal" data-target="#modalDelete" href="#" onclick="confirmation('product/doDeleteProduct?id=<?php echo $product->id; ?>','{{$product->id}}');"><span class="glyphicon glyphicon-remove"></span></a></td>
				</tr>
			  @endforeach
              </tbody>
            </table>
          </div><!-- /.box-body -->
        </div>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
  <div class="modal fade" id="modalDelete" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Hapus Product?</h4>
        </div>
        <div class="modal-body">
          <p>Yakin ingin menghapus product dengan nomor SKU <span id="codeProduct"></span>?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="okDelete">Ya</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('javascript')
<script type="text/javascript">
  $(function(){
    $("#menu_product").closest("li").addClass("active");

    $('#accepted-merchant').DataTable({
       "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
           scrollX: true
      });
  });
  
  function confirmation(link,id){
    $("#codeProduct").html(id);
      $("#okDelete").click(function(){
        location.href = link;
      });
      return false;
  }
</script>
@endsection
