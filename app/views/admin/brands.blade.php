@extends('admin.templates.layout')

@section('content')
  <section class="content-header">
    <h1>
      Brands
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
    @forelse ($brands as $brand)
      <div class="col-md-4">
        <div class="box box-danger">
          <!-- form start --> 
          <form class="form-horizontal" action="{{ URL::to('admin/brands/doUpdateBrand') }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{ $brand->id }}" />
            <img class="img-responsive pad" src="{{ asset($brand->image_url) }}" alt="Photo">
            <div class="box-body">
              <div class="form-group">
                <label for="image" class="col-sm-3 control-label">Image <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title='Jika tidak ingin mengganti gambar, maka biarkan kosong.'></i></label>
                <div class="col-sm-9">
                  <input type="file" class="form-control" id="image" name="image">
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Nama Brand</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="name" name="name" value="{{ $brand->name }}" required>
                </div>
              </div>

              <div class="form-group">
                <label for="target_url" class="col-sm-3 control-label">URL <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title='URL tanpa mengandung "bandungmall.co.id". Contoh, jika ingin ke "bandungmall.co.id/product/12", maka isi URL dengan "product/12". Jika tidak ingin ada URL, maka isi dengan "#".'></i></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="target_url" name="target_url" value="{{ $brand->target_url }}" required>
                </div>
              </div>

            </div><!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <button type="button" class="btn btn-danger" onclick="deleteBrand({{ $brand->id }})">Hapus</button>
                <button type="submit" class="btn btn-info">Ubah</button>
              </div>
            </div><!-- /.box-footer -->
          </form>
        </div>
      </div>
    @empty
      <div class="col-md-12">
        <p>Belum ada brand yang terdaftar</p>
      </div>
    @endforelse
    </div>

    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Tambah Brand</h3>
      </div><!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" action="{{ URL::to('admin/brands/doAddBrand') }}" method="POST" enctype="multipart/form-data">
        <div class="box-body">
          <div class="form-group">
            <label for="image" class="col-sm-3 control-label">Image <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title='Ukuran yang disarankan adalah 200px &times; 200px.'></i></label>
            <div class="col-sm-9">
              <input type="file" class="form-control" id="image" name="image">
            </div>
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Nama Brand</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
          </div>

          <div class="form-group">
            <label for="target_url" class="col-sm-3 control-label">URL <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title='URL tanpa mengandung "bandungmall.co.id". Contoh, jika ingin ke "bandungmall.co.id/product/12", maka isi URL dengan "product/12". Jika tidak ingin ada URL, maka isi dengan "#".'></i></label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="target_url" name="target_url" required>
            </div>
          </div>

        </div><!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-info pull-right">Tambah</button>
        </div><!-- /.box-footer -->
      </form>
    </div>

  </section><!-- /.content -->
@endsection


@section('javascript')
  <!-- Page script -->
  <script>
    function post(path, params, method) {
      method = method || "post"; // Set method to post by default if not specified.

      // The rest of this code assumes you are not using a library.
      // It can be made less wordy if you use one.
      var form = document.createElement("form");
      form.setAttribute("method", method);
      form.setAttribute("action", path);

      for(var key in params) {
          if(params.hasOwnProperty(key)) {
              var hiddenField = document.createElement("input");
              hiddenField.setAttribute("type", "hidden");
              hiddenField.setAttribute("name", key);
              hiddenField.setAttribute("value", params[key]);

              form.appendChild(hiddenField);
           }
      }

      document.body.appendChild(form);
      form.submit();
    }
    function deleteBrand(id) {
      post("{{ URL::to('admin/brands/doDeleteBrand')}}", {
        id: id
      }, "post");
    }
    $(function () {
      // Activate Sidebar Menu
      $("#menu_brands").closest("li").addClass("active");
    });
  </script>
@endsection
