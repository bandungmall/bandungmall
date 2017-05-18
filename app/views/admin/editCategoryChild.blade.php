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
            <form role="form" action="{{URL::to('admin/category/doEditCategoryChild')}}" method="post">
                      <input type="hidden" name="category_id" value="{{$categories->ccid}}"/>
                      <div class="form-group">
                          <label for="adminid">Category Root</label>
                          <select style="text-transform: capitalize;" name="category_root" id="addRootChild" class="form-control" required>
                            <option value="0">Pilih Kategori</option>
                            @foreach($category_root as $cat)
                              @if($cat->id == $categories->crid)
                                <option value="{{$cat->id}}" selected>{{$cat->name}}</option>
                              @else
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                              @endif
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="adminid">Category Parent</label>
                          <select style="text-transform: capitalize;" name="category_parent" id="addParentChild" class="form-control" required>
                            <option value="0">Pilih Kategori</option>
                            @foreach($category_parent as $cat)
                              @if($cat->id == $categories->cpid)
                                <option value="{{$cat->id}}" selected>{{$cat->name}}</option>
                              @else
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                              @endif
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="adminpwd">Category Name</label>
                          <input type="text" name="category" class="form-control" id="category" value="{{$categories->ccname}}" placeholder="Masukkan caregory baru" required/>
                      </div>
                      <div class="form-group">
                          <label for="adminpwd">Commision</label>
                          <input type="number" name="commision" class="form-control" id="commision" placeholder="Masukkan commision" value="{{$categories->cccommision}}" min="0" <?php echo $category->has_grand_child == "yes" ? "readonly":"";?>/>
                          <input type="hidden" class="form-control" id="commisionTemp" placeholder="Masukkan commision" value="{{$categories->cccommision}}"/>
                      </div>
                      <div class="form-group">
                          <label for="adminpwd">Has Grand Child ? <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Jika ya, maka category akan mempunyai sub category"></i></label>
                          <div>
                          <input type="checkbox" class="minimal" value="yes" name="hasgrandchild" id="hasGrandChild" <?php echo $category->has_grand_child == "yes" ? "checked":"";?>> Yes
                          </div>
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

      $("#addRootChild").change(function(){
        $("#addParentChild").empty();
        
        if($(this).val() !== "0"){
          getParent($(this).val(),"#addParentChild");
          $("#addParentChild").focus();
        }else{
          alert("Pilih Category Rootnya");
          $("#addParentChild").append("<option value='0'>Pilih Kategori</option>");
          $(this).focus();
        }
      });

      $("#hasGrandChild").click(function(){
        if(!$(this).is(":checked")){
          $("#commision").val($("#commisionTemp").val());
          $("#commision").prop("readonly",false);
        }else{
          $("#commision").val("0");
          $("#commision").prop("readonly",true);
        }
      });
    });
    function getParent(val,elem){
    $.ajax({
      data: 'id='+val,
      url: "../../category/getParent", 
      success: function(result){
        if(result.categories_parent.length > 0){
          var x;
          $(elem).append("<option value='0'>Pilih Kategori</option>");
          for(x in result.categories_parent){
            var id = result.categories_parent[x].id;
            var name = result.categories_parent[x].name;

            $(elem).append("<option value='"+id+"'>"+name+"</option>");
          }
        }else{
          $(elem).append("<option value='0'>Kategori Belum Tersedia</option>");
        }
      }
    });
  }
</script>
@endsection