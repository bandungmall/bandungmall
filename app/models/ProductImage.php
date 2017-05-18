<?php
	class ProductImage extends Eloquent{
		protected $table = 'product_image';
		protected $primaryKey = 'id';

		public function insertProductImage($product_id, $image_link){

			$data_product_image = new ProductImage();
			$data_product_image->product_id = $product_id;
			$data_product_image->image_link = $image_link;
			return $data_product_image->save();
		}
	}
?>