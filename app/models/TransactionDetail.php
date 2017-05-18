<?php
	class TransactionDetail extends Eloquent{
		protected $table = 'transaction_detail';
		protected $primaryKey = 'id';

		public function insertTransactionDetail($transaction_id, $product_id, $merchant_id, $price, $quantity, $size, $color, $sub_total){
			$data_transactiondetai = new TransactionDetail();
			$data_transactiondetai->transaction_id = $transaction_id;
			$data_transactiondetai->product_id = $product_id;
			$data_transactiondetai->merchant_id = $merchant_id;
			$data_transactiondetai->price = $price;
			$data_transactiondetai->quantity = $quantity;
			$data_transactiondetai->size = $size;
			$data_transactiondetai->color = $color;
			$data_transactiondetai->sub_total = $sub_total;
			$data_transactiondetai->save();
		}
		
		public function getDetail($transaction_id){
			$rs = TransactionDetail::where('transaction_detail.transaction_id', '=', $transaction_id)
							->leftJoin('transaction', 'transaction.id', '=', 'transaction_detail.transaction_id')
							->leftJoin('transaction_resi', 'transaction_resi.transaction_id', '=', 'transaction_detail.transaction_id')
							->leftJoin('product', 'product.id', '=', 'transaction_detail.product_id')
							->leftJoin('user', 'user.id', '=', 'transaction.user_id')
							->select('transaction.*', 'product.*', 'transaction_detail.*','transaction_resi.resi as resi')
							->get();
			return $rs;
		}

		public function getDetailWithResi($transaction_id){
			// $rs = TransactionDetail::where('transaction_detail.transaction_id', '=', $transaction_id)
			// 				->leftJoin('transaction', 'transaction.id', '=', 'transaction_detail.transaction_id')
			// 				->leftJoin('product', 'product.id', '=', 'transaction_detail.product_id')
			// 				->leftJoin('user', 'user.id', '=', 'transaction.user_id')
			// 				->leftJoin('transaction_resi', function($join) use ($transaction_id)
			// 			        {
			// 			            $join->on('transaction_detail.merchant_id', '=', 'transaction_resi.merchant_id')
			// 			            		->where('transaction_resi.transaction_id', '=', $transaction_id);
			// 			        })
			// 				->groupBy('transaction_detail.id')
			// 				->select('transaction.*', 'product.*', 'transaction_resi.*', 'transaction_detail.*', 'transaction_resi.updated_at as resi_date')
			// 				->get();
			// return $rs;

			$rs = TransactionDetail::where('transaction_id', '=', $transaction_id)
							->leftJoin('transaction', 'transaction.id', '=', 'transaction_detail.transaction_id')
							->leftJoin('product', 'product.id', '=', 'transaction_detail.product_id')
							->leftJoin('user', 'user.id', '=', 'transaction.user_id')
							->select('transaction.*', 'product.*', 'transaction_detail.*')
							->get();
			return $rs;
		}
		
		public function getDetailUser($transaction_id, $user_id){
			$rs = TransactionDetail::where('transaction_id', '=', $transaction_id)
							->leftJoin('transaction', 'transaction.id', '=', 'transaction_detail.transaction_id')
							->leftJoin('product', 'product.id', '=', 'transaction_detail.product_id')
							->leftJoin('user', 'user.id', '=', 'transaction.user_id')
							->where('transaction.user_id', '=', $user_id)
							->groupBy('transaction.id')
							->select('transaction.*', 'product.*', 'transaction_detail.*')
							->get();
			return $rs;
		}

		public function getDetailMerchant($transaction_id, $merchant_id){
			$rs = TransactionDetail::where('transaction_id', '=', $transaction_id)
							->leftJoin('transaction', 'transaction.id', '=', 'transaction_detail.transaction_id')
							->leftJoin('product', 'product.id', '=', 'transaction_detail.product_id')
							->where('transaction_detail.merchant_id', '=', $merchant_id)
							->select('transaction.*', 'product.*', 'transaction_detail.*')
							->get();
			return $rs;
		}
		
		public function getMerchantList($transaction_id){
			$rs = TransactionDetail::where('transaction_id', '=', $transaction_id)
							->leftJoin('transaction', 'transaction.id', '=', 'transaction_detail.transaction_id')
							->leftJoin('product', 'product.id', '=', 'transaction_detail.product_id')
							->leftJoin('merchant', 'merchant.id', '=', 'transaction_detail.merchant_id')
							->groupBy('transaction.id')
							->select('transaction.*', 'product.*', 'transaction_detail.*', 'merchant.*')
							->get();
			return $rs;
		}
		
		/*public function getMerchantList($transaction_id){
			$rs = TransactionDetail::where('transaction_detail.transaction_id', '=', $transaction_id)
									->join('merchant', 'merchant.id', '=', 'transaction_detail.merchant_id')
									->join('transaction_shipping_fee', 'transaction_shipping_fee.merchant_id', '=', 'transaction_detail.merchant_id')
									->select('transaction_detail.merchant_id', 'shop_name', 'transaction_shipping_fee.shipping_price')->groupBy('merchant_id')->get();

			return $rs;
		}*/
		
	}
?>