@extends('admin.templates.layout')

@section('content')
  <section class="content-header">
    <h1>
      Banner
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    @foreach ($banners as $banner)
      <div class="box box-danger">
        <!-- form start --> 
        <form class="form-horizontal" action="{{ URL::to('admin/banner/doUpdateBanner') }}" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="id" value="{{ $banner->id }}" />
          <img class="img-responsive pad" src="{{ asset($banner->image_url) }}" alt="Photo">
          <div class="box-body">
            <div class="form-group">
              <label for="image" class="col-sm-3 control-label">Image</label>
              <div class="col-sm-9">
                <input type="file" class="form-control" id="image" name="image">
                <p class="help-block">Jika tidak ingin mengganti gambar, maka biarkan saja.</p>
              </div>
            </div>

            <div class="form-group">
              <label for="target_url" class="col-sm-3 control-label">URL</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="target_url" name="target_url" value="{{ $banner->target_url }}" required>
                <p class="help-block">URL tanpa mengandung "bandungmall.co.id". Contoh, jika ingin ke "bandungmall.co.id/product/12", maka isi URL dengan "product/12". Jika tidak ingin ada URL, maka isi dengan "#".</p>
              </div>
            </div>

          </div><!-- /.box-body -->
          <div class="box-footer">
            <div class="pull-right">
              <button type="button" class="btn btn-danger" onclick="deleteBanner({{ $banner->id }})">Hapus</button>
              <button type="submit" class="btn btn-info">Ubah</button>
            </div>
          </div><!-- /.box-footer -->
        </form>
      </div>
    @endforeach

    <div class="box box-info">
      <div class="box-header with-border">
        <h3 class="box-title">Tambah Banner</h3>
      </div><!-- /.box-header -->
      <!-- form start -->
      <form class="form-horizontal" action="{{ URL::to('admin/banner/doAddBanner') }}" method="POST" enctype="multipart/form-data">
        <div class="box-body">
          <div class="form-group">
            <label for="image" class="col-sm-3 control-label">Image</label>
            <div class="col-sm-9">
              <input type="file" class="form-control" id="image" name="image" required>
              <p class="help-block">Resolusi gambar yang direkomendasikan adalah 1920px &times; 848px (lebar &times; tinggi).</p>
            </div>
          </div>

          <div class="form-group">
            <label for="target_url" class="col-sm-3 control-label">URL</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="target_url" name="target_url" required>
              <p class="help-block">URL tanpa mengandung "bandungmall.co.id". Contoh, jika ingin ke "bandungmall.co.id/product/12", maka isi URL dengan "product/12". Jika tidak ingin ada URL, maka isi dengan "#".</p>
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
    function deleteBanner(id) {
      post("{{ URL::to('admin/banner/doDeleteBanner')}}", {
        id: id
      }, "post");
    }
    $(function () {
      // Activate Sidebar Menu
      $("#menu_banner").closest("li").addClass("active");
    });
  </script>
@endsection
