<?php
	class TransactionNotification extends Eloquent{
		protected $table = 'transaction_notification';
		protected $primaryKey = 'id';

		public function insertData($transaction_id, $notification){
			$data = new TransactionNotification();

			$data->transaction_id = $transaction_id;
			$data->notification = $notification;
			$data->save();
		}
	}
?>