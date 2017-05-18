<?php
	class ProductSpec extends Eloquent{
		protected $table = 'product_spec';
		protected $primaryKey = 'id';

		public function insertProductSpec($product_id, $spec_name, $spec_detail){

			$data_product_spec = new ProductSpec();
			$data_product_spec->product_id = $product_id;
			$data_product_spec->spec_name = $spec_name;
			$data_product_spec->spec_detail = $spec_detail;
			return $data_product_spec->save();
		}

		public function deleteProductSpec($product_id){
			DB::table('product_spec')->where('product_id', '=', $product_id)->delete();
		}
	}
?>