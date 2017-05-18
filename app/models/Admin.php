<?php
	class Admin extends Eloquent{
		protected $table = 'admin';
		protected $primaryKey = 'id';


		public function insertAdmin($username, $password){

			$temp = Admin::where('username', '=', $username)->first();
			if($temp !==NULL) return false;

			$data_admin = new Admin();
			$data_admin->username = $username;
			$data_admin->password = md5($password);
			return $data_admin->save();
		}

		public function checkLogin($username, $password){
			$rs = Admin::where('username', '=', $username)->where('password', '=', $password)->get();
			if(isset($rs[0])) return true;
			return false;
		}

	}
?>