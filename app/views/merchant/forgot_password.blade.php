<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bandung Mall Merchant | Forgot Password</title>
    <link rel="shortcut icon" href="{{ asset('public/assets/common/images/icon.png') }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('public/assets/merchant/bootstrap/css/bootstrap.min.css') }} ">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/assets/merchant/dist/css/AdminLTE.min.css') }} ">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('public/assets/merchant/plugins/iCheck/square/blue.css') }} ">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="{{ URL::to('/') }}"><img src="{{ asset('public/assets/common/images/logo.png') }}"></a><br>
        <a href="{{ URL::to('/') }}"><b>Merchant Area</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        @if ($msg != NULL)
          <div class="alert alert-warning alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-exclamation"></i> {{ $msg }}</h4>
          </div>
        @endif

        <p class="login-box-msg">Lupa Password? Masukkan alamat email Merchant Anda</p>
        <form action="{{ URL::to('merchant/forgotPassword/generateForgotPasswordCode') }}" method="post">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="email">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <a href="{{ URL::to('merchant/login') }}">Login</a>
            </div>
            <div class="col-xs-6">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Reset Password</button>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('public/assets/merchant/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('public/assets/merchant/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('public/assets/merchant/plugins/iCheck/icheck.min.js') }}"></script>
  </body>
</html>