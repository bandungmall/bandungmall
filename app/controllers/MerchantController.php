<?php

class MerchantController extends BaseController {

	public function getIndexHome(){
		return View::make('merchant/home');
	}

	public function getIndexRegister(){

		$data['areas'] = Area::all();
		$data['msg'] = Session::get('error_code');
		
		$category_root = new CategoryRoot();
		$category_parent = new CategoryParent();
		$category_child = new CategoryChild();
		$category_grand_child = new CategoryGrandChild();
		$data['category_root'] = $category_root->getAll();
		$data['category_parent'] = $category_parent->getAll();
		$data['category_child'] = $category_child->getAll();
		$data['category_grand_child'] = $category_grand_child->getAll();

		return View::make('merchant/register', $data);
	}

	public function getIndexLogin(){
		if (Session::has('merchant_email')) {
			return Redirect::to('merchant/info');
		}

		return View::make('merchant/login');
	}

	public function getIndexForgotPassword(){
	
		$data['msg'] = Session::get('error_code');
	
		return View::make('merchant/forgot_password', $data);
	}

	public function doRegister(){

		//$temp_data = Merchant::where('email', '=', Input::get('email'))->where('is_accepted', '=', 'yes')->get();
		//if(isset($temp_data[0])) return Redirect::to('merchant/register');
		$check_email = Merchant::where('email', '=', Input::get('email'))->first();
		if(!($check_email ===NULL)){
			return Redirect::to('merchant/register')->with('error_code', "Email sudah ada");
		}

		//input data k db tunggu di approve
		$name = Input::get('seller_name');
		$shop_name = Input::get('shop_name');
		$phone_number = Input::get('shop_name');
		$email = Input::get('email');
		$company_name = Input::get('company_name');
		$person_in_charge = Input::get('pic_name');
		$ic_number = Input::get('ic_number');
		$address = Input::get('address');
		$province = Input::get('province');
		$city = Input::get('city');
		$district = Input::get('district');
		$postal_code = Input::get('postal_code');
		$city_from = Input::get('city_from');
		$account_number = Input::get('account_number');
		$account_name = Input::get('account_name');
		$account_bank = Input::get('account_bank');

		$merchant = new Merchant();
		$merchant->insertMerchant($name, $shop_name, $phone_number, $email, $company_name, $person_in_charge, $ic_number, $address, $province, $city, $district, $postal_code, $city_from, $account_number, $account_name, $account_bank);
	
		//return Redirect::to('/info')->with('info_data', 'Pendaftaran telah berhasil di lakukan, kami akan menghubungi anda lewat email.');
		//return Redirect::to('/info')->with('info_data', 'Kode untuk mengaktifasi akun anda telah di kirim ke email anda, silahkan untuk mengaktifkan melalui link yang di berikan');
		return Redirect::to('/info')->with('info_data', 'Silahkan menunggu konfirmasi dari admin untuk mengaktifasi akun anda');
	}

	public function activateAccount($activation_code){
		$merchant = Merchant::where('activation_code', '=', $activation_code)->first();
		if($merchant ===NULL){
			//ke new page, 
			return Redirect::to('/info')->with('info_data', 'Kode Aktifasi salah');
		}
		else{
			$merchant->activation_code = "";
			$merchant->save();

			//ke login page
			return Redirect::to('merchant/login');
		}
	}

	public function doLogin(){

		$email = Input::get('email');
		$password = md5(Input::get('password'));

		$merchant = new Merchant();
		$data = $merchant->checkLogin($email, $password);

		if(isset($data[0])){
			if($data[0]->activation_code !=''){
				return Redirect::to('/info')->with('info_data', 'Silahkan mengaktifkan akun anda sebelum login');
			}
			else{
				Session::put('merchant_email', $email);
				Session::put('merchant_id', $data[0]['id']);
				return Redirect::to(URL::to('merchant/info'))->with("message", "Welcome ". $email);
			}
			
		}
		return Redirect::to(URL::to('merchant/login'))->with("message", "Invalid Login");
	}

	public function doLogout(){
		//Session::flush();
		Session::forget('merchant_email');
		return Redirect::to(URL::to('merchant/login'));
	}

	public function getIndexInfo(){

		$now = Date("Y-m-d h:i:s");

		$data['merchant'] = Merchant::where('email', '=', Session::get('merchant_email'))->first();
		$data['title'] = 'Informasi Merchant';

		$transaction = new Transaction();

		$data['transactions'] = $transaction->getAllPaidByMerchantID($data['merchant']->id);
		foreach ($data['transactions'] as $key => $value) {
			if($now > $value['batas_pengiriman']){
				$up_transaction = Transaction::find($value['id']);
				$up_transaction->sent_status = "declined";
				$up_transaction->save();

				$transaction_detail = TransactionDetail::where('transaction_id','=',$value['id'])->get();
				$up_transaction_detail = TransactionDetail::where('transaction_id','=',$value['id'])->first();
				$up_transaction_detail->is_counted = "no";
				$up_transaction_detail->save();

				$transaction_detail_notification = new TransactionDetailNotification();
				$transaction_detail_notification->insertData($value['id'], $data['merchant']->id, 'Merchant Telat Kirim Barang');

				foreach ($transaction_detail as $key => $value) {
					$up_product = Product::find($value['product_id']);
					$up_product->quantity = $up_product['quantity'] + $value['quantity'];
					$up_product->save();
				}
			}
		}

		$area_provinsi = new AreaProvinsi();
		$data['areas_provinsi'] = $area_provinsi->getAll();
		
		return View::make('merchant/info', $data);
	}

	public function getIndexAddProduct(){

		$data['error_code'] = Session::get('error_code');

		$colour = new Colour();
		
		$data['colours'] = $colour->getAll();

		$category_root = new CategoryRoot();

		$data['categories_root'] = $category_root->getAll();

		$category_grand_child = DB::table('category_grand_child as cgc')
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
		$data['categories_grand_child'] = $category_grand_child;

		$category_child = DB::table('category_child as cc')
								->leftJoin('category_parent as cp', 'cc.id_parent', '=', 'cp.id')
								->leftJoin('category_root as cr', 'cp.id_root', '=', 'cr.id')
								->select(
									'cr.id as crid',
									'cr.name as crname',
									'cp.id as cpid',
									'cp.name as cpname',
									'cc.id as ccid',
									'cc.name as ccname',
									'cc.commision as cccommision'
									)
								->orderBy('cr.name','asc')
								->orderBy('cp.name','asc')
								->orderBy('cc.name','asc')
								->get();
		$data['categories_child'] = $category_child;

		$category_parent = DB::table('category_parent as cp')
								->leftJoin('category_root as cr', 'cp.id_root', '=', 'cr.id')
								->select(
									'cr.id as crid',
									'cr.name as crname',
									'cp.id as cpid',
									'cp.name as cpname'
									)
								->orderBy('cr.name','asc')
								->orderBy('cp.name','asc')
								->get();
		$data['categories_parent'] = $category_parent;
		return View::make('merchant/add_product', $data);
	}

	public function getParent(){

		$id = Input::get('id');

		$category_parent = new CategoryParent();

		$data['categories_parent'] = $category_parent->getParent($id);

		return $data;
	}

	public function getChild(){

		$id = Input::get('id');

		$category_child = new CategoryChild();

		$data['categories_child'] = $category_child->getChild($id);

		return $data;
	}

	public function getChildAll(){

		$id = Input::get('id');

		$category_child = new CategoryChild();

		$data['categories_child'] = $category_child->getChildAll($id);

		return $data;
	}

	public function getGrandChild(){

		$id = Input::get('id');

		$category_grand_child = new CategoryGrandChild();

		$data['categories_grand_child'] = $category_grand_child->getGrandChild($id);

		return $data;
	}

	public function getConfigProduct(){

		$category = Input::get('category');
		
		$size = new Size();
		$data['size'] = Size::where('category_id', '=', $category)->first();

		$des = new Description();
		$data['description'] = Description::where('category_id', '=', $category)->first();
		if(count($data['description']) > 0){
			$data['description']['temp_deskripsi'] = urldecode($data['description']['temp_deskripsi']);
		}
		return $data;
	}

	public function doAddProduct(){

		if(Input::get('category_grand_child') == 0){
			if(Input::get('category_child') == 0){
				return Redirect::to(URL::to('merchant/addProduct'))->with("error", "Category belum dipilih");
			}
		}

		if(Input::get('color') == 0){
			return Redirect::to(URL::to('merchant/addProduct'))->with("error", "Warna belum dipilih");
		}else{
			$col = Colour::find(Input::get('color'));
			$color = $col['nama'];
		}

		if(Input::get('size') == 0){
			$size = Input::get('size');
		}else{
			$total_size = implode(",",Input::get('temp_size'));
			$size = Input::get('size');
		}

		if(Input::get('quantity') == 0){
			$total_quantity = Input::get('quantity');
		}else{
			$quantity = Input::get('quantity');
			$total_quantity = 0;
			foreach (Input::get('quantity') as $key => $value) {
				$total_quantity += $value;
			}
		}

		if(Input::get('description') == 0){
			$description = Input::get('description');
			$val_description = Input::get('description');
		}else{
			$description = Input::get('description');
			$val_description = Input::get('description');
			$satuan = Input::get('satuan');
			$jenis_deskripsi = Input::get('jenis_description');

			$temp_description = "
				<strong>Deskripsi</strong>
				<table class='table'>";
			foreach($description as $key => $desc){
				$temp_description .= "
				<tr>
				<td>$jenis_deskripsi[$key]</td>
				<td>$desc $satuan[$key]</td>
				</tr>
				";
			}
			$temp_description .= "</table>";

			$temp_val_description = "";
			foreach($val_description as $key => $desc){
				$temp_val_description .= "
				<label>$jenis_deskripsi[$key]</label>
				<div class='input-group'>
				<input type='text' class='form-control' name='description[]' value='$desc' placeholder='Masukkan $jenis_deskripsi[$key]' required/>
				<input type='hidden' class='form-control' name='jenis_description[]' value='$jenis_deskripsi[$key]'/>
				<input type='hidden' class='form-control' name='satuan[]' value='$satuan[$key]'/>
				<span class='input-group-addon'>$satuan[$key]</span>
				</div>
				<br/>
				";
			}
		}

		if(Input::get('pdkgudang') == 'yes'){
			$pdkgudang = Input::get('pdkgudang');
		}else{
			$pdkgudang = 'no';
		}
		
		$merchant = Merchant::where('email', '=', Session::get('merchant_email'))->first();

		// $link = MerchantHelper::savePicture(Input::file('main_picture'));

		$data_product = new Product();
		preg_match("/(.*) \- (.*)/", Input::get('discount_date'), $match);
		$discount_date_start = new DateTime($match[1]);
		$discount_date_end = new DateTime($match[2]);
		$data_product->merchant_id = $merchant->id;
		$data_product->category_id = (Input::get('category_grand_child') != 0) ? Input::get('category_grand_child') : Input::get('category_child');
		$data_product->name = Input::get('name');
		$data_product->price = Input::get('price');
		$data_product->quantity = $total_quantity;
		$data_product->temp_quantity = $total_quantity;
		$data_product->weight = Input::get('weight');
		$data_product->discount = Input::get('discount');
		$data_product->discount_date_start = $discount_date_start;
		$data_product->discount_date_end = $discount_date_end;
		$data_product->brand = Input::get('brand');
		$data_product->image_link = 'link';
		$data_product->description = isset($temp_description) ? urlencode($temp_description) : $description;
		$data_product->val_description = isset($temp_val_description) ? urlencode($temp_val_description) : $val_description;
		$data_product->is_active = $pdkgudang;
		$data_product->size = $total_size;
		$data_product->color = $color;			
		$data_product->level = (Input::get('category_grand_child') != 0) ? 4 : 3;
		$data_product->save();
		$product_id = $data_product->id;


		foreach(Input::get('size') as $key => $value){
			$product_detail = new ProductDetail();
			$product_detail->product_id = $product_id;
			$product_detail->quantity = $quantity[$key];
			$product_detail->temp_quantity = $quantity[$key];
			$product_detail->description = isset($temp_description) ? urlencode($temp_description) : $description;
			$product_detail->val_description = isset($temp_val_description) ? urlencode($temp_val_description) : $val_description;
			$product_detail->size = $size[$key];
			$product_detail->color = $color;
			$product_detail->weight = Input::get('weight');
			$product_detail->save();
		}
		

		// if(Input::get('spec_name1') !=NULL && Input::get('spec1') !=NULL) $product_spec->insertProductSpec($product_id, Input::get('spec_name1'), Input::get('spec1'));
		// if(Input::get('spec_name2') !=NULL && Input::get('spec2') !=NULL) $product_spec->insertProductSpec($product_id, Input::get('spec_name2'), Input::get('spec2'));
		// if(Input::get('spec_name3') !=NULL && Input::get('spec3') !=NULL) $product_spec->insertProductSpec($product_id, Input::get('spec_name3'), Input::get('spec3'));
		// if(Input::get('spec_name4') !=NULL && Input::get('spec4') !=NULL) $product_spec->insertProductSpec($product_id, Input::get('spec_name4'), Input::get('spec4'));

		$product_image = new ProductImage();

		$images = Input::file('images');
		$has = false;
		foreach ($images as $idx => $image) {
			if (is_null($image)) continue;
			$image_link = MerchantHelper::savePicture($image, $product_id);
			$product_image->insertProductImage($product_id, $image_link);
			if (!$has) {
				$data_product->image_link = $image_link;
				$data_product->save();
				$has = true;
			}
		}

		// for($i=0; $i<5; $i++){
		// 	$str = 'picture'.$i;
		// 	if(Input::file($str) !=NULL){
		// 		$image_link = MerchantHelper::savePicture(Input::file($str));
		// 		$product_image->insertProductImage($product_id, $image_link);
		// 	}
		// }
		
		
		return Redirect::to('merchant/productList');
	}

	public function getIndexEditProduct($id){

		$merchant = Merchant::where('email', '=', Session::get('merchant_email'))->first();

		$product_id = $id;
		$category_root = new CategoryRoot();

		$product_spec = new ProductSpec();
		$colour = new Colour();

		$data['products'] = Product::where('product.id', '=', $product_id)
							->leftJoin('category_child as cc', 'product.category_id', '=', 'cc.id')
							->leftJoin('category_parent as cp', 'cc.id_parent', '=', 'cp.id')
							->leftJoin('category_root as cr', 'cp.id_root', '=', 'cr.id')
							->select(
								'product.*',
								'cr.id as crid',
								'cr.name as crname',
								'cp.id as cpid',
								'cp.name as cpname',
								'cc.id as ccid',
								'cc.name as ccname',
								'cc.commision as cccommision'
								)
							->orderBy('product.id','asc')
							->first();

		$data['products_grand'] = Product::where('product.id', '=', $product_id)
							->leftJoin('category_grand_child as cgc', 'product.category_id', '=', 'cgc.id')
							->leftJoin('category_child as cc', 'cgc.id_child', '=', 'cc.id')
							->leftJoin('category_parent as cp', 'cc.id_parent', '=', 'cp.id')
							->leftJoin('category_root as cr', 'cp.id_root', '=', 'cr.id')
							->select(
								'product.*',
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
							->orderBy('product.id','asc')
							->first();
		if ($data['products']->merchant_id !== $merchant->id) {
			return Redirect('merchant');
		}

		$category_id = $data['products']->category_id;

		$category = new CategoryChild();
		$category_root = new CategoryRoot();
		$category_parent = new CategoryParent();
		$category_child = new CategoryChild();
		$category_grand_child = new CategoryGrandChild();
		$data['category_root'] = $category_root->getAll();
		$data['category'] = CategoryGrandChild::where('id', '=', $category_id)->first();

		if($data['products']->level == 4){
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
									->where('cgc.id', '=', $category_id)
									->first();
		}else{
			$data['categories'] = DB::table('category_child as cc')
									->leftJoin('category_parent as cp', 'cc.id_parent', '=', 'cp.id')
									->leftJoin('category_root as cr', 'cp.id_root', '=', 'cr.id')
									->select(
										'cr.id as crid',
										'cr.name as crname',
										'cp.id as cpid',
										'cp.name as cpname',
										'cc.id as ccid',
										'cc.name as ccname',
										'cc.commision as cccommision'
										)
									->orderBy('cr.name','asc')
									->orderBy('cp.name','asc')
									->orderBy('cc.name','asc')
									->where('cc.id', '=', $category_id)
									->first();
		}

		$data['category_parent'] = $category_parent->getAllSelectedParent($data['categories']->crid);
		$data['category_child'] = $category_child->getAllSelectedChild($data['categories']->cpid);
		$data['category_grand_child'] = $category_grand_child->getAllSelectedGrandChild($data['categories']->ccid);

		$data['images'] = ProductImage::where('product_id', '=', $product_id)
											->orderBy('id','asc')
											->get();
		$data['product_detail'] = ProductDetail::where('product_id', '=', $product_id)->get();
		$data['colours'] = $colour->getAll();

		$data['colour'] = Colour::where('nama','=',$data['products']['color'])->first();
		$data['temp_size'] = Size::where('category_id','=',$data['products']['category_id'])->select('size')->first();
		$data['temp_desc'] = Description::where('category_id','=',$data['products']['category_id'])->first();

		if(count($data['products']) > 0){
			$data['products']['val_description'] = urldecode($data['products']['val_description']);
		}
		return View::make('merchant/edit_product', $data);
	}
	
	public function doEditProduct(){
	
		$merchant = Merchant::where('email', '=', Session::get('merchant_email'))->first();

		$data_product = Product::where('id', '=', Input::get('product_id'))->first();
		$product_detail = ProductDetail::where('product_id', '=', Input::get('product_id'))->get();
		if ($data_product->merchant_id !== $merchant->id) {
			App::abort(403, 'Unauthorized action.');
		}

		if(Input::get('category_grand_child') == 0){
			if(Input::get('category_child') == 0){
				return Redirect::to(URL::to('merchant/addProduct'))->with("error", "Category belum dipilih");
			}
		}

		if(Input::get('color') == 0){
			return Redirect::to(URL::to('merchant/addProduct'))->with("error", "Warna belum dipilih");
		}else{
			$col = Colour::find(Input::get('color'));
			$color = $col['nama'];
		}

		if(Input::get('size') == 0){
			$size = Input::get('size');
		}else{
			$size = implode(",",Input::get('size'));
		}

		$quantity = Input::get('quantity');

		if(Input::get('description') == 0){
			$description = Input::get('description');
			$val_description = Input::get('description');
		}else{
			$description = Input::get('description');
			$val_description = Input::get('description');
			$satuan = Input::get('satuan');
			$jenis_deskripsi = Input::get('jenis_description');

			$temp_description = "
				<strong>Deskripsi</strong>
				<table class='table'>";
			foreach($description as $key => $desc){
				$temp_description .= "
				<tr>
				<td>$jenis_deskripsi[$key]</td>
				<td>$desc $satuan[$key]</td>
				</tr>
				";
			}
			$temp_description .= "</table>";

			$temp_val_description = "";
			foreach($val_description as $key => $desc){
				$temp_val_description .= "
				<label>$jenis_deskripsi[$key]</label>
				<div class='input-group'>
				<input type='text' class='form-control' name='description[]' value='$desc' placeholder='Masukkan $jenis_deskripsi[$key]' required/>
				<input type='hidden' class='form-control' name='jenis_description[]' value='$jenis_deskripsi[$key]'/>
				<input type='hidden' class='form-control' name='satuan[]' value='$desc $satuan[$key]'/>
				<span class='input-group-addon'>$satuan[$key]</span>
				</div>
				<br/>
				";
			}
		}

		if(Input::get('pdkgudang') == 'yes'){
			$pdkgudang = Input::get('pdkgudang');
		}else{
			$pdkgudang = 'no';
		}

		preg_match("/(.*) \- (.*)/", Input::get('discount_date'), $match);
		$discount_date_start = new DateTime($match[1]);
		$discount_date_end = new DateTime($match[2]);
		$data_product->category_id = (Input::get('category_grand_child') != 0) ? Input::get('category_grand_child') : Input::get('category_child');
		$data_product->name = Input::get('name');
		$data_product->price = Input::get('price');
		$data_product->weight = Input::get('weight');
		$data_product->discount = Input::get('discount');
		$data_product->discount_date_start = $discount_date_start;
		$data_product->discount_date_end = $discount_date_end;
		$data_product->brand = Input::get('brand');
		$data_product->image_link = 'link';
		$data_product->description = isset($temp_description) ? urlencode($temp_description) : $description;
		$data_product->val_description = isset($temp_val_description) ? urlencode($temp_val_description) : $val_description;
		$data_product->is_active = $pdkgudang;
		$data_product->size = $size;
		$data_product->color = $color;
		$data_product->level = (Input::get('category_grand_child') != 0) ? 4 : 3;
		$data_product->save();

		foreach($product_detail as $key => $value){
			$product_detail[$key]->quantity = $value['quantity'] + $quantity[$key];
			$product_detail[$key]->temp_quantity = $value['temp_quantity'] + $quantity[$key];
			$product_detail[$key]->save();
		}

		foreach ($quantity as $key => $value) {
			$data_product->quantity = $data_product->quantity + $value;
			$data_product->temp_quantity = $data_product->temp_quantity + $value;
			$data_product->save();
		}
				

		$usedImageIndex = [];
		$has = false;
		$indices = Input::get('images_id');
		foreach ($indices as $index) {
			if ($index) {
				$usedImageIndex[] = $index;
				$has = true;
			}
		}
		ProductImage::where('product_id', $data_product->id)->whereNotIn('id', $usedImageIndex)->delete();

		$images = Input::file('images');
		$product_image = new ProductImage;
		foreach ($images as $idx => $image) {
			if (is_null($image)) continue;
			$image_link = MerchantHelper::savePicture($image, $data_product->id);
			$product_image->insertProductImage($data_product->id, $image_link);
			if (!$has) {
				$data_product->image_link = $image_link;
				$data_product->save();
				$has = true;
			}
		}

		$product_image = ProductImage::where('product_id', $data_product->id)
											->orderBy('id','asc')
											->first();
		if (isset($product_image)) {
			$data_product->image_link = $product_image->image_link;
			$data_product->save();
		}

		// $product_id = $data_product->editProduct(Input::get('product_id'), $merchant->id, Input::get('category'), Input::get('name'), Input::get('price'), Input::get('quantity'), Input::get('weight'), Input::get('discount'), Input::get('discount_date_start'), Input::get('discount_date_end'), Input::get('brand'), Input::get('description'), Input::get('pdkgudang'));
		// $product_spec = new ProductSpec();

		// $product_spec->deleteProductSpec($product_id);

		// if(Input::get('spec_name1') !=NULL && Input::get('spec1') !=NULL) $product_spec->insertProductSpec($product_id, Input::get('spec_name1'), Input::get('spec1'));
		// if(Input::get('spec_name2') !=NULL && Input::get('spec2') !=NULL) $product_spec->insertProductSpec($product_id, Input::get('spec_name2'), Input::get('spec2'));
		// if(Input::get('spec_name3') !=NULL && Input::get('spec3') !=NULL) $product_spec->insertProductSpec($product_id, Input::get('spec_name3'), Input::get('spec3'));
		// if(Input::get('spec_name4') !=NULL && Input::get('spec4') !=NULL) $product_spec->insertProductSpec($product_id, Input::get('spec_name4'), Input::get('spec4'));

		
		
		return Redirect::to('merchant/editProduct/'.$data_product->id);
	}
	
	public function doDeleteImage(){
		$product_id = Input::get('product_id');
		$image_id = Input::get('image_id');

		$data_product_image = ProductImage::where('id','=',$image_id)->get();
		$files = array();
		foreach ($data_product_image as $key => $value) {
			$files[] = $value['image_link'];
		}
		File::delete($files);

		$delete_product_image = ProductImage::where('id','=',$image_id);
		$delete_product_image->delete();

		$product_image = ProductImage::where('product_id', $product_id)
											->orderBy('id','asc')
											->first();
											
		if (isset($product_image)) {
			$edit_product = Product::where('id', '=', $product_id)->first();
			$edit_product->image_link = $product_image->image_link;
			$edit_product->save();
		}
	

		return Redirect::to('merchant/editProduct?product_id='.$product_id);
	}

	public function getIndexProductList(){

		$merchant = Merchant::where('email', '=', Session::get('merchant_email'))->first();
		// $data['product'] = Product::where('merchant_id', '=', $merchant->id)
		// 					->leftJoin('category_grand_child as cgc', 'product.category_id', '=', 'cgc.id')
		// 					->get();

		$data['products_grand'] = Product::where('merchant_id', '=', $merchant->id)
							->leftJoin('category_grand_child as cgc', 'product.category_id', '=', 'cgc.id')
							->leftJoin('category_child as cc', 'cgc.id_child', '=', 'cc.id')
							->leftJoin('category_parent as cp', 'cc.id_parent', '=', 'cp.id')
							->leftJoin('category_root as cr', 'cp.id_root', '=', 'cr.id')
							->select(
								'product.*',
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
							->orderBy('product.id','asc')
							->get();

		$data['products'] = Product::where('merchant_id', '=', $merchant->id)
							->leftJoin('category_child as cc', 'product.category_id', '=', 'cc.id')
							->leftJoin('category_parent as cp', 'cc.id_parent', '=', 'cp.id')
							->leftJoin('category_root as cr', 'cp.id_root', '=', 'cr.id')
							->select(
								'product.*',
								'cr.id as crid',
								'cr.name as crname',
								'cp.id as cpid',
								'cp.name as cpname',
								'cc.id as ccid',
								'cc.name as ccname',
								'cc.commision as cccommision'
								)
							->orderBy('product.id','asc')
							->get();

		return View::make('merchant/product_list', $data);
	}

	public function doDeleteProduct($id){
		
		$product_id = $id;

		$data_product = Product::find($product_id);
		$data_product->delete();
		
		$data_product_image = ProductImage::where('product_id','=',$product_id)->get();
		$files = array();
		foreach ($data_product_image as $key => $value) {
			$files[] = $value['image_link'];
		}
		File::delete($files);

		$delete_product_image = ProductImage::where('product_id','=',$product_id);
		$delete_product_image->delete();

		$merchant = Merchant::where('email', '=', Session::get('merchant_email'))->first();

		return Redirect::to('merchant/productList');
	}

	public function getIndexReport(){

		$merchant = Merchant::where('merchant.email', '=', Session::get('merchant_email'))->first();
		
		$data['transactions'] = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
				->leftJoin('user_address', 'user_address.id', '=', 'transaction.address_id')
				->leftJoin('transaction_detail', 'transaction_detail.transaction_id', '=', 'transaction.id')
				->leftJoin('transaction_resi', 'transaction_resi.transaction_id', '=', 'transaction.id')
				->where('transaction_detail.merchant_id', '=', $merchant->id)
				->where('transaction_detail.is_accepted', '=', 'yes')
				->where('transaction_detail.is_counted', '=', 'yes')
				->select('user.first_name as user_name', 'user_address.alamat as user_address', 'transaction.*', 'transaction_resi.resi as resi')
				->orderBy('transaction.id')
				->distinct('transaction.id')
				->get();

		return View::make('merchant/report', $data);
	}

	public function getIndexReportDetail(){

		$transaction_detail = new TransactionDetail();

		$merchant = Merchant::where('merchant.email', '=', Session::get('merchant_email'))->first();
		$transaction_id = Input::get('id');
		
		$data['transaction'] = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
				->leftJoin('user_address', 'user_address.user_id', '=', 'transaction.user_id')
				->where('transaction.id', '=', $transaction_id)
				->select('transaction.*', 'user.first_name as user_name', 'user_address.alamat as user_address', 'user_address.phone_number as phone_number', 'user_address.postal_code as postal_code', 'user_address.city as city')
				->first();

		$data['transaction_details'] = $transaction_detail->getDetailMerchant($transaction_id, $merchant->id);
		$data['transaction_resi'] = TransactionResi::where('merchant_id', '=', $merchant->id)->where('transaction_id', '=', $transaction_id)->first();

		return View::make('merchant/report_detail', $data);
	}

	public function getIndexMessage(){

		$merchant = Merchant::where('email', '=', Session::get('merchant_email'))->first();
		$data['messages'] = Message::where('merchant_id', '=', $merchant->id)
							->leftJoin('user', 'user.id', '=', 'message.user_id')
							->select('message.*', 'user.first_name as user_first_name', 'user.last_name as user_last_name')
							->get();
		$data['count'] =  DB::table('message')
		                     ->select(DB::raw('count(message.is_read) as user_count, message.*'))
		                     ->where('is_read', '=', 'no')
		                     ->groupBy('user_id')
		                     ->get();

		return View::make('merchant/message', $data);
	}

	public function getIndexOrder(){

		$merchant = Merchant::where('merchant.email', '=', Session::get('merchant_email'))->first();
		$transaction = new Transaction();

		$data['transactions'] = $transaction->getAllPaidByMerchantID($merchant->id);

		$data['accepted_transactions'] = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
				->leftJoin('user_address', 'user_address.id', '=', 'transaction.address_id')
				->leftJoin('transaction_detail', 'transaction_detail.transaction_id', '=', 'transaction.id')
				->where('transaction_detail.merchant_id', '=', $merchant->id)
				->where('transaction_detail.is_accepted', '=', 'yes')
				->where('transaction.sent_status', '=', 'no')
				->select('user.*', 'user_address.alamat as user_address', 'transaction.*')
				->orderBy('transaction.id')
				->distinct('transaction.id')
				->get();

		$data['rejected_transactions'] = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
				->leftJoin('user_address', 'user_address.id', '=', 'transaction.address_id')
				->leftJoin('transaction_detail', 'transaction_detail.transaction_id', '=', 'transaction.id')
				->where('transaction_detail.merchant_id', '=', $merchant->id)
				->where('transaction_detail.is_accepted', '=', 'declined')
				->select('user.*', 'user_address.alamat as user_address', 'transaction.*')
				->orderBy('transaction.id')
				->distinct('transaction.id')
				->get();
				
		$data['sent_transactions'] = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
				->leftJoin('user_address', 'user_address.id', '=', 'transaction.address_id')
				->leftJoin('transaction_detail', 'transaction_detail.transaction_id', '=', 'transaction.id')
				->where('transaction_detail.merchant_id', '=', $merchant->id)
				->where('transaction.sent_status', '=', 'yes')
				->select('user.*', 'user_address.alamat as user_address', 'transaction.*')
				->orderBy('transaction.id')
				->distinct('transaction.id')
				->get();

		$data['received_transactions'] = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
				->leftJoin('user_address', 'user_address.id', '=', 'transaction.address_id')
				->leftJoin('transaction_detail', 'transaction_detail.transaction_id', '=', 'transaction.id')
				->where('transaction_detail.merchant_id', '=', $merchant->id)
				->where('transaction.received_status', '=', 'yes')
				->select('user.*', 'user_address.alamat as user_address', 'transaction.*')
				->orderBy('transaction.id')
				->distinct('transaction.id')
				->get();
				
		$data['title'] = 'Order';

		return View::make('merchant/order', $data);
	}
	
	/*
	public function getIndexOrder(){

		$merchant = Merchant::where('merchant.email', '=', Session::get('merchant_email'))->first();
		$transaction = new Transaction();

		$data['transactions'] = $transaction->getAllPaidByMerchantID($merchant->id);

		$data['accepted_transactions'] = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
				->leftJoin('user_address', 'user_address.id', '=', 'transaction.address_id')
				->leftJoin('transaction_detail', 'transaction_detail.transaction_id', '=', 'transaction.id')
				->leftJoin('transaction_resi', 'transaction_resi.transaction_id', '=', 'transaction.id')
				->where('transaction_detail.merchant_id', '=', $merchant->id)
				->where('transaction_detail.is_accepted', '=', 'yes')
				->select('user_address.name as user_name', 'user_address.address as user_address', 'transaction.*', 'transaction_resi.resi as resi')
				->orderBy('transaction.id')
				->distinct('transaction.id')
				->get();

		$data['title'] = 'Order';

		return View::make('merchant/order', $data);
	}*/

	public function getIndexOrderDetail($id){

		$transaction_detail = new TransactionDetail();

		$merchant = Merchant::where('merchant.email', '=', Session::get('merchant_email'))->first();
		$transaction_id = $id;
		
		$data['transaction'] = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
				->join('transaction_address', 'transaction_address.id', '=', 'transaction.user_address_temp')
				->where('transaction.id', '=', $transaction_id)
				->select('transaction.*', 'user.first_name as first_name', 'user.last_name as last_name', 'transaction_address.alamat as user_address', 'transaction_address.nomer_hp as phone_number', 'transaction_address.kode_pos as postal_code', 'transaction_address.kota as city', 'transaction_address.provinsi as district')
				->first();
		if(!$data['transaction']){
			$data['transaction'] = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
				->leftJoin('user_address', 'user_address.id', '=', 'transaction.user_address')
				->where('transaction.id', '=', $transaction_id)
				->select('transaction.*', 'user.first_name as first_name', 'user.last_name as last_name', 'user_address.alamat as user_address', 'user_address.nomer_hp as phone_number', 'user_address.kode_pos as postal_code', 'user_address.kota as city', 'user_address.provinsi as district')
				->first();
		}
		//$data['shipping_fee'] = TransactionShippingFee::where('transaction_id', '=', $transaction_id)->where('merchant_id', '=', $merchant->id)->first();
		$data['transaction_details'] = $transaction_detail->getDetailMerchant($transaction_id, $merchant->id);

		//if($data['transaction_details'][0]->is_accepted !='pending') return Redirect::to('merchant/order');

		return View::make('merchant/order_detail', $data);
	}

	public function doAcceptOrder($id){

		$merchant = Merchant::where('merchant.email', '=', Session::get('merchant_email'))->first();
		$transaction_id = $id;

		$transact = DB::table('transaction_detail')
		            ->where('transaction_id', $transaction_id)
		            ->where('merchant_id', $merchant->id)
		            ->first();

		$data_product = Product::where('id', '=', $transact->product_id)->first();
        $data_product->temp_quantity = $data_product->temp_quantity - $transact->quantity;
        $data_product->save();

		// print_r($transact);exit;

		DB::table('transaction_detail')
            ->where('transaction_id', $transaction_id)
            ->where('merchant_id', $merchant->id)
            ->update(array('is_accepted' => 'yes'));

        //insert notification
		$transaction_detail_notification = new TransactionDetailNotification();
		$transaction_detail_notification->insertData($transaction_id, $merchant->id, 'Merchant Menerima Order');

        return Redirect::to('merchant/order');
	}

	public function doDeclineOrder($id){

		$merchant = Merchant::where('merchant.email', '=', Session::get('merchant_email'))->first();
		$transaction_id = $id;

		DB::table('transaction_detail')
            ->where('transaction_id', $transaction_id)
            ->where('merchant_id', $merchant->id)
            ->update(array('is_accepted' => 'declined'));

        $transact = DB::table('transaction_detail')
		            ->where('transaction_id', $transaction_id)
		            ->where('merchant_id', $merchant->id)
		            ->first();

		$data_product = Product::where('id', '=', $transact->product_id)->first();
        $data_product->quantity = $data_product->quantity + $transact->quantity;
        $data_product->save();

        //insert notification
		$transaction_detail_notification = new TransactionDetailNotification();
		$transaction_detail_notification->insertData($transaction_id, $merchant->id, 'Merchant Menolak Order');

        return Redirect::to('merchant/order');

	}

	public function doTransactionSent($id)
	{
		$id = $id;
		
		$transaction = new Transaction();
		$transaction->merchantDoSent( $id );

		return Redirect::to('merchant/order');
	}
	
	public function getIndexAcceptedOrder(){

		$merchant = Merchant::where('merchant.email', '=', Session::get('merchant_email'))->first();
		
		$data['transactions'] = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
				->leftJoin('user_address', 'user_address.id', '=', 'transaction.address_id')
				->leftJoin('transaction_detail', 'transaction_detail.transaction_id', '=', 'transaction.id')
				->where('transaction_detail.merchant_id', '=', $merchant->id)
				->where('transaction_detail.is_accepted', '=', 'yes')
				->select('user.*', 'user_address.alamat as user_address', 'transaction.*')
				->orderBy('transaction.id')
				->distinct('transaction.id')
				->get();

		return View::make('merchant/accepted_order', $data);
	}

	public function getIndexAcceptedOrderDetail($id){

		$transaction_detail = new TransactionDetail();

		$merchant = Merchant::where('merchant.email', '=', Session::get('merchant_email'))->first();
		$transaction_id = $id;
		
		$data['transaction'] = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
				->join('transaction_address', 'transaction_address.id', '=', 'transaction.user_address_temp')
				->where('transaction.id', '=', $transaction_id)
				->select('transaction.*', 'user.first_name as first_name', 'user.last_name as last_name', 'transaction_address.alamat as user_address', 'transaction_address.nomer_hp as phone_number', 'transaction_address.kode_pos as postal_code', 'transaction_address.kota as city', 'transaction_address.provinsi as district')
				->first();
		if(!$data['transaction']){
			$data['transaction'] = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
				->leftJoin('user_address', 'user_address.id', '=', 'transaction.user_address')
				->where('transaction.id', '=', $transaction_id)
				->select('transaction.*', 'user.first_name as first_name', 'user.last_name as last_name', 'user_address.alamat as user_address', 'user_address.nomer_hp as phone_number', 'user_address.kode_pos as postal_code', 'user_address.kota as city', 'user_address.provinsi as district')
				->first();
		}
		//$data['shipping_price'] = TransactionShippingFee::where('transaction_id', '=', $transaction_id)->where('merchant_id', '=', $merchant->id)->first()->shipping_price;		
		$data['transaction_details'] = $transaction_detail->getDetailMerchant($transaction_id, $merchant->id);
		$data['merchant_id'] = Session::get('merchant_id');

		$data['transaction_resi'] = TransactionResi::where('merchant_id', '=', $merchant->id)->where('transaction_id', '=', $transaction_id)->first();

		//$data['transaction_resi'] = TransactionResi::where('merchant_id', '=', $merchant->id)->where('transaction_id', '=', $transaction_id)->first();

		return View::make('merchant/accepted_order_detail', $data);
	}

	public function getIndexRejectedOrderDetail($id){

		$transaction_detail = new TransactionDetail();

		$merchant = Merchant::where('merchant.email', '=', Session::get('merchant_email'))->first();
		$transaction_id = $id;
		
		$data['transaction'] = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
				->join('transaction_address', 'transaction_address.id', '=', 'transaction.user_address_temp')
				->where('transaction.id', '=', $transaction_id)
				->select('transaction.*', 'user.first_name as first_name', 'user.last_name as last_name', 'transaction_address.alamat as user_address', 'transaction_address.nomer_hp as phone_number', 'transaction_address.kode_pos as postal_code', 'transaction_address.kota as city', 'transaction_address.provinsi as district')
				->first();
		if(!$data['transaction']){
			$data['transaction'] = Transaction::leftJoin('user', 'user.id', '=', 'transaction.user_id')
				->leftJoin('user_address', 'user_address.id', '=', 'transaction.user_address')
				->where('transaction.id', '=', $transaction_id)
				->select('transaction.*', 'user.first_name as first_name', 'user.last_name as last_name', 'user_address.alamat as user_address', 'user_address.nomer_hp as phone_number', 'user_address.kode_pos as postal_code', 'user_address.kota as city', 'user_address.provinsi as district')
				->first();
		}
		//$data['shipping_price'] = TransactionShippingFee::where('transaction_id', '=', $transaction_id)->where('merchant_id', '=', $merchant->id)->first()->shipping_price;		
		$data['transaction_details'] = $transaction_detail->getDetailMerchant($transaction_id, $merchant->id);
		$data['merchant_id'] = Session::get('merchant_id');

		$data['transaction_resi'] = TransactionResi::where('merchant_id', '=', $merchant->id)->where('transaction_id', '=', $transaction_id)->first();

		//$data['transaction_resi'] = TransactionResi::where('merchant_id', '=', $merchant->id)->where('transaction_id', '=', $transaction_id)->first();

		return View::make('merchant/rejected_order_detail', $data);
	}

	public function doInsertResi(){

		$transaction_id = Input::get('transaction_id');
		$resi = Input::get('resi');
		$merchant_id = Input::get('merchant_id');

		$transaction_resi = new TransactionResi();
		$transaction_resi->transaction_id = $transaction_id;
		$transaction_resi->merchant_id = $merchant_id;
		$transaction_resi->resi = $resi;
		$transaction_resi->save();

		//insert notification
		$transaction_detail_notification = new TransactionDetailNotification();
		$transaction_detail_notification->insertData($transaction_id, $merchant_id, 'Pengiriman telah di proses merchant');

		return Redirect::back();

	}

	public function generateForgotPasswordCode(){

		$data_merchant = Merchant::where('email', '=', Input::get('email'))->where('is_accepted', '=', 'yes')->first();
		if(empty($data_merchant)){
			$error_code = "Email tidak ada";
			return Redirect::to('merchant/forgotPassword')->with('error_code', $error_code);
		}

		$resetPasswordCode = UserHelper::newResetPasswordCode();

		if(!($data_merchant ===NULL)){
			$data_merchant->reset_password_code = $resetPasswordCode;

			if($data_merchant->save()){
				//send confirmation email
				EmailHelper::sendResetCodeMerchant($data_merchant);
			}
		}
		return Redirect::to('/info')->with('info_data', 'Sebuah link untuk reset password telah terkirim ke email anda');
	}

	public function resetPassword($reset_password_code){

		$data_merchant = Merchant::where('reset_password_code', '=', $reset_password_code)->first();
		if($data_merchant ===NULL){
			return Redirect::to('/');
		}
		else{
			return View::make('merchant.reset_password')->with('merchant_id', $data_merchant->id);
		}
	}

	public function doResetPassword(){
		$merchant_id = Input::get('merchant_id');
		$data_merchant = Merchant::where('id', '=', $merchant_id)->first();

		$data_merchant->password = md5(Input::get('password'));
		$data_merchant->reset_password_code = "";
		$data_merchant->save();

		$data['merchant'] = $data_merchant;

		return Redirect::to('/merchant/info');

	}

	public function generateReportMerchantSales(){

		$start_date = Input::get('start_date');
		$end_date = Input::get('end_date');


		$merchant = Merchant::where('merchant.email', '=', Session::get('merchant_email'))->first();

		$data['merchant'] = $merchant;
		$data['start_date'] = $start_date;
		$data['end_date'] = $end_date;

		$data['mlm_merchants'] = MlmMerchant::where('mlm_merchant.merchant_id', '=', $merchant->id)
												->where('mlm_merchant.created_at', '>=', $start_date)
												->where('mlm_merchant.created_at', '<=', $end_date)
												->leftJoin('transaction_detail', 'transaction_detail.id', '=', 'mlm_merchant.transaction_detail_id')
												->leftJoin('transaction_resi', function($join) use ($merchant)
											        {
											            $join->on('transaction_detail.transaction_id', '=', 'transaction_resi.transaction_id')
											            		->where('transaction_resi.merchant_id', '=', $merchant->id);
											        })
												->leftJoin('product', 'product.id', '=', 'transaction_detail.product_id')
												->where('transaction_detail.is_counted', '=', 'yes')
												->select('product.*', 'transaction_resi.*', 'transaction_detail.*', 'mlm_merchant.*')
												->get();

		/*
		$transaction_detail_id_list = MlmMerchant::where('merchant_id', '=', $merchant->id)
												->where('created_at', '>=', $start_date)
												->where('created_at', '<=', $end_date)
												->lists('transaction_detail_id');

		$data['transaction_details'] = TransactionDetail::whereIn('id', $transaction_detail_id_list)->get();
		*/
		
		return PDF::loadView('report.report_merchant', $data)->stream();
	}
	
	public function doUpdatePassword() {
		$merchant_id = Input::get('merchant_id');
		$merchant = Merchant::find($merchant_id);

		$new_password = Input::get('new_password');
		if ($new_password !== Input::get('new_password_confirmation')) {
			return Redirect::to('merchant/info')->with('error', 'Konfirmasi password tidak cocok!');
		}

		if ($merchant->password !== md5(Input::get('current_password'))) {
			return Redirect::to('merchant/info')->with('error', 'Password sekarang tidak cocok!');
		}

		$merchant->password = md5($new_password);
		$merchant->save();
		return Redirect::to('merchant/info')->with('message', 'Password berhasil diubah!');
	}

	public function doUpdateGeneralInformation() {
		$merchant_id = Input::get('merchant_id');
		$merchant = Merchant::find($merchant_id);

		$merchant->name = Input::get('name');
		$merchant->shop_name = Input::get('shop_name');
		$merchant->company_name = Input::get('company_name');
		$merchant->phone_number = Input::get('phone_number');
		$merchant->email = Input::get('email');
		$merchant->person_in_charge = Input::get('person_in_charge');
		$merchant->ic_number = Input::get('ic_number');

		$merchant->save();
		return Redirect::to('merchant/info')->with('message', 'Informasi umum berhasil diubah!');
	}
	
	public function doUpdatePaymentInformation() {
		$merchant_id = Input::get('merchant_id');
		$merchant = Merchant::find($merchant_id);

		$merchant->account_number = Input::get('account_number');
		$merchant->account_name = Input::get('account_name');
		$merchant->account_bank = Input::get('account_bank');

		$merchant->save();
		return Redirect::to('merchant/info')->with('message', 'Informasi rekening berhasil diubah!');
	}

	public function doUpdateAddressInformation() {
		$merchant_id = Input::get('merchant_id');
		$merchant = Merchant::find($merchant_id);

		$merchant->address = Input::get('address');
		$merchant->province = Input::get('province');
		$merchant->city = Input::get('city');
		$merchant->district = Input::get('district');
		$merchant->postal_code = Input::get('postal_code');

		$merchant->save();
		return Redirect::to('merchant/info')->with('message', 'Informasi alamat berhasil diubah!');
	}
}











