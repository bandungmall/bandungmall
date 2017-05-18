
<!-- Informasi Alamat -->
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Informasi Alamat</h3>
  </div><!-- /.box-header -->
  <!-- form start -->
  <form class="form-horizontal" action="{{ URL::to('admin/merchant/editMerchant/doUpdateAddressInformation') }}" method="POST">
    <input type="hidden" name="merchant_id" value="{{ $merchant->id }}" />
    <div class="box-body">
      <!-- Jalan -->
      <div class="form-group">
        <label for="address" class="col-sm-3 control-label">Jalan</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="address" name="address" value="{{ $merchant->address }}" required>
        </div>
      </div> <!-- /Jalan -->

      <!-- Provinsi -->
      <div class="form-group">
        <label for="province" class="col-sm-3 control-label">Provinsi</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="province" name="province" value="{{ $merchant->province }}" required>
        </div>
      </div> <!-- /Provinsi -->

      <!-- Kota -->
      <div class="form-group">
        <label for="city" class="col-sm-3 control-label">Kota</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="city" name="city" value="{{ $merchant->city }}" required>
        </div>
      </div> <!-- /Kota -->

      <!-- Kecamatan -->
      <div class="form-group">
        <label for="district" class="col-sm-3 control-label">Kecamatan</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="district" name="district" value="{{ $merchant->district }}" required>
        </div>
      </div> <!-- /Kecamatan -->

      <!-- Kode Pos -->
      <div class="form-group">
        <label for="postal_code" class="col-sm-3 control-label">Kode Pos</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ $merchant->postal_code }}" required>
        </div>
      </div> <!-- /Kode Pos -->
    </div><!-- /.box-body -->
    <div class="box-footer">
      <button type="submit" class="btn btn-info pull-right">Perbarui</button>
    </div><!-- /.box-footer -->
  </form>
</div><!-- /.Informasi Alamat -->
