@extends('admin.templates.layout')

@section('content')
<section class="content-header">
    <h1>
      Laporan Akhir
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
   <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Filtering</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div style="margin-bottom:10px;">
            		@if (Session::has('error_code'))
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('error_code') }}
                    </div>
                    @endif
                    <form action="{{URL::to('admin/filterTransactionReport')}}" method="get">
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
		        		<button style="margin-top:20px;" class="btn btn-success" type="submit">Apply</button>
		        		<a style="margin-top:20px;" class="btn btn-danger" href="{{URL::to('admin/transactionReport')}}"><i class="fa fa-remove"></i>&nbsp;&nbsp;&nbsp;Clear Filter</a>
	        		</form>
	        	</div>
          </div><!-- /.box-body -->
        </div>
      </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">List Laporan Akhir</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="listTransaction" class="table table-bordered table-hover">
              <thead>
                <tr>
                	<th scope="col">No Pesanan</th>                                    
	                <th scope="col">Customer</th>
	                <th scope="col">Total</th>
					<th scope="col">Merchant Total</th>
					<th scope="col">Fee</th>
					<th scope="col">Commision</th>
	                <th scope="col">Confirmed</th>
	                <th scope="col">Detail</th>
                </tr>
              </thead>
              <tbody>
              <?php $comTotal=0;?>
	                    @foreach($transactions as $transaction)
		                    <tr>
		                    	<td>#{{$transaction->tid}}</td>                                    
		                    	<td>{{$transaction->first_name.' '.$transaction->last_name}}</td>
		                    	<td>Rp. {{number_format($transaction->total, 0, '', '.');}} ,-</td>
								<td>Rp. {{number_format($transaction->total-($transaction->total/100)*$transaction->commision, 0, '', '.');}} ,-</td>
								<td>{{$transaction->commision}}%</td>
								<td>Rp. {{number_format(($transaction->total/100)*$transaction->commision, 0, '', '.');}} ,-</td>
		                    	<th>{{$transaction->is_counted}}</th>
		                        <td><a href="{{URL::to('admin/transaction/transactionSentDetail/'.$transaction->tid)}}"><span class="glyphicon glyphicon-file"></span></td></a>
		                    </tr>
							<?php $comTotal += ($transaction->total/100)*$transaction->commision; ?>
	                    @endforeach
              </tbody>
            </table>
            <div class="wrap-header">
	    		<h4>Total Commision : Rp. {{number_format($comTotal, 0, '', '.');}}</h4>
	        </div>
          </div><!-- /.box-body -->
        </div>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div>
@endsection
@section('javascript')
   <script type="text/javascript">
   $(function(){
    $("#menu_report").closest("li").addClass("active");
    $("#menu_report_final").closest("li").addClass("active");

    $("#listTransaction").DataTable({
       "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
           scrollX: true
    });
   });
  </script>
@endsection