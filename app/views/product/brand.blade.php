@extends('layout.frontend')

@section('isi')
  <div id="bordered">
	<div id="row">
	<div class="col-sm-6">
		<h3>Brand yang terdaftar di tokocerdas.com</h3>
	</div>
	<div class="col-sm-6" align="right">
	 	<form class="form-inline">
	       	<label>Filter:</label>
	       	<select class="form-control-static" id="sort">
	           	<option value="asc">A - Z</option>
	           	@if(Input::get('sort') =='desc')
	           		<option selected value="desc">Z - A</option>
	           	@else
	           		<option value="desc">Z - A</option>
	           	@endif
	       	</select>
	  	</form>
	</div>
	</div>
	<div class="row">
	<div class="col-sm-12 table-responsive">
	    <table class="table table-striped">
	        <tr>
	            <th scope="col">Brand</th>
	        </tr>
	        @foreach($brands as $brand)
		        <tr>
		            <td><a href="{{URL::to('product?brand='.$brand->brand)}}">{{$brand->brand}}</a></td>
		        </tr>
		@endforeach
	    </table>
	</div>
	</div>  
</div>
<script>
	$("#sort").change(function(){
	    //alert($("#sort").val());
	    location.replace("{{URL::to('brand?sort=')}}"+$("#sort").val());
	});
</script>
@stop