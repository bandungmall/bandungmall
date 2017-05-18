<?php
	class MlmMerchant extends Eloquent{
		protected $table = 'mlm_merchant';
		protected $primaryKey = 'id';

		public function insertData($transaction_detail_id, $merchant_id, $percentage){
			$data = new MlmMerchant();

			$data->transaction_detail_id = $transaction_detail_id;
			$data->merchant_id = $merchant_id;
			$data->percentage = $percentage;
			$data->save();
		}
	}
?>