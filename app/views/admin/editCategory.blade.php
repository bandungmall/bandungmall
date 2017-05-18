@extends('admin.templates.layout')

@section('content')
  
<!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Edit Category</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <form role="form" action="{{URL::to('admin/category/doEditCategory')}}" method="post">
                      <input type="hidden" name="category_id" value="{{$category->id}}"/>
                      <div class="form-group">
                          <label for="adminid">Category Parent:</label>
                          <select name="category_parent" id="category_parent" class="form-control" required>
                            <option value="0">Root</option>
                            @foreach($categories as $cat)
                              @if($category->parent ==$cat->id)
                                <option value="{{$cat->id}}" selected>{{$cat->name}}</option>
                              @else
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                              @endif
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="adminpwd">Category Child:</label>
                          <input type="text" name="category" class="form-control" id="category" value="{{$category->name}}" placeholder="Masukkan caregory baru" required/>
                      </div>
            <div class="form-group">
                          <label for="adminid">Category Commision:</label>
                          <input type="number" name="category_commision" class="form-control" id="category" value="{{$category->commision}}" placeholder="Masukkan komisi baru" required/>
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