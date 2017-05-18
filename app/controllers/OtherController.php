<?php

class OtherController extends BaseController {

	public function privacyPolicy(){

		return View::make('other/privacy_policy');
	}

	public function termOfUse(){

		return View::make('other/term_of_use');
	}

	public function help(){
		$category_root = new CategoryRoot();
		$category_parent = new CategoryParent();
		$category_child = new CategoryChild();
		$category_grand_child = new CategoryGrandChild();
		$data['category_root'] = $category_root->getAll();
		$data['category_parent'] = $category_parent->getAll();
		$data['category_child'] = $category_child->getAll();
		$data['category_grand_child'] = $category_grand_child->getAll();

		return View::make('user.help', $data);
	}

	public function about(){
		return View::make('other/about');
	}

	public function pagenotfound(){
		return View::make('other/404');
	}
}
