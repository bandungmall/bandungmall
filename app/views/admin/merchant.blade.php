@extends('admin.templates.layout')

@section('content')
  <section class="content-header">
    <h1>
      Registered Merchant
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Accepted Merchant</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="accepted-merchant" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Email</th>
                  <th scope="col">Shop Name</th> 
                  <th scope="col">Detail</th>
                </tr>
              </thead>
              <tbody>
              @foreach($merchants as $merchant)
                <tr>
                  <td>{{$merchant->id}}</td>
                  <td>{{$merchant->email}}</td>
                  <td>{{$merchant->shop_name}}</td>
                  <td><a href="{{URL::to('admin/merchant/editMerchant?id='.$merchant->id)}}"><span class="glyphicon glyphicon-file"></span></td></a>
                </tr>
              @endforeach
              </tbody>
            </table>
          </div><!-- /.box-body -->
        </div>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
@endsection


@section('javascript')
  <!-- DataTables -->

  <!-- Page Script -->
  <script>
    function confirmation(link){
      if(confirm("Are you sure?")){
        location.href = link;
      }
      return false;
    }
    $(function () {
      // Activate Sidebar Menu
      $("#menu_merchant_login").closest("li").addClass("active");
      $("#menu_merchant").closest("li").addClass("active");

      $("#accepted-merchant").DataTable({
       "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
           scrollX: true
      });
    });
  </script>
@endsection
