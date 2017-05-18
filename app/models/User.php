<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user';
	protected $primaryKey = 'id';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	public function insertUser($first_name, $last_name, $email, $password, $referral_id){
		
		$activation_code = UserHelper::checkActivationCode();

		$data_user = new User;
		$data_user->first_name = $first_name;
		$data_user->last_name = $last_name;
		$data_user->email = $email;
		$data_user->password = Hash::make($password);
		$data_user->activation_code = $activation_code;
		$data_user->referral_id = $referral_id;
		
		if($data_user->save()){
			//send confirmation email
			EmailHelper::sendActivationCode($data_user);
		}

		//insert downline
		if($referral_id !=NULL){
			$data_mlm = new Mlm;
			$data_mlm->upline_id = $referral_id;
			$data_mlm->downline_id = $data_user->id;
			$data_mlm->save();
		}
	}

	public function editUser($first_name, $last_name, $email, $id){
		$data_user = User::find($id);
		$data_user->first_name = $first_name;
		$data_user->last_name = $last_name;
		$data_user->email = $email;

		$data_user->save();
	}

	public function addBalance($user_id, $balance){

		$data_user = User::find($user_id);
		$data_user->balance += $balance;
		$data_user->save();


	}

}
