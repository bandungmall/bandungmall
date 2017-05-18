	<?php

class AdminUserTransactionController extends BaseController {

	public function getIndex(){
		
		$transaction = new Transaction();

		$data['transactions'] = $transaction->getAll();

		return View::make('admin/user_transaction', $data);
	}
	
	public function detailTransaction(){
		$transaction = new Transaction();
		$transaction_id = Input::get('id');
		$transaction_detail = new TransactionDetail();
		$data['user_confirmation_payment'] = UserConfirmationPayment::where('transaction_id', '=', $transaction_id)->leftJoin('user', 'user.id', '=', 'user_confirmation_payment.user_id')->first();
		$data['merchants'] = $transaction_detail->getMerchantList($transaction_id);
		$data['detail_transactions'] = $transaction_detail->getDetail($transaction_id);
		$data['transaction'] = $transaction->where('id', '=', $transaction_id)->first();

		return View::make('admin/user_transaction_detail', $data);
	}
}