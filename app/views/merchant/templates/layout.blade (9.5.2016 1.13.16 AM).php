<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bandungmall Merchant | {{ $title or "" }}</title>
    <link rel="shortcut icon" href="{{ asset('public/assets/common/images/icon.png') }}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('public/assets/merchant/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Page-specific Stylesheets -->
    @yield('stylesheet')
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('public/assets/merchant/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="{{ asset('public/assets/merchant/dist/css/skins/skin-black.min.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body class="hold-transition skin-black sidebar-mini ">
    <div class="wrapper">

      @include('merchant.templates.header')
      @include('merchant.templates.left_sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        @include('merchant.templates.alert')
        @yield('content')
      </div><!-- /.content-wrapper -->

      @include('merchant.templates.footer')
      @include('merchant.templates.right_sidebar')

    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('public/assets/merchant/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('public/assets/merchant/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('public/assets/merchant/dist/js/app.min.js') }}"></script>

    <!-- Plugins and Page-specific Scripts -->
    @yield('javascript')
  </body>
</html>
