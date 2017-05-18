<?php

class UserController extends BaseController {

	public function getIndexLogin(){
		$category_root = new CategoryRoot();
		$category_parent = new CategoryParent();
		$category_child = new CategoryChild();
		$category_grand_child = new CategoryGrandChild();
		$result['category_root'] = $category_root->getAll();
		$result['category_parent'] = $category_parent->getAll();
		$result['category_child'] = $category_child->getAll();
		$result['category_grand_child'] = $category_grand_child->getAll();

		if(Auth::check()) return Redirect::to('home');
		else return View::make('user/user_login', $result);
	}

	public function getIndexRegister(){
		$category_root = new CategoryRoot();
		$category_parent = new CategoryParent();
		$category_child = new CategoryChild();
		$category_grand_child = new CategoryGrandChild();
		$data['category_root'] = $category_root->getAll();
		$data['category_parent'] = $category_parent->getAll();
		$data['category_child'] = $category_child->getAll();
		$data['category_grand_child'] = $category_grand_child->getAll();

		$data['error_code'] = Session::get('error_code');
		Session::put('error_code', NULL);

		return View::make('user/user_register', $data);
	}

	public function doRegister(){
		$check_email = User::where('email', '=', Input::get('email'))->first();

		if($check_email !=NULL){
			return Redirect::to('user/register')->with('error_code', "Email has been taken");
		}
		//check ref email, if available, send 50k code
		$data_ref = User::where('id', '=', Input::get('referral_id'));

		$data_user = new User;
		$data_user->insertUser(Input::get('first_name'), Input::get('last_name'), Input::get('email'), Input::get('password'), Input::get('referral_id'));
		
		//$data['info_data'] = 'Activation code has been sent to your email, place proceed to your email to activate your account';

		$info_data['info_data'] = 'Kode untuk mengaktifasi akun anda telah di kirim ke email anda, silahkan untuk mengaktifkan melalui link yang di berikan';

		Session::put('info_data', $info_data['info_data']);

		return Redirect::to('/info');
	}

	public function activateAccount($activation_code){
		$user = User::where('activation_code', '=', $activation_code)->first();
		if($user ===NULL){
			//ke new page, 
			$info_data['info_data'] = 'Kode Aktifasi salah';

			Session::put('info_data', $info_data['info_data']);
			return Redirect::to('/info');
		}
		else{
			$user->activation_code = "";
			$user->save();

			//ke login page
			return Redirect::to('user/login');

			//manually login user
			//Auth::login($user);
			//return Redirect::to('home');
		}
	}

	public function doLogin(){
		$data_login = array('email' => Input::get('email'), 'password' => Input::get('password'));

		if($data_login['email'] != "" && $data_login['password'] != ""){
			if(Auth::attempt($data_login)){
				$data_user = User::where('email', '=', Input::get('email'))->first();
				if($data_user->activation_code ==""){
					Session::put('user_email', Input::get('email'));
					return Redirect::back();
				}
				else{
					Auth::logout();
					EmailHelper::sendActivationCode($data_user);
					
					//ke page, please activate your account, an activation code has been sent to your email, place proceed to your email to activate your account
					return Redirect::to('/info')->with('info_data', 'Sebuah link aktivasi akun telah terkirim ke email anda');
				}
			}
			else{
				$error_login = "Email or Password incorrect";
				return Redirect::to('/user/login')->with('error_login', $error_login);
			}
		}else{
				return Redirect::to('/user/login');
			}
	}

	public function doLogout(){
		Auth::logout();
		Session::flush();
		return Redirect::to('/');
	}

	public function getIndexForgotPassword(){

		$category_root = new CategoryRoot();
		$category_parent = new CategoryParent();
		$category_child = new CategoryChild();
		$category_grand_child = new CategoryGrandChild();
		$data['category_root'] = $category_root->getAll();
		$data['category_parent'] = $category_parent->getAll();
		$data['category_child'] = $category_child->getAll();
		$data['category_grand_child'] = $category_grand_child->getAll();

		
		$data['msg'] = Session::get('error_code');
	
		return View::make('user/forgot_password', $data);
	}

	public function generateForgotPasswordCode(){

		$data_user = User::where('email', '=', Input::get('email'))->first();
		if(empty($data_user)){
			$error_code = "Email tidak ada";
			return Redirect::to('user/forgotPassword')->with('error_code', $error_code);
		}

		$resetPasswordCode = UserHelper::newResetPasswordCode();
		$data_user = User::where('email', '=', Input::get('email'))->first();

		if(!($data_user ===NULL)){
			$data_user->reset_password_code = $resetPasswordCode;

			if($data_user->save()){
				//send confirmation email
				EmailHelper::sendResetCode($data_user);
			}
		}
		return Redirect::to('/info')->with('info_data', 'Sebuah link untuk reset password telah terkirim ke email anda');
	}

	public function resetPassword($reset_password_code){

		$data_user = User::where('reset_password_code', '=', $reset_password_code)->first();
		if($data_user ===NULL){
			return Redirect::to('/');
		}
		else{
			return View::make('user.reset_password')->with('auth_user_id', $data_user->id);
		}
	}

	public function doResetPassword(){
		$user_id = Input::get('auth_user_id');
		$user_data = User::where('id', '=', $user_id)->first();

		$user_data->password = Hash::make(Input::get('password'));
		$user_data->reset_password_code = "";
		$user_data->save();

		return Redirect::to('/user/login');

	}

	public function getIndexHome(){

		return View::make('user/home');
	}

	public function getIndexAccount(){
		$category_root = new CategoryRoot();
		$category_parent = new CategoryParent();
		$category_child = new CategoryChild();
		$category_grand_child = new CategoryGrandChild();
		$result['category_root'] = $category_root->getAll();
		$result['category_parent'] = $category_parent->getAll();
		$result['category_child'] = $category_child->getAll();
		$result['category_grand_child'] = $category_grand_child->getAll();

		return View::make('user/user_account',$result);
	}

	public function getAddress(){
		$data['user_address'] = UserAddress::where('user_id', '=', Auth::user()->id)->get();
		$data['areas'] = Area::all();

		$area_provinsi = new AreaProvinsi();
		$data['areas_provinsi'] = $area_provinsi->getAll();

		$category_root = new CategoryRoot();
		$category_parent = new CategoryParent();
		$category_child = new CategoryChild();
		$category_grand_child = new CategoryGrandChild();
		$data['category_root'] = $category_root->getAll();
		$data['category_parent'] = $category_parent->getAll();
		$data['category_child'] = $category_child->getAll();
		$data['category_grand_child'] = $category_grand_child->getAll();

		return View::make('user/user_address', $data);
	}

	public function setAddress($id){
		$id = $id;

		$data_all = UserAddress::where('user_id', '=', Auth::user()->id)->get();
		foreach($data_all as $dt){
			$data = UserAddress::where('id', '=', $dt['id'])->first();
			$data->is_selected = "no";
			$data->save();
		}

		$data = UserAddress::where('id', '=', $id)->first();
		$data->is_selected = "yes";
		$data->save();
		
		return Redirect::to('user/address');		
	}

	public function getKota(){
		$id = Input::get('id');
		
		$area_kota = new AreaKota();
		
		$data['areas_kota'] = $area_kota->getKota($id);

		return $data;
	}
	
	public function getBank(){
		$data['user_bank'] = UserBank::where('user_id', '=', Auth::user()->id)
							->join('bank','user_bank.bank_id','=','bank.id')
							->select('user_bank.*', 'bank.singkatan as nama_bank', 'bank.id as id_bank', 'user_bank.id as id_user_bank')
							->get();
		$data['banks'] = Bank::all();

		$category_root = new CategoryRoot();
		$category_parent = new CategoryParent();
		$category_child = new CategoryChild();
		$category_grand_child = new CategoryGrandChild();
		$data['category_root'] = $category_root->getAll();
		$data['category_parent'] = $category_parent->getAll();
		$data['category_child'] = $category_child->getAll();
		$data['category_grand_child'] = $category_grand_child->getAll();

		return View::make('user/user_bank', $data);
	}


	public function getThankYou(){
		return View::make('user.user_final_order');
	}

	public function getInfo(){

		$user = new User();

		$data['user'] = User::where('user.id', '=', Auth::user()->id)->first();
		$data['user_address'] = UserAddress::where('user_id', '=', Auth::user()->id)->get();
		//$mlm = new Mlm();
		//$data['upline'] = $mlm->getUpline($data['user']->id);
		$data['areas'] = Area::all();

		$category_root = new CategoryRoot();
		$category_parent = new CategoryParent();
		$category_child = new CategoryChild();
		$category_grand_child = new CategoryGrandChild();
		$data['category_root'] = $category_root->getAll();
		$data['category_parent'] = $category_parent->getAll();
		$data['category_child'] = $category_child->getAll();
		$data['category_grand_child'] = $category_grand_child->getAll();

		return View::make('user/user_info', $data);
	}
	
	public function getIndexHistory(){

		$user_id = Auth::User()->id;
		$transaction = new Transaction();
		$allData = Transaction::where('user_id', '=', $user_id)->get();
		$detail = array();
		foreach ($allData as $data){
			$transactionDetail = new TransactionDetail();

			array_push($detail,$transactionDetail->getDetail($data->id));
		}
		$data['details'] = $detail;

		$data['transactionsPaid'] = $transaction->getByIDPaid($user_id);
		$data['transactionsUnpaid'] = $transaction->getByID($user_id);

		$category_root = new CategoryRoot();
		$category_parent = new CategoryParent();
		$category_child = new CategoryChild();
		$category_grand_child = new CategoryGrandChild();
		$data['category_root'] = $category_root->getAll();
		$data['category_parent'] = $category_parent->getAll();
		$data['category_child'] = $category_child->getAll();
		$data['category_grand_child'] = $category_grand_child->getAll();

		return View::make('user/user_history',$data);
	}

	public function transactionPayment($id){
		
		$category_root = new CategoryRoot();
		$category_parent = new CategoryParent();
		$category_child = new CategoryChild();
		$category_grand_child = new CategoryGrandChild();
		$data['category_root'] = $category_root->getAll();
		$data['category_parent'] = $category_parent->getAll();
		$data['category_child'] = $category_child->getAll();
		$data['category_grand_child'] = $category_grand_child->getAll();

		$user_id = Auth::User()->id;
		$transaction = new Transaction();
		$data['info'] = Transaction::where('transaction.id', '=', $id)
								->leftJoin('transaction_detail','transaction.id','=','transaction_detail.transaction_id')
								->leftJoin('product','transaction_detail.product_id','=','product.id')
								->select('transaction.*','transaction_detail.*','product.*','product.id as pid')
								->first();

		return View::make('user/user_transaction_payment',$data);
	}

	public function doTransactionPayment()
	{

		$transaction_id = Input::get('transaction_id');
		$user_id = Auth::User()->id;
		
		$user_confirmation_payment = new UserConfirmationPayment();
		$user_confirmation_payment->transaction_id = $transaction_id;
		$user_confirmation_payment->user_id = $user_id;
		$user_confirmation_payment->image_link = 'link';
		$user_confirmation_payment->save();
		$user_confirmation_payment_id = $user_confirmation_payment->id;

		$payment = Transaction::find($transaction_id);
		$payment->paid = "pending";
		$payment->save();

		// $upload_image = new ProductImage();

		$images = Input::file('images');
		$has = false;
		foreach ($images as $idx => $image) {
			if (is_null($image)) continue;
			$image_link = UserHelper::savePicture($image, $user_confirmation_payment_id);
			// $upload_image->insertProductImage($product_id, $image_link);
			if (!$has) {
				$user_confirmation_payment->image_link = $image_link;
				$user_confirmation_payment->save();
				$has = true;
			}
		}

		//insert notification
		$transaction_notification = new TransactionNotification();
		$transaction_notification->insertData($transaction_id, 'User Melakukan Konfirmasi Pembayaran');

		return Redirect::to('/info')->with('info_data', 'Konfirmasi pembayaran sudah di terima, akan kami cek lagi');
	}

	public function doTransactionReceived()
	{
		$id = Input::get('transaction_id');
		
		$transaction = new Transaction();
		$transaction->userDoReceived( $id );

		$transaction_notification = new TransactionNotification();
		$transaction_notification->insertData($id, 'User Melakukan Konfirmasi Penerimaan Barang');

		return Redirect::to('user/transactionHistory');
	}
	
	public function getIndexOrder(){
	/*

		$data['transactions'] = Transaction::where('user_id', '=', Auth::User()->id)->get();
		$transaction_ids = Transaction::where('user_id', '=', Auth::User()->id)->lists('id');
		$data['transaction_details'] = TransactionDetail::whereIn('transaction_id', $transaction_ids)
										->leftJoin('product as p', 'p.id', '=', 'transaction_detail.product_id')
										->select('p.*', 'transaction_detail.*')
										->get();
*/
		$user_id = Auth::User()->id;
		$transaction = new Transaction();
		$data['transactions'] = $transaction->getByID($user_id);
		return View::make('user/user_order', $data);
	}
	
	public function getIndexOrderDetail(){
		$transaction_id = Input::get('id');
		
		$transaction_detail = new TransactionDetail();
		$data['merchants'] = $transaction_detail->getMerchantList($transaction_id);
		$data['detail_transactions'] = $transaction_detail->getDetailUser($transaction_id, Auth::User()->id);
		$data['user_confirmation_payment'] = UserConfirmationPayment::where('transaction_id', '=', $data['detail_transactions'][0]->transaction_id)
																	->where('user_id', '=', Auth::User()->id)
																	->first();
		$data['transaction_notifications'] = TransactionNotification::where('transaction_id', '=', $data['detail_transactions'][0]->transaction_id)->get();
		$data['transaction_detail_notifications'] = TransactionDetailNotification::where('transaction_id', '=', $data['detail_transactions'][0]->transaction_id)->get();

		$transaction = new Transaction();
		$data['resi_transactions'] = $transaction->getResiByID($transaction_id);
		
		//print_r($data['resi_transactions']);
		
		return View::make('user/user_order_detail', $data);
	}

	public function getIndexDownline(){

		$tier1 = Mlm::where('upline_id', '=', Auth::user()->id)->lists('downline_id');
		$tier2 = DB::table('mlm')->whereIn('upline_id', $tier1)->lists('downline_id');
		$tier3 = DB::table('mlm')->whereIn('upline_id', $tier2)->lists('downline_id');
		$tier4 = DB::table('mlm')->whereIn('upline_id', $tier3)->lists('downline_id');

		$data['tier1'] = $tier1;
		$data['tier2'] = $tier2;
		$data['tier3'] = $tier3;
		$data['tier4'] = $tier4;

		$data['mlm_levels'] = MlmLevel::all();

		//echo count($tier1).' '.count($tier2).' '.count($tier3).' '.count($tier4);

		return View::make('user/user_downline', $data);
	}

	public function doInsertPaymentConfirmation(){
		// $account_number = Input::get('account_number');
		// $account_name = Input::get('account_name');
		// $account_bank = Input::get('account_bank');
		// $amount = Input::get('amount');
		// $account_destination = Input::get('account_destination');
		// $transaction_id = Input::get('transaction_id');
		// $user_id = Auth::User()->id;
		
		// $user_confirmation_payment = new UserConfirmationPayment();
		// $user_confirmation_payment->account_number = $account_number;
		// $user_confirmation_payment->account_name = $account_name;
		// $user_confirmation_payment->account_bank = $account_bank;
		// $user_confirmation_payment->amount = $amount;
		// $user_confirmation_payment->account_destination = $account_destination;
		// $user_confirmation_payment->transaction_id = $transaction_id;
		// $user_confirmation_payment->user_id = $user_id;
		// $data_product->image_link = 'link';
		// $user_confirmation_payment->save();

		$transaction_id = Input::get('transaction_id');
		$user_id = Auth::User()->id;
		
		$user_confirmation_payment = new UserConfirmationPayment();
		$user_confirmation_payment->transaction_id = $transaction_id;
		$user_confirmation_payment->user_id = $user_id;
		$user_confirmation_payment->image_link = 'link';
		$user_confirmation_payment->save();
		$user_confirmation_payment_id = $user_confirmation_payment->id;

		$payment = Transaction::find($transaction_id);
		$payment->paid = "pending";
		$payment->save();

		// $upload_image = new ProductImage();

		$images = Input::file('images');
		$has = false;
		foreach ($images as $idx => $image) {
			if (is_null($image)) continue;
			$image_link = UserHelper::savePicture($image, $user_confirmation_payment_id);
			// $upload_image->insertProductImage($product_id, $image_link);
			if (!$has) {
				$user_confirmation_payment->image_link = $image_link;
				$user_confirmation_payment->save();
				$has = true;
			}
		}

		//insert notification
		$transaction_notification = new TransactionNotification();
		$transaction_notification->insertData($transaction_id, 'User Melakukan Konfirmasi Pembayaran');

		Session::forget('mycart'); 

		$info_data['info_data'] = 'Konfirmasi pembayaran sudah di terima, akan kami cek lagi';

		Session::put('info_data', $info_data['info_data']);
		
		return Redirect::to('info');
	}

	public function getIndexIncome(){

		return View::make('user/user_income');
	}

	public function getIndexCashout(){

		return View::make('user/user_cashout');
	}

	public function getIndexEditAddress(){

		$address_id = Input::get('address_id');

		$data['user_address'] = UserAddress::where('id', '=', $address_id)->first();
		$data['areas'] = Area::all();

		return View::make('user/user_edit_address', $data);
	}

	public function doAddAddress(){

		$user_id = Auth::user()->id;
		$name = Input::get('name');
		$district = Input::get('district');
		$city = Input::get('city');
		$address = Input::get('address');
		$postal_code = Input::get('postal_code');
		$phone_number = Input::get('phone_number');

		$user_address = new UserAddress();
		$user_address->insertAddress($user_id, $name, $district, $city, $address, $postal_code, $phone_number);

		return Redirect::to('user/address');		
	}

	public function doAddBank(){

		$user_id = Auth::user()->id;
		$bank_id = Input::get('bank_id');
		$nama_rek = Input::get('nama_rek');
		$nama_acc = Input::get('nama_acc');
		$no_rek = Input::get('no_rek');
		if($bank_id == 0){
			return Redirect::back()->withErrors(['Silahkan pilih nama bank']);
		}
		if(is_numeric($no_rek)){
			$cek = UserBank::where('bank_account', '=', $nama_acc)
							->where('user_bank.user_id', '=', $user_id)
							->first();
			if(count($cek) == 0){
				$user_bank = new UserBank();
				$user_bank->insertBank($user_id, $bank_id, $nama_rek, $nama_acc, $no_rek);

				return Redirect::to('user/bank');
			}else{
				return Redirect::back()->withErrors(['Nama Account sudah tersedia']);
			}
		}else{
			return Redirect::back()->withErrors(['Mohon isi no rekening dengan benar']);
		}
		
	}
	public function doEditInfo(){
		$fname = Input::get('InputName');
		$lname = Input::get('InputLastName');
		$email = Input::get('InputEmail');
		$id = Input::get('idUser');

		$result = new User();
		$result->editUser($fname, $lname, $email, $id);
		return Redirect::to('user/myAccount');
	}

	public function doEditAddress(){

		$address_id = Input::get('address_id');
		$name = Input::get('name');
		$district = Input::get('district');
		$city = Input::get('city');
		$address = Input::get('address');
		$postal_code = Input::get('postal_code');
		$phone_number = Input::get('phone_number');

		$user_address = new UserAddress();
		$user_address->editAddress($address_id, $name, $district, $city, $address, $postal_code, $phone_number);

		return Redirect::to('user/myAccount');
	}

	public function doEditBank(){
		$user_id = Auth::user()->id;
		$id = Input::get('id');
		$bank_id_ganti = Input::get('bank_id_ganti');
		if($bank_id_ganti == 0){
			$bank_id = Input::get('bank_id');
		}else{
			$bank_id = $bank_id_ganti;
		}
		$nama_rek = Input::get('nama_rek');
		$nama_acc = Input::get('nama_acc');
		$no_rek = Input::get('no_rek');

		if(is_numeric($no_rek)){
			$cek = UserBank::where('bank_account', '=', $nama_acc)
							->where('user_bank.user_id', '=', $user_id)
							->first();
			$user_bank = new UserBank();
			$user_bank->editBank($id, $user_id, $bank_id, $nama_rek, $nama_acc, $no_rek);

			return Redirect::to('user/bank');
		}else{
			return Redirect::back()->withErrors(['Mohon isi no rekening dengan benar']);
		}
	}

	public function deleteAddress(){

		$id = Input::get('address_id');
		$user = UserAddress::find($id);

		$user->delete();

		return Redirect::to('user/address');
	}


	public function deleteBank(){

		$id = Input::get('bank_id');
		$user = UserBank::find($id);

		$user->delete();

		return Redirect::to('user/bank');
	}
	public function doCashout(){

		$account_number = Input::get('account_number');
		$account_name = Input::get('account_name');
		$account_bank = Input::get('account_bank');

		$user_cashout = new UserCashout();
		$user_cashout->account_number = $account_number;
		$user_cashout->account_name = $account_name;
		$user_cashout->account_bank = $account_bank;
		$user_cashout->user_id = Auth::User()->id;
		$user_cashout->save();

		return Redirect::to('/info')->with('info_data', 'Your cashout has been submitted, we will send you an email regarding the details');
	}

	public function doUpdateReferral(){

		$user_id = Input::get('user_id');
		$referral_id = Input::get('referral_id');

		$user = User::find($user_id);
		$user->referral_id = $referral_id;
		$user->save();

	}
}