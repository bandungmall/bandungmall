<!-- Modal Signup start -->
<form role="form" action="{{URL::to('user/register/doRegister')}}" method="post">
    <div class="modal signUpContent fade" id="ModalSignup" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
                    <h3 class="modal-title-site text-center"> DAFTAR </h3>
                </div>
                <div class="modal-body">
                    <!-- <div class="control-group"><a class="fb_button btn  btn-block btn-lg " href="#"> SIGNUP WITH
                        FACEBOOK </a></div>
                    <h5 style="padding:10px 0 10px 0;" class="text-center"> OR </h5> -->

                    <div class="form-group reg-email">
                        <div>
                            <input name="email" class="form-control input" size="20" placeholder="Email" type="email">
                        </div>
                    </div>
                    <div class="form-group reg-password">
                        <div>
                            <input name="password" class="form-control input" size="20" placeholder="Password" type="password">
                        </div>
                    </div>
                    <div class="form-group reg-password">
                        <div>
                            <input name="confirm_password" class="form-control input" size="20" placeholder="Konfirmasi Password" type="password">
                        </div>
                    </div>
                    <div class="form-group reg-username">
                        <div>
                            <input name="first_name" class="form-control input" size="20" placeholder="Nama Depan" type="text">
                        </div>
                    </div>
                    <div class="form-group reg-username">
                        <div>
                            <input name="last_name" class="form-control input" size="20" placeholder="Nama Belakang" type="text">
                        </div>
                    </div>
                    <div>
                        <div>
                            <input name="submit" class="btn  btn-block btn-lg btn-primary" value="DAFTAR" type="submit">
                        </div>
                    </div>
                    <!--userForm-->
<!-- <div style="text-align:center;margin-top:5px;">
<a href="{{ URL::to('user/login/fb') }}"><img src="{{ url('public/img/login-fb.png') }}" width="45%" height="auto"/></a>
<a href="{{ URL::to('user/login/google') }}"><img src="{{ url('public/img/login-google.png') }}" width="45%" height="auto"/></a>
</div> -->
                </div>
                <div class="modal-footer">
                    <p class="text-center"> Punya akun? <a data-toggle="modal" data-dismiss="modal" href="#ModalLogin">
                        Login </a></p>
                </div>
            </div>
            <!-- /.modal-content -->

        </div>
        <!-- /.modal-dialog -->

    </div>
    <!-- /.ModalSignup End -->
</form>
