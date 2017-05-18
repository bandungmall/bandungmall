<!-- Modal Login start -->
<form action="{{ URL::to('user/login/doLogin') }}" method="POST">
    <div class="modal signUpContent fade" id="ModalLogin" tabindex="-1" role="dialog">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
                    <h3 class="modal-title-site text-center"> MASUK</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group login-username">
                        <div>
                            <input name="email" id="login-user" class="form-control input" size="20"
                                   placeholder="Email" type="email">
                        </div>
                    </div>
                    <div class="form-group login-password">
                        <div>
                            <input name="password" id="login-password" class="form-control input" size="20"
                                   placeholder="Password" type="password">
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <div>
                            <div class="checkbox login-remember">
                                <label>
                                    <input name="remember_me" value="forever" checked="checked" type="checkbox">
                                    Remember Me </label>
                            </div>
                        </div>
                    </div> -->
                    <div>
                        <div>
                            <input name="submit" class="btn  btn-block btn-lg btn-primary" value="MASUK" type="submit">
                        </div>
                    </div>
                    <!--userForm-->
<!-- <div style="text-align:center;margin-top:5px;">
<a href="{{ URL::to('user/login/fb') }}"><button type="submit" class="btn btn-primary" style="background:#4d6fa8; font-size: 12px; margin-left: -4px;"><i class="fa fa-facebook"></i> Masuk Dengan Facebook</button></a>
                <a href="{{ URL::to('user/login/google') }}"><button type="submit" class="btn btn-primary" style="background:#df4a32; font-size: 12px;"><i class="fa fa-google"></i> Masuk Dengan Google</button></a>
</div> -->
                </div>
                <div class="modal-footer">
                    <p class="text-center"> Pertama kali ke sini? <a data-toggle="modal" data-dismiss="modal"
                                                                href="#ModalSignup"> Sign Up. </a> <br>
                        <a href="{{ URL::to('user/forgotPassword') }}"> Lupa password? </a></p>
                </div>
            </div>
            <!-- /.modal-content -->

        </div>
        <!-- /.modal-dialog -->

    </div>
    <!-- /.Modal Login -->
</form>
