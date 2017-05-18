@extends('layout.frontend')

@section('isi')
    <div class="row">   
            <div class="col-sm-6">
              <div id="bordered">
                <h3>Reset Password Merchant</h3>
                <hr />
                <form role="form" action="{{URL::to('merchant/forgotPassword/resetPassword/doResetPassword')}}" method="post">
                  <div class="row">
                    <div class="form-group">
                      <label for="lupapwd">Masukkan password baru anda:</label>
                      <input type="password" name="password" class="form-control" id="password" placeholder="Password" required />
                    </div>
                    <div class="form-group">
                      <label for="lupapwd2">Ulangi password baru anda:</label>
                      <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Ulangi Password" required />
                    </div>
                    <button type="submit" class="btn btn-default">Kirim</button>
                  </div>
                  {{Form::hidden('merchant_id', $merchant_id)}}
                </form>
              </div>                               
            </div>
            <div class="col-sm-6">
            </div>
        </div>
    </div>

    <script type="text/javascript">
      var password = document.getElementsById("password")[0];
    var confirm_password = document.getElementsById("confirm_password")[0];

    function validatePassword(){
      if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Don't Match");
      } else {
        confirm_password.setCustomValidity('');
      }
    }
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
    </script>
@stop