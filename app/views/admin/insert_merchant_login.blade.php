@extends('admin.templates.layout')

@section('stylesheet')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('public/assets/merchant/plugins/select2/select2.min.css') }}">
@endsection


@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Accept Merchant
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title">Atur Password</h3>
      </div><!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" action="{{ URL::to('admin/merchant/insertMerchantLogin/doInsertMerchantLogin') }}" method="POST">
        <div class="box-body">
          <input type="hidden" value="{{ $merchant->id }}" name="merchant_id"/>
          <!-- Email Merchant -->
          <div class="form-group">
            <label for="email" class="col-sm-3 control-label">Email Merchant</label>
            <div class="col-sm-9">
              <input name="email" type="email" class="form-control" id="email" name="name" value="{{ $merchant->email }}" required disabled>
            </div>
          </div> <!-- /Email Merchant -->

          <!-- Password Merchant -->
          <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Password Merchant</label>
            <div class="col-sm-9">
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
          </div> <!-- /Password Merchant -->

          <!-- Konfirmasi Password -->
          <div class="form-group">
            <label for="confirm_password" class="col-sm-3 control-label">Konfirmasi Password</label>
            <div class="col-sm-9">
              <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
          </div> <!-- /Password Merchant -->
        </div><!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-info pull-right">Tambah</button>
        </div><!-- /.box-footer -->
      </form>
    </div>

  </section><!-- /.content -->
@endsection


@section('javascript')
  <!-- Page script -->
  <script>
    $(function () {
      // Activate Sidebar Menu
      $("#menu_merchant").closest("li").addClass("active");
    });
    
    var password = document.getElementsByName("password")[0];
    var confirm_password = document.getElementsByName("confirm_password")[0];

    function validatePassword(){
      if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Password doesn't match");
      } else {
        confirm_password.setCustomValidity('');
      }
    }
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
  </script>

@endsection
