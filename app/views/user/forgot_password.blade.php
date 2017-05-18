@extends('user.templates.layout')


@section('content')
     <div class="container headerOffset">
            <div class="col-sm-6">
              <div id="bordered">
                <h3>Forgot Password</h3>
                <hr />
                <form role="form" action="{{URL::to('user/forgotPassword/generateForgotPasswordCode')}}" method="post">
                  <div class=" ">
                    <div class="form-group">
                      <label for="lupapwd">Masukkan email anda:</label>
                      <input type="email" name="email" class="form-control" id="lupapwd" placeholder="Email" required />
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                  </div>
                </form>
              </div>                               
            </div>
        </div>
    </div>
    
    <script>
	@if($msg !='' || $msg !=null)
		alert('{{$msg}}');
	@endif
</script>
@stop