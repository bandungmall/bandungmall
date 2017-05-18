@extends('admin.templates.layout')

@section('content')
<section class="content-header">
    <h1>
      Registered Customer
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">List Customer</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="listCustomer" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col">id</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Email</th>
                </tr>
              </thead>
              <tbody>
              @foreach($users as $user)
                <tr>
                  <td>{{$user->id}}</td>
                  <td>{{$user->first_name.' '.$user->last_name}}</td>
                  <td>{{$user->email}}</td>
                  {{--@if(!empty($user->upline_id))--}}
                  {{--<td>{{$user->upline_id}}</td>--}}
                  {{--@else--}}
                  {{--<td>-</td>--}}
                  {{--@endif--}}
                </tr>
              @endforeach
              </tbody>
            </table>
          </div><!-- /.box-body -->
        </div>
      </div><!-- /.col -->
    </div><!-- /.row -->
     <div class="row">
      <div class="col-xs-6">
        <div class="box box-success">
          <div class="box-body">
            <form>
              <div class="form-group">
                <label for="adminpwd">Content</label>
                <input type="text" name="content" class="form-control" id="content" placeholder="Masukkan Content" required/>
              </div>
              <div align="right">
                <button type="submit" class="btn btn-default">Send</button>
              </div>
            </form>
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
    $("#menu_user_user").closest("li").addClass("active");

    $("#listCustomer").DataTable({
       "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
           scrollX: true
    });
   });
  </script>
@endsection