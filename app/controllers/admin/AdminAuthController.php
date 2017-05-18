<?php

class AdminAuthController extends BaseController {

	public function getIndexLogin(){
		return View::make('admin/login');
	}

	public function doLogin(){

		$username = Input::get('username');
		$password = md5(Input::get('password'));

		$admin = new Admin();

		if($admin->checkLogin($username, $password)){
			Session::put('admin', $username);
			return Redirect::to(URL::to('admin/home'))->with("message", "Welcome ". $username);
		}
		return Redirect::to(URL::to('admin/login'))->with("message", "Invalid Login");
	}

	public function doLogout(){
		Session::put('admin', NULL);
		return Redirect::to(URL::to('admin/login'));
	}

}
