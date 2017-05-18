@extends('admin.templates.layout')

@section('stylesheet')
  <link rel="stylesheet" href="{{ asset('public/assets/admin/plugins/colorpicker/bootstrap-colorpicker.min.css') }}">
@endsection

@section('content')
  <section class="content-header">
    <h1>
      Daftar Template Warna
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">List Warna</h3>
          </div><!-- /.box-header -->
          @if(!empty($error_code))
            <span style="margin-left:10px; color:red">* {{$error_code}}</span>
          @endif
          <div class="box-body">
            <table style="text-transform: capitalize;" id="listWarna" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama Warna</th>
                  <th scope="col">Kode</th>
                  <th scope="col">Pallete</th>
                  <th scope="col">Edit</th>
                  <th scope="col">Hapus</th>
                </tr>
              </thead>
              <tbody>
              {{--*/ $x = 1 /*--}}
              @foreach ($colours as $colour)
                <tr>
                  <td>{{$x}}</td>
                  <td>{{$colour->nama}}</td>
                  <td>{{$colour->kode}}</td>
                  <td>
                    <div id="pallete" class="input-group colorpicker-component">
                        <input type="text" value="{{$colour->kode}}" class="form-control" disabled />
                        <span class="input-group-addon"><i></i></span>
                    </div>
                  </td>
                  <td><a href="{{URL::to('admin/configColour/editConfigColour?id='.$colour->id)}}"><span class="glyphicon glyphicon-edit"></span></a></td>
          <td><a data-toggle="modal" data-target="#modalDelete" href="#" onclick="delete_confirm('configColour/doDeleteConfigColour?id={{$colour->id}}','{{$colour->nama}}');"><span class="glyphicon glyphicon-remove"></span></a></td>
                </tr>
                {{--*/ $x++ /*--}}
              @endforeach
              </tbody>
            </table>
            <button style="float:right" class="btn btn-success" id="addWarna"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Tambah Warna</button>
          </div><!-- /.box-body -->
        </div>
      </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row">
      <div class="col-xs-6 tambahWarnaWrap hide">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Tambah Warna</h3>
            <button style="float:right" class="btn btn-danger" id="closeAddWarna"><i class="fa fa-close"></i></button>
          </div><!-- /.box-header -->
          <div class="box-body">
            <form role="form" action="{{URL::to('admin/configColour/doInsertConfigColour')}}" method="post">
                <div class="form-group">
                  <label for="nama">Nama Warna</label>
                  <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Warna" required/>
                </div>
                <div class="form-group">
                  <label for="adminpwd">Pallet Warna</label>
                  <div id="addPallete" class="input-group colorpicker-component">
                        <input type="text" name="kode" value="#000000" class="form-control" placeholder="Masukkan Kode Hexa / Klik pallete" required />
                        <span class="input-group-addon"><i></i></span>
                    </div>
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
          <h4 class="modal-title">Hapus Warna?</h4>
        </div>
        <div class="modal-body">
          <p>Yakin ingin menghapus warna <span id="namaWarna"></span>?</p>
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
  <script src="{{ asset('public/assets/admin/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>

   <script type="text/javascript">
   $(function(){
    $("#menu_config").closest("li").addClass("active");
    $("#menu_config_colour").closest("li").addClass("active");
    $("#listWarna").DataTable({
       "scrollY": "250px",
        "paging": false,
            scrollX: true
    });
    $("#addWarna").click(function(){
      $('.tambahWarnaWrap').removeClass("hide");
    });
    $("#closeAddWarna").click(function(){
      $('.tambahWarnaWrap').addClass("hide");
    });
    $(".colorpicker-component").colorpicker();
    
   });

    function delete_confirm(link,warna){
      $("#namaWarna").html(warna);
      $("#okDelete").click(function(){
        location.href = link;
      });
      return false;
    }
  </script>
@endsection