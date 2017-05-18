<?php

class AdminHomeController extends BaseController {

	public function getIndex(){
		//return View::make('admin/home');
		return Redirect::to('admin/admin');
	}

	public function getIndexHome(){

		$now = Date("Y-m-d h:i:s");
		
		$data['transaction_detail_notifications'] = DB::table('transaction_detail_notification')->orderBy('created_at', 'desc')->get();
		$data['transaction_notifications'] = DB::table('transaction_notification')->orderBy('created_at', 'desc')->get();

		$transaction = new Transaction();
		$data['transactions'] = $transaction->getAllUnPaid();
		foreach ($data['transactions'] as $key => $value) {
			if($now > $value['batas_pembayaran']){
				$up_transaction = Transaction::find($value['id']);
				$up_transaction->paid = "reject";
				$up_transaction->save();

				$transaction_detail = TransactionDetail::where('transaction_id','=',$value['id'])->get();
				$up_transaction_detail = TransactionDetail::where('transaction_id','=',$value['id'])->first();
				$up_transaction_detail->is_counted = "no";
				$up_transaction_detail->save();

				$transaction_notification = new TransactionNotification();
				$transaction_notification->insertData($value['id'], 'User Telat Melakukan Pembayaran');
				
				foreach ($transaction_detail as $key => $value) {
					$up_product = Product::find($value['product_id']);
					$up_product->quantity = $up_product['quantity'] + $value['quantity'];
					$up_product->temp_quantity = $up_product['temp_quantity'] + $value['quantity'];
					$up_product->save();
				}
			}
		}
		
		return View::make('admin/home', $data);
	}

}
