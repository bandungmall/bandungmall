@extends('admin.templates.layout')


@section('content')
  <section class="content-header">
    <h1>
      Edit Template Desciption
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-6 editDesciptionWrap">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Edit Desciption</h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <form role="form" action="{{URL::to('admin/configDescription/doEditConfigDescription')}}" method="post">
                <div class="form-group">
                  <label for="category">Category Root</label>
                  <select style="text-transform: capitalize;" name="category_root" id="categoryRoot" class="form-control" required>
                    <option value="0">Pilih Kategori</option>
                    @foreach($category_root as $cat)
                      @if($cat->id == $categories->crid)
                       <option value="{{$cat->id}}" data-keterangan="{{$cat->name}}" selected>{{$cat->name}}</option>
                      @else
                        <option value="{{$cat->id}}" data-keterangan="{{$cat->name}}">{{$cat->name}}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="category">Category Parent</label>
                  <select style="text-transform: capitalize;" name="category_parent" id="categoryParent" class="form-control" required>
                    <option value="0">Pilih Kategori</option>
                    @foreach($category_parent as $cat)
                      @if($cat->id == $categories->cpid)
                       <option value="{{$cat->id}}" data-keterangan="{{$cat->name}}" selected>{{$cat->name}}</option>
                      @else
                        <option value="{{$cat->id}}" data-keterangan="{{$cat->name}}">{{$cat->name}}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="category">Category Child</label>
                  <select style="text-transform: capitalize;" name="category_child" id="categoryChild" class="form-control" required>
                    <option value="0">Pilih Kategori</option>
                    @foreach($category_child as $cat)
                      @if($cat->id == $categories->ccid)
                       <option value="{{$cat->id}}" data-keterangan="{{$cat->name}}" selected data-keterangan2="{{$cat->has_grand_child}}">{{$cat->name}}</option>
                      @else
                        <option value="{{$cat->id}}" data-keterangan="{{$cat->name}}" data-keterangan2="{{$cat->has_grand_child}}">{{$cat->name}}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="category">Category Grand Child</label>
                  <select style="text-transform: capitalize;" name="category_grand_child" id="categoryGrandChild" class="form-control" required <?php echo $description->level == 4 ? '': 'disabled'; ?>>
                    <option value="0">Pilih Kategori</option>
                    @if($description->level == 4)
                      @foreach($category_grand_child as $cat)
                        @if($cat->id == $categories->cgcid)
                         <option value="{{$cat->id}}" data-keterangan="{{$cat->name}}" selected>{{$cat->name}}</option>
                        @else
                          <option value="{{$cat->id}}" data-keterangan="{{$cat->name}}">{{$cat->name}}</option>
                        @endif
                      @endforeach
                    @endif
                  </select>
                </div>
                <div class="form-group">
                  <label for="nama">Nama Desciption</label>
                  <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Description" value="{{$description->nama}}" readonly/>
                </div>
                <div class="form-group">
                  <label for="Description">Desciption <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Masukkan macam-macam Description dipisahkan dengan koma. Contoh : panjang lengan,lingkar dada,lingkar pinggang"></i></label>
                  <textarea name="description" class="form-control" id="description" placeholder="Masukkan Description" required>{{$description->deskripsi}}</textarea>
                  <input type="hidden" name="id" value="{{$description->id}}"/>
                </div>
                 <div class="form-group">
                  <label for="satuan">Satuan Description <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Masukkan hanya satu satuan description. Contoh : cm"></i></label>
                  <input type="text" name="satuan" class="form-control" id="satuan" placeholder="Masukkan Satuan Description" value="{{$description->satuan}}"/>
                </div>
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

   <script type="text/javascript">
   $(function(){
    $("#menu_config").closest("li").addClass("active");
    $("#menu_config_description").closest("li").addClass("active");

    $("#category").change(function(){
      $("#nama").val($(this).children('option:selected').data("keterangan"));
    });

    $("#categoryRoot").change(function(){
        $("#categoryParent").empty();
        $("#categoryChild").empty();
        $("#categoryGrandChild").empty();
        $("#categoryChild").append("<option value='0'>Pilih Kategori</option>");
        $("#categoryGrandChild").append("<option value='0'>Pilih Kategori</option>");
        $("#categoryGrandChild").prop("disabled",false);
        $("#nama").val("");
        
        if($(this).val() !== "0"){
          getParent($(this).val(),"#categoryParent");
          $("#categoryParent").focus();
        }else{
          alert("Pilih Category Rootnya");
          $("#categoryParent").append("<option value='0'>Pilih Kategori</option>");
          $(this).focus();
        }
      });

    $("#categoryParent").change(function(){
        $("#categoryChild").empty();
        $("#categoryGrandChild").empty();
        $("#categoryGrandChild").append("<option value='0'>Pilih Kategori</option>");
        $("#categoryGrandChild").prop("disabled",false);
        $("#nama").val("");
        
        if($(this).val() !== "0"){
          getChild($(this).val(),"#categoryChild");
          $("#categoryChild").focus();
        }else{
          alert("Pilih Category Parentnya");
          $("#categoryChild").append("<option value='0'>Pilih Kategori</option>");
          $(this).focus();
        }
      });

    $("#categoryChild").change(function(){
        $("#categoryGrandChild").prop("disabled",false);
        $("#categoryGrandChild").empty();
        $("#nama").val("");
        
        if($(this).find(':selected').data('keterangan2') === "yes"){        
          if($(this).val() !== "0"){
            getGrandChild($(this).val(),"#categoryGrandChild");
            $("#categoryGrandChild").focus();
          }else{
            alert("Pilih Category Child");
            $("#categoryGrandChild").append("<option value='0'>Pilih Kategori</option>");
            $(this).focus();
          }
        }else{
          $("#categoryGrandChild").append("<option value='0'>Pilih Kategori</option>");
          if($(this).val() !== "0"){
            $("#categoryGrandChild").prop("disabled",true);
            $("#nama").val("deskripsi "+$(this).children('option:selected').data("keterangan")+" "+$("#categoryParent").children('option:selected').data("keterangan")+" "+$("#categoryRoot").children('option:selected').data("keterangan"));
          }else{
            alert("Pilih Category Child");
            $("#categoryGrandChild").prop("disabled",false);
            $(this).focus();
          }
        }
      });

    $("#categoryGrandChild").change(function(){
       $("#nama").val("");
        if($(this).val() !== "0"){
          $("#nama").val("deskripsi "+$(this).children('option:selected').data("keterangan")+" "+$("#categoryChild").children('option:selected').data("keterangan")+" "+$("#categoryParent").children('option:selected').data("keterangan")+" "+$("#categoryRoot").children('option:selected').data("keterangan"));
        }else{
          alert("Pilih Category Grand Child");
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

            $(elem).append("<option value='"+id+"' data-keterangan='"+name+"'>"+name+"</option>");
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
      url: "../../category/getChildAll", 
      success: function(result){
        if(result.categories_child.length > 0){
          var x;
          $(elem).append("<option value='0'>Pilih Kategori</option>");
          for(x in result.categories_child){
            var id = result.categories_child[x].id;
            var name = result.categories_child[x].name;
            var has_grand_child = result.categories_child[x].has_grand_child;

            $(elem).append("<option value='"+id+"' data-keterangan='"+name+"' data-keterangan2='"+has_grand_child+"'>"+name+"</option>");
          }
        }else{
          $(elem).append("<option value='0'>Kategori Belum Tersedia</option>");
        }
      }
    });
  }

  function getGrandChild(val,elem){
    $.ajax({
      data: 'id='+val,
      url: "../../category/getGrandChild", 
      success: function(result){
        if(result.categories_grand_child.length > 0){
          var x;
          $(elem).append("<option value='0'>Pilih Kategori</option>");
          for(x in result.categories_grand_child){
            var id = result.categories_grand_child[x].id;
            var name = result.categories_grand_child[x].name;

            $(elem).append("<option value='"+id+"' data-keterangan='"+name+"'>"+name+"</option>");
          }
        }else{
          $(elem).append("<option value='0'>Kategori Belum Tersedia</option>");
        }
      }
    });
  }
  </script>
@endsection