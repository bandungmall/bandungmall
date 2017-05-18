<?php

class ProductController extends BaseController {

	public function getIndex($type, $category_id){

		$category_id = $category_id;
		if($category_id <= 10){
			Session::put('jenisKelamin',"wanita");
		} else {
			Session::put('jenisKelamin',"pria");
		}

		$product_id = Input::get('product_id');
		
		$product_cart = Product::where('id', '=', 19)->first();
		$data['product_cart'] = $product_cart;
		$data['product_cart_images'] = ProductImage::where('product_id', '=', 19)
														->orderBy('id','asc')
														->get();

		$data['products'] = Array();

		$category = new Category();

		$product = new Product();
		
		$category_root = new CategoryRoot();
		$category_parent = new CategoryParent();
		$category_child = new CategoryChild();
		$category_grand_child = new CategoryGrandChild();
		$data['category_root'] = $category_root->getAll();
		$data['category_parent'] = $category_parent->getAll();
		$data['category_child'] = $category_child->getAll();
		$data['category_grand_child'] = $category_grand_child->getAll();

		$data['categories'] = $category->getAll();
		if(isset($category_id)){
			//$data['products'] = $product->getProductByCategoryID($search, $category_id, $sort);
			// $data['products'] = Product::where('category_id', '=', $category_id)->paginate(9);
			if($type == "c"){
				$data['data_category_child'] = CategoryChild::where('id', '=', $category_id)->orderBy('name','asc')->first();
				$data['data_category_parent'] = CategoryParent::where('id', '=', $data['data_category_child']['id_parent'])->orderBy('name','asc')->first();
				$data['data_category_root'] = CategoryRoot::where('id', '=', $data['data_category_parent']['id_root'])->orderBy('name','asc')->first();
				
				$data['products'] = DB::table('product as p')
								->leftJoin('category_child as cc','cc.id','=','p.category_id')
								->where('p.category_id','=',$category_id)
								->where('p.level','=',3)
								->where('cc.name','=',$data['data_category_child']['name'])
								->select(
									'p.*',
									'cc.id as ccid',
									'cc.name as ccname',
									'cc.commision as cccommision'
									)
								->paginate(9);
			}else{
				$data['data_category_grand_child'] = CategoryGrandChild::where('id', '=', $category_id)->orderBy('name','asc')->first();
				$data['data_category_child'] = CategoryChild::where('id', '=', $data['data_category_grand_child']['id_child'])->orderBy('name','asc')->first();
				$data['data_category_parent'] = CategoryParent::where('id', '=', $data['data_category_child']['id_parent'])->orderBy('name','asc')->first();
				$data['data_category_root'] = CategoryRoot::where('id', '=', $data['data_category_parent']['id_root'])->orderBy('name','asc')->first();

				$data['products'] = DB::table('product as p')
								->leftJoin('category_grand_child as cgc','cgc.id','=','p.category_id')
								->where('p.category_id','=',$category_id)
								->where('p.level','=',4)
								->where('cgc.name','=',$data['data_category_grand_child']['name'])
								->select(
									'p.*',
									'cgc.id as cgcid',
									'cgc.name as cgcname',
									'cgc.commision as cgccommision'
									)
								->paginate(9);
			}

			// $data['category_parent'] = Category::where('id', '=', $data['category']['parent'])->orderBy('parent','asc')->orderBy('name','asc')->first();
		}
				
		// $data['data_category_parent'] = Category::where('parent', '=',z "0")->orderBy('name','asc')->get();
		// $data['data_category_child'] = Category::where('parent', '!=', "0")->orderBy('name','asc')->get();

		return View::make('user.product', $data);
	}

	public function getIndexList($type, $category_id){

		$category_id = $category_id;
		if($category_id <= 10){
			Session::put('jenisKelamin',"wanita");
		} else {
			Session::put('jenisKelamin',"pria");
		}

		$product_id = Input::get('product_id');
		
		$product_cart = Product::where('id', '=', 19)->first();
		$data['product_cart'] = $product_cart;
		$data['product_cart_images'] = ProductImage::where('product_id', '=', 19)
														->orderBy('id','asc')
														->get();

		$data['products'] = Array();

		$category = new Category();

		$product = new Product();

		$data['categories'] = $category->getAll();
		if(isset($category_id)){
			//$data['products'] = $product->getProductByCategoryID($search, $category_id, $sort);
			// $data['products'] = Product::where('category_id', '=', $category_id)->paginate(9);
			if($type == "c"){
				$data['data_category_child'] = CategoryChild::where('id', '=', $category_id)->orderBy('name','asc')->first();
				$data['data_category_parent'] = CategoryParent::where('id', '=', $data['data_category_child']['id_parent'])->orderBy('name','asc')->first();
				$data['data_category_root'] = CategoryRoot::where('id', '=', $data['data_category_parent']['id_root'])->orderBy('name','asc')->first();
				
				$data['products'] = DB::table('product as p')
								->leftJoin('category_child as cc','cc.id','=','p.category_id')
								->where('p.category_id','=',$category_id)
								->where('p.level','=',3)
								->where('cc.name','=',$data['data_category_child']['name'])
								->paginate(9);
				
			}else{
				$data['data_category_grand_child'] = CategoryGrandChild::where('id', '=', $category_id)->orderBy('name','asc')->first();
				$data['data_category_child'] = CategoryChild::where('id', '=', $data['data_category_grand_child']['id_child'])->orderBy('name','asc')->first();
				$data['data_category_parent'] = CategoryParent::where('id', '=', $data['data_category_child']['id_parent'])->orderBy('name','asc')->first();
				$data['data_category_root'] = CategoryRoot::where('id', '=', $data['data_category_parent']['id_root'])->orderBy('name','asc')->first();
				
				$data['products'] = DB::table('product as p')
								->leftJoin('category_grand_child as cgc','cgc.id','=','p.category_id')
								->where('p.category_id','=',$category_id)
								->where('p.level','=',4)
								->where('cgc.name','=',$data['data_category_grand_child']['name'])
								->paginate(9);
			}

			// $data['category_parent'] = Category::where('id', '=', $data['category']['parent'])->orderBy('parent','asc')->orderBy('name','asc')->first();
		}

		$category_root = new CategoryRoot();
		$category_parent = new CategoryParent();
		$category_child = new CategoryChild();
		$category_grand_child = new CategoryGrandChild();
		$data['category_root'] = $category_root->getAll();
		$data['category_parent'] = $category_parent->getAll();
		$data['category_child'] = $category_child->getAll();
		$data['category_grand_child'] = $category_grand_child->getAll();
				
		// $data['data_category_parent'] = Category::where('parent', '=', "0")->orderBy('name','asc')->get();
		// $data['data_category_child'] = Category::where('parent', '!=', "0")->orderBy('name','asc')->get();

		return View::make('user.product_list', $data);
	}

	public function getPria(){

		$data['products'] = Category::where('parent', '=', '2')->orderBy('parent','asc')->orderBy('name','asc')->get();
		$data['most_viewed_products'] = Product::where('is_active', '=', 'yes')
							->leftJoin('category as c1', 'c1.id', '=', 'product.category_id')
							->where('c1.parent', '=', '2')
							->leftJoin('category as c2', 'c2.id', '=', 'c1.parent')
							->select('product.*', 'c1.name as category_name', 'c2.name as category_parent_name')
							->orderBy('product.viewed', 'desc') 
							->take(4)->get();

		if(Session::has('jenisKelamin')){
			Session::put('jenisKelamin',"pria");
		}

		return View::make('user.pria', $data);
	}

	public function getWanita(){

		$data['products'] = Category::where('parent', '=', '1')->orderBy('parent','asc')->orderBy('name','asc')->get();
		$data['most_viewed_products'] = Product::where('is_active', '=', 'yes')
							->leftJoin('category as c1', 'c1.id', '=', 'product.category_id')
							->where('c1.parent', '=', '1')
							->leftJoin('category as c2', 'c2.id', '=', 'c1.parent')
							->select('product.*', 'c1.name as category_name', 'c2.name as category_parent_name')
							->orderBy('product.viewed', 'desc') 
							->take(4)->get();

		if(Session::has('jenisKelamin')){
			Session::put('jenisKelamin',"wanita");
		}

		return View::make('user.wanita', $data);
	}

	public function searchItem($keyword){
		$url = explode("/", $_SERVER['REQUEST_URI']);
		
		if($url[3] == "price"){
			$keyword = str_replace("p_","",$keyword);
			$price = $keyword;
		} elseif($url[3] == "date") { 
			$keyword = str_replace("d_","",$keyword);
			$date = $keyword;
		} elseif($url[3] == "sale") { 
			$keyword = str_replace("s_","",$keyword);
			$sale = $keyword;
		} elseif($url[3] == "colour") { 
			$keyword = str_replace("c_","",$keyword);
			$colour = $keyword;
		} 
		else {
			$search = $keyword;
		}
		$category_id = Input::get('category_id');
		if($category_id <= 10){
			Session::put('jenisKelamin',"wanita");
		} else {
			Session::put('jenisKelamin',"pria");
		}
		
		$brand = Input::get('brand');
		$sort = Input::get('sort');

		$product_id = Input::get('product_id');
		
		$product_cart = Product::where('id', '=', 19)->first();
		$data['product_cart'] = $product_cart;
		$data['product_cart_images'] = ProductImage::where('product_id', '=', 19)
														->orderBy('id','asc')
														->get();

		$data['products'] = Array();

		$category = new Category();

		$product = new Product();

		$data['categories'] = $category->getAll();
		if(isset($category_id)){
			//$data['products'] = $product->getProductByCategoryID($search, $category_id, $sort);
			$data['products'] = Product::where('category_id', '=', $category_id)->paginate(9);
			$data['category'] = Category::where('id', '=', $category_id)->orderBy('parent','asc')->orderBy('name','asc')->first();
			$data['category_parent'] = Category::where('id', '=', $data['category']['parent'])->orderBy('parent','asc')->orderBy('name','asc')->first();
		}
		else if(isset($brand)){
			$data['products'] = $product->getProductByBrand($search, $brand, $sort)->paginate(9);
			$data['product_brand'] = $data['products'][0]->brand_name;
		}
		else if(isset($price)){
			$data['products'] = Product::orderBy('price', $price)->paginate(9);
			$data['price'] = $price;
		}
		else if(isset($date)){
			$data['products'] = Product::orderBy('created_at', $date)->paginate(9);
			$data['date'] = $date;
		}
		else if(isset($sale)){
			$data['products'] = Product::where('discount','!=',0)
							->where('discount_date_start','<=',date('Y-m-d'))
							->where('discount_date_end','>=',date('Y-m-d'))
							->orderBy('discount', $sale)->paginate(9);
			$data['sale'] = $sale;
		}
		else if(isset($colour)){
			$data['products'] = Product::where('color','=',$colour)->paginate(9);
			$data['colour'] = $colour;
		}
		else{
			$data['products'] = Product::where('product.name', 'like', '%'.$search.'%')
										->orWhere('product.brand', 'LIKE', '%'.$search.'%')
										->paginate(9);
		}

		$category_root = new CategoryRoot();
		$category_parent = new CategoryParent();
		$category_child = new CategoryChild();
		$category_grand_child = new CategoryGrandChild();
		$data['category_root'] = $category_root->getAll();
		$data['category_parent'] = $category_parent->getAll();
		$data['category_child'] = $category_child->getAll();
		$data['category_grand_child'] = $category_grand_child->getAll();
				
		// $data['data_category_parent'] = Category::where('parent', '=', 0)->orderBy('parent','asc')->orderBy('name','asc')->get();
		// $data['data_category_child'] = Category::where('parent', '!=', 0)->orderBy('parent','asc')->orderBy('name','asc')->get();


		return View::make('user.product', $data);
	}
	
	public function getIndexBrand(){
		
		$data['brands'] = Array();
		
		$sort = Input::get('sort');
		
		//$data['brands'] = DB::table('product')->distinct()->select('brand')->get();
		if($sort == 'desc')
			$data['brands'] = DB::table('product')->distinct()->select('brand')->orderBy('brand', 'desc')->get();
		else
			$data['brands'] = DB::table('product')->distinct()->select('brand')->get();
		
		//print_r($data['brands']);
		
		return View::make('product/brand', $data);
	}

	public function productDetail($p_id){

		$category_root = new CategoryRoot();
		$category_parent = new CategoryParent();
		$category_child = new CategoryChild();
		$category_grand_child = new CategoryGrandChild();
		$data['category_root'] = $category_root->getAll();
		$data['category_parent'] = $category_parent->getAll();
		$data['category_child'] = $category_child->getAll();
		$data['category_grand_child'] = $category_grand_child->getAll();
		
		if(isset($category_id)){
			//$data['products'] = $product->getProductByCategoryID($search, $category_id, $sort);
			// $data['products'] = Product::where('category_id', '=', $category_id)->paginate(9);
			if($type == "c"){
				$data['data_category_child'] = CategoryChild::where('id', '=', $category_id)->orderBy('name','asc')->first();
				$data['data_category_parent'] = CategoryParent::where('id', '=', $data['data_category_child']['id_parent'])->orderBy('name','asc')->first();
				$data['data_category_root'] = CategoryRoot::where('id', '=', $data['data_category_parent']['id_root'])->orderBy('name','asc')->first();
				
				$data['products'] = DB::table('product as p')
								->leftJoin('category_child as cc','cc.id','=','p.category_id')
								->where('p.category_id','=',$category_id)
								->where('p.level','=',3)
								->where('cc.name','=',$data['data_category_child']['name'])
								->select(
									'p.*',
									'cc.id as ccid',
									'cc.name as ccname',
									'cc.commision as cccommision'
									)
								->paginate(9);
			}else{
				$data['data_category_grand_child'] = CategoryGrandChild::where('id', '=', $category_id)->orderBy('name','asc')->first();
				$data['data_category_child'] = CategoryChild::where('id', '=', $data['data_category_grand_child']['id_child'])->orderBy('name','asc')->first();
				$data['data_category_parent'] = CategoryParent::where('id', '=', $data['data_category_child']['id_parent'])->orderBy('name','asc')->first();
				$data['data_category_root'] = CategoryRoot::where('id', '=', $data['data_category_parent']['id_root'])->orderBy('name','asc')->first();

				$data['products'] = DB::table('product as p')
								->leftJoin('category_grand_child as cgc','cgc.id','=','p.category_id')
								->where('p.category_id','=',$category_id)
								->where('p.level','=',4)
								->where('cgc.name','=',$data['data_category_grand_child']['name'])
								->select(
									'p.*',
									'cgc.id as cgcid',
									'cgc.name as cgcname',
									'cgc.commision as cgccommision'
									)
								->paginate(9);
			}

			// $data['category_parent'] = Category::where('id', '=', $data['category']['parent'])->orderBy('parent','asc')->orderBy('name','asc')->first();
		}

		//ambil product id di get
		$product_id = $p_id;
		
		$product = Product::where('id', '=', $product_id)->first();

		$product_cart = Product::where('id', '=', 19)->first();
		$data['product_cart'] = $product_cart;
		$data['product_cart_images'] = ProductImage::where('product_id', '=', 19)
														->orderBy('id','asc')
														->get();
		
		if($product !=null){
			$product->viewed = $product->viewed+1;
			$product->save();
		}

		$data['product'] = $product;
		$data['product_specs'] = ProductSpec::where('product_id', '=', $product_id)->get();
		$data['product_images'] = ProductImage::where('product_id', '=', $product_id)
														->orderBy('id','asc')
														->get();
														
		if($product->level == 4){
			$data['products'] = DB::table('product as p')
								->leftJoin('category_grand_child as cgc','cgc.id','=','p.category_id')
								->where('p.category_id','=',$product->category_id)
								->where('p.level','=',4)
								->where('p.id','!=',$product->id)
								->select(
									'p.*',
									'cgc.id as product_id',
									'cgc.name as cgcname',
									'cgc.commision as cgccommision'
									)
								->orderBy(DB::raw('RAND()'))
								->take(4)->get();	
		}else{
			$data['products'] = DB::table('product as p')
								->leftJoin('category_child as cc','cc.id','=','p.category_id')
								->where('p.category_id','=',$product->category_id)
								->where('p.level','=',4)
								->where('p.id','!=',$product->id)
								->select(
									'p.*',
									'cc.id as product_id',
									'cc.name as ccname',
									'cc.commision as cccommision'
									)
								->orderBy(DB::raw('RAND()'))
								->take(4)->get();
		}

				
							
		$data['category'] = Product::where('product.id', '=', $product_id)
							->leftJoin('category as c1', 'c1.id', '=', 'product.category_id')
							->leftJoin('category as c2', 'c2.id', '=', 'c1.parent')
							->select('c1.name as category_name', 'c2.name as category_parent_name', 'c1.id as category_id', 'c2.id as category_parent_id')
							->first();


		return View::make('user.product_detail', $data);
	}
}