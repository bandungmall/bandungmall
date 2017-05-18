@extends('layout.frontend')

@section('isi')
	<div id="bordered" style="padding: 20px;">
		<h3>Troli Belanja</h3>
		<hr />
		    <div>
		    	
		    </div>
			<div class="row padded">
				<!--
		    	<div class="col-sm-8 col-xs-12">
		        	<div class="alert alert-info" align="center">Anda mendapatkan diskon sebesar 20%</div>
		        </div>
		    	
		        <div class="col-sm-4 col-xs-12" align="right">
		        	<input type="text" id="promocode" class="form-control-static" placeholder="Promo code" style="height:50px" />
		        	<button class="btn btn-default" type="submit" style="height:50px">Verify</button>
		        </div>
		        -->
		    </div>
		    <div class="row padded">
		    	
		        <div class="col-sm-6 col-xs-6">
		    		<a href="{{URL::to('product')}}"><button class="btn btn-link"><span class="glyphicon glyphicon-triangle-left"></span>Kembali belanja</button></a>
		    	</div>
		    	<div class="col-sm-6 col-xs-6" align="right">
		        	<a href="{{URL::to('checkout')}}"><button class="btn btn-primary" type="button" style="height:50px">Bayar</button></a>
		        </div>
		    
		    </div>
		</div>
	</div>
@stop