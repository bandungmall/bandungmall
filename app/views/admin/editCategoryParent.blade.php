@extends('admin.templates.layout')

@section('content')
  
<!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Edit Category Root</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <form role="form" action="{{URL::to('admin/category/doEditCategoryParent')}}" method="post">
                      <input type="hidden" name="category_id" value="{{$category->id}}"/>
                      <div class="form-group">
                          <label for="adminid">Category Root</label>
                          <select style="text-transform: capitalize;" name="category_root" id="category_root" class="form-control" required>
                            <option value="0">Pilih Kategori</option>
                            @foreach($category_root as $cat)
                              @if($cat->id == $category->id_root)
                                <option value="{{$cat->id}}" selected>{{$cat->name}}</option>
                              @else
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                              @endif
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="adminpwd">Category Name</label>
                          <input type="text" name="category" class="form-control" id="category" value="{{$category->name}}" placeholder="Masukkan caregory baru" required/>
                      </div>
                      @if(!empty($error_code))
                        {{$error_code}}
                      @endif
                      <div align="right">
                        <button type="submit" class="btn btn-success"><i class='fa fa-save'></i>&nbsp;&nbsp;&nbsp;Edit</button>
                      </div>
                  </form> 
          </div><!-- /.box-body -->
        </div>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
@endsection

@section('javascript')
<script type="text/javascript">
    $(function () {
      // Activate Sidebar Menu
      $("#menu_category").closest("li").addClass("active");
    });
</script>
@endsection