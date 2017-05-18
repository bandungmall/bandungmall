<?php

class AdminHelper extends BaseController {

	public static function checkLogin(){

		if(!Session::has("admin")) return false;

		else return true;
	}
}
