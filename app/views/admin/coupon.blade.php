@extends('admin.templates.layout')

@section('content')
  <section class="content-header">
    <h1>
      Daftar Coupon
    </h1>
  </section>
  
<!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">List Coupon</h3>
          </div><!-- /.box-header -->
          @if(!empty($error_code))
            <span style="margin-left:10px; color:red">* {{$error_code}}</span>
          @endif
          <div class="box-body">
            <table id="listCoupon" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Kode Coupon</th>
                  <th scope="col">Potongan Harga</th>
                  <th scope="col">Status</th>
        				  <th scope="col">Edit</th>
        				  <th scope="col">Hapus</th>     
                </tr>
              </thead>
              <tbody>
              @foreach($coupons as $coupon)
				  <tr>
					<td>{{$coupon->id}}</td>
          <td>{{$coupon->kode_coupon}}</td>
          <td>Rp. {{number_format($coupon->potongan, 0, '', '.');}}</td>
          <td>{{str_replace('_',' ',$coupon->status)}}</td>
          @if($coupon->status == 'belum_dipakai')
					<td><a href="{{URL::to('admin/coupon/editCoupon?id='.$coupon->id)}}"><span class="glyphicon glyphicon-edit"></span></a></td>
          @else
          <td>Maaf, coupon sudah digunakan dan tidak bisa diedit</td>
          @endif
					<td><a data-toggle="modal" data-target="#modalDelete" href="#" onclick="confirmation('coupon/doDeleteCoupon?id=<?php echo $coupon->id; ?>','{{$coupon->kode_coupon}}');"><span class="glyphicon glyphicon-remove"></span></a></td>
				  </tr>
				@endforeach
              </tbody>
            </table>
            <button style="float:right" class="btn btn-success" id="addCoupon"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Tambah Coupon</button>
          </div><!-- /.box-body -->
        </div>
      </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row">
      <div class="col-xs-6 tambahCouponWrap hide">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Tambah Coupon</h3>
            <button style="float:right" class="btn btn-danger" id="closeAddCoupon"><i class="fa fa-close"></i></button>
          </div><!-- /.box-header -->
          <div class="box-body">
            <form role="form" action="{{URL::to('admin/coupon/doInsertCoupon')}}" method="post">
                      <div class="form-group">
                          <label for="couponid">Kode Coupon</label>
                          <input type="text" name="couponid" class="form-control" id="couponid" placeholder="Masukkan kode coupon baru" required/>
                      </div>
                      <div class="form-group">
                          <label for="potongan">Potongan Harga</label>
                            <div class="input-group">
                              <span class="input-group-addon">Rp</span>
                              <input type="text" class="form-control" id="potongan" name="potongan" value="" required>
                            </div>
                      </div>
                      <div align="right">
                        <button type="submit" class="btn btn-default">Tambah</button>
                      </div>
                  </form>
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
          <h4 class="modal-title">Hapus Coupon?</h4>
        </div>
        <div class="modal-body">
          <p>Yakin ingin menghapus coupon dengan kode <span id="userAdmin"></span>?</p>
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
 $(function () {
      // Activate Sidebar Menu
      $("#menu_coupon").closest("li").addClass("active");
      $("#listCoupon").DataTable({
       "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
           scrollX: true
      });

      $("#addCoupon").click(function(){
        $('.tambahCouponWrap').removeClass("hide");
      });
      $("#closeAddCoupon").click(function(){
        $('.tambahCouponWrap').addClass("hide");
      });

    });
  function confirmation(link,name){
    $("#userAdmin").html(name);
    $("#okDelete").click(function(){
      location.href = link;
    });
    return false;
  }
</script>
@endsection