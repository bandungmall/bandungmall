<?php

class EmailHelper extends BaseController {

	public static function sendActivationCodeMerchant($data_merchant){
		
		Mail::send('emails.auth.merchant_activation_code', 
			array(
				'link' => URL::route('merchant-account-activation', $data_merchant->activation_code)
			),
			function($message) use ($data_merchant){
				$message->to($data_merchant->email, $data_merchant->shop_name)->subject('Welcome to BandungMall - Merchant account activation‏');
			}
		);
	}

	public static function sendActivationCode($data_user){
		
		Mail::send('emails.auth.account_activation_code', 
			array(
				'link' => URL::route('account-activation', $data_user->activation_code),
				'firstName' => $data_user->first_name,
				'email' => $data_user->email,
			),
			function($message) use ($data_user){
				$message->to($data_user->email, $data_user->first_name)->subject('Welcome to BandungMall - User account activation‏');
			}
		);	
	}

	public static function sendResetCode($data_user){
		Mail::send('emails.auth.reset_password_code', 
			array(
				'link' => URL::route('reset-password', $data_user->reset_password_code),
				'firstName' => $data_user->first_name,
				'email' => $data_user->email,
			),
			function($message) use ($data_user){
				$message->to($data_user->email, $data_user->first_name)->subject('BandungMall - User Account Reset Password');
			}
		);	
	}

	public static function sendResetCodeMerchant($data_merchant){
		Mail::send('emails.auth.reset_password_code', 
			array(
				'link' => URL::route('reset-password-merchant', $data_merchant->reset_password_code),
				'firstName' => $data_merchant->shop_name,
				'email' => $data_merchant->email,
			),
			function($message) use ($data_merchant){
				$message->to($data_merchant->email, $data_merchant->shop_name)->subject('BandungMall - Merchant Account Reset Password');
			}
		);	
	}
	
	public static function sendConfirmationToMerchant($data_merchant, $data_transaction_detail, $address){
		Mail::send('emails.merchant.merchant_confirmation', 
			array(
				//'link' => URL::route('reset-password', $data_user->reset_password_code),
				//'firstName' => $data_user->first_name,
				'email' => $data_merchant->email,
				'transaction_details' => $data_transaction_detail,
				'address' => $address,
			),
			function($message) use ($data_merchant){
				$message->to($data_merchant->email)->subject('BandungMall - User Payment Confirmation');
			}
		);	
	}

}