<?php

class AdminCouponController extends BaseController {

	public function getIndex(){

		$data['error_code'] = Session::get('error_code');

		$coupon = new Coupon();
		$data['coupons'] = $coupon->getAll();
		return View::make('admin/coupon', $data);
	}

	public function getIndexEditCoupon(){

		$data['error_code'] = Session::get('error_code');
		
		$coupon_id = Input::get('id');

		$coupon = new Coupon();
		$data['coupon'] = Coupon::where('id', '=', $coupon_id)->first();

		return View::make('admin/editcoupon', $data);
	}

	public function doEditCoupon(){

		$coupon_id = Input::get('coupon_id');
		$couponid = Input::get('couponid');
		$potongan = Input::get('potongan');
		
		$data['Coupon'] = Coupon::where('kode_coupon', '=', $couponid)
									->where('id','!=',$coupon_id)
									->first();
		if(count($data['Coupon']) > 0){
			return Redirect::to('admin/coupon')->with('error_code', "Kode Coupon sudah ada");
		}
		$coup = Coupon::find($coupon_id);
		$coup->kode_coupon = $couponid;
		$coup->potongan = $potongan;
		$coup->save();

		return Redirect::to('admin/coupon');
	}

	public function doInsertCoupon(){

		$couponid = Input::get('couponid');
		$potongan = Input::get('potongan');

		$coup = new Coupon();
		$data['Coupon'] = Coupon::where('kode_coupon', '=', $couponid)->first();
		if(count($data['Coupon']) > 0){
			return Redirect::to('admin/coupon')->with('error_code', "Kode Coupon sudah ada");
		}
		$coup->kode_coupon = $couponid;
		$coup->potongan = $potongan;
		$coup->save();

		return Redirect::to('admin/coupon');
	}

	public function doDeleteCoupon(){

		$coupon_id = Input::get('id');

		$data_coupon = Coupon::find($coupon_id);
		$data_coupon->delete();

		return Redirect::to('admin/coupon');
	}
}
