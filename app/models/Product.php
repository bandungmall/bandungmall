<?php
	class Product extends Eloquent{
		protected $table = 'product';
		protected $primaryKey = 'id';

		public function insertProduct($merchant_id, $category_id, $name, $price, $quantity, $weight, $discount, $discount_date_start, $discount_date_end, $brand, $description, $image_link, $is_active, $size, $color){

			$data_product = new Product();
			$data_product->merchant_id = $merchant_id;
			$data_product->category_id = $category_id;
			$data_product->name = $name;
			$data_product->price = $price;
			$data_product->quantity = $quantity;
			$data_product->weight = $weight;
			$data_product->discount = $discount;
			$data_product->discount_date_start = $discount_date_start;
			$data_product->discount_date_end = $discount_date_end;
			$data_product->brand = $brand;
			$data_product->description = $description;
			$data_product->image_link = $image_link;
			$data_product->is_active = $is_active;
			$data_product->size = $size;
			$data_product->color = $color;
			$data_product->save();

			return $data_product->id;
		}
		
		public function editProduct($product_id, $merchant_id, $category_id, $name, $price, $quantity, $weight, $discount, $discount_date_start, $discount_date_end, $brand, $description, $is_active, $size, $color){

			$data_product = Product::find($product_id);
			$data_product->merchant_id = $merchant_id;
			$data_product->category_id = $category_id;
			$data_product->name = $name;
			$data_product->price = $price;
			$data_product->quantity = $quantity;
			$data_product->weight = $weight;
			$data_product->discount = $discount;
			$data_product->discount_date_start = $discount_date_start;
			$data_product->discount_date_end = $discount_date_end;
			$data_product->brand = $brand;
			$data_product->description = $description;
			$data_product->is_active = $is_active;
			$data_product->size = $size;
			$data_product->color = $color;
			$data_product->save();

			return $data_product->id;
		}
		
		public function getCartData($ids){
			$product_id = "";
			$product_ids = array();
			for($a=0; $a<sizeof($ids); $a++)
			{
				array_push($product_ids, $ids[$a]);
				$product_id .= $ids[$a];
				if($a !=count($ids)-1){
					$product_id.=",";
				}
			}
			//$rs = DB::select("select *,(price1 - ((price1 * discount)/100)) as disc, (price2 - ((price2 * discount2)/100)) as disc2, (price3 - ((price3 * discount3)/100)) as disc3 from product a join (select product_id, min(link) as judul from product_image group by product_id)  b on a.product_id = b.product_id where a.product_id in ($idProd)");			
			
			$rs = Product::where('is_active', '=', 'yes')
							->whereIn('product.id', $product_ids)
							->leftJoin('category as c1', 'c1.id', '=', 'product.category_id')
							->leftJoin('category as c2', 'c2.id', '=', 'c1.parent')
							->select('product.id','product.name','product.merchant_id','product.price','product.discount_date_end','product.discount_date_start','product.discount','product.image_link','product.weight','c1.name as category_name', 'c2.name as category_parent_name')
							->get();
			return $rs;
		}

		public function getProductByCategoryID($search, $category_id, $sort){

			$rs;

			if($sort ==1){
				$rs = Product::where('is_active', '=', 'yes')
								->where('product.name', 'like', '%'.$search.'%')
								->where('product.category_id', '=', $category_id)
								->leftJoin('category as c1', 'c1.id', '=', 'product.category_id')
								->leftJoin('category as c2', 'c2.id', '=', 'c1.parent')
								->select('product.*', 'c1.name as category_name', 'c2.name as category_parent_name')
								->orderBy('product.name', 'asc')
								->paginate(15)->groupBy('product.name','product.merchant_id');
			}
			else if($sort ==2){
				$rs = Product::where('is_active', '=', 'yes')
								->where('product.name', 'like', '%'.$search.'%')
								->where('product.category_id', '=', $category_id)
								->leftJoin('category as c1', 'c1.id', '=', 'product.category_id')
								->leftJoin('category as c2', 'c2.id', '=', 'c1.parent')
								->select('product.*', 'c1.name as category_name', 'c2.name as category_parent_name')
								->orderBy('product.name', 'desc')
								->paginate(15)->groupBy('product.name','product.merchant_id');
			}
			else if($sort ==3){
				$rs = Product::where('is_active', '=', 'yes')
								->where('product.name', 'like', '%'.$search.'%')
								->where('product.category_id', '=', $category_id)
								->leftJoin('category as c1', 'c1.id', '=', 'product.category_id')
								->leftJoin('category as c2', 'c2.id', '=', 'c1.parent')
								->select('product.*', 'c1.name as category_name', 'c2.name as category_parent_name')
								->orderBy('product.price', 'asc')
								->paginate(15)->groupBy('product.name','product.merchant_id');
			}
			else if($sort ==4){
				$rs = Product::where('is_active', '=', 'yes')
								->where('product.name', 'like', '%'.$search.'%')
								->where('product.category_id', '=', $category_id)
								->leftJoin('category as c1', 'c1.id', '=', 'product.category_id')
								->leftJoin('category as c2', 'c2.id', '=', 'c1.parent')
								->select('product.*', 'c1.name as category_name', 'c2.name as category_parent_name')
								->orderBy('product.price', 'desc')
								->paginate(15)->groupBy('product.name','product.merchant_id');
			}
			else{
				$rs = Product::where('is_active', '=', 'yes')
								->where('product.name', 'like', '%'.$search.'%')
								->where('product.category_id', '=', $category_id)
								->leftJoin('category as c1', 'c1.id', '=', 'product.category_id')
								->leftJoin('category as c2', 'c2.id', '=', 'c1.parent')
								->select('product.*', 'c1.name as category_name', 'c2.name as category_parent_name')
								->orderBy('product.name', 'asc')
								->paginate(15)->groupBy('product.name','product.merchant_id');
			}

			return $rs;
		}

		public function getProductByCategory($category_id){
			$rs = Product::where('is_active', '=', 'yes')
							->where('product.category_id', '=', $category_id)
							->orderBy('product.name', 'asc')
							->paginate(15)->groupBy('product.name','product.merchant_id');
			
			return $rs;
		}

		public function getProductByBrand($search, $brand, $sort){

			$rs;

			if($sort ==1){
				$rs = Product::where('is_active', '=', 'yes')
								->where('product.name', 'like', '%'.$search.'%')
								->orWhere('product.brand', 'like', '%'.$search.'%')
								->where('product.brand', '=', $brand)
								->leftJoin('category as c1', 'c1.id', '=', 'product.category_id')
								->leftJoin('category as c2', 'c2.id', '=', 'c1.parent')
								->select('product.*', 'c1.name as category_name', 'c2.name as category_parent_name', 'product.brand as brand_name')
								->orderBy('product.name', 'asc')->groupBy('product.name','product.merchant_id')
								->paginate(15);
			}
			else if($sort ==2){
				$rs = Product::where('is_active', '=', 'yes')
								->where('product.name', 'like', '%'.$search.'%')
								->orWhere('product.brand', 'like', '%'.$search.'%')
								->where('product.brand', '=', $brand)
								->leftJoin('category as c1', 'c1.id', '=', 'product.category_id')
								->leftJoin('category as c2', 'c2.id', '=', 'c1.parent')
								->select('product.*', 'c1.name as category_name', 'c2.name as category_parent_name', 'product.brand as brand_name')
								->orderBy('product.name', 'desc')->groupBy('product.name','product.merchant_id')
								->paginate(15);
			}
			else if($sort ==3){
				$rs = Product::where('is_active', '=', 'yes')
								->where('product.name', 'like', '%'.$search.'%')
								->orWhere('product.brand', 'like', '%'.$search.'%')
								->where('product.brand', '=', $brand)
								->leftJoin('category as c1', 'c1.id', '=', 'product.category_id')
								->leftJoin('category as c2', 'c2.id', '=', 'c1.parent')
								->select('product.*', 'c1.name as category_name', 'c2.name as category_parent_name', 'product.brand as brand_name')
								->orderBy('product.price', 'asc')->groupBy('product.name','product.merchant_id')
								->paginate(15);
			}
			else if($sort ==4){
				$rs = Product::where('is_active', '=', 'yes')
								->where('product.name', 'like', '%'.$search.'%')
								->orWhere('product.brand', 'like', '%'.$search.'%')
								->where('product.brand', '=', $brand)
								->leftJoin('category as c1', 'c1.id', '=', 'product.category_id')
								->leftJoin('category as c2', 'c2.id', '=', 'c1.parent')
								->select('product.*', 'c1.name as category_name', 'c2.name as category_parent_name', 'product.brand as brand_name')
								->orderBy('product.price', 'desc')->groupBy('product.name','product.merchant_id')
								->paginate(15);
			}
			else{
				$rs = Product::where('is_active', '=', 'yes')
								->where('product.name', 'like', '%'.$search.'%')
								->orWhere('product.brand', 'like', '%'.$search.'%')
								->where('product.brand', '=', $brand)
								->leftJoin('category as c1', 'c1.id', '=', 'product.category_id')
								->leftJoin('category as c2', 'c2.id', '=', 'c1.parent')
								->select('product.*', 'c1.name as category_name', 'c2.name as category_parent_name', 'product.brand as brand_name')
								->orderBy('product.name', 'asc')->groupBy('product.name','product.merchant_id')
								->paginate(15);
			}

			return $rs;
		}

		public function getProduct($search, $sort){

			$rs;

			if($sort ==1){
				$rs = Product::where('is_active', '=', 'yes')
								->where('product.name', 'like', '%'.$search.'%')
								->orWhere('product.brand', 'like', '%'.$search.'%')
								->leftJoin('category as c1', 'c1.id', '=', 'product.category_id')
								->leftJoin('category as c2', 'c2.id', '=', 'c1.parent')
								->select('product.*', 'c1.name as category_name', 'c2.name as category_parent_name')
								->orderBy('product.name', 'asc')->groupBy('product.name','product.merchant_id')
								->paginate(15);
			}
			else if($sort ==2){
				$rs = Product::where('is_active', '=', 'yes')
								->where('product.name', 'like', '%'.$search.'%')
								->orWhere('product.brand', 'like', '%'.$search.'%')
								->leftJoin('category as c1', 'c1.id', '=', 'product.category_id')
								->leftJoin('category as c2', 'c2.id', '=', 'c1.parent')
								->select('product.*', 'c1.name as category_name', 'c2.name as category_parent_name')
								->orderBy('product.name', 'desc')->groupBy('product.name','product.merchant_id')
								->paginate(15);
			}
			else if($sort ==3){
				$rs = Product::where('is_active', '=', 'yes')
								->where('product.name', 'like', '%'.$search.'%')
								->orWhere('product.brand', 'like', '%'.$search.'%')
								->leftJoin('category as c1', 'c1.id', '=', 'product.category_id')
								->leftJoin('category as c2', 'c2.id', '=', 'c1.parent')
								->select('product.*', 'c1.name as category_name', 'c2.name as category_parent_name')
								->orderBy('product.price', 'asc')->groupBy('product.name','product.merchant_id')
								->paginate(15);
			}
			else if($sort ==4){
				$rs = Product::where('is_active', '=', 'yes')
								->where('product.name', 'like', '%'.$search.'%')
								->orWhere('product.brand', 'like', '%'.$search.'%')
								->leftJoin('category as c1', 'c1.id', '=', 'product.category_id')
								->leftJoin('category as c2', 'c2.id', '=', 'c1.parent')
								->select('product.*', 'c1.name as category_name', 'c2.name as category_parent_name')
								->orderBy('product.price', 'desc')->groupBy('product.name','product.merchant_id')
								->paginate(15);
			}
			else{
				$rs = Product::where('is_active', '=', 'yes')
								->where('product.name', 'like', '%'.$search.'%')
								->orWhere('product.brand', 'like', '%'.$search.'%')
								->leftJoin('category as c1', 'c1.id', '=', 'product.category_id')
								->leftJoin('category as c2', 'c2.id', '=', 'c1.parent')
								->select('product.*', 'c1.name as category_name', 'c2.name as category_parent_name')
								->orderBy('product.name', 'asc')->groupBy('product.name','product.merchant_id')
								->paginate(15);
			}

			return $rs;
		}
	}
?>