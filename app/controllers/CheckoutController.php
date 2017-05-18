<?php

class CheckoutController extends BaseController {

	public function getIndex(){
		if(Auth::check()) {
			if(Session::has('mycart') && count(Session::get('mycart'))!=0){
				$product = new Product();

				$cartProductID =  array();
				$cart = Session::get('mycart'); 
				foreach ($cart as $id => $qty) {
					array_push($cartProductID,$id);
				}
				$result['cart_data'] = $product->getCartData($cartProductID);
				$result['cart']=$cart;
				if(Auth::check())
					$result['user_address'] = UserAddress::where('user_id', '=', Auth::user()->id)
												->where('is_selected','=','yes')
												->first();

				return View::make('user.user_cart',$result);
			}
			else{
				return Redirect::to('cart');
			}
		}
		else return View::make('user/user_login');
	}

	public function getAddress(){
		$name = Input::get('name');

		// $address = new UserAddress();
		$result = Area::where('area_name','=',$name)->get();

		return $result;
	}

	public function getCheckout(){
		$result['error_alamat'] = Session::get('error_alamat');
		$result['error_kurir'] = Session::get('error_kurir');
		$result['error_paket'] = Session::get('error_paket');

		$category_root = new CategoryRoot();
		$category_parent = new CategoryParent();
		$category_child = new CategoryChild();
		$category_grand_child = new CategoryGrandChild();
		$result['category_root'] = $category_root->getAll();
		$result['category_parent'] = $category_parent->getAll();
		$result['category_child'] = $category_child->getAll();
		$result['category_grand_child'] = $category_grand_child->getAll();

		$area_provinsi = new AreaProvinsi();
		$result['areas_provinsi'] = $area_provinsi->getAll();

		if(Auth::check()) {
			if(Session::has('mycart') && count(Session::get('mycart'))!=0){
				$product = new Product();

				$cartProductID =  array();
				$cart = Session::get('mycart');

				foreach ($cart as $id => $qty) {
					array_push($cartProductID,$id);
				}
				$result['cart_data'] = $product->getCartData($cartProductID);
				$result['cart']=$cart;
				if(Auth::check()){
					$result['user_address'] = UserAddress::where('user_id', '=', Auth::user()->id)
												->where('is_selected','=','yes')
												->first();
				}
				$result['areas'] = Area::all();

				return View::make('user.user_checkout', $result);
			}
			else{
				//$result['cart_data'] = json_encode ((object) null);
				//$result['cart']= array();
				//$result['areas'] = Area::all();
				//if(Auth::check()){
				//	$result['user_address'] = UserAddress::where('user_id', '=', Auth::user()->id)
				//								->where('is_selected','=','yes')
				//								->first();
				//}
				return Redirect::to('cart');
			}
		}
		else return View::make('user/user_login', $result);
	}
	
	public function checkCoupon(){
		$coupon_code = Input::get('coupon_code');

		$hasil = array();

		$hasil['data'] = Coupon::where('kode_coupon', '=', $coupon_code)->get();

		if(count($hasil['data']) > 0){
			$hasil['status'] = $hasil['data'][0]['status'];
			if($hasil['status'] == 'sudah_dipakai'){
				$hasil['message'] = '* Kupon sudah digunakan';
			}else{
				$hasil['message'] = '* Kupon tersedia';
			}
		}else{
			$hasil['message'] = '* Kupon tidak ada';
		}

		return $hasil;
	}

	public function setCoupon(){
		$coupon_code = Input::get('coupon_code');
		
		$coupon = new Coupon();
		// $coupon->editCoupon(NULL, $coupon_code, 'sudah_dipakai');

		$hasil = Coupon::where('kode_coupon', '=', $coupon_code)->get();

		return $hasil;
	}

	public function getIndexConfirmation(){

		return View::make('checkout/confirmation');
	}

	public function doCheckout(){
		
		$user_id = Auth::user()->id;
		$total = Input::get('transaction_total');
		$address_id = Input::get('address');
		$shipping_choice = Input::get('info_kurir');
		$shipping_type = Input::get('info_paket');
		$shipping_price = Input::get('shipping_price');			

		//echo($user_id.' '.$total.' '.$address_id.' '.$shipping_choice.' '.$shipping_type.' '.$shipping_price);

		// $transaction = new Transaction();
		// $transaction_id = $transaction->insertTransaction($user_id, $total, $address_id, $shipping_choice, $shipping_type, $shipping_price);

		$transaction_detail = new TransactionDetail();
		$product = new Product();

		$cartProductID =  array();
		$cart = Session::get('mycart'); 
		foreach ($cart as $id => $qty) {
			array_push($cartProductID,$id);
		}
		$cart_data = $product->getCartData($cartProductID);

		foreach($cart_data as $data){
            $harga = 0;
            if(!empty($data->discount)) $harga = $data->price - ($data->price*$data->discount)/100;
            else $harga = $data->price;
            $sub = $harga * $cart[$data->id];

            $transaction_detail->insertTransactionDetail($transaction_id, $data->id, $data->merchant_id, $harga, $cart[$data->id], $sub);
        }

        $this::addTransactionShippingFee($address_id, $shipping_choice, $cart_data, $shipping_type, $transaction_id);

		Session::forget('mycart'); 

		//insert notification
		$transaction_notification = new TransactionNotification();
		$transaction_notification->insertData($transaction_id, 'User Melakukan Checkout');

		$data['transaction'] = Transaction::where('id', '=', $transaction_id)->first();

		return View::make('checkout/confirmation', $data);
	}

	public function doCheckoutFinal(){
		
		$user_id = Auth::user()->id;
		$total = Input::get('transaction_total');
		$address_id = Input::get('address');
		$shipping_choice = Input::get('info_kurir');
		$shipping_type = Input::get('info_paket');
		$shipping_price = Input::get('shipping_price');
		$coupon_id = Input::get('coupon_id');
		$is_save = 	Input::get('temp_address_is_save');
		$name = Input::get('temp_address_name');			
		$provinsi = Input::get('temp_address_provinsi');
		$kota = Input::get('temp_address_kota');
		$alamat = Input::get('temp_address_alamat');
		$kode_pos = Input::get('temp_address_kode_pos');
		$nomer_hp = Input::get('temp_address_nomer_hp');

		if($coupon_id){
			$coupon = new Coupon();
			$coupon->editCoupon($coupon_id, NULL, 'sudah_dipakai');
		}

		$now = Date("Y-m-d h:i:s");

		// echo $shipping_choice;exit;

		if($address_id == "0"){
			return Redirect::to('checkout')->with('error_alamat', 'Alamat belum dipilih');
		}

		if($shipping_choice == ""){
			return Redirect::to('checkout')->with('error_kurir', 'Kurir belum dipilih');
		}

		if($shipping_type == ""){
			return Redirect::to('checkout')->with('error_paket', 'Paket belum dipilih');
		}

		//echo($user_id.' '.$total.' '.$address_id.' '.$shipping_choice.' '.$shipping_type.' '.$shipping_price);

		if($is_save == "yes"){
			$user_address = new UserAddress();
			$user_address->insertAddress($user_id, $name, $provinsi, $kota, $alamat, $kode_pos, $nomer_hp);

			$list_address = UserAddress::where('user_id','=',$user_id)->get();

			$address = UserAddress::where('user_id','=',$user_id)->orderBy('created_at','desc')->first();

			foreach ($list_address as $key) {
				$up_address = UserAddress::where('id','=',$key['id'])->first();
				$up_address->is_selected = "no";
				$up_address->save();
			}

			$address->is_selected = "yes";
			$address->save();
		}else if($is_save == "no_saved"){
			$user_address = new TransactionAddress();
			$user_address->insertAddress($user_id, $provinsi, $kota, $alamat, $kode_pos, $nomer_hp);

			$address = TransactionAddress::where('user_id','=',$user_id)->orderBy('created_at','desc')->first();
		}
		else{
			$address = UserAddress::where('user_id','=',$user_id)->where('is_selected','=','yes')->first();
		}

		$tomorrow = Date("Y-m-d h:i:s", strtotime(' +1 day'));
		$transaction = new Transaction();
		$transaction_id = $transaction->insertTransaction($user_id, $total, $address['id'], $shipping_choice, $shipping_type, $shipping_price, $coupon_id, $tomorrow, $is_save);

		
		$transaction_detail = new TransactionDetail();
		$product = new Product();

		$cartProductID =  array();
		$cart = Session::get('mycart'); 
		foreach ($cart as $id => $qty) {
			array_push($cartProductID,$id);
		}
		$cart_data = $product->getCartData($cartProductID);		

		foreach($cart_data as $data){
            $harga = 0;
            if(!empty($data->discount) && ( $data->discount_date_start >= date("Y-m-d") && $data->discount_date_end <= date("Y-m-d") && $data->discount > 0)) $harga = $data->price - ($data->price*$data->discount)/100;
            else $harga = $data->price;
            $sub = $harga * $cart[$data['id']]['quantity'];

            $data_product = Product::where('id', '=', $data['id'])->first();
            $data_product->quantity = $data_product->quantity - $cart[$data['id']]['quantity'];
            $data_product->save();

            $data_product = Product::where('id', '=', $data['id'])->first();
            if($data_product->quantity == 0){
            	$data_product->is_active = "no";
            	$data_product->save();
            }

            $transaction_detail->insertTransactionDetail($transaction_id, $data->id, $data->merchant_id, $harga, $cart[$data['id']]['quantity'], $cart[$data['id']]['size'], $cart[$data['id']]['color'], $sub);
        }

        // $this::addTransactionShippingFee($address_id, $shipping_choice, $cart_data, $shipping_type, $transaction_id);

        $transactionShippingFee = new TransactionShippingFee();
		$transactionShippingFee->insertData($transaction_id, $shipping_price);


		//insert notification
		$transaction_notification = new TransactionNotification();
		$transaction_notification->insertData($transaction_id, 'User Melakukan Checkout');
		$data['final_cart'] = $product->getCartData($cartProductID);
		$data['final_cart_data'] = $cart;
		$data['kurir'] = array(
				'kurir' => $shipping_choice,
				'paket' => $shipping_type,
				'harga' => $shipping_price
			);
		$data['transaction'] = Transaction::where('id', '=', $transaction_id)->first();

		
		$data['banks'] = UserBank::where('user_id', '=', $user_id)
							->join('bank','user_bank.bank_id','=','bank.id')
							->select('user_bank.*', 'bank.singkatan as nama_bank', 'bank.id as id_bank', 'user_bank.id as id_user_bank')
							->get();

		$data['batas_pembayaran'] = $tomorrow;

		Session::forget('mycart'); 
		Session::forget('cartQty'); 

		$category_root = new CategoryRoot();
		$category_parent = new CategoryParent();
		$category_child = new CategoryChild();
		$category_grand_child = new CategoryGrandChild();
		$data['category_root'] = $category_root->getAll();
		$data['category_parent'] = $category_parent->getAll();
		$data['category_child'] = $category_child->getAll();
		$data['category_grand_child'] = $category_grand_child->getAll();

		return View::make('user.user_final_order', $data);
	}
	
	public function getAccountBank(){
		$bank_id = Input::get('bank_id');

		$bank_account = UserBank::where('id', '=', $bank_id)->get();

		return $bank_account;
	}


	public function getCost(){

	    $address_id = Input::get('address_id');
	    $info_kurir = Input::get('info_kurir');
	    $cart_data = json_decode(Input::get('cart_data'));

	    // $addr_data = UserAddress::where('id', '=', $address_id)->first();
	    $dest_data = Area::find($address_id);


	    $cart = array();

	    foreach($cart_data as $data){
	    	if(!isset($cart[$data->merchant_id]))
	    		$cart[$data->merchant_id] = $data->weight;
	    	else
	    		$cart[$data->merchant_id] += $data->weight;
	    }

	    $array = array();
	    foreach($cart as $key=>$data){
	    	//echo $key.$data.", ";

	    	//ambil merchant
	    	$merchant_data = Merchant::where('id', '=', $key)->first();
	    	$departure_data = Area::where('area_name', '=', $merchant_data['city_from'])->first();

	    	$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "http://rajaongkir.com/api/starter/cost",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => "origin=".$departure_data['id']."&destination=".$dest_data['id']."&weight=".$data."&courier=".$info_kurir,
			  CURLOPT_HTTPHEADER => array(
				"content-type: application/x-www-form-urlencoded",
				"key: cc88e4b157992dc4841d7e622a90b208"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);
			array_push($array, json_decode($response, true));
			//$array = json_decode($response, true);
			//var_dump($array);
			curl_close($curl);
	    }

		//print_r($array);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			$shipment_data = array();
			foreach($array as $a){
				foreach($a['rajaongkir']['results'][0]['costs'] as $b){

					$shipment = array("service" => $b['service'], "cost" => $b['cost'][0]['value'], "etd" =>$b['cost'][0]['etd']);

					$flag = -1;

					foreach($shipment_data as $key=>$data){
						if($data['service'] ==$b['service']) $flag = $key;
					}
					
					if($flag ==-1)
						array_push($shipment_data, $shipment);
					else
						$shipment_data[$flag]['cost'] += $b['cost'][0]['value'];
				}
			}

			return Response::json(array(
		      'success' => true,
		      'content' => $shipment_data,
		    ));
		}
		
	}

	public static function addTransactionShippingFee($address_id, $info_kurir, $cart_data, $shipping_type, $transaction_id){ 

	    $addr_data = UserAddress::where('id', '=', $address_id)->first();
	    $dest_data = Area::where('area_name', '=', $addr_data['city'])->first();

	    $cart = array();

	    foreach($cart_data as $data){
	    	if(!isset($cart[$data->merchant_id]))
	    		$cart[$data->merchant_id] = $data->weight;
	    	else
	    		$cart[$data->merchant_id] += $data->weight;
	    }

	    $array = array();
	    $merchant_ids = array();
	    foreach($cart as $key=>$data){
	    	//echo $key.$data.", ";

	    	//tampung merchant id
	    	array_push($merchant_ids, $key);

	    	//ambil merchant
	    	$merchant_data = Merchant::where('id', '=', $key)->first();
	    	$departure_data = Area::where('area_name', '=', $merchant_data['city_from'])->first();

	    	$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "http://rajaongkir.com/api/starter/cost",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => "origin=".$departure_data['id']."&destination=".$dest_data['id']."&weight=".$data."&courier=".$info_kurir,
			  CURLOPT_HTTPHEADER => array(
				"content-type: application/x-www-form-urlencoded",
				"key: cc88e4b157992dc4841d7e622a90b208"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);
			array_push($array, json_decode($response, true));
			//$array = json_decode($response, true);
			//var_dump($array);
			curl_close($curl);
	    }

	   	//print_r($merchant_ids); 
		//print_r($array);

		//$temp = array();

		$i=0;

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			$shipment_data = array();
			foreach($array as $a){
				foreach($a['rajaongkir']['results'][0]['costs'] as $b){

					$shipment = array("service" => $b['service'], "cost" => $b['cost'][0]['value'], "etd" =>$b['cost'][0]['etd']);

					$flag = -1;

					foreach($shipment_data as $key=>$data){
						if($data['service'] ==$b['service']) $flag = $key;
					}
					
					if($flag ==-1)
						array_push($shipment_data, $shipment);
					else
						$shipment_data[$flag]['cost'] += $b['cost'][0]['value'];

					if($b['service'] =='OKE'){
						//array_push($temp, $merchant_ids[$i].' '.$b['cost'][0]['value']);
						$transactionShippingFee = new TransactionShippingFee();
						$transactionShippingFee->insertData($transaction_id, $merchant_ids[$i], $b['cost'][0]['value']);
					}
				}
				$i++;
			}

			//print_r($temp);

			return Response::json(array(
		      'success' => true,
		      'content' => $shipment_data,
		    ));
		}
		
	}

	public function setCost(){

	    $inputData = Input::get('formData');
		parse_str($inputData, $formFields);

	    $shipping_cost = $formFields[$formFields['shippingChoice']];

		return Response::json(array(
		      'success' => true,
		      'cost' => $shipping_cost
		    ));

	}

}
