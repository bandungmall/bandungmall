<?php
	class Transaction extends Eloquent{
		protected $table = 'transaction';
		protected $primaryKey = 'id';

		public function insertTransaction($user_id, $total, $address_id, $shipping_choice, $shipping_type, $shipping_price,$coupon_id, $batas_pembayaran, $is_save){
			$data_transaction = new Transaction();
			$data_transaction->user_id = $user_id;
			$data_transaction->total = $total;
			if($is_save == "yes"){
				$data_transaction->user_address = $address_id;
			}else if($is_save == "no"){
				$data_transaction->user_address = $address_id;
			}else if($is_save == "no_saved"){
				$data_transaction->user_address_temp = $address_id;
			}
			$data_transaction->shipping_choice = $shipping_choice;
			$data_transaction->shipping_type = $shipping_type;
			$data_transaction->shipping_price = $shipping_price;
			$data_transaction->coupon_id = $coupon_id;
			$data_transaction->batas_pembayaran = $batas_pembayaran;
			$data_transaction->save();

			return $data_transaction->id;
		}
		
		public function userDoPayment( $transaction_id )
		{
			$data = Transaction::find($transaction_id);
			$data->paid = "pending";
			$data->save();
		}

		public function userDoReceived( $transaction_id )
		{
			$data = Transaction::find($transaction_id);
			$data->received_status = "yes";
			$data->save();
		}
		
		public function merchantDoSent($transaction_id){
			
			$data = Transaction::find($transaction_id);
			$data->sent_status = "yes";
			$data->save();
		}
		
		public function getAll(){
			
			$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
								->select(
									'transaction.*',
									'user.first_name as first_name',
									'user.last_name as last_name'
								)
								->orderBy('transaction.created_at','desc')
								->get();
			return $rs;
			
		}

		/*
		public function getAllUnPaid(){
			$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
				->where('transaction.paid', '=', 'no')
				->select('user.*', 'transaction.*')
				->orderBy('transaction.paid', 'desc')
				->orderBy('transaction.id', 'desc')
				->get();
			return $rs;
		}*/
		
		public function getAllUnPaid($start_date=NULL, $end_date=NULL){

			if($start_date != NULL && $end_date != NULL){
				$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
													->leftjoin('transaction_detail','transaction_detail.transaction_id','=','transaction.id')
													->where('transaction.paid', '=', 'no')
													->whereBetween('transaction.created_at', array($start_date, $end_date))
													->select(
														'transaction.*',
														'transaction_detail.id as td_id',
														'user.first_name as first_name',
														'user.last_name as last_name'
														)
													->orderBy('transaction.created_at','desc')
													->get();
			}
			else{
				$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
													->leftjoin('transaction_detail','transaction_detail.transaction_id','=','transaction.id')
													->where('transaction.paid', '=', 'no')
													->select(
														'transaction.*',
														'transaction_detail.id as td_id',
														'user.first_name as first_name',
														'user.last_name as last_name'
														)
													->orderBy('transaction.created_at','desc')
													->get();
			}
			return $rs;
		}

		public function getAllReject($start_date=NULL, $end_date=NULL){

			if($start_date != NULL && $end_date != NULL){
				$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
													->leftjoin('transaction_detail','transaction_detail.transaction_id','=','transaction.id')
													->where('transaction.paid', '=', 'reject')
													->whereBetween('transaction.created_at', array($start_date, $end_date))
													->select(
														'transaction.*',
														'transaction_detail.id as td_id',
														'user.first_name as first_name',
														'user.last_name as last_name'
														)
													->orderBy('transaction.created_at','desc')
													->get();
			}
			else{
				$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
													->leftjoin('transaction_detail','transaction_detail.transaction_id','=','transaction.id')
													->where('transaction.paid', '=', 'reject')
													->select(
														'transaction.*',
														'transaction_detail.id as td_id',
														'user.first_name as first_name',
														'user.last_name as last_name'
														)
													->orderBy('transaction.created_at','desc')
													->get();
			}
			return $rs;
		}

		public function getAllPending($start_date=NULL, $end_date=NULL){

			if($start_date != NULL && $end_date != NULL){
				$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
													->leftjoin('transaction_detail','transaction_detail.transaction_id','=','transaction.id')
													->where('transaction.paid', '=', 'pending')
													->whereBetween('transaction.created_at', array($start_date, $end_date))
													->select(
														'transaction.*',
														'transaction_detail.id as td_id',
														'user.first_name as first_name',
														'user.last_name as last_name'
														)
													->orderBy('transaction.created_at','desc')
													->get();
			}
			else{
				$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
													->leftjoin('transaction_detail','transaction_detail.transaction_id','=','transaction.id')
													->where('transaction.paid', '=', 'pending')
													->select(
														'transaction.*',
														'transaction_detail.id as td_id',
														'user.first_name as first_name',
														'user.last_name as last_name'
														)
													->orderBy('transaction.created_at','desc')
													->get();
			}
			return $rs;
		}
		
		public function getAllPaid($start_date=NULL, $end_date=NULL){

			if($start_date != NULL && $end_date != NULL){
				$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
													->leftjoin('transaction_detail','transaction_detail.transaction_id','=','transaction.id')
													->where('transaction.paid', '=', 'yes')
													->whereBetween('transaction.created_at', array($start_date, $end_date))
													->select(
														'transaction.*',
														'transaction_detail.id as td_id',
														'transaction_detail.is_accepted as td_is_accepted',
														'user.first_name as first_name',
														'user.last_name as last_name'
														)
													->orderBy('transaction.created_at','desc')
													->get();
			}
			else{
				$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
													->leftJoin('transaction_detail','transaction_detail.transaction_id','=','transaction.id')
													->where('transaction.paid', '=', 'yes')
													->select(
														'transaction.*',
														'transaction_detail.id as td_id',
														'transaction_detail.is_accepted as td_is_accepted',
														'user.first_name as first_name',
														'user.last_name as last_name'
														)
													->orderBy('transaction.created_at','desc')
													->get();
			}
			return $rs;
		}
		
		public function getAllSent($start_date=NULL, $end_date=NULL){

			if($start_date != NULL && $end_date != NULL){
				$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
													->leftjoin('transaction_detail','transaction_detail.transaction_id','=','transaction.id')
													->where('transaction.sent_status', '=', 'yes')
													->whereBetween('transaction.created_at', array($start_date, $end_date))
													->select(
														'transaction.*',
														'transaction_detail.id as td_id',
														'transaction_detail.is_counted as td_is_counted',
														'user.first_name as first_name',
														'user.last_name as last_name'
														)
													->orderBy('transaction.created_at','desc')
													->get();
			}
			else{
				$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
													->leftjoin('transaction_detail','transaction_detail.transaction_id','=','transaction.id')
													->where('transaction.sent_status', '=', 'yes')
													->select(
														'transaction.*',
														'transaction_detail.id as td_id',
														'transaction_detail.is_counted as td_is_counted',
														'user.first_name as first_name',
														'user.last_name as last_name'
														)
													->orderBy('transaction.created_at','desc')
													->get();
			}
			return $rs;
		}

		public function getAllSentDeclined($start_date=NULL, $end_date=NULL){

			if($start_date != NULL && $end_date != NULL){
				$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
													->leftjoin('transaction_detail','transaction_detail.transaction_id','=','transaction.id')
													->where('transaction.sent_status', '=', 'declined')
													->whereBetween('transaction.created_at', array($start_date, $end_date))
													->select(
														'transaction.*',
														'transaction_detail.id as td_id',
														'transaction_detail.is_accepted as td_is_accepted',
														'transaction_detail.is_counted as td_is_counted',
														'user.first_name as first_name',
														'user.last_name as last_name'
														)
													->orderBy('transaction.created_at','desc')
													->get();
			}
			else{
				$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
													->leftjoin('transaction_detail','transaction_detail.transaction_id','=','transaction.id')
													->where('transaction.sent_status', '=', 'declined')
													->select(
														'transaction.*',
														'transaction_detail.id as td_id',
														'transaction_detail.is_accepted as td_is_accepted',
														'transaction_detail.is_counted as td_is_counted',
														'user.first_name as first_name',
														'user.last_name as last_name'
														)
													->orderBy('transaction.created_at','desc')
													->get();
			}
			return $rs;
		}
		
		public function getAllSentPending($start_date=NULL, $end_date=NULL){
		
			if($start_date != NULL && $end_date != NULL){
				$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
													->leftJoin('transaction_detail', 'transaction_detail.transaction_id', '=', 'transaction.id')
													->leftJoin('product', 'product.id', '=', 'transaction_detail.product_id')
													->leftJoin('category', 'category.id', '=', 'product.category_id')
													->where('transaction_detail.is_counted', '=', 'pending')
													->whereBetween('transaction.created_at', array($start_date, $end_date))
													->orderBy('transaction.created_at','desc')
													->select('user.*','transaction.*','transaction_detail.*','product.*','category.*','transaction.id as tid')
													->get();
			}
			else{
				$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
													->leftJoin('transaction_detail', 'transaction_detail.transaction_id', '=', 'transaction.id')
													->leftJoin('product', 'product.id', '=', 'transaction_detail.product_id')
													->leftJoin('category', 'category.id', '=', 'product.category_id')
													->where('transaction_detail.is_counted', '=', 'pending')
													->orderBy('transaction.created_at','desc')
													->select('user.*','transaction.*','transaction_detail.*','product.*','category.*','transaction.id as tid')
													->get();
			}
			return $rs;
		}

		public function getAllSentReject($start_date=NULL, $end_date=NULL){
		
			if($start_date != NULL && $end_date != NULL){
				$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
													->leftJoin('transaction_detail', 'transaction_detail.transaction_id', '=', 'transaction.id')
													->leftJoin('product', 'product.id', '=', 'transaction_detail.product_id')
													->leftJoin('category', 'category.id', '=', 'product.category_id')
													->where('transaction_detail.is_counted', '=', 'no')
													->whereBetween('transaction.created_at', array($start_date, $end_date))
													->orderBy('transaction.created_at','desc')
													->select('user.*','transaction.*','transaction_detail.*','product.*','category.*','transaction.id as tid')
													->get();
			}
			else{
				$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
													->leftJoin('transaction_detail', 'transaction_detail.transaction_id', '=', 'transaction.id')
													->leftJoin('product', 'product.id', '=', 'transaction_detail.product_id')
													->leftJoin('category', 'category.id', '=', 'product.category_id')
													->where('transaction_detail.is_counted', '=', 'no')
													->orderBy('transaction.created_at','desc')
													->select('user.*','transaction.*','transaction_detail.*','product.*','category.*','transaction.id as tid')
													->get();
			}
			return $rs;
		}
		
		public function getAllSentFinal($start_date=NULL, $end_date=NULL){
		
			if($start_date != NULL && $end_date != NULL){
				$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
													->leftJoin('transaction_detail', 'transaction_detail.transaction_id', '=', 'transaction.id')
													->leftJoin('product', 'product.id', '=', 'transaction_detail.product_id')
													->leftJoin('category', 'category.id', '=', 'product.category_id')
													->where('transaction_detail.is_counted', '=', 'yes')
													->whereBetween('transaction.created_at', array($start_date, $end_date))
													->orderBy('transaction.created_at','desc')
													->select('user.*','transaction.*','transaction_detail.*','product.*','category.*','transaction.id as tid')
													->get();
			}
			else{
				$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
													->leftJoin('transaction_detail', 'transaction_detail.transaction_id', '=', 'transaction.id')
													->leftJoin('product', 'product.id', '=', 'transaction_detail.product_id')
													->leftJoin('category', 'category.id', '=', 'product.category_id')
													->where('transaction_detail.is_counted', '=', 'yes')
													->orderBy('transaction.created_at','desc')
													->select('user.*','transaction.*','transaction_detail.*','product.*','category.*','transaction.id as tid')
													->get();
			}
			return $rs;
		}
		
		/*
		public function getAllPaid(){
			$user_confirmation_payment_list = DB::table('user_confirmation_payment')->lists('transaction_id');

			$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
												->whereIn('transaction.id', $user_confirmation_payment_list)
												->select('user.*', 'transaction.*')
												->orderBy('transaction.paid', 'desc')
												->orderBy('transaction.id', 'desc')
												->get();
			return $rs;
		}*/

		public function getAllPaidByMerchantID($merchant_id){
			
			$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
								->leftJoin('user_address', 'user_address.id', '=', 'transaction.address_id')
								->leftJoin('transaction_detail', 'transaction_detail.transaction_id', '=', 'transaction.id')
								->where('transaction.paid', '=', 'yes')
								->where('transaction.sent_status', '!=', 'declined')
								->where('transaction_detail.is_accepted', '=', "pending")
								->where('transaction_detail.merchant_id', '=', $merchant_id)
								->select('user.*', 'user_address.alamat as user_address', 'transaction.*')
								->orderBy('transaction.created_at','desc')
								->orderBy('transaction.paid', 'desc')
								->get();
			
			return $rs;
		}
		
		/*
		public function getAllPaidByMerchantID($merchant_id){
			$user_confirmation_payment_list = DB::table('user_confirmation_payment')->lists('transaction_id');

			$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
							->leftJoin('user_address', 'user_address.id', '=', 'transaction.address_id')
							->leftJoin('transaction_detail', 'transaction_detail.transaction_id', '=', 'transaction.id')
							->where('transaction_detail.merchant_id', '=', $merchant_id)
							->where('transaction.paid', '=', 'yes')
							->where('transaction_detail.is_accepted', '=', 'pending')
							->select('user_address.name as user_name', 'user_address.address as user_address', 'transaction.*')
							->orderBy('transaction.id')
							->distinct('transaction.id')
							->get();

			return $rs;
		}*/
		

		public function getAllHasResi($start_date, $end_date){
			$user_confirmation_payment_list = DB::table('user_confirmation_payment')->lists('transaction_id');
			$transaction_resi_list = DB::table('transaction_resi')->lists('transaction_id');

			if(isset($start_date)){
				$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
													->whereIn('transaction.id', $transaction_resi_list)
													->where('transaction.created_at', '>=', $start_date)
													->where('transaction.created_at', '<=', $end_date)
													->where('transaction.paid', '=', 'yes')
													->select('user.*', 'transaction.*')
													->orderBy('transaction.created_at','desc')
													->orderBy('transaction.paid', 'desc')
													->get();
			}
			else{
				$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
													->whereIn('transaction.id', $transaction_resi_list)
													->where('transaction.paid', '=', 'yes')
													->select('user.*', 'transaction.*')
													->orderBy('transaction.created_at','desc')
													->orderBy('transaction.paid', 'desc')
													->get();
			}
			return $rs;
		}

		public function getAllPaidWithoutResi($start_date, $end_date){
			$user_confirmation_payment_list = DB::table('user_confirmation_payment')->lists('transaction_id');
			$transaction_resi_list = DB::table('transaction_resi')->lists('transaction_id');

			if(isset($start_date)){
				$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
													->whereNotIn('transaction.id', $transaction_resi_list)
													->where('transaction.created_at', '>=', $start_date)
													->where('transaction.created_at', '<=', $end_date)
													->where('transaction.paid', '=', 'yes')
													->select('user.*', 'transaction.*')
													->orderBy('transaction.created_at','desc')
													->orderBy('transaction.paid', 'desc')
													->get();
			}
			else{
				$rs = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
													->whereNotIn('transaction.id', $transaction_resi_list)
													->where('transaction.paid', '=', 'yes')
													->select('user.*', 'transaction.*')
													->orderBy('transaction.created_at','desc')
													->orderBy('transaction.paid', 'desc')
													->get();
			}
			return $rs;
		}
		
		public function getByID($user_id){
			$rs = Transaction::where('user_id', '=', $user_id)
					->where('transaction.paid', '!=', 'yes')
					->orderBy('transaction.created_at','desc')
					->get();
			
			return $rs;
		}

		public function getByIDPaid($user_id){

			$rs = Transaction::where('user_id', '=', $user_id)
								->where('transaction.paid', '=', 'yes')
								->orderBy('transaction.created_at','desc')
								->get();
			return $rs;
		}
		
		public function getResiByID($transaction_id){
			
			$rs = TransactionResi::where('transaction_resi.transaction_id', '=', $transaction_id)
							->join('transaction_detail', function($join) use ($transaction_id)
						        {
						            $join->on('transaction_detail.merchant_id', '=', 'transaction_resi.merchant_id')
						            		->where('transaction_detail.transaction_id', '=', $transaction_id);
						        })
							->groupBy('transaction_resi.merchant_id')
							->get();
							
			return $rs;
		}

		public function calculateCommision($transaction_detail_id){

			$fees = FeeRate::all();
			$mlm_level = MlmLevel::all()->toArray();

			$transaction_details = TransactionDetail::where('id', '=', $transaction_detail_id)
														->get();
			$user_id = Transaction::where('id', '=', $transaction_details[0]->transaction_id)
									->select('user_id')
									->first();

			$mlm = new Mlm();
			$upline_list = array();
			$upline = $user_id['user_id'];
			for($i=0; $i<4; $i++){
				$temp_upline = $mlm->getUpline($upline);
				if(empty($temp_upline)) break;
				else{
					$upline = $temp_upline->id;
					array_push($upline_list, $temp_upline);
				}
			}

			/*
			foreach($upline_list as $list){
				echo $list->email.'<br>';
			}
			echo $user_id['user_id'];
			echo $mlm_level[0]['bonus_percentage'];
			*/
			
			$user = new User();
			$mlm_merchant = new MlmMerchant();
			$mlm_user = new MlmUser();
			foreach($transaction_details as $detail){
				foreach($fees as $fee){
					if($detail->price >= $fee->price_cap_start && $detail->price <= $fee->price_cap_end){
						//input ke mlm_merchant
						$mlm_merchant->insertData($detail->id, $transaction_details[0]->merchant_id, $fee->percentage);

						//input ke mlm_user
						$temp_amount = $detail->price * ($fee->percentage/100);
						$temp_total = $temp_amount * $detail->quantity;

						$i = 0;
						foreach($upline_list as $upline){
							$temp_commision = $temp_total * ($mlm_level[$i]['bonus_percentage']/100);
							$mlm_user->insertData($transaction_details[0]->transaction_id, $transaction_detail_id, $user_id['user_id'], $upline->id, $temp_commision);
							$user->addBalance($upline->id, $temp_commision);
							$i++;
						}
					}
				}
			}
			
			
		}



	}
?>