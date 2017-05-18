<?php
	class UserAddress extends Eloquent{
		protected $table = 'user_address';
		protected $primaryKey = 'id';

		public function insertAddress($user_id, $name, $provinsi, $kota, $alamat, $kode_pos, $nomer_hp){
			
			$data_address = new UserAddress();
			$data_address->user_id = $user_id;
			$data_address->name = $name;
			$data_address->provinsi = $provinsi;
			$data_address->kota = $kota;
			$data_address->alamat = $alamat;
			$data_address->kode_pos = $kode_pos;
			$data_address->nomer_hp = $nomer_hp;
			$data_address->save();
		}

		public function editAddress($address_id, $name, $provinsi, $kota, $alamat, $kode_pos, $nomer_hp){
			
			$data_address = UserAddress::find($address_id);
			$data_address->name = $name;
			$data_address->provinsi = $provinsi;
			$data_address->kota = $kota;
			$data_address->alamat = $alamat;
			$data_address->kode_pos = $kode_pos;
			$data_address->nomer_hp = $nomer_hp;
			$data_address->save();

		}
	}
?>