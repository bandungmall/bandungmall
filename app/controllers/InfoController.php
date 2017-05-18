<?php

class InfoController extends BaseController {

	public function getIndex(){

		$info_data['info_data'] = Session::get('info_data');

		$category_root = new CategoryRoot();
		$category_parent = new CategoryParent();
		$category_child = new CategoryChild();
		$category_grand_child = new CategoryGrandChild();
		$info_data['category_root'] = $category_root->getAll();
		$info_data['category_parent'] = $category_parent->getAll();
		$info_data['category_child'] = $category_child->getAll();
		$info_data['category_grand_child'] = $category_grand_child->getAll();

		if($info_data ==NULL){
			return Redirect::to('/');
		}
		else{
			Session::put('info_data', NULL);

			return View::make('user/info', $info_data);
		}
	}

	public function getInfo(){

		$info_data['info_data'] = Session::get('info_data');

		$category_root = new CategoryRoot();
		$category_parent = new CategoryParent();
		$category_child = new CategoryChild();
		$category_grand_child = new CategoryGrandChild();
		$info_data['category_root'] = $category_root->getAll();
		$info_data['category_parent'] = $category_parent->getAll();
		$info_data['category_child'] = $category_child->getAll();
		$info_data['category_grand_child'] = $category_grand_child->getAll();

		if($info_data ===NULL){
			return Redirect::to('/');
		}
		else{
			Session::put('info_data', NULL);

			return View::make('user.info', $info_data);
		}
	}
}
