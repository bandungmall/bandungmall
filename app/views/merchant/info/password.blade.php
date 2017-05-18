<!-- Ganti Password -->
<div class="box box-danger">
  <div class="box-header with-border">
    <h3 class="box-title">Ganti Password</h3>
  </div><!-- /.box-header -->
  <!-- form start -->
  <form class="form-horizontal" action="{{ URL::to('merchant/doUpdatePassword') }}" method="POST">
    <input type="hidden" name="merchant_id" value="{{ $merchant->id }}" />
    <div class="box-body">
      <!-- Password Sekarang -->
      <div class="form-group">
        <label for="current_password" class="col-sm-3 control-label">Password Sekarang</label>
        <div class="col-sm-9">
          <input type="password" class="form-control" id="current_password" name="current_password" required>
        </div>
      </div><!-- / Password Sekarang -->

      <!-- Password Baru -->
      <div class="form-group">
        <label for="new_password" class="col-sm-3 control-label">Password Baru</label>
        <div class="col-sm-9">
          <input type="password" class="form-control" id="new_password" name="new_password" required>
        </div>
      </div><!-- / Password Baru -->

      <!-- Konfirmasi Password Baru -->
      <div class="form-group">
        <label for="new_password_confirmation" class="col-sm-3 control-label">Konfirmasi Password Baru</label>
        <div class="col-sm-9">
          <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
        </div>
      </div><!-- / Konfirmasi Password Baru -->
    </div><!-- /.box-body -->
    <div class="box-footer">
      <button type="submit" class="btn btn-info pull-right">Ganti Password</button>
    </div><!-- /.box-footer -->
  </form>
</div><!-- /.Ganti Password -->
