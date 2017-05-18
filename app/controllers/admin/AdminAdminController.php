<?php

class AdminAdminController extends BaseController {

	public function getIndex(){

		$data['error_code'] = Session::get('error_code');

		$data['admins'] = Admin::all();

		return View::make('admin/admin', $data);
	}

	public function doInsertAdmin(){

		$data_admin = new Admin();
		$data['admin'] = Admin::where('username', '=', Input::get('username'))->first();
		if(count($data['admin']) > 0){
			return Redirect::to('admin/admin')->with('error_code', "Username sudah ada");
		}
		if(!$data_admin->insertAdmin(Input::get('username'), Input::get('password'))){
			$data['error_code'] = "Username sudah di pakai";
		}

		return Redirect::to('admin/admin');
	}

	public function doDeleteAdmin(){

		$id = Input::get('id');

		if($id !=NULL){
			$data_admin = Admin::find($id);
			$data_admin->delete();
		}

		return Redirect::to('admin/admin');
	}
}
