@if (Session::has('error'))
  <section class="content" style="min-height: 0; padding-bottom: 0">
    <div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-warning"></i> Error!</h4>
      {{ Session::get('error') }}
    </div>
  </section>
@endif

@if (Session::has('message'))
  <section class="content" style="min-height: 0; padding-bottom: 0">
    <div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> {{ Session::get('message') }}</h4>
    </div>
  </section>
@endif
