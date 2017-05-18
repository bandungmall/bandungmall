@extends('admin.templates.layout')


@section('content')
  <section class="content-header">
    <h1>
      Registered Admin
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">List Admin</h3>
          </div><!-- /.box-header -->
          @if(!empty($error_code))
            <span style="margin-left:10px; color:red">* {{$error_code}}</span>
          @endif
          <div class="box-body">
            <table id="listAdmin" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col">Username</th>
                  <th scope="col">Hapus</th>
                </tr>
              </thead>
              <tbody>
              @foreach($admins as $admin)
                <tr>
                  <td>{{$admin->username}}</td>
                  <td><a data-toggle="modal" data-target="#modalDelete" href="#" onclick="delete_confirm('admin/doDeleteAdmin?id={{ $admin->id; }}','{{$admin->username}}');"><span class="fa fa-remove"></span></a></td>
                </tr>
              @endforeach
              </tbody>
            </table>
            <button style="float:right" class="btn btn-success" id="addAdmin"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Tambah Admin</button>
          </div><!-- /.box-body -->
        </div>
      </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row">
      <div class="col-xs-6 tambahAdminWrap hide">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Tambah Admin</h3>
            <button style="float:right" class="btn btn-danger" id="closeAddAdmin"><i class="fa fa-close"></i></button>
          </div><!-- /.box-header -->
          <div class="box-body">
            <form role="form" action="{{URL::to('admin/admin/doInsertAdmin')}}" method="post">
                <div class="form-group">
                  <label for="adminid">Admin Username</label>
                  <input type="text" name="username" class="form-control" id="adminid" placeholder="Masukkan Userame" required/>
                </div>
                <div class="form-group">
                  <label for="adminpwd">Admin Password</label>
                  <input type="password" name="password" class="form-control" id="adminpwd" placeholder="Masukkan password" required/>
                </div>
                <div class="form-group">
                  <label for="adminpwd1">Konfirmasi Password</label>
                  <input type="password" name="confirm_password" class="form-control" id="adminpwd1" placeholder="Ketik ulang password" required/>
                </div>
                <div align="right">
                  <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;&nbsp;Tambah</button>
                </div>
              </form> 
          </div><!-- /.box-body -->
        </div>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
  <div class="modal fade" id="modalDelete" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Hapus Admin?</h4>
        </div>
        <div class="modal-body">
          <p>Yakin ingin menghapus <span id="userAdmin"></span>?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="okDelete">Ya</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('javascript')
   <script type="text/javascript">
   $(function(){
    $("#menu_admin").closest("li").addClass("active");
    $("#listAdmin").DataTable({
       "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
           scrollX: true
    });
    $("#addAdmin").click(function(){
      $('.tambahAdminWrap').removeClass("hide");
    });
    $("#closeAddAdmin").click(function(){
      $('.tambahAdminWrap').addClass("hide");
    });
   });
    var password = document.getElementsByName("password")[0];
    var confirm_password = document.getElementsByName("confirm_password")[0];

    function validatePassword(){
      if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Don't Match");
      } else {
        confirm_password.setCustomValidity('');
      }
    }
    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;

    function delete_confirm(link,username){
      $("#userAdmin").html(username);
      $("#okDelete").click(function(){
        location.href = link;
      });
      return false;
    }
  </script>
@endsection