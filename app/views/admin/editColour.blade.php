@extends('admin.templates.layout')

@section('stylesheet')
  <link rel="stylesheet" href="{{ asset('public/assets/admin/plugins/colorpicker/bootstrap-colorpicker.min.css') }}">
@endsection

@section('content')
  <section class="content-header">
    <h1>
      Edit Template Warna
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-6 editWarnaWrap">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Edit Warna</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <form role="form" action="{{URL::to('admin/configColour/doEditConfigColour')}}" method="post">
                <div class="form-group">
                  <label for="nama">Nama Warna</label>
                  <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Warna" value="{{$colour->nama}}" required/>
                  <input type="hidden" name="id" class="form-control" id="id" value="{{$colour->id}}" required/>
                </div>
                <div class="form-group">
                  <label for="adminpwd">Pallet Warna</label>
                  <div id="addPallete" class="input-group colorpicker-component">
                        <input type="text" name="kode" class="form-control" placeholder="Masukkan Kode Hexa / Klik pallete" value="{{$colour->kode}}" required/>
                        <span class="input-group-addon"><i></i></span>
                    </div>
                </div>
                @if(!empty($error_code))
                  {{$error_code}}
                @endif
                <div align="right">
                  <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;&nbsp;Edit</button>
                </div>
              </form> 
          </div><!-- /.box-body -->
        </div>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
@endsection
@section('javascript')
  <script src="{{ asset('public/assets/admin/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>

   <script type="text/javascript">
   $(function(){
    $("#menu_config").closest("li").addClass("active");
    $("#menu_config_colour").closest("li").addClass("active");

    $(".colorpicker-component").colorpicker();
    
   });
  </script>
@endsection