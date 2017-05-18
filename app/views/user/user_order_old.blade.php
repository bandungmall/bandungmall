@extends('layout.frontend')

@section('isi')
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3">
          <div class="sidemenuwrap">
            <ul class="nav nav-pills nav-stacked">
              <li><a href="{{URL::to('user/home')}}">Akun saya</a></li>
              <li><a href="{{URL::to('user/myAccount')}}">Informasi akun saya</a></li>
              <li class="active"><a href="{{URL::to('user/order')}}">Check pesanan</a></li>
              <li><a href="{{URL::to('user/transactionHistory')}}">Riwayat pesanan</a></li>
              <hr />
              {{--<li><a href="{{URL::to('user/downline')}}">Check downline</a></li>--}}
              {{--<li><a href="{{URL::to('user/income')}}">Check penghasilan</a></li>--}}
              <li><a href="{{URL::to('user/doLogout')}}">Log out</a></li>
            </ul>
          </div>
        </div>
        <div class="col-sm-9">
              <div class="wrap-content">
	            <div class="table-responsive">
	            	<table class="table table-hover">
	            		<tr>
	                    	<th>No Pesanan</th>   
	                        <th>Total</th>
	                        <th>Detail</th>
	                    <tr>
                      @if(!empty($transactions))
  	                    @foreach($transactions as $transaction)
  	                    <tr>
  	                    	<td>#{{$transaction->id}}</td>                                    
  	                    	<td>RP. {{number_format($transaction->total, 0, '', '.');}} ,-</td>
  	                        <td><a href="{{URL::to('user/transactionHistoryDetail?id='.$transaction->id)}}"><span class="glyphicon glyphicon-file"></span></td></a>
  	                    </tr>
  	                    @endforeach
                      @endif
	           	</table>
	            </div>
	        </div>
            </div>
      </div>
    </div>
@stop