@extends('user.templates.layout')

@section('content')

<div class="container main-container headerOffset">

    <div class="row">

        <div class="col-lg-12 col-md-12 col-sm-12">

            <h5 class="section-title-inner" style="text-align: center"><span> Belum punya account Bandungmall?<br>Silahkan daftar</span></h5>

            <div class="row userInfo">
                @if (Session::has('error_code'))
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('error_code') }}
                    </div>
                @endif
                <form style="margin:auto; width: 500px;" role="form" class="logForm" action="{{ URL::to('user/register/doRegister') }}" method="post">
                    <div class="col-sm-6" style="margin-bottom: 20px;">
                        <label>Nama Depan</label>
                        <input name="first_name" type="text" class="form-control" placeholder="Nama Depan" required>
                    </div>
                    <div class="col-sm-6" style="margin-bottom: 20px;">
                        <label>Nama Belakang</label>
                        <input name="last_name" type="text" class="form-control" placeholder="Nama Belakang" required>
                    </div>   
                    <div class="col-sm-12" style="margin-bottom: 20px;">
                        <label>Email</label>
                        <input name="email" type="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="col-sm-12" style="margin-bottom: 20px;">
                        <label>Password</label>
                        <input name="password" type="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="col-sm-12" style="margin-bottom: 20px;">
                        <label>Konfirmasi Password</label>
                        <input name="confirm_password" type="password" class="form-control" placeholder="Konfirmasi Password" required>
                    </div>
                
                    <button type="submit" class="btn btn-primary" style="margin-left: 15px; margin-bottom: 20px;"><i class="fa fa-sign-up"></i> Daftar</button>
                </form>
            </div>

            <hr style="border: 2px #ccc solid">

            <h5 class="section-title-inner" style="text-align: center"><span> Sudah punya account Bandungmall?<br>Silahkan masuk</span></h5>

            <div class="row userInfo">
                @if (Session::has('error_login'))
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('error_login') }}
                    </div>
                @endif
                <form style="margin:auto; width: 500px;" role="form" class="logForm" action="{{ URL::to('user/login/doLogin') }}" method="post">
                    <div class="col-sm-12" style="margin-bottom: 20px;">
                        <label>Email</label>
                        <input name="email" type="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="col-sm-12" style="margin-bottom: 20px;">
                        <label>Password</label>
                        <input name="password" type="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group" style="margin-left: 15px; margin-bottom: -10px;">
                        <p><a title="Recover your forgotten password" href="{{ URL::to('user/forgotPassword') }}">Lupa password? </a></p>
                    </div>
                    <button type="submit" class="btn btn-success" style="margin-left: 15px; margin-bottom: 20px;"><i class="fa fa-sign-in"></i> Masuk</button>
                </form>
               <!--  <a href="{{ URL::to('user/login/fb') }}"><button type="submit" class="btn btn-primary" style="background:#4d6fa8; margin-left: 15px; margin-bottom: 20px; font-size: 12px;"><i class="fa fa-facebook"></i> Masuk Dengan Facebook</button></a>
                <a href="{{ URL::to('user/login/google') }}"><button type="submit" class="btn btn-primary" style="background:#df4a32; margin-left: 15px; margin-bottom: 20px; font-size: 12px;"><i class="fa fa-google"></i> Masuk Dengan Google</button></a> -->
            </div>

            <!--/row end-->

        </div>
    </div>
    <!--/row-->

    <div style="clear:both"></div>
</div>
<!-- /wrapper -->

@stop