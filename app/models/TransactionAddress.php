<?php
	class TransactionAddress extends Eloquent{
		protected $table = 'transaction_address';
		protected $primaryKey = 'id';

		public function insertAddress($user_id, $provinsi, $kota, $alamat, $kode_pos, $nomer_hp){
			
			$data_address = new TransactionAddress();
			$data_address->user_id = $user_id;
			$data_address->provinsi = $provinsi;
			$data_address->kota = $kota;
			$data_address->alamat = $alamat;
			$data_address->kode_pos = $kode_pos;
			$data_address->nomer_hp = $nomer_hp;
			$data_address->save();
		}
	}
?>