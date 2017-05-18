<?php

class AdminMerchantController extends BaseController {

	public function getIndex(){

		$data['merchants'] = Merchant::where('is_accepted', '=', 'yes')->get();

		return View::make('admin/merchant', $data);
	}

	public function getIndexEditMerchant(){

		$merchant_id = Input::get('id');
		$data['merchant'] = Merchant::where('id', '=', $merchant_id)->first();

		return View::make('admin/merchant_detail', $data);
	}

	public function getIndexEditMerchantLogin(){

		$merchant_id = Input::get('id');
		$data['merchant'] = Merchant::where('id', '=', $merchant_id)->first();

		$data['merchant_details'] = MerchantDetail::where('is_accepted', '=', 'yes')->get();

		return View::make('admin/merchant_edit', $data);
	}

	public function doEditMerchantLogin(){

		$merchant_detail_id = Input::get('merchant_detail_id');
		$merchant_detail = MerchantDetail::find($merchant_detail_id);
		$merchant_detail->merchant_id = Input::get('merchant_id');
		$merchant_detail->save();

		return Redirect::to('admin/merchant');

	}

	public function getIndexRegistration(){
		$data['merchants'] = Merchant::where('is_accepted', '=', 'pending')->get();

		return View::make('admin/merchant_registration', $data);
	}

	public function insertMerchantLogin(){
		return View::make('admin/insert_merchant_login');
	}

	public function doAcceptMerchantRegistration(){

		$merchant_id = Input::get('id');

		$data['merchant'] = Merchant::where('id', '=', $merchant_id)->first();

		return View::make('admin/insert_merchant_login', $data);
	}

	public function doDeclineMerchantRegistration(){

		$merchant_id = Input::get('id');
		
		Merchant::destroy($merchant_id);

		//$data_merchant = Merchant::find($merchant_id);
		//$data_merchant->is_accepted = 'declined';
		//$data_merchant->save();

		return Redirect::to('admin/merchant/registration');
	}

	public function doInsertMerchantLogin(){

		$data = array();

		$data_merchant = new Merchant();
		$data_merchant->insertMerchantLogin(Input::get('merchant_id'), Input::get('password'));

		return Redirect::to('admin/merchant');
	}

	public function doDeleteMerchant(){

		$merchant_id = Input::get('id');

		$data_merchant = Merchant::find($merchant_id);
		$data_merchant->delete();

		return Redirect::to('admin/merchant');
	}
	
	public function doInformMerchant(){
		
		$merchant_id = Input::get('merchant_id');
		$transaction_id = Input::get('transaction_id');
		$transaction_detail = new TransactionDetail();
		
		$merchant = Merchant::where('id', '=', $merchant_id)->first();
		$transaction_details = $transaction_detail->getDetail($transaction_id);
		$transaction = Transaction::find($transaction_id);
		$transaction->paid = 'yes';
		$transaction->save();
		
		$address = UserAddress::where('id', '=', $transaction->address_id)->first();
		
		//insert notification
		$transaction_notification = new TransactionNotification();
		$transaction_notification->insertData($transaction_id, 'Admin menkonfirmasi pembayaran telah di terima');
		
		EmailHelper::sendConfirmationToMerchant($merchant, $transaction_details, $address);
		
		return Redirect::to('admin/user/transaction');
	}
	

	public function doUpdatePassword() {
		$merchant_id = Input::get('merchant_id');
		$merchant = Merchant::find($merchant_id);

		$new_password = Input::get('new_password');
		if ($new_password !== Input::get('new_password_confirmation')) {
			return Redirect::to('admin/merchant/editMerchant?id=' . $merchant_id)->with('error', 'Konfirmasi password tidak cocok!');
		}

		$merchant->password = md5($new_password);
		$merchant->save();
		return Redirect::to('admin/merchant/editMerchant?id=' . $merchant_id)->with('message', 'Password berhasil diubah!');
	}

	public function doUpdateGeneralInformation() {
		$merchant_id = Input::get('merchant_id');
		$merchant = Merchant::find($merchant_id);

		$data['merchant'] = Merchant::where('id', '!=', $merchant_id)
									->where('email','=', Input::get('email'))
									->first();
		if(count($data['merchant']) > 0){
			return Redirect::to('admin/merchant/editMerchant?id=' . $merchant_id)->with('error', 'Email sudah terdaftar!');
		}

		$merchant->name = Input::get('name');
		$merchant->shop_name = Input::get('shop_name');
		$merchant->company_name = Input::get('company_name');
		$merchant->phone_number = Input::get('phone_number');
		$merchant->email = Input::get('email');
		$merchant->person_in_charge = Input::get('person_in_charge');
		$merchant->ic_number = Input::get('ic_number');

		$merchant->save();
		return Redirect::to('admin/merchant/editMerchant?id=' . $merchant_id)->with('message', 'Informasi umum berhasil diubah!');
	}
	
	public function doUpdatePaymentInformation() {
		$merchant_id = Input::get('merchant_id');
		$merchant = Merchant::find($merchant_id);

		$merchant->account_number = Input::get('account_number');
		$merchant->account_name = Input::get('account_name');
		$merchant->account_bank = Input::get('account_bank');

		$merchant->save();
		return Redirect::to('admin/merchant/editMerchant?id=' . $merchant_id)->with('message', 'Informasi rekening berhasil diubah!');
	}

	public function doUpdateAddressInformation() {
		$merchant_id = Input::get('merchant_id');
		$merchant = Merchant::find($merchant_id);

		$merchant->address = Input::get('address');
		$merchant->province = Input::get('province');
		$merchant->city = Input::get('city');
		$merchant->district = Input::get('district');
		$merchant->postal_code = Input::get('postal_code');

		$merchant->save();
		return Redirect::to('admin/merchant/editMerchant?id=' . $merchant_id)->with('message', 'Informasi alamat berhasil diubah!');
	}



}