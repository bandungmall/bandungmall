@extends('admin.templates.layout')

@section('content')
<section class="content-header">
    <h1>
      Transaksi Dikirim
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
	        		<form action="{{URL::to('admin/transaction/filterTransactionSent')}}" method="get">
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
		        		<a style="margin-top:20px;" class="btn btn-danger" href="{{URL::to('admin/transaction/transactionSent')}}"><i class="fa fa-remove"></i>&nbsp;&nbsp;&nbsp;Clear Filter</a>
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
            <h3 class="box-title">List Transaksi Dikirim</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="listTransaction" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col">No Pesanan</th>
                  <th scope="col">Customer</th>
                  <th scope="col">Total</th>
                  <th scope="col">Barang Sampai</th>
                  <th scope="col">Approve</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Detail</th>
                  <th class="hide" scope="col">Created_at</th>
                </tr>
              </thead>
              <tbody>
              @foreach($transactions as $transaction)
                <tr>
                  <td>#{{$transaction->id}}</td>                                    
	              <td>{{$transaction->first_name.' '.$transaction->last_name}}</td>
	              <td>RP. {{number_format($transaction->total, 0, '', '.');}} ,-</td>
	              <td>{{$transaction->received_status}}</td>
                <td>{{$transaction->td_is_counted}}</td>
                <td>{{ date_format(new datetime($transaction->created_at), 'g:ia jS F Y') }}</td>
	              <td><a href="{{URL::to('admin/transaction/transactionSentDetail/'.$transaction->id)}}"><span class="glyphicon glyphicon-file"></span></td></a>
                <td class="hide">{{$transaction->created_at}}</td>
                </tr>
              @endforeach
              </tbody>
            </table>
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
    $("#menu_transaction").closest("li").addClass("active");
    $("#menu_transaction_success").closest("li").addClass("active");

    $("#listTransaction").DataTable({
       "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
       "order": [[ 7, 'desc' ]],
       scrollX: true

    });
   });
  </script>
@endsection