@extends('admin.templates.layout')

@section('content')
<section class="content-header">
    <h1>
      Transaction User
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">List Transaction</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="listTransaction" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col">No Pesanan</th>
                  <th scope="col">Customer</th>
                  <th scope="col">Total</th>
                  <th scope="col">Confirmed</th>
                  <th scope="col">Detail</th>
                </tr>
              </thead>
              <tbody>
              @foreach($transactions as $transaction)
                <tr>
                  <td>#{{$transaction->id}}</td>                                    
	              <td>{{$transaction->first_name.' '.$transaction->last_name}}</td>
	              <td>RP. {{number_format($transaction->total, 0, '', '.');}} ,-</td>
	              <th>{{$transaction->paid}}</th>
	              <td><a href="{{URL::to('admin/user/detailTransaction?id='.$transaction->id)}}"><span class="glyphicon glyphicon-file"></span></td></a>
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
    $("#menu_user").closest("li").addClass("active");
    $("#menu_user_transaction").closest("li").addClass("active");

    $("#listTransaction").DataTable({
       "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
           scrollX: true
    });
   });
  </script>
@endsection