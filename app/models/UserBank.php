<?php
	class UserBank extends Eloquent{
		protected $table = 'user_bank';
		protected $primaryKey = 'id';

		public function insertBank($user_id, $bank_id, $nama_rek, $nama_acc, $no_rek){
			
			$data_bank = new UserBank();
			$data_bank->user_id = $user_id;
			$data_bank->bank_id = $bank_id;
			$data_bank->nama_rekening = $nama_rek;
			$data_bank->bank_account = $nama_acc;
			$data_bank->no_rekening = $no_rek;
			$data_bank->save();
		}

		public function editBank($id, $user_id, $bank_id, $nama_rek, $nama_acc, $no_rek){
			
			$data_bank = UserBank::find($id);
			$data_bank->user_id = $user_id;
			$data_bank->bank_id = $bank_id;
			$data_bank->nama_rekening = $nama_rek;
			$data_bank->bank_account = $nama_acc;
			$data_bank->no_rekening = $no_rek;
			$data_bank->save();

		}
	}
?>