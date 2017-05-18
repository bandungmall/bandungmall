<?php
	class TransactionDetailNotification extends Eloquent{
		protected $table = 'transaction_detail_notification';
		protected $primaryKey = 'id';

		public function insertData($transaction_id, $merchant_id, $notification){
			$data = new TransactionDetailNotification();

			$data->transaction_id = $transaction_id;
			$data->merchant_id = $merchant_id;
			$data->notification = $notification;
			$data->save();
		}
	}
?>