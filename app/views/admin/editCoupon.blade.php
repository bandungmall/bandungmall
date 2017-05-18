@extends('admin.templates.layout')

@section('content')
  <section class="content-header">
    <h1>
      Edit Template Coupon
    </h1>
  </section>
  
<!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-6">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Edit Coupon</h3>
          </div><!-- /.box-header -->
          @if(!empty($error_code))
            <span style="margin-left:10px; color:red">* {{$error_code}}</span>
          @endif
          <div class="box-body">
            <form role="form" action="{{URL::to('admin/coupon/doEditCoupon')}}" method="post">
                      <input type="hidden" name="coupon_id" value="{{$coupon->id}}"/>
                      <div class="form-group">
                          <label for="couponid">Kode Coupon</label>
                          <input type="text" name="couponid" class="form-control" id="couponid" placeholder="Masukkan kode coupon baru" value="{{$coupon->kode_coupon}}" required/>
                      </div>
                      <div class="form-group">
                          <label for="potongan">Potongan Harga</label>
                            <div class="input-group">
                              <span class="input-group-addon">Rp</span>
                              <input type="text" class="form-control" id="potongan" name="potongan" value="{{$coupon->potongan}}" required>
                            </div>
                      </div>
                      <div align="right">
                        <button type="submit" class="btn btn-success"><i class='fa fa-save'></i>&nbsp;&nbsp;&nbsp;Edit</button>
                      </div>
                  </form> 
          </div><!-- /.box-body -->
        </div>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
@endsection

@section('javascript')
<script type="text/javascript">
    $(function () {
      // Activate Sidebar Menu
      $("#menu_coupon").closest("li").addClass("active");
    });
</script>
@endsection