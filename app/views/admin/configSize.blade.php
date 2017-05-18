@extends('admin.templates.layout')

@section('content')
  <section class="content-header">
    <h1>
      Daftar Template Size
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">List Size</h3>
          </div><!-- /.box-header -->
          @if(!empty($error_code))
            <span style="margin-left:10px; color:red">* {{$error_code}}</span>
          @endif
          <div class="box-body">
            <table style="text-transform: capitalize;" id="listSize" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Deskripsi Size</th>
                  <th scope="col">Edit</th>
                  <th scope="col">Hapus</th>
                </tr>
              </thead>
              <tbody>
              {{--*/ $x = 1 /*--}}
              @foreach ($sizes as $size)
                <tr>
                  <td>{{$x}}</td>
                  <td>{{$size->nama}}</td>
                  <td>{{$size->size}}</td>
                  <td><a href="{{URL::to('admin/configSize/editConfigSize/'.$size->id)}}"><span class="glyphicon glyphicon-edit"></span></a></td>
          <td><a data-toggle="modal" data-target="#modalDelete" href="#" onclick="delete_confirm('configSize/doDeleteConfigSize?id={{$size->id}}','{{$size->nama}}');"><span class="glyphicon glyphicon-remove"></span></a></td>
                </tr>
                {{--*/ $x++ /*--}}
              @endforeach
              </tbody>
            </table>
            <button style="float:right" class="btn btn-success" id="addSize"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Tambah Size</button>
          </div><!-- /.box-body -->
        </div>
      </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row">
      <div class="col-xs-6 tambahSizeWrap hide">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Tambah Size</h3>
            <button style="float:right" class="btn btn-danger" id="closeAddSize"><i class="fa fa-close"></i></button>
          </div><!-- /.box-header -->
          <div class="box-body">
            <form role="form" action="{{URL::to('admin/configSize/doInsertConfigSize')}}" method="post">
                <div class="form-group">
                  <label for="category">Category Root</label>
                  <select style="text-transform: capitalize;" name="category_root" id="categoryRoot" class="form-control" required>
                    <option value="0">Pilih Kategori</option>
                    @foreach($categories_root as $category)
                      <option value="{{$category->id}}" data-keterangan="{{$category->name}}">{{$category->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="category">Category Parent</label>
                  <select style="text-transform: capitalize;" name="category_parent" id="categoryParent" class="form-control" required>
                    <option value="0">Pilih Kategori</option>
                    
                  </select>
                </div>
                <div class="form-group">
                  <label for="category">Category Child</label>
                  <select style="text-transform: capitalize;" name="category_child" id="categoryChild" class="form-control" required>
                    <option value="0">Pilih Kategori</option>
                    
                  </select>
                </div>
                <div class="form-group">
                  <label for="category">Category Grand Child</label>
                  <select style="text-transform: capitalize;" name="category_grand_child" id="categoryGrandChild" class="form-control" required>
                    <option value="0">Pilih Kategori</option>
                    
                  </select>
                </div>
                <div class="form-group">
                  <label for="nama">Nama Size</label>
                  <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Size" readonly/>
                </div>
                <div class="form-group">
                  <label for="size">Deskripsi Size <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Masukkan macam-macam size dipisahkan dengan koma. Contoh : S,M,L"></i></label>
                  <textarea name="size" class="form-control" id="size" placeholder="Masukkan Deskripsi Size" required></textarea>
                </div>
                <div align="right">
                  <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;&nbsp;&nbsp;Tambah</button>
                </div>
              </form> 
          </div><!-- /.box-body -->
        </div>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
  <div class="modal fade" id="modalDelete" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Hapus Size?</h4>
        </div>
        <div class="modal-body">
          <p>Yakin ingin menghapus <span id="namaSize"></span>?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="okDelete">Ya</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('javascript')
  

   <script type="text/javascript">
   $(function(){
    $("#menu_config").closest("li").addClass("active");
    $("#menu_config_size").closest("li").addClass("active");
    $("#listSize").DataTable({
       "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
           scrollX: true
    });
    $("#addSize").click(function(){
      $('.tambahSizeWrap').removeClass("hide");
    });
    $("#closeAddSize").click(function(){
      $('.tambahSizeWrap form')[0].reset();
      $('.tambahSizeWrap').addClass("hide");
    });

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
          $("#nama").val("size "+$(this).children('option:selected').data("keterangan")+" "+$("#categoryParent").children('option:selected').data("keterangan")+" "+$("#categoryRoot").children('option:selected').data("keterangan"));
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
          $("#nama").val("size "+$(this).children('option:selected').data("keterangan")+" "+$("#categoryChild").children('option:selected').data("keterangan")+" "+$("#categoryParent").children('option:selected').data("keterangan")+" "+$("#categoryRoot").children('option:selected').data("keterangan"));
        }else{
          alert("Pilih Category Grand Child");
          $(this).focus();
        }
      });
  });

    function delete_confirm(link,size){
      $("#namaSize").html(size);
      $("#okDelete").click(function(){
        location.href = link;
      });
      return false;
    }
    function getParent(val,elem){
    $.ajax({
      data: 'id='+val,
      url: "category/getParent", 
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
      url: "category/getChildAll", 
      success: function(result){
        if(result.categories_child.length > 0){
          var x;
          $(elem).append("<option value='0'>Pilih Kategori</option>");
          for(x in result.categories_child){
            var id = result.categories_child[x].id;
            var name = result.categories_child[x].name;
            var has_grand_child = result.categories_child[x].has_grand_child;

            $(elem).append("<option value='"+id+"' data-keterangan='"+name+"'' data-keterangan2='"+has_grand_child+"'>"+name+"</option>");
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
      url: "category/getGrandChild", 
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