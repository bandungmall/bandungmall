@extends('admin.templates.layout')

@section('content')
  <div class="col-sm-8 col-md-9 col-xs-12 contentwrap">
	<div class="row">
		<div class="col-sm-12 customertransaksiwrap">
	    	<div class="wrap-header">
	    		<h4>Transaksi Belum Dikirim</h4>
	        </div>
	        <div id="bordered">                                  
            <hr />
	        <div class="wrap-content">

	        	<div style="margin-bottom:10px;">
	        		<form action="{{URL::to('admin/transaction/transaction')}}" method="get">
						<div class="col-lg-6">
							<div class="input-group">
								<span class="input-group-addon">
									Tanggal Mulai :
								</span>
								<input type="date" class="form-control" name="start_date" value="{{Input::get('start_date')}}"/>
							</div><!-- /input-group -->
						</div><!-- /.col-lg-6 -->
						<div class="col-lg-6">
							<div class="input-group">
								<span class="input-group-addon">
									Sampai Tanggal :
								</span>
								<input type="date" class="form-control" name="end_date" value="{{Input::get('end_date')}}"/>
							</div><!-- /input-group -->
						</div><!-- /.col-lg-6 -->
		        		<button style="margin-top:5px;" class="btn btn-primary" type="submit">Apply</button>
	        		</form>
	        	</div>

	            <div class="table-responsive">
	            	<table class="table table-hover">
	            		<tr>
	                    	<th>No Pesanan</th>                                    
	                    	<th>Customer</th>
	                        <th>Total</th>
	                        <th>Confirmed</th>
	                        <th>Detail</th>
							<th>Aksi</th>
	                    <tr>
	                    @foreach($transactions as $transaction)
		                    <tr>
		                    	<td>#{{$transaction->id}}</td>                                    
		                    	<td>{{$transaction->first_name.' '.$transaction->last_name}}</td>
		                    	<td>RP. {{number_format($transaction->total, 0, '', '.');}} ,-</td>
		                    	<th>{{$transaction->paid}}</th>
		                        <td><a href="{{URL::to('admin/transaction/transactionDetail?id='.$transaction->id)}}"><span class="glyphicon glyphicon-file"></span></td></a>
								<td><a href="{{URL::to('admin/transaction/doTransactionPayment?id='.$transaction->id)}}"><span class="btn btn-default">Sudah Bayar</span></a>
		                    </tr>
	                    @endforeach
	           	</table>
	            </div>
	        </div>
	        </div>
	    </div>
	</div>
   </div>
@endsection

@section('javascript')
  <!-- Page Script -->
  <script>
    $(function () {
      // Activate Sidebar Menu
      $("#menu_transaction").closest("li").addClass("active");
      $("#menu_transaction_pending").closest("li").addClass("active");
    });
  </script>
@endsection