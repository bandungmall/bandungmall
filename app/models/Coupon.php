<?php
	class Coupon extends Eloquent{
		protected $table = 'coupon';
		protected $primaryKey = 'id';

		public function getAll(){
			$data_coupon = DB::table('coupon')->get();

			return $data_coupon;
		}

		public function insertCoupon($kode_coupon){
			
			$data_coupon = new Coupon();
			$data_coupon->kode_coupon = $kode_coupon;
			$data_coupon->save();
		}

		public function editCoupon($id=NULL, $kode_coupon=NULL, $status){
			if($kode_coupon != NULL){
				$data_coupon = Coupon::where('kode_coupon','=',$kode_coupon)->first();
			}else{
				$data_coupon = Coupon::find($id);
			}
			
			$data_coupon->status = $status;
			$data_coupon->save();

		}
	}
?>