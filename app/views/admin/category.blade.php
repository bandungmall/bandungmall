@extends('admin.templates.layout')

@section('stylesheet')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('public/assets/merchant/plugins/select2/select2.min.css') }}">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="{{ asset('public/assets/merchant/plugins/iCheck/all.css') }}">
@endsection

@section('content')
  <section class="content-header">
    <h1>
      Daftar Category
    </h1>
  </section>
  
<!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">List Category Root</h3>
          </div><!-- /.box-header -->
          @if($errors->first('root_msg'))
              <span style="margin-left:10px; color:red">* {{$errors->first('root_msg')}}</span>
          @endif
          <div class="box-body">
            <table style="text-transform: capitalize;" id="listCategoryRoot" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
          <th scope="col">Category Root</th>
          <th scope="col">Edit</th>
          <th scope="col">Hapus</th>     
                </tr>
              </thead>
              <tbody>
              <?php $x=1;?>
              @foreach($categories_root as $category)
          <tr>
          <td>{{$x}}</td>
          <td>{{$category->name}}</td>
          <td><a href="{{URL::to('admin/category/editCategoryRoot/'.$category->id)}}"><span class="glyphicon glyphicon-edit"></span></a></td>
          <td><a data-toggle="modal" data-target="#modalDelete" href="#" onclick="confirmation('category/doDeleteCategoryRoot/<?php echo $category->id; ?>','{{$category->name}}');"><span class="glyphicon glyphicon-remove"></span></a></td>           
          </tr>
          <?php $x++;?>
        @endforeach
              </tbody>
            </table>
            <button style="float:right" class="btn btn-success" id="addCategoryRoot"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Tambah Category Root</button>
          </div><!-- /.box-body -->
        </div>
      </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">List Category Parent</h3>
          </div><!-- /.box-header -->
         @if($errors->first('parent_msg'))
            <span style="margin-left:10px; color:red">* {{$errors->first('parent_msg')}}</span>
          @endif
          <div class="box-body">
            <table style="text-transform: capitalize;" id="listCategoryParent" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
          <th scope="col">Category Parent</th>
          <th scope="col">Category Root</th>
          <th scope="col">Edit</th>
          <th scope="col">Hapus</th>     
                </tr>
              </thead>
              <tbody>
              <?php $x=1;?>
              @foreach($categories_parent as $category)
          <tr>
          <td>{{$x}}</td>
          <td>{{$category->cpname}}</td>
          <td>{{$category->crname}}</td>
          <td><a href="{{URL::to('admin/category/editCategoryParent/'.$category->cpid)}}"><span class="glyphicon glyphicon-edit"></span></a></td>
          <td><a data-toggle="modal" data-target="#modalDelete" href="#" onclick="confirmation('category/doDeleteCategoryParent/<?php echo $category->cpid; ?>','{{$category->cpname}}');"><span class="glyphicon glyphicon-remove"></span></a></td>           
          </tr>
          <?php $x++;?>
        @endforeach
              </tbody>
            </table>
            <button style="float:right; margin-left:20px;" class="btn btn-success" id="addCategoryParent"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Tambah Category Parent</button>
          </div><!-- /.box-body -->
        </div>
      </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">List Category Child</h3>
          </div><!-- /.box-header -->
          @if($errors->first('child_msg'))
            <span style="margin-left:10px; color:red">* {{$errors->first('child_msg')}}</span>
          @endif
          <div class="box-body">
            <table style="text-transform: capitalize;" id="listCategoryChild" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
          <th scope="col">Category Child</th>
          <th scope="col">Category Parent</th>
          <th scope="col">Category Root</th>
          <th scope="col">Commision</th>
          <th scope="col">Edit</th>
          <th scope="col">Hapus</th>     
                </tr>
              </thead>
              <tbody>
              <?php $x=1;?>
              @foreach($categories_child as $category)
          <tr>
          <td>{{$x}}</td>
          <td>{{$category->ccname}}</td>
          <td>{{$category->cpname}}</td>
          <td>{{$category->crname}}</td>
          <td>{{$category->cccommision}} %</td>
          <td><a href="{{URL::to('admin/category/editCategoryChild/'.$category->ccid)}}"><span class="glyphicon glyphicon-edit"></span></a></td>
          <td><a data-toggle="modal" data-target="#modalDelete" href="#" onclick="confirmation('category/doDeleteCategoryChild/<?php echo $category->ccid; ?>','{{$category->ccname}}');"><span class="glyphicon glyphicon-remove"></span></a></td>           
          </tr>
          <?php $x++;?>
        @endforeach
              </tbody>
            </table>
            <button style="float:right; margin-left:20px;" class="btn btn-success" id="addCategoryChild"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Tambah Category Child</button>
          </div><!-- /.box-body -->
        </div>
      </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">List Category Grand Child</h3>
          </div><!-- /.box-header -->
          @if($errors->first('grand_child_msg'))
            <span style="margin-left:10px; color:red">* {{$errors->first('grand_child_msg')}}</span>
          @endif
          <div class="box-body">
            <table style="text-transform: capitalize;" id="listCategoryGrandChild" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th scope="col">#</th>
				  <th scope="col">Category Grand Child</th>
          <th scope="col">Category Child</th>
				  <th scope="col">Category Parent</th>
          <th scope="col">Category Root</th>
          <th scope="col">Commision</th>
				  <th scope="col">Edit</th>
				  <th scope="col">Hapus</th>     
                </tr>
              </thead>
              <tbody>
              <?php $x=1;?>
              @foreach($categories_grand_child as $category)
				  <tr>
					<td>{{$x}}</td>
          <td>{{$category->cgcname}}</td>
          <td>{{$category->ccname}}</td>
          <td>{{$category->cpname}}</td>
  				<td>{{$category->crname}}</td>
          <td>{{$category->cgccommision}} %</td>
          <td><a href="{{URL::to('admin/category/editCategoryGrandChild/'.$category->cgcid)}}"><span class="glyphicon glyphicon-edit"></span></a></td>
          <td><a data-toggle="modal" data-target="#modalDelete" href="#" onclick="confirmation('category/doDeleteCategoryGrandChild/<?php echo $category->cgcid; ?>','{{$category->cgcname}}');"><span class="glyphicon glyphicon-remove"></span></a></td>  					
				  </tr>
          <?php $x++;?>
				@endforeach
              </tbody>
            </table>
            <button style="float:right; margin-left:20px;" class="btn btn-success" id="addCategoryGrandChild"><i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Tambah Category Grand Child</button>
          </div><!-- /.box-body -->
        </div>
      </div><!-- /.col -->
    </div><!-- /.row -->
    <div class="row">
      <div class="col-xs-6 tambahCategoryRootWrap hide">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Tambah Category Root</h3>
            <button style="float:right" class="btn btn-danger" id="closeAddCategoryRoot"><i class="fa fa-close"></i></button>
          </div><!-- /.box-header -->
          <div class="box-body">
            <form role="form" action="{{URL::to('admin/category/doInsertCategoryRoot')}}" method="post">
                      <div class="form-group">
                          <label for="adminpwd">Category Name</label>
                          <input type="text" name="category" class="form-control" id="category" placeholder="Masukkan category baru" required/>
                      </div>
                      <div align="right">
                        <button type="submit" class="btn btn-default">Tambah</button>
                      </div>
                  </form>
          </div><!-- /.box-body -->
        </div>
      </div><!-- /.col -->
      <div class="col-xs-6 tambahCategoryParentWrap hide">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Tambah Category Parent</h3>
            <button style="float:right" class="btn btn-danger" id="closeAddCategoryParent"><i class="fa fa-close"></i></button>
          </div><!-- /.box-header -->
          <div class="box-body">
            <form role="form" action="{{URL::to('admin/category/doInsertCategoryParent')}}" method="post">
                      <div class="form-group">
                          <label for="adminid">Category Root</label>
                          <select style="text-transform: capitalize;" name="category_root" id="category_root" class="form-control" required>
                            <option value="0">Pilih Kategori</option>
                            @foreach($categories_root as $category)
                              <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="adminpwd">Category Name</label>
                          <input type="text" name="category" class="form-control" id="category" placeholder="Masukkan category baru" required/>
                      </div>
                      <div align="right">
                        <button type="submit" class="btn btn-default">Tambah</button>
                      </div>
                  </form>
          </div><!-- /.box-body -->
        </div>
      </div><!-- /.col -->
      <div class="col-xs-6 tambahCategoryChildWrap hide">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Tambah Category Child</h3>
            <button style="float:right" class="btn btn-danger" id="closeAddCategoryChild"><i class="fa fa-close"></i></button>
          </div><!-- /.box-header -->
          <div class="box-body">
            <form role="form" action="{{URL::to('admin/category/doInsertCategoryChild')}}" method="post">
                      <div class="form-group">
                          <label for="adminid">Category Root</label>
                          <select style="text-transform: capitalize;" name="category_root" id="addRootChild" class="form-control" required>
                            <option value="0">Pilih Kategori</option>
                            @foreach($categories_root as $category)
                              <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="adminid">Category Parent</label>
                          <select style="text-transform: capitalize;" name="category_parent" id="addParentChild" class="form-control" required>
                            <option value="0">Pilih Kategori</option>
                            
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="adminpwd">Category Name</label>
                          <input type="text" name="category" class="form-control" id="category" placeholder="Masukkan category baru" required/>
                      </div>
                      <div class="form-group">
                          <label for="adminpwd">Commision</label>
                          <input type="number" name="commision" class="form-control" id="commision" placeholder="Masukkan commision" value="0" min="0"/>
                      </div>
                      <div class="form-group">
                          <label for="adminpwd">Has Grand Child ? <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="Jika ya, maka category akan mempunyai sub category"></i></label>
                          <div>
                          <input type="checkbox" class="minimal" value="yes" name="hasgrandchild" id="hasGrandChild"> Yes
                          </div>
                      </div>
                      <div align="right">
                        <button type="submit" class="btn btn-default">Tambah</button>
                      </div>
                  </form>
          </div><!-- /.box-body -->
        </div>
      </div><!-- /.col -->
      <div class="col-xs-6 tambahCategoryGrandChildWrap hide">
        <div class="box box-success">
          <div class="box-header">
            <h3 class="box-title">Tambah Category Grand Child</h3>
            <button style="float:right" class="btn btn-danger" id="closeAddCategoryGrandChild"><i class="fa fa-close"></i></button>
          </div><!-- /.box-header -->
          <div class="box-body">
            <form role="form" action="{{URL::to('admin/category/doInsertCategoryGrandChild')}}" method="post">
                      <div class="form-group">
                          <label for="adminid">Category Root</label>
                          <select style="text-transform: capitalize;" name="category_root" id="addRootGrandChild" class="form-control" required>
                            <option value="0">Pilih Kategori</option>
                            @foreach($categories_root as $category)
                              <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="adminid">Category Parent</label>
                          <select style="text-transform: capitalize;" name="category_parent" id="addParentGrandChild" class="form-control" required>
                            <option value="0">Pilih Kategori</option>
                            
                          </select>
                      </div>
                       <div class="form-group">
                          <label for="adminid">Category Child</label>
                          <select style="text-transform: capitalize;" name="category_child" id="addChildGrandChild" class="form-control" required>
                            <option value="0">Pilih Kategori</option>
                            
                          </select>
                      </div>
                      <div class="form-group">
                          <label for="adminpwd">Category Name</label>
                          <input type="text" name="category" class="form-control" id="category" placeholder="Masukkan category baru" required/>
                      </div>
                      <div class="form-group">
                          <label for="adminpwd">Commision</label>
                          <input type="number" name="commision" class="form-control" id="commisionGrandChild" placeholder="Masukkan commision" value="0" min="0"/>
                      </div>
                      <div align="right">
                        <button type="submit" class="btn btn-default">Tambah</button>
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
          <h4 class="modal-title">Hapus Category?</h4>
        </div>
        <div class="modal-body">
          <p>Yakin ingin menghapus category <span id="userAdmin"></span>?</p>
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
  <!-- Select2 -->
  <script src="{{ asset('public/assets/merchant/plugins/select2/select2.full.min.js') }}"></script>
  <!-- iCheck 1.0.1 -->
  <script src="{{ asset('public/assets/merchant/plugins/iCheck/icheck.min.js') }}"></script>

<script type="text/javascript">
 $(function () {
      // Activate Sidebar Menu
      $("#menu_category").closest("li").addClass("active");
      $("#listCategoryRoot").DataTable({
       "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
           scrollX: true
      });

      $("#listCategoryParent").DataTable({
       "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
           scrollX: true
      });

      $("#listCategoryChild").DataTable({
       "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
           scrollX: true
      });

      $("#listCategoryGrandChild").DataTable({
       "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
           scrollX: true
      });

      $("#addCategoryRoot").click(function(){
        $('.tambahCategoryRootWrap').removeClass("hide");
      });
      $("#closeAddCategoryRoot").click(function(){
        $('.tambahCategoryRootWrap form')[0].reset();
        $('.tambahCategoryRootWrap').addClass("hide");
      });

      $("#addCategoryParent").click(function(){
        $('.tambahCategoryParentWrap').removeClass("hide");
      });
      $("#closeAddCategoryParent").click(function(){
        $('.tambahCategoryParentWrap form')[0].reset();
        $('.tambahCategoryParentWrap').addClass("hide");
      });

      $("#addCategoryChild").click(function(){
        $('.tambahCategoryChildWrap').removeClass("hide");
      });
      $("#closeAddCategoryChild").click(function(){
        $('.tambahCategoryChildWrap form')[0].reset();
        $('.tambahCategoryChildWrap').addClass("hide");
      });

      $("#addCategoryGrandChild").click(function(){
        $('.tambahCategoryGrandChildWrap').removeClass("hide");
      });
      $("#closeAddCategoryGrandChild").click(function(){
        $('.tambahCategoryGrandChildWrap form')[0].reset();
        $('.tambahCategoryGrandChildWrap').addClass("hide");
      });

      $("#hasGrandChild").click(function(){
        if(!$(this).is(":checked")){
          $("#commision").val("0");
          $("#commision").prop("readonly",false);
        }else{
          $("#commision").val("0");
          $("#commision").prop("readonly",true);
        }
      });

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
  function confirmation(link,name){
    $("#userAdmin").html(name);
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
      url: "category/getChild", 
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