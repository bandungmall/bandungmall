@extends('admin.templates.layout')

@section('content')
  <section class="content-header">
    <h1>
      Promotions 
    </h1>
    <h4 style="color:red">
      @if($errors->any())
      {{$errors->first()}}
      @endif
    </h4>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      @if ($promotions->count() >= 5)
      <div class="col-md-6">
        <div class="box box-danger">
          <!-- form start --> 
          <form class="form-horizontal" action="{{ URL::to('admin/promotions/doUpdatePromotion') }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{ $promotions[0]->id }}" />
            <img class="img-responsive pad" src="{{ asset($promotions[0]->image_url) }}" alt="Photo">
            <div class="box-body">
              <div class="form-group">
                <label for="image" class="col-sm-3 control-label">Image <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title='Jika tidak ingin mengganti gambar, maka biarkan kosong.'></i></label>
                <div class="col-sm-9">
                  <input type="file" class="form-control" id="image" name="image">
                </div>
              </div>

              <div class="form-group">
                <label for="target_url" class="col-sm-3 control-label">URL <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title='URL tanpa mengandung "bandungmall.co.id". Contoh, jika ingin ke "bandungmall.co.id/product/12", maka isi URL dengan "product/12". Jika tidak ingin ada URL, maka isi dengan "#".'></i></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="target_url" name="target_url" value="{{ $promotions[0]->target_url }}" required>
                </div>
              </div>

            </div><!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <button type="submit" class="btn btn-info">Ubah</button>
              </div>
            </div><!-- /.box-footer -->
          </form>
        </div>
      </div>

      <div class="col-md-6">
        <div class="box box-danger">
          <!-- form start --> 
          <form class="form-horizontal" action="{{ URL::to('admin/promotions/doUpdatePromotion') }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{ $promotions[3]->id }}" />
            <img class="img-responsive pad" src="{{ asset($promotions[3]->image_url) }}" alt="Photo">
            <div class="box-body">
              <div class="form-group">
                <label for="image" class="col-sm-3 control-label">Image <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title='Jika tidak ingin mengganti gambar, maka biarkan kosong.'></i></label>
                <div class="col-sm-9">
                  <input type="file" class="form-control" id="image" name="image">
                </div>
              </div>

              <div class="form-group">
                <label for="target_url" class="col-sm-3 control-label">URL <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title='URL tanpa mengandung "bandungmall.co.id". Contoh, jika ingin ke "bandungmall.co.id/product/12", maka isi URL dengan "product/12". Jika tidak ingin ada URL, maka isi dengan "#".'></i></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="target_url" name="target_url" value="{{ $promotions[3]->target_url }}" required>
                </div>
              </div>

            </div><!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <button type="submit" class="btn btn-info">Ubah</button>
              </div>
            </div><!-- /.box-footer -->
          </form>
        </div>
      </div>

      <div class="col-md-6">
        <div class="box box-danger">
          <!-- form start --> 
          <form class="form-horizontal" action="{{ URL::to('admin/promotions/doUpdatePromotion') }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{ $promotions[2]->id }}" />
            <img class="img-responsive pad" src="{{ asset($promotions[2]->image_url) }}" alt="Photo">
            <div class="box-body">
              <div class="form-group">
                <label for="image" class="col-sm-3 control-label">Image <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title='Jika tidak ingin mengganti gambar, maka biarkan kosong.'></i></label>
                <div class="col-sm-9">
                  <input type="file" class="form-control" id="image" name="image">
                </div>
              </div>

              <div class="form-group">
                <label for="target_url" class="col-sm-3 control-label">URL <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title='URL tanpa mengandung "bandungmall.co.id". Contoh, jika ingin ke "bandungmall.co.id/product/12", maka isi URL dengan "product/12". Jika tidak ingin ada URL, maka isi dengan "#".'></i></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="target_url" name="target_url" value="{{ $promotions[2]->target_url }}" required>
                </div>
              </div>

            </div><!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <button type="submit" class="btn btn-info">Ubah</button>
              </div>
            </div><!-- /.box-footer -->
          </form>
        </div>
      </div>

      <div class="col-md-6">
        <div class="box box-danger">
          <!-- form start --> 
          <form class="form-horizontal" action="{{ URL::to('admin/promotions/doUpdatePromotion') }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{ $promotions[4]->id }}" />
            <img class="img-responsive pad" src="{{ asset($promotions[4]->image_url) }}" alt="Photo">
            <div class="box-body">
              <div class="form-group">
                <label for="image" class="col-sm-3 control-label">Image <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title='Jika tidak ingin mengganti gambar, maka biarkan kosong.'></i></label>
                <div class="col-sm-9">
                  <input type="file" class="form-control" id="image" name="image">
                </div>
              </div>

              <div class="form-group">
                <label for="target_url" class="col-sm-3 control-label">URL <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title='URL tanpa mengandung "bandungmall.co.id". Contoh, jika ingin ke "bandungmall.co.id/product/12", maka isi URL dengan "product/12". Jika tidak ingin ada URL, maka isi dengan "#".'></i></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="target_url" name="target_url" value="{{ $promotions[4]->target_url }}" required>
                </div>
              </div>

            </div><!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <button type="submit" class="btn btn-info">Ubah</button>
              </div>
            </div><!-- /.box-footer -->
          </form>
        </div>
      </div>

      <div class="col-md-4">
        <div class="box box-danger">
          <!-- form start --> 
          <form class="form-horizontal" action="{{ URL::to('admin/promotions/doUpdatePromotion') }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="{{ $promotions[1]->id }}" />
            <img class="img-responsive pad" src="{{ asset($promotions[1]->image_url) }}" alt="Photo">
            <div class="box-body">
              <div class="form-group">
                <label for="image" class="col-sm-3 control-label">Image <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title='Jika tidak ingin mengganti gambar, maka biarkan kosong.'></i></label>
                <div class="col-sm-9">
                  <input type="file" class="form-control" id="image" name="image">
                </div>
              </div>

              <div class="form-group">
                <label for="target_url" class="col-sm-3 control-label">URL <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title='URL tanpa mengandung "bandungmall.co.id". Contoh, jika ingin ke "bandungmall.co.id/product/12", maka isi URL dengan "product/12". Jika tidak ingin ada URL, maka isi dengan "#".'></i></label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" id="target_url" name="target_url" value="{{ $promotions[1]->target_url }}" required>
                </div>
              </div>

            </div><!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <button type="submit" class="btn btn-info">Ubah</button>
              </div>
            </div><!-- /.box-footer -->
          </form>
        </div>
      </div>
      @else
      <div class="col-md-12">
        <p>Terjadi kesalahan (promotions harus diinisialisasi terlebih dahulu. Hubungi admin database)</p>
      </div>
      @endif
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
    function deletePromotion(id) {
      post("{{ URL::to('admin/promotions/doDeletePromotion')}}", {
        id: id
      }, "post");
    }
    $(function () {
      // Activate Sidebar Menu
      $("#menu_promotions").closest("li").addClass("active");
    });
  </script>
@endsection
