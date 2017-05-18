<?php
	class MlmUser extends Eloquent{
		protected $table = 'mlm_user';
		protected $primaryKey = 'id';

		public function insertData($transaction_id, $transaction_detail_id, $user_id_from, $user_id_to, $amount){
			$data = new MlmUser();

			$data->transaction_id = $transaction_id;
			$data->transaction_detail_id = $transaction_detail_id;
			$data->user_id_from = $user_id_from;
			$data->user_id_to = $user_id_to;
			$data->amount = $amount;
			$data->save();
		}
	}
?>