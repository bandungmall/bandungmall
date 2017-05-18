<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}

	public function index(){

		$now = Date("Y-m-d h:i:s");
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
					$up_product->save();
				}
			}
		}

		$data['transactions_mercahant'] = $transaction->getAllPaid();
		foreach ($data['transactions_mercahant'] as $key => $value) {
			if($now > $value['batas_pengiriman']){
				$up_transaction = Transaction::find($value['id']);
				$up_transaction->sent_status = "declined";
				$up_transaction->save();

				$transaction_detail = TransactionDetail::where('transaction_id','=',$value['id'])->get();
				$up_transaction_detail = TransactionDetail::where('transaction_id','=',$value['id'])->first();
				$up_transaction_detail->is_counted = "no";
				$up_transaction_detail->save();
				foreach ($transaction_detail as $key => $value) {
					$up_product = Product::find($value['product_id']);
					$up_product->quantity = $up_product['quantity'] + $value['quantity'];
					$up_product->temp_quantity = $up_product['temp_quantity'] + $value['quantity'];
					$up_product->save();
				}
			}
		}

		$category_root = new CategoryRoot();
		$category_parent = new CategoryParent();
		$category_child = new CategoryChild();
		$category_grand_child = new CategoryGrandChild();
		$data['category_root'] = $category_root->getAll();
		$data['category_parent'] = $category_parent->getAll();
		$data['category_child'] = $category_child->getAll();
		$data['category_grand_child'] = $category_grand_child->getAll();

		$data_category_parent = Category::where('parent', '=', 0)->orderBy('name','asc')->get();
		$data_category_child = Category::where('parent', '!=', 0)->orderBy('name','asc')->get();

		$data['categories'] = DB::table('category_grand_child as cgc')
									->leftJoin('category_child as cc', 'cgc.id_child', '=', 'cc.id')
									->leftJoin('category_parent as cp', 'cc.id_parent', '=', 'cp.id')
									->leftJoin('category_root as cr', 'cp.id_root', '=', 'cr.id')
									->select(
										'cr.id as crid',
										'cr.name as crname',
										'cp.id as cpid',
										'cp.name as cpname',
										'cc.id as ccid',
										'cc.name as ccname',
										'cc.commision as cccommision',
										'cgc.id as cgcid',
										'cgc.name as cgcname',
										'cgc.commision as cgccommision'
										)
									->orderBy('cr.name','asc')
									->orderBy('cp.name','asc')
									->orderBy('cc.name','asc')
									->orderBy('cgc.name','asc')
									->get();

		$product_id = Input::get('product_id');
		
		$product_cart = Product::where('id', '=', 19)->first();
		$data['product_cart'] = $product_cart;
		$data['product_cart_images'] = ProductImage::where('product_id', '=', 19)
														->orderBy('id','asc')
														->get();

		
		// Session::put("data_category_parent",$data_category_parent);
		// Session::put("data_category_child",$data_category_child);

		// $data['data_category_parent'] = $data_category_parent;
		// $data['data_category_child'] = $data_category_child;
		
		$data['most_viewed_products'] = Product::where('is_active', '=', 'yes')
							->leftJoin('category as c1', 'c1.id', '=', 'product.category_id')
							->leftJoin('category as c2', 'c2.id', '=', 'c1.parent')
							->select('product.*', 'c1.name as category_name', 'c2.name as category_parent_name')
							->orderBy('product.viewed', 'desc') 
							->take(4)->get();
		
		$data['products'] = Product::where('is_active', '=', 'yes')
							->leftJoin('category as c1', 'c1.id', '=', 'product.category_id')
							->leftJoin('category as c2', 'c2.id', '=', 'c1.parent')
							->select('product.*', 'c1.name as category_name', 'c2.name as category_parent_name')
							->orderBy('product.created_at', 'desc') 
							->take(4)->get();
		$data['banners'] = Banner::all();
		$data['brands'] = Brand::all();
		$data['promotions'] = Promotion::all();
		$data['title'] = 'Home';
		if (!Session::has('jenisKelamin')){
			Session::put("jenisKelamin","wanita");
		}

		return View::make('user.home', $data);
	}

	public function getProductId(){

		$product_id = Input::get('id');
		
		$product_cart = Product::where('id', '=', $product_id)->first();
		$data['product_cart'] = $product_cart;
		$data['product_cart_images'] = ProductImage::where('product_id', '=', $product_id)
														->orderBy('id','asc')
														->get();


		return $data;
	}

}