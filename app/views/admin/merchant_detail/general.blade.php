
<!-- Informasi Umum -->
<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Informasi Umum</h3>
  </div><!-- /.box-header -->
  <!-- form start -->
  <form class="form-horizontal" action="{{ URL::to('admin/merchant/editMerchant/doUpdateGeneralInformation') }}" method="POST">
    <input type="hidden" name="merchant_id" value="{{ $merchant->id }}" />
    <div class="box-body">
      <!-- Nama Seller -->
      <div class="form-group">
        <label for="name" class="col-sm-3 control-label">Nama Seller</label>
        <div class="col-sm-9">
          <input name="name" type="text" class="form-control" id="name" name="name" value="{{ $merchant->name }}" required>
        </div>
      </div> <!-- /Nama Seller -->

      <!-- Nama Toko -->
      <div class="form-group">
        <label for="shop_name" class="col-sm-3 control-label">Nama Toko</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="shop_name" name="shop_name" value="{{ $merchant->shop_name }}" required>
        </div>
      </div> <!-- /Nama Toko -->

      <!-- Nama Perusahaan -->
      <div class="form-group">
        <label for="company_name" class="col-sm-3 control-label">Nama Perusahaan</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $merchant->company_name }}" required>
        </div>
      </div> <!-- /Nama Perusahaan -->

      <!-- Nomor Telepon -->
      <div class="form-group">
        <label for="phone_number" class="col-sm-3 control-label">Nomor Telepon</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $merchant->phone_number }}" required>
        </div>
      </div> <!-- /Nomor Telepon -->

      <!-- Alamat Email -->
      <div class="form-group">
        <label for="email" class="col-sm-3 control-label">Alamat Email</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="email" name="email" value="{{ $merchant->email }}" required>
        </div>
      </div> <!-- /Alamat Email -->

      <!-- Nama Penanggungjawab -->
      <div class="form-group">
        <label for="person_in_charge" class="col-sm-3 control-label">Nama Penanggungjawab</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="person_in_charge" name="person_in_charge" value="{{ $merchant->person_in_charge }}" required>
        </div>
      </div> <!-- /Nama Penanggungjawab -->

      <!-- Nomor KTP -->
      <div class="form-group">
        <label for="ic_number" class="col-sm-3 control-label">Nomor KTP</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" id="ic_number" name="ic_number" value="{{ $merchant->ic_number }}" required>
        </div>
      </div> <!-- /Nomor KTP -->
    </div><!-- /.box-body -->
    <div class="box-footer">
      <button type="submit" class="btn btn-info pull-right">Perbarui</button>
    </div><!-- /.box-footer -->
  </form>
</div><!-- /.Informasi Umum -->
