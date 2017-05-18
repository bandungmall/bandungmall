@extends('admin.templates.layout')

@section('content')
<section class="content-header">
    <h1>
      Transaksi Belum Dibayar
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
	        		<form action="{{URL::to('admin/transaction/filterTransactionPending')}}" method="get">
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
		        		<a style="margin-top:20px;" class="btn btn-danger" href="{{URL::to('admin/transaction/transactionPending')}}"><i class="fa fa-remove"></i>&nbsp;&nbsp;&nbsp;Clear Filter</a>
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
            <h3 class="box-title">List Transaksi Belum Dibayar</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="listTransaction" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col">No Pesanan</th>
                  <th scope="col">Customer</th>
                  <th scope="col">Total</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Detail</th>
                  <th scope="col">Aksi</th>
                  <th class="hide" scope="col">Created_at</th>
                </tr>
              </thead>
              <tbody>
              @foreach($transactions as $transaction)
                <tr>
                  <td>#{{$transaction->id}}</td>                                    
	              <td>{{$transaction->first_name.' '.$transaction->last_name}}</td>
	              <td>RP. {{number_format($transaction->total, 0, '', '.');}} ,-</td>
                <td>{{ date_format(new datetime($transaction->created_at), 'g:ia jS F Y') }}</td>
	              <td><a href="{{URL::to('admin/transaction/transactionDetail/'.$transaction->id)}}"><span class="glyphicon glyphicon-file"></span></td></a>
	              <td><a data-toggle="modal" data-target="#modalConfirm" onclick="confirmation('doTransactionPayment/{{$transaction->id}}','#{{$transaction->id}}')" href="#"><span class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;&nbsp;Sudah Bayar</span></a>
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
<div class="modal fade" id="modalConfirm" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Konfirmasi Pembayaran?</h4>
        </div>
        <div class="modal-body">
          <p>Pembayaran dengan no pesanan <span id="noTransaksi"></span> akan dikonfirmasi?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="okConfirm">Ya</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('javascript')
   <script type="text/javascript">
   $(function(){
    $("#menu_transaction").closest("li").addClass("active");
    $("#menu_transaction_pending").closest("li").addClass("active");

    $("#listTransaction").DataTable({
       "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
       "order": [[ 6, 'desc' ]],
       scrollX: true
    });
   });

    function confirmation(link,username){
      $("#noTransaksi").html(username);
      $("#okConfirm").click(function(){
        location.href = link;
      });
      return false;
    }
  </script>
@endsection