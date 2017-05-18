<?php

class CartController extends BaseController {

	public function getIndex(){

		if(Session::has('mycart') && count(Session::get('mycart'))!=0){
			$product = new Product();

			$cartProductID =  array();
			$cart = Session::get('mycart'); 
			foreach ($cart as $id => $qty) {
				array_push($cartProductID,$id);
			}
			$result['cart_data'] = $product->getCartData($cartProductID);
			$result['cart']=$cart;
			$result['user_address'] = UserAddress::where('user_id', '=', Auth::user()->id)->get();

			return View::make('cart/cart',$result);
		}
		else{
			return View::make('cart/cart');
		}
	}


	public function getCart(){
		// if(Auth::check()) {
			$category_root = new CategoryRoot();
			$category_parent = new CategoryParent();
			$category_child = new CategoryChild();
			$category_grand_child = new CategoryGrandChild();
			$result['category_root'] = $category_root->getAll();
			$result['category_parent'] = $category_parent->getAll();
			$result['category_child'] = $category_child->getAll();
			$result['category_grand_child'] = $category_grand_child->getAll();

			if(Session::has('mycart') && count(Session::get('mycart'))!=0){
				$product = new Product();

				$cartProductID =  array();
				$cart = Session::get('mycart');

				foreach ($cart as $id => $qty) {
					array_push($cartProductID,$id);
				}
				$result['cart_data'] = $product->getCartData($cartProductID);
				$result['cart']=$cart;
				$result['cart_session'] = $cart;

				// $result['user_address'] = UserAddress::where('user_id', '=', Auth::user()->id)->get();
				return View::make('user.user_cart', $result);
			}
			else{
				$result['cart_data'] = json_encode ((object) null);
				$result['cart']= array();
				// $result['user_address'] = UserAddress::where('user_id', '=', Auth::user()->id)->get();
				return View::make('user.user_cart', $result);
			}
		// }
		// else return View::make('user/user_login');
		
	}

	public function refreshCart(){
		return Redirect::back();
	}

	public function addToCart(){
		// if(Auth::check()) {
			$id = Input::get('product_id');
			$name = Input::get('product_name');
			$images = Input::get('images');
			$price = Input::get('price');
			$qty = Input::get('quantity');
			$color = Input::get('color');
			$size = Input::get('size');
			$modal = Input::get('modal') ? Input::get('modal') : 'no';

			$data_product = Product::where('id', '=', $id)->first();
			// print_r($data_product);exit;
			if($qty > $data_product->quantity){
				$msg = "Maaf stok tidak teresedia, hanya tersedia ".$data_product->quantity." lagi";
				return Redirect::back()->withErrors(array('msg'=>$msg,'id'=>$id,'modal'=>$modal));
			}

			$cart = Session::get('mycart'); 

			if($qty == "0"){
				return Redirect::back()->withErrors(array('msg'=>'Mohon diisi jumlah pembelian','id'=>$id,'modal'=>$modal));
			}
			if($color == "0"){
				return Redirect::back()->withErrors(array('msg'=>'Mohon dipilih warnanya','id'=>$id,'modal'=>$modal));
			}
			if($size == "0"){
				return Redirect::back()->withErrors(array('msg'=>'Mohon dipilih ukurannya','id'=>$id,'modal'=>$modal));
			}

			if(!Session::has('mycart')) {
				$cart = array();
				if($qty>0)
					$cart[$id] = array(
						"name"=>$name,
						"quantity"=>$qty,
						"color"=>$color,
						"size"=>$size,
						"price"=>$price,
						"images"=>$images
						);	
			}
			else if(Session::has('mycart') && !isset($cart[$id])){
				if($qty>0)
					$cart[$id] = array(
						"name"=>$name,
						"quantity"=>$qty,
						"color"=>$color,
						"size"=>$size,
						"price"=>$price,
						"images"=>$images
						);	
			}
			else if(Session::has('mycart') && isset($cart[$id])){
				if($qty>0)
					$cart[$id] = array(
						"name"=>$name,
						"quantity"=>$cart[$id]['quantity'] + $qty,
						"color"=>$color,
						"size"=>$size,
						"price"=>$price,
						"images"=>$images
						);	
			}					
			
			
			Session::put("mycart",$cart);
			$this::countCart($cart);
			
			return Redirect::to('cart');
		// }
		// else return View::make('user/user_login');
	}

	public function deleteCart(){
		$id = Input::get('product_id');
		$cart = Session::get('mycart');
		if(!Session::has('mycart')) {
			$cart = array();
		} else {
			unset($cart[$id]);
			Session::put("mycart",$cart);	
			$this::countCart($cart);
			$cartProductID = array();
			$prod = new Product();
			if(count($cart)!=0){
				foreach ($cart as $id => $qty) {
					array_push($cartProductID,$id);
				}
				$result['cartData']= $prod->getCartData($cartProductID);
				$result['cart']=$cart;	
			}
		}

		if(Session::get('cartQty') == 0){
			Session::forget('cartQty'); 
		}
				
		return Redirect::to('/cart');			
	}

	public static function countCart($cart){
		$totalQty=0;
		foreach ($cart as $id => $qty) {
				$totalQty +=$qty['quantity'];
		}		
		Session::put('cartQty',$totalQty);
	}
}
