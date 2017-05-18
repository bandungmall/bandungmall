<?php

class AdminContentController extends BaseController {

	public function getIndexBanner() {
		$data['banners'] = Banner::all();
		return View::make('admin/banner', $data);
	}

	public function doDeleteBanner() {
		$id = Input::get('id');
		Banner::destroy($id);

		return Redirect::to('admin/banner');
	}

	public function doAddBanner() {
		$banner = new Banner();
		$banner->image_url = ".";
		$banner->target_url = Input::get('target_url');
		$banner->save();

		$banner_image = Input::file('image');
		$banner->image_url = $this->saveFile($banner_image, 'public/images/banner', $banner->id . '.' . $banner_image->getClientOriginalExtension());
		$banner->save();

		return Redirect::to('admin/banner');
	}

	public function doUpdateBanner() {
		$banner = Banner::find(Input::get('id'));
		if ($banner === NULL) {
			return Redirect::to('admin/banner');
		}
		$banner->target_url = Input::get('target_url');
		$banner->save();

		if (Input::hasFile('image')) {
			$banner_image = Input::file('image');
			$banner->image_url = $this->saveFile($banner_image, 'public/images/banner', $banner->id . '.' . $banner_image->getClientOriginalExtension());
			$banner->save();
		}

		return Redirect::to('admin/banner');
	}

	public function getIndexBrand() {
		$data['brands'] = Brand::all();
		return View::make('admin/brands', $data);
	}

	public function doDeleteBrand() {
		$id = Input::get('id');
		Brand::destroy($id);

		return Redirect::to('admin/brands');
	}

	public function doAddBrand() {
		$brand = new Brand();
		$brand->image_url = ".";
		$brand->target_url = Input::get('target_url');
		$brand->name = Input::get('name');
		$brand->save();

		$brand_image = Input::file('image');
		$brand->image_url = $this->saveFile($brand_image, 'public/images/brands', $brand->id . '.' . $brand_image->getClientOriginalExtension());
		$brand->save();

		return Redirect::to('admin/brands');
	}

	public function doUpdateBrand() {
		$brand = Brand::find(Input::get('id'));
		if ($brand === NULL) {
			return Redirect::to('admin/brands');
		}
		$brand->target_url = Input::get('target_url');
		$brand->name = Input::get('name');
		$brand->save();

		if (Input::hasFile('image')) {
			$brand_image = Input::file('image');
			$brand->image_url = $this->saveFile($brand_image, 'public/images/brands', $brand->id . '.' . $brand_image->getClientOriginalExtension());
			$brand->save();
		}

		return Redirect::to('admin/brands');
	}

	public function getIndexPromotion() {
		$data['promotions'] = Promotion::all();
		return View::make('admin/promotions', $data);
	}

	public function doDeletePromotion() {
		$id = Input::get('id');
		Promotion::destroy($id);

		return Redirect::to('admin/promotions');
	}

	public function doUpdatePromotion() {
		$promotion = Promotion::find(Input::get('id'));
		$con_dimensi = false;

		if ($promotion === NULL) {
			return Redirect::to('admin/promotions');
		}

		$promotion->target_url = Input::get('target_url');
		$promotion->save();	

		if (Input::hasFile('image')) {
			list($width, $height) = getimagesize(Input::file('image'));

			if($promotion['id'] != 2){
				if($width != 750 && $height != 500){
					$arr = array('width'=>750,'height'=>500);
					$con_dimensi = false;
				}else{
					$con_dimensi = true;
				}
			}
			else{
				if($width != 338 && $height != 507){
					$arr = array('width'=>338,'height'=>507);
					$con_dimensi = false;
				}else{
					$con_dimensi = true;
				}
			}

			if($con_dimensi){			
				$promotion_image = Input::file('image');
				$promotion->image_url = $this->saveFile($promotion_image, 'public/images/promotions', $promotion->id . '.' . $promotion_image->getClientOriginalExtension());
				$promotion->save();
			}else{
				$msg = 'dimensi tidak sesuai, dimensi harus (width:'.$arr['width'].', height:'.$arr['height'].')';
				return Redirect::back()->withErrors($msg);
			}
		}

		return Redirect::to('admin/promotions');
	}

	private static function saveFile($file, $directory, $filename) {
		$file->move($directory, $filename);
		return $directory . '/' . $filename;
	}
}
