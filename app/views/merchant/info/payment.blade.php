<!-- Informasi Rekening -->
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Informasi Rekening</h3>
  </div><!-- /.box-header -->
  <!-- form start -->
  <form class="form-horizontal" action="{{ URL::to('merchant/doUpdatePaymentInformation') }}" method="POST">
    <input type="hidden" name="merchant_id" value="{{ $merchant->id }}" />
    <div class="box-body">
      <!-- Nomor Rekening -->
      <div class="form-group">
        <label for="account_number" class="col-sm-3 control-label">Nomor Rekening</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="account_number" name="account_number" value="{{ $merchant->account_number }}" required>
        </div>
      </div> <!-- /Nomor Rekening -->

      <!-- Atas Nama -->
      <div class="form-group">
        <label for="account_name" class="col-sm-3 control-label">Atas Nama</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="account_name" name="account_name" value="{{ $merchant->account_name }}" required>
        </div>
      </div> <!-- /Atas Nama -->

      <!-- Bank -->
      <div class="form-group">
        <label for="account_bank" class="col-sm-3 control-label">Bank</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="account_bank" name="account_bank" value="{{ $merchant->account_bank }}" required>
        </div>
      </div> <!-- /Bank -->
    </div><!-- /.box-body -->
    <div class="box-footer">
      <button type="submit" class="btn btn-info pull-right">Perbarui</button>
    </div><!-- /.box-footer -->
  </form>
</div><!-- /.Informasi Rekening -->
