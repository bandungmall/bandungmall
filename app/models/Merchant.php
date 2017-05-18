<?php
	class Merchant extends Eloquent{
		protected $table = 'merchant';
		protected $primaryKey = 'id';

		public function insertMerchant($name, $shop_name, $phone_number, $email, $company_name, $person_in_charge, $ic_number, $address, $province, $city, $district, $postal_code, $city_from, $account_number, $account_name, $account_bank){

			$activation_code = MerchantHelper::checkActivationCode();

			$merchant = new Merchant();
			$merchant->name = $name;
			$merchant->shop_name = $shop_name;
			$merchant->phone_number = $phone_number;
			$merchant->email = $email;
			$merchant->company_name = $company_name;
			$merchant->person_in_charge = $person_in_charge;
			$merchant->ic_number = $ic_number;
			$merchant->address = $address;
			$merchant->province = $province;
			$merchant->city = $city;
			$merchant->district = $district;
			$merchant->postal_code = $postal_code;
			$merchant->city_from = $city_from;
			$merchant->account_number = $account_number;
			$merchant->account_name = $account_name;
			$merchant->account_bank = $account_bank;
			//$merchant->activation_code = $activation_code;
			
			if($merchant->save()){
				//EmailHelper::sendActivationCodeMerchant($merchant);
			}
		}

		public function insertMerchantLogin($id, $password){

			$merchant = Merchant::find($id);
			$merchant->password = md5($password);
			$merchant->is_accepted = 'yes';
			$merchant->save();
		}

		public function checkLogin($email, $password){
			$rs = Merchant::where('email', '=', $email)->where('password', '=', $password)->where('is_accepted', '=', 'yes')->get();
			return $rs;
			// if(isset($rs[0])) return true;
			// return false;
		}
	}
?>