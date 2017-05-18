	<?php

class AdminTransactionController extends BaseController {

	public function getIndex(){
		
		$start_date = Input::get('start_date');
		$end_date = Input::get('end_date');

		$transaction = new Transaction();

		$data['transactions'] = $transaction->getAllPaidWithoutResi($start_date, $end_date);

		return View::make('admin/transaction', $data);
	}
	
	public function getPaidTransaction(){
		
		$transaction = new Transaction();

		$data['transactions'] = $transaction->getAllPaid();

		return View::make('admin/transactionPaid', $data);
	}

	public function getFilterTransactionPaid(){
		
		$start_date = Input::get('start_date');
		$end_date = Input::get('end_date');

		$transaction = new Transaction();

		if($start_date == '' || $end_date == ''){
			return Redirect::to('admin/transaction/transactionPaid')->with('error_code', "filter harus diisi keduanya");;
		}
		$data['transactions'] = $transaction->getAllPaid($start_date, $end_date);

		return View::make('admin/transactionPaid', $data);
	}

	public function getUnPaidTransaction(){

		$transaction = new Transaction();

		$data['transactions'] = $transaction->getAllUnPaid();

		return View::make('admin/transactionUnpaid', $data);
	}

	public function getFilterUnPaidTransaction(){
		
		$start_date = Input::get('start_date');
		$end_date = Input::get('end_date');

		$transaction = new Transaction();

		if($start_date == '' || $end_date == ''){
			return Redirect::to('admin/transaction/transactionUnpaid')->with('error_code', "filter harus diisi keduanya");;
		}
		$data['transactions'] = $transaction->getAllUnPaid($start_date, $end_date);

		return View::make('admin/transactionUnpaid', $data);
	}

	public function getRejectTransaction(){

		$transaction = new Transaction();

		$data['transactions'] = $transaction->getAllReject();

		return View::make('admin/transactionReject', $data);
	}

	public function getFilterRejectTransaction(){
		
		$start_date = Input::get('start_date');
		$end_date = Input::get('end_date');

		$transaction = new Transaction();

		if($start_date == '' || $end_date == ''){
			return Redirect::to('admin/transaction/transactionReject')->with('error_code', "filter harus diisi keduanya");;
		}
		$data['transactions'] = $transaction->getAllReject($start_date, $end_date);

		return View::make('admin/transactionReject', $data);
	}
	
	public function getPendingTransaction(){

		$transaction = new Transaction();

		$data['transactions'] = $transaction->getAllPending();

		return View::make('admin/transactionPending', $data);
	}

	public function getFilterTransactionPending(){
		
		$start_date = Input::get('start_date');
		$end_date = Input::get('end_date');

		$transaction = new Transaction();

		if($start_date == '' || $end_date == ''){
			return Redirect::to('admin/transaction/transactionPending')->with('error_code', "filter harus diisi keduanya");;
		}
		$data['transactions'] = $transaction->getAllPending($start_date, $end_date);

		return View::make('admin/transactionPending', $data);
	}
	
	public function doTransactionPayment($id){
		$tomorrow = Date("Y-m-d h:i:s", strtotime(' +1 day'));
		
		$transaction_id = $id;

		$transaction = Transaction::find($transaction_id);
		$transaction->paid = 'yes';
		$transaction->batas_pengiriman = $tomorrow;
		$transaction->save();

		return Redirect::to('admin/transaction/transactionPending');
	}
	
	public function getIndexTransactionSent(){
		
		$transaction = new Transaction();

		$data['transactions'] = $transaction->getAllSent();

		return View::make('admin/transaction_sent', $data);
	}

	public function getFilterTransactionSent(){
		
		$start_date = Input::get('start_date');
		$end_date = Input::get('end_date');

		$transaction = new Transaction();

		if($start_date == '' || $end_date == ''){
			return Redirect::to('admin/transaction/transactionSent')->with('error_code', "filter harus diisi keduanya");;
		}
		$data['transactions'] = $transaction->getAllSent($start_date, $end_date);

		return View::make('admin/transaction_sent', $data);
	}

	public function getIndexTransactionSentDeclined(){
		
		$transaction = new Transaction();

		$data['transactions'] = $transaction->getAllSentDeclined();

		return View::make('admin/transaction_sent_declined', $data);
	}

	public function getFilterTransactionSentDeclined(){
		
		$start_date = Input::get('start_date');
		$end_date = Input::get('end_date');

		$transaction = new Transaction();

		if($start_date == '' || $end_date == ''){
			return Redirect::to('admin/transaction/transactionSent')->with('error_code', "filter harus diisi keduanya");;
		}
		$data['transactions'] = $transaction->getAllSentDeclined($start_date, $end_date);

		return View::make('admin/transaction_sent_declined', $data);
	}

	public function getIndexTransactionSentDetail($id){
		$transaction = new Transaction();
		$transaction_id = $id;
		$transaction_detail = new TransactionDetail();
		$data['user_confirmation_payment'] = UserConfirmationPayment::where('user_confirmation_payment.transaction_id', '=', $transaction_id)
												->leftJoin('user', 'user.id', '=', 'user_confirmation_payment.user_id')
												->leftJoin('transaction', 'transaction.id', '=', 'user_confirmation_payment.transaction_id')
												->select('user.*', 'user_confirmation_payment.*', 'transaction.updated_at as payment_approved_date')
												->first();
		$data['merchants'] = $transaction_detail->getMerchantList($transaction_id);
		$data['transaction_detail'] = $transaction_detail->getDetailWithResi($transaction_id);
		$data['transaction'] = $transaction->where('id', '=', $transaction_id)->first();
		$data['resi_transactions'] = $transaction->getResiByID($transaction_id);
		$data['transaction_notifications'] = TransactionNotification::where('transaction_id', '=', $data['transaction_detail'][0]->transaction_id)->get();
		$data['transaction_detail_notifications'] = TransactionDetailNotification::where('transaction_id', '=', $data['transaction_detail'][0]->transaction_id)->get();

		return View::make('admin/transaction_sent_detail', $data);
	}

	public function detailTransaction($id){
		$transaction = new Transaction();
		$transaction_id = $id;
		$transaction_detail = new TransactionDetail();
		$data['user_confirmation_payment'] = UserConfirmationPayment::where('user_confirmation_payment.transaction_id', '=', $transaction_id)
												->leftJoin('user', 'user.id', '=', 'user_confirmation_payment.user_id')
												->leftJoin('transaction', 'transaction.id', '=', 'user_confirmation_payment.transaction_id')
												->select('user.*', 'user_confirmation_payment.*', 'transaction.updated_at as payment_approved_date')
												->first();
		$data['merchants'] = $transaction_detail->getMerchantList($transaction_id);
		$data['transaction_detail'] = $transaction_detail->getDetailWithResi($transaction_id);
		$data['transaction'] = $transaction->where('id', '=', $transaction_id)->groupBy('transaction.id')->first();

		$data['resi_transactions'] = $transaction->getResiByID($transaction_id);
		$data['transaction_notifications'] = TransactionNotification::where('transaction_id', '=', $data['transaction_detail'][0]->transaction_id)->get();
		$data['transaction_detail_notifications'] = TransactionDetailNotification::where('transaction_id', '=', $data['transaction_detail'][0]->transaction_id)->get();

		return View::make('admin/transaction_detail', $data);
	}

	public function doApproveTransactionDetail(){

		$transaction_detail_id = Input::get('id');

		$transaction_detail = TransactionDetail::find($transaction_detail_id);
		$transaction_detail->is_counted = 'yes';
		$transaction_detail->save();

		$transaction = new Transaction();
		$transaction->calculateCommision($transaction_detail_id);

		return Redirect::to('admin/transaction/transactionSentDetail/'.$transaction_detail->transaction_id);

	}

	public function doRejectTransactionDetail(){

		$transaction_detail_id = Input::get('id');

		$transaction_detail = TransactionDetail::find($transaction_detail_id);
		$transaction_detail->is_counted = 'no';
		$transaction_detail->save();

		return Redirect::to('admin/transaction/transactionSentDetail?id='.$transaction_detail->transaction_id);

	}

	public function getIndexTransactionReportFinal(){

		$transaction = new Transaction();

		$data['transactions'] = $transaction->getAllSentFinal();

		return View::make('admin/transaction_report', $data);
	}

	public function getFilterTransactionReportFinal(){
		$start_date = Input::get('start_date');
		$end_date = Input::get('end_date');

		$transaction = new Transaction();

		if($start_date == '' || $end_date == ''){
			return Redirect::to('admin/transactionReport')->with('error_code', "filter harus diisi keduanya");;
		}
		$data['transactions'] = $transaction->getAllSentFinal($start_date, $end_date);

		return View::make('admin/transaction_report', $data);
	}
	
	public function getIndexTransactionReportPending(){

		$transaction = new Transaction();

		$data['transactions'] = $transaction->getAllSentPending();

		return View::make('admin/transaction_report_pending', $data);
	}

	public function getFilterTransactionReportPending(){
		$start_date = Input::get('start_date');
		$end_date = Input::get('end_date');

		$transaction = new Transaction();

		if($start_date == '' || $end_date == ''){
			return Redirect::to('admin/transactionReportPending')->with('error_code', "filter harus diisi keduanya");;
		}
		$data['transactions'] = $transaction->getAllSentPending($start_date, $end_date);

		return View::make('admin/transaction_report_pending', $data);
	}

	public function getIndexTransactionReportReject(){

		$transaction = new Transaction();

		$data['transactions'] = $transaction->getAllSentReject();

		return View::make('admin/transaction_report_reject', $data);
	}

	public function getFilterTransactionReportReject(){
		$start_date = Input::get('start_date');
		$end_date = Input::get('end_date');

		$transaction = new Transaction();

		if($start_date == '' || $end_date == ''){
			return Redirect::to('admin/transactionReportReject')->with('error_code', "filter harus diisi keduanya");;
		}
		$data['transactions'] = $transaction->getAllSentReject($start_date, $end_date);

		return View::make('admin/transaction_report_reject', $data);
	}
	
	public function getIndexTransactionReport(){
		return View::make('admin/transaction_report');
	}

	public function generateTransactionReport(){
		$start_date = Input::get('start_date');
		$end_date = Input::get('end_date');

		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;

		$data['mlm_merchants'] = MlmMerchant::where('mlm_merchant.created_at', '>=', $start_date)
												->where('mlm_merchant.created_at', '<=', $end_date)
												->leftJoin('transaction_detail', 'transaction_detail.id', '=', 'mlm_merchant.transaction_detail_id')
												->leftJoin('merchant', 'merchant.id', '=', 'transaction_detail.merchant_id')
												->where('transaction_detail.is_counted', '=', 'yes')
												->select('merchant.*', 'transaction_detail.*', 'mlm_merchant.*')
												->get();
		/*
		$data['mlm_users'] = MlmUser::where('mlm_user.created_at', '>=', $start_date)
										->where('mlm_user.created_at', '<=', $end_date)
										->select(DB::raw('sum(amount) as total_amount, mlm_user.*'))
										->groupBy('mlm_user.transaction_detail_id')
										->get();
										
		
		$temp_data = array();
		foreach($data['mlm_users'] as $dat){
			//echo $data->transaction_detail_id.'<br>';
			$temp_data[$dat->transaction_detail_id] = $dat->total_amount;
		}

		//echo $temp_data[130];
		$data['user_commision'] = $temp_data;
		*/
		
		return View::make('report.report_admin', $data);
		//return PDF::loadView('report.report_admin', $data)->stream();
	}
}