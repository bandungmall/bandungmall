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
            <form role="form" action="{{URL::to('admin/category/doEditCategoryGrandChild')}}" method="post">
                      <input type="hidden" name="category_id" value="{{$categories->cgcid}}"/>
                      <div class="form-group">
                          <label for="adminid">Category Root</label>
                          <select style="text-transform: capitalize;" name="category_root" id="addRootGrandChild" class="form-control" required>
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
                          <select style="text-transform: capitalize;" name="category_parent" id="addParentGrandChild" class="form-control" required>
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
                          <label for="adminid">Category Child</label>
                          <select style="text-transform: capitalize;" name="category_child" id="addChildGrandChild" class="form-control" required>
                            <option value="0">Pilih Kategori</option>
                            @foreach($category_child as $cat)
                              @if($cat->id == $categories->ccid)
                                <option value="{{$cat->id}}" selected>{{$cat->name}}</option>
                              @else
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                              @endif
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="adminpwd">Category Name</label>
                          <input type="text" name="category" class="form-control" id="category" value="{{$categories->cgcname}}" placeholder="Masukkan caregory baru" required/>
                      </div>
                      <div class="form-group">
                          <label for="adminpwd">Commision</label>
                          <input type="number" name="commision" class="form-control" id="commision" placeholder="Masukkan commision" value="{{$categories->cgccommision}}" min="0"/>
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

      $("#addRootGrandChild").change(function(){
        $("#addParentGrandChild").empty();
        $("#addChildGrandChild").empty();
        $("#addChildGrandChild").append("<option value='0'>Pilih Kategori</option>");

        if($(this).val() !== "0"){
          getParent($(this).val(),"#addParentGrandChild");
          $("#addParentGrandChild").focus();
        }else{
          alert("Pilih Category Rootnya");
          $("#addParentGrandChild").append("<option value='0'>Pilih Kategori</option>");
          $(this).focus();
        }
      });

      $("#addParentGrandChild").change(function(){
        $("#addChildGrandChild").empty();

        if($(this).val() !== "0"){
          getChild($(this).val(),"#addChildGrandChild");
          $("#addChildGrandChild").focus();
        }else{
          alert("Pilih Category Parentnya");
          $("#addChildGrandChild").append("<option value='0'>Pilih Kategori</option>");
          $(this).focus();
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

    function getChild(val,elem){
      $.ajax({
        data: 'id='+val,
        url: "../../category/getChild", 
        success: function(result){
          if(result.categories_child.length > 0){
            var x;
            $(elem).append("<option value='0'>Pilih Kategori</option>");
            for(x in result.categories_child){
              var id = result.categories_child[x].id;
              var name = result.categories_child[x].name;

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