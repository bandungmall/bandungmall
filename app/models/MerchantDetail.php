<?php
	class MerchantDetail extends Eloquent{
		protected $table = 'merchant_detail';
		protected $primaryKey = 'id';

		public function insertMerchantLogin($name, $shop_name, $phone_number, $email, $company_name, $person_in_charge, $ic_number, $address, $province, $city, $district, $postal_code, $city_from, $account_number, $account_name, $account_bank){

			$merchant_detail = new MerchantDetail();
			$merchant_detail->name = $name;
			$merchant_detail->shop_name = $shop_name;
			$merchant_detail->phone_number = $phone_number;
			$merchant_detail->email = $email;
			$merchant_detail->company_name = $company_name;
			$merchant_detail->person_in_charge = $person_in_charge;
			$merchant_detail->ic_number = $ic_number;
			$merchant_detail->address = $address;
			$merchant_detail->province = $province;
			$merchant_detail->city = $city;
			$merchant_detail->district = $district;
			$merchant_detail->postal_code = $postal_code;
			$merchant_detail->city_from = $city_from;
			$merchant_detail->account_number = $account_number;
			$merchant_detail->account_name = $account_name;
			$merchant_detail->account_bank = $account_bank;
			$merchant_detail->save();
		}
	}
?>