<?php

class MerchantHelper extends BaseController {

	public static function checkLogin(){
		if(!Session::has("merchant_email")) return false;
		else return true;
	}

	public static function savePicture($picture, $product_id){

		$date_time = new \DateTime( 'now',  new \DateTimeZone( 'Asia/Jakarta' ) );

		$merchant = Merchant::where('email', '=', Session::get('merchant_email'))->first();

		//$fileName = $merchant->id.'#'.Input::get('name').'#'.date_format($date_time,"Y/m/d H:i:s");
		$fileName = date_format($date_time, 'YmdHis').'_'.$merchant->id.'_'.$product_id.'_'.$picture->getClientOriginalName();
		 // Image::make($image->getRealPath())->resize(468, 249)->save('images/'. $filename); 
		// Image::make($picture->getRealPath())->resize(324, 512)->save("public/images/merchant_product/" . $fileName);
		$picture->move("public/images/merchant_product/", $fileName);
		$link = "public/images/merchant_product/".$fileName;

		return $link;
	}

	public static function checkActivationCode(){
		
		$activation_code = '';
		
		while(true){
			$activation_code = str_random(30);
			$check_code = Merchant::where('activation_code', '=', $activation_code)->first();
			if($check_code ===NULL){
				break;
			}
		}
		return $activation_code;;
	}

}
