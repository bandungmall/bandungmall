@extends('admin.templates.layout')

@section('content')
  <section class="content-header">
    <h1>
      Daftar Template Description
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">List Description</h3>
          </div><!-- /.box-header -->
          @if(!empty($error_code))
            <span style="margin-left:10px; color:red">* {{$error_code}}</span>
          @endif
          <div class="box-body">
            <table style="text-transform: capitalize;" id="listDescription" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Description</th>
                  <th scope="col">Satuan</th>
                  <th scope="col">Edit</th>
                  <th scope="col">Hapus</th>
                </tr>
              </thead>
              <tbody>
              {{--*/ $x = 1 /*--}}
              @foreach ($descriptions as $description)
                <tr>
                  <td>{{$x}}</td>
                  <td>{{$description->nama}}</td>
                  <td>{{$description->deskripsi}}</td>
                  <td>{{$description->satuan}}</td>
                  <td><a href="{{URL::to('admin/configDescription/editConfigDescription/'.$description->id)}}"><span class="glyphicon glyphicon-edit"></span></a></td>
          <td><a data-toggle="modal" data-target="#modalDelete" href="#" onclick="delete_confirm('configDescription/doDeleteConfigDescription?id={{$description->id}}','{{$description->nama}}');"><span class="glyphicon glyphicon-remove"></span></a></td>
                </tr>
                {{--*/ $x++ /*--}}
              @endforeach
              </tbody>
            </table>
            <button style="float:right" class="btn btn-success" id="addDescription"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Tambah Description</button>
          </div><!-- /.box-body -->
        </div>
      </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row">
      <div class="col-xs-6 tambahDescriptionWrap hide">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Tambah Description</h3>
            <button style="float:right" class="btn btn-danger" id="closeAddDescription"><i class="fa fa-close"></i></button>
          </div><!-- /.box-header -->
          <div class="box-body">
            <form role="form" action="{{URL::to('admin/configDescription/doInsertConfigDescription')}}" method="post">
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
                  <label for="nama">Nama Description</label>
                  <input type="text" name="nama" class="form-control" id="nama" placeholder="Masukkan Nama Description" readonly/>
                </div>
                <div class="form-group">
                  <label for="Description">Description <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Masukkan macam-macam description dipisahkan dengan koma. Contoh : panjang lengan,lingkar dada,lingkar pinggang"></i></label>
                  <textarea name="description" class="form-control" id="description" placeholder="Masukkan Deskripsi Description" required></textarea>
                </div>
                <div class="form-group">
                  <label for="satuan">Satuan Description <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Masukkan hanya satu satuan description. Contoh : cm"></i></label>
                  <input type="text" name="satuan" class="form-control" id="satuan" placeholder="Masukkan Satuan Description"/>
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
          <h4 class="modal-title">Hapus Description?</h4>
        </div>
        <div class="modal-body">
          <p>Yakin ingin menghapus <span id="namaDescription"></span>?</p>
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
    $("#menu_config_description").closest("li").addClass("active");
    $("#listDescription").DataTable({
       "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
           scrollX: true
    });
    $("#addDescription").click(function(){
      $('.tambahDescriptionWrap').removeClass("hide");
    });
    $("#closeAddDescription").click(function(){
      $('.tambahDescriptionWrap form')[0].reset();
      $('.tambahDescriptionWrap').addClass("hide");
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

    function delete_confirm(link,description){
      $("#namaDescription").html(description);
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