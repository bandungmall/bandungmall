<?php

class AdminProductController extends BaseController {

	public function getIndex(){

		$product = new Product();
		$data['products'] = Product::leftJoin('category', 'product.category_id', '=', 'category.id')
							->leftJoin('merchant', 'product.merchant_id', '=', 'merchant.id')
							->select('category.name as category_name', 'merchant.email as merchant_email', 'product.*')
							->get();
		return View::make('admin/product', $data);
	}

	public function doDeleteProduct(){

		$product_id = Input::get('id');

		$data_product = Product::find($product_id);
		$data_product->delete();

		$data_product_image = ProductImage::where('product_id','=',$product_id)->get();
		$files = array();
		foreach ($data_product_image as $key => $value) {
			$files[] = $value['image_link'];
		}
		File::delete($files);

		$delete_product_image = ProductImage::where('product_id','=',$product_id);
		$delete_product_image->delete();

		return Redirect::to('admin/product');
	}
}
