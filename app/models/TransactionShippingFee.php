<?php
	class TransactionShippingFee extends Eloquent{
		protected $table = 'transaction_shipping_fee';
		protected $primaryKey = 'id';

		public function insertData($transaction_id, $cost){
			$data = new TransactionShippingFee();

			$data->transaction_id = $transaction_id;
			$data->shipping_price = $cost;
			$data->save();
		}

	}
?>