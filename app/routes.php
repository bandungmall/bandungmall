<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

date_default_timezone_set("Asia/Jakarta");

View::composer('user.templates.layout', function($view){
    $data['data_category_parent'] = Category::where('parent', '=', 0)->get();
	$data['data_category_child'] = Category::where('parent', '!=', 0)->get();
    $view->with($data);
});

View::composer('layout.frontend', function($view){
    $data['data_category_parent'] = Category::where('parent', '=', 0)->get();
	$data['data_category_child'] = Category::where('parent', '!=', 0)->get();
    $view->with($data);
});

Route::get('/', 'HomeController@index'); // done
Route::get('home', 'HomeController@index'); // done
Route::get('getProductId', 'HomeController@getProductId'); // done

Route::get('info', 'InfoController@getInfo');
Route::get('admin', 'AdminAuthController@getIndexLogin'); // done
Route::get('admin/login', 'AdminAuthController@getIndexLogin'); // done
Route::post('admin/login/doLogin', 'AdminAuthController@doLogin'); // done
Route::get('admin/login/doLogout', 'AdminAuthController@doLogout'); // done

// Route::get('tes', function(){return View::make('layout.frontend_new');});

Route::group(array(), function() 
{
	if(AdminHelper::checkLogin()){
		Route::get('admin/home', 'AdminHomeController@getIndexHome'); // done
		Route::get('admin/user', 'AdminUserController@getIndex');
		
		//Route::get('admin/user/doDeleteUser', 'AdminUserController@doDeleteUser');
		
		Route::get('admin/user/transaction', 'AdminUserTransactionController@getIndex');
		Route::get('admin/user/detailTransaction', 'AdminUserTransactionController@detailTransaction');


		Route::get('admin/admin', 'AdminAdminController@getIndex');
		Route::post('admin/admin/doInsertAdmin', 'AdminAdminController@doInsertAdmin');
		Route::get('admin/admin/doDeleteAdmin', 'AdminAdminController@doDeleteAdmin');

		Route::get('admin/merchant', 'AdminMerchantController@getIndex');
		Route::get('admin/merchant/editMerchant', 'AdminMerchantController@getIndexEditMerchant');
		Route::post('admin/merchant/editMerchant/doUpdatePassword', 'AdminMerchantController@doUpdatePassword');
		Route::post('admin/merchant/editMerchant/doUpdateGeneralInformation', 'AdminMerchantController@doUpdateGeneralInformation');
		Route::post('admin/merchant/editMerchant/doUpdatePaymentInformation', 'AdminMerchantController@doUpdatePaymentInformation');
		Route::post('admin/merchant/editMerchant/doUpdateAddressInformation', 'AdminMerchantController@doUpdateAddressInformation');

		Route::get('admin/merchant/editMerchantLogin', 'AdminMerchantController@getIndexEditMerchantLogin');
		Route::post('admin/merchant/editMerchantLogin/doEditMerchantLogin', 'AdminMerchantController@doEditMerchantLogin');
		Route::get('admin/merchant/registration', 'AdminMerchantController@getIndexRegistration');
		Route::get('admin/merchant/doAcceptMerchantRegistration', 'AdminMerchantController@doAcceptMerchantRegistration');
		Route::get('admin/merchant/doDeclineMerchantRegistration', 'AdminMerchantController@doDeclineMerchantRegistration');
		Route::get('admin/merchant/doDeleteMerchant', 'AdminMerchantController@doDeleteMerchant');
		Route::get('admin/merchant/insertMerchantLogin', 'AdminMerchantController@insertMerchantLogin');
		Route::post('admin/merchant/insertMerchantLogin/doInsertMerchantLogin', 'AdminMerchantController@doInsertMerchantLogin');
		Route::post('admin/merchant/doInformMerchant', 'AdminMerchantController@doInformMerchant');

		Route::get('admin/category', 'AdminCategoryController@getIndex');
		Route::get('admin/category/getParent', 'AdminCategoryController@getParent');
		Route::get('admin/category/getChild', 'AdminCategoryController@getChild');
		Route::get('admin/category/getChildAll', 'AdminCategoryController@getChildAll');
		Route::get('admin/category/getGrandChild', 'AdminCategoryController@getGrandChild');
		Route::get('admin/category/editCategory', 'AdminCategoryController@getIndexEditCategory');
		Route::get('admin/category/editCategoryRoot/{id}', 'AdminCategoryController@getIndexEditCategoryRoot')->where('id', '[0-9]+');
		Route::get('admin/category/editCategoryParent/{id}', 'AdminCategoryController@getIndexEditCategoryParent')->where('id', '[0-9]+');
		Route::get('admin/category/editCategoryChild/{id}', 'AdminCategoryController@getIndexEditCategoryChild')->where('id', '[0-9]+');
		Route::get('admin/category/editCategoryGrandChild/{id}', 'AdminCategoryController@getIndexEditCategoryGrandChild')->where('id', '[0-9]+');
		Route::post('admin/category/doEditCategory', 'AdminCategoryController@doEditCategory');
		Route::post('admin/category/doEditCategoryRoot', 'AdminCategoryController@doEditCategoryRoot');
		Route::post('admin/category/doEditCategoryParent', 'AdminCategoryController@doEditCategoryParent');
		Route::post('admin/category/doEditCategoryChild', 'AdminCategoryController@doEditCategoryChild');
		Route::post('admin/category/doEditCategoryGrandChild', 'AdminCategoryController@doEditCategoryGrandChild');
		Route::post('admin/category/doInsertCategory', 'AdminCategoryController@doInsertCategory');
		Route::post('admin/category/doInsertCategoryRoot', 'AdminCategoryController@doInsertCategoryRoot');
		Route::post('admin/category/doInsertCategoryParent', 'AdminCategoryController@doInsertCategoryParent');
		Route::post('admin/category/doInsertCategoryChild', 'AdminCategoryController@doInsertCategoryChild');
		Route::post('admin/category/doInsertCategoryGrandChild', 'AdminCategoryController@doInsertCategoryGrandChild');
		Route::get('admin/category/doDeleteCategory', 'AdminCategoryController@doDeleteCategory');
		Route::get('admin/category/doDeleteCategoryRoot/{id}', 'AdminCategoryController@doDeleteCategoryRoot')->where('id', '[0-9]+');
		Route::get('admin/category/doDeleteCategoryParent/{id}', 'AdminCategoryController@doDeleteCategoryParent')->where('id', '[0-9]+');
		Route::get('admin/category/doDeleteCategoryChild/{id}', 'AdminCategoryController@doDeleteCategoryChild')->where('id', '[0-9]+');
		Route::get('admin/category/doDeleteCategoryGrandChild/{id}', 'AdminCategoryController@doDeleteCategoryGrandChild')->where('id', '[0-9]+');

		Route::get('admin/product', 'AdminProductController@getIndex');
		Route::get('admin/product/doDeleteProduct', 'AdminProductController@doDeleteProduct');

		Route::get('admin/coupon', 'AdminCouponController@getIndex');
		Route::get('admin/coupon/editCoupon', 'AdminCouponController@getIndexEditCoupon');
		Route::post('admin/coupon/doEditCoupon', 'AdminCouponController@doEditCoupon');
		Route::post('admin/coupon/doInsertCoupon', 'AdminCouponController@doInsertCoupon');
		Route::get('admin/coupon/doDeleteCoupon', 'AdminCouponController@doDeleteCoupon');

		Route::get('admin/configColour', 'AdminConfigController@getIndexColour');
		Route::get('admin/configColour/editConfigColour', 'AdminConfigController@getIndexEditColour');
		Route::post('admin/configColour/doEditConfigColour', 'AdminConfigController@doEditConfigColour');
		Route::post('admin/configColour/doInsertConfigColour', 'AdminConfigController@doInsertConfigColour');
		Route::get('admin/configColour/doDeleteConfigColour', 'AdminConfigController@doDeleteConfigColour');
		Route::get('admin/configSize', 'AdminConfigController@getIndexSize');
		Route::get('admin/configSize/editConfigSize/{id}', 'AdminConfigController@getIndexEditSize')->where('id', '[0-9]+');
		Route::post('admin/configSize/doEditConfigSize', 'AdminConfigController@doEditConfigSize');
		Route::post('admin/configSize/doInsertConfigSize', 'AdminConfigController@doInsertConfigSize');
		Route::get('admin/configSize/doDeleteConfigSize', 'AdminConfigController@doDeleteConfigSize');
		Route::get('admin/configDescription', 'AdminConfigController@getIndexDescription');
		Route::get('admin/configDescription/editConfigDescription/{id}', 'AdminConfigController@getIndexEditDescription')->where('id', '[0-9]+');
		Route::post('admin/configDescription/doEditConfigDescription', 'AdminConfigController@doEditConfigDescription');
		Route::post('admin/configDescription/doInsertConfigDescription', 'AdminConfigController@doInsertConfigDescription');
		Route::get('admin/configDescription/doDeleteConfigDescription', 'AdminConfigController@doDeleteConfigDescription');

		Route::get('admin/transaction/transactionPending', 'AdminTransactionController@getPendingTransaction');
		Route::get('admin/transaction/filterTransactionPending', 'AdminTransactionController@getFilterTransactionPending');
		Route::get('admin/transaction/transactionPaid', 'AdminTransactionController@getPaidTransaction');
		Route::get('admin/transaction/filterTransactionPaid', 'AdminTransactionController@getFilterTransactionPaid');
		Route::get('admin/transaction/transactionUnpaid', 'AdminTransactionController@getUnPaidTransaction');
		Route::get('admin/transaction/filterTransactionUnPaid', 'AdminTransactionController@getFilterUnPaidTransaction');
		Route::get('admin/transaction/transactionReject', 'AdminTransactionController@getRejectTransaction');
		Route::get('admin/transaction/filterTransactionReject', 'AdminTransactionController@getFilterRejectTransaction');
		Route::get('admin/transaction/doTransactionPayment/{id}', 'AdminTransactionController@doTransactionPayment')->where('id', '[0-9]+');
		Route::get('admin/transaction/transactionDetail/{id}', 'AdminTransactionController@detailTransaction')->where('id', '[0-9]+');
		Route::get('admin/transaction/transactionSent', 'AdminTransactionController@getIndexTransactionSent');
		Route::get('admin/transaction/filterTransactionSent', 'AdminTransactionController@getFilterTransactionSent');
		Route::get('admin/transaction/transactionSentDeclined', 'AdminTransactionController@getIndexTransactionSentDeclined');
		Route::get('admin/transaction/filterTransactionSentDeclined', 'AdminTransactionController@getFilterTransactionSentDeclined');
		Route::get('admin/transaction/transactionSentDetail/{id}', 'AdminTransactionController@getIndexTransactionSentDetail')->where('id', '[0-9]+');
		Route::get('admin/transaction/doApproveTransactionDetail', 'AdminTransactionController@doApproveTransactionDetail');
		Route::get('admin/transaction/doRejectTransactionDetail', 'AdminTransactionController@doRejectTransactionDetail');
		Route::get('admin/transactionReport', 'AdminTransactionController@getIndexTransactionReportFinal');
		Route::get('admin/filterTransactionReport', 'AdminTransactionController@getFilterTransactionReportFinal');
		Route::get('admin/transactionReportReject', 'AdminTransactionController@getIndexTransactionReportReject');
		Route::get('admin/filterTransactionReportReject', 'AdminTransactionController@getFilterTransactionReportReject');
		Route::get('admin/transactionReportPending', 'AdminTransactionController@getIndexTransactionReportPending');
		Route::get('admin/filterTransactionReportPending', 'AdminTransactionController@getFilterTransactionReportPending');
		Route::get('admin/generateTransactionReport', 'AdminTransactionController@generateTransactionReport');
		Route::get('admin/banner', 'AdminContentController@getIndexBanner'); // done
		Route::post('admin/banner/doUpdateBanner', 'AdminContentController@doUpdateBanner'); // done
		Route::post('admin/banner/doAddBanner', 'AdminContentController@doAddBanner'); // done
		Route::post('admin/banner/doDeleteBanner', 'AdminContentController@doDeleteBanner'); // done
		Route::get('admin/brands', 'AdminContentController@getIndexBrand'); // done
		Route::post('admin/brands/doUpdateBrand', 'AdminContentController@doUpdateBrand'); // done
		Route::post('admin/brands/doAddBrand', 'AdminContentController@doAddBrand'); // done
		Route::post('admin/brands/doDeleteBrand', 'AdminContentController@doDeleteBrand'); // done
		Route::get('admin/promotions', 'AdminContentController@getIndexPromotion'); // done
		Route::post('admin/promotions/doUpdatePromotion', 'AdminContentController@doUpdatePromotion'); // done
		Route::post('admin/promotions/doDeletePromotion', 'AdminContentController@doDeletePromotion'); // done
	}
});

Route::group(array(), function() 
{
	if(UserHelper::checkLogin()){
		Route::get('user/login', 'UserController@getIndexLogin'); // done
		Route::post('user/login/doLogin', 'UserController@doLogin'); // done
		Route::get('user/login/fb', 'LoginFacebookController@login'); // done
		Route::get('user/login/fb/callback', 'LoginFacebookController@callback'); // done
		Route::get('user/login/google', 'LoginGoogleController@loginWithGoogle'); // done
		Route::get('user/doLogout', 'UserController@doLogout'); // done

		Route::get('user/register', 'UserController@getIndexRegister'); // done
		Route::post('user/register/doRegister', 'UserController@doRegister'); // done
		Route::get('user/register/doRegister/activate_account/{activation_code}', array('as' => 'account-activation', 'uses' => 'UserController@activateAccount')); // done
		Route::get('user/forgotPassword', 'UserController@getIndexForgotPassword');
		Route::post('user/forgotPassword/generateForgotPasswordCode', 'UserController@generateForgotPasswordCode');
		Route::get('user/forgotPassword/resetPassword/{reset_password_code}', array('as' => 'reset-password', 'uses' => 'UserController@resetPassword'));
		Route::post('user/forgotPassword/resetPassword/doResetPassword', 'UserController@doResetPassword');

		Route::get('user/home', 'UserController@getIndexHome'); // done
		Route::get('user/myAccount', 'UserController@getIndexAccount');//done
		Route::post('user/myAccount/doUpdateReferral', 'UserController@doUpdateReferral');
		Route::get('user/info', 'UserController@getInfo');//done
		Route::get('user/address', 'UserController@getAddress');//done
		Route::get('user/address/getKota', 'UserController@getKota');//done
		Route::get('user/address/setAddress/{id}', 'UserController@setAddress')->where('id', '[0-9]+');//done
		Route::get('user/bank', 'UserController@getBank');//done
		Route::get('user/thankyou', 'UserController@getThankYou');//done
		Route::post('user/editInfo', 'UserController@doEditInfo');//done
		Route::post('user/myAccount/doAddAddress', 'UserController@doAddAddress');//done
		Route::get('user/myAccount/deleteAddress', 'UserController@deleteAddress');//done
		Route::post('user/myAccount/editAddress', 'UserController@doEditAddress');//done
		Route::post('user/myAccount/doAddBank', 'UserController@doAddBank');//done
		Route::get('user/myAccount/deleteBank', 'UserController@deleteBank');//done
		Route::post('user/myAccount/editBank', 'UserController@doEditBank');//done
		Route::get('user/transactionHistory', 'UserController@getIndexHistory');//done
		Route::get('user/transactionPayment/{id}', 'UserController@transactionPayment')->where('id', '[0-9]+');
		Route::get('user/doTransactionPayment', 'UserController@doTransactionPayment');
		Route::get('user/doTransactionReceived', 'UserController@doTransactionReceived');
		//Route::get('user/transactionHistory', 'UserController@getIndexOrder');
		Route::get('user/transactionHistoryDetail', 'UserController@getIndexOrderDetail');
		Route::get('user/order', 'UserController@getIndexOrder');
		Route::get('user/orderDetail', 'UserController@getIndexOrderDetail');
		Route::get('user/downline', 'UserController@getIndexDownline');
		Route::get('user/income', 'UserController@getIndexIncome');
		Route::get('user/cashout', 'UserController@getIndexCashout');
		Route::post('user/cashout/doCashout', 'UserController@doCashout');

		Route::get('product/{type}-{id}', 'ProductController@getIndex')->where('id', '[0-9]+');//done
		Route::get('product-list/{type}-{id}', 'ProductController@getIndexList')->where('id', '[0-9]+');//done
		Route::get('product/search/brand/{keyword}', 'ProductController@searchItem');//done
		Route::get('product/search/price/{keyword}', 'ProductController@searchItem');//done
		Route::get('product/search/colour/{keyword}', 'ProductController@searchItem');//done
		Route::get('product/search/date/{keyword}', 'ProductController@searchItem');//done
		Route::get('product/search/sale/{keyword}', 'ProductController@searchItem');//done
		Route::get('product/search/colour/{keyword}', 'ProductController@searchItem');//done
		Route::get('productDetail/{id}', 'ProductController@productDetail');//done
		Route::get('pria', 'ProductController@getPria');//done
		Route::get('wanita', 'ProductController@getWanita');//done

		Route::get('cart', 'CartController@getCart');//done
		Route::get('cart/refresh', 'CartController@refreshCart');//done
		Route::post('cart/add', 'CartController@addToCart');//done
		Route::get('cart/delete', 'CartController@deleteCart');//done
		Route::get('checkout', 'CheckoutController@getCheckout');//done
		Route::get('checkout/getAddress', 'CheckoutController@getAddress');//done
		Route::get('checkout/getCost', 'CheckoutController@getCost');//done
		Route::get('checkout/checkCoupon', 'CheckoutController@checkCoupon');//done
		Route::get('checkout/setCoupon', 'CheckoutController@setCoupon');//done
		Route::get('checkout/getAccountBank', 'CheckoutController@getAccountBank');//done
		Route::post('/checkout/doCheckoutFinal', 'CheckoutController@doCheckoutFinal');//done
		Route::get('checkout/confirmation', 'CheckoutController@getIndexConfirmation');
		Route::post('user/doInsertPaymentConfirmation', 'UserController@doInsertPaymentConfirmation');
		Route::post('/checkout/shipping/getCost', 'CheckoutController@getCost');
		Route::post('/checkout/doCheckout', 'CheckoutController@doCheckout');
	}
});

Route::get('privacyPolicy', 'OtherController@privacyPolicy');//done
Route::get('termOfUse', 'OtherController@termOfUse');//done
Route::get('help', 'OtherController@help');//done
Route::get('about', 'OtherController@about');//done
Route::get('404', 'OtherController@pagenotfound');//done

Route::get('merchant/register', 'MerchantController@getIndexRegister'); // done
Route::get('merchant/doRegister/activate_account/{activation_code}', array('as' => 'merchant-account-activation', 'uses' => 'MerchantController@activateAccount')); // done
Route::post('merchant/doRegister', 'MerchantController@doRegister'); // done
Route::get('merchant', 'MerchantController@getIndexLogin'); // done
Route::get('merchant/login', 'MerchantController@getIndexLogin'); // done
Route::post('merchant/login/doLogin', 'MerchantController@doLogin'); // done
Route::get('merchant/login/doLogout', 'MerchantController@doLogout'); // done

Route::get('merchant/forgotPassword', 'MerchantController@getIndexForgotPassword');
Route::post('merchant/forgotPassword/generateForgotPasswordCode', 'MerchantController@generateForgotPasswordCode');
Route::get('merchant/forgotPassword/resetPassword/{reset_password_code}', array('as' => 'reset-password-merchant', 'uses' => 'MerchantController@resetPassword'));
Route::post('merchant/forgotPassword/resetPassword/doResetPassword', 'MerchantController@doResetPassword');

Route::group(array(), function() 
{
	if(MerchantHelper::checkLogin()){
		Route::get('merchant/info', 'MerchantController@getIndexInfo'); // done
		Route::get('merchant/addProduct', 'MerchantController@getIndexAddProduct'); // done
		Route::get('merchant/category/getParent', 'MerchantController@getParent');
		Route::get('merchant/category/getChild', 'MerchantController@getChild');
		Route::get('merchant/category/getChildAll', 'MerchantController@getChildAll');
		Route::get('merchant/category/getGrandChild', 'MerchantController@getGrandChild');
		Route::get('merchant/configProduct', 'MerchantController@getConfigProduct'); // done
		Route::post('merchant/addProduct/doAddProduct', 'MerchantController@doAddProduct'); // done
		Route::get('merchant/editProduct/{id}', 'MerchantController@getIndexEditProduct')->where('id', '[0-9]+'); // done
		Route::post('merchant/editProduct/doEditProduct', 'MerchantController@doEditProduct'); // done
		Route::post('merchant/editProduct/doDeleteImage', 'MerchantController@doDeleteImage'); // done
		Route::get('merchant/productList', 'MerchantController@getIndexProductList'); // done
		Route::get('merchant/deleteProduct/doDeleteProduct/{id}', 'MerchantController@doDeleteProduct')->where('id', '[0-9]+'); // done
		Route::get('merchant/generateReport', 'MerchantController@generateReportMerchantSales'); 
		Route::get('merchant/report', 'MerchantController@getIndexReport');
		Route::get('merchant/reportDetail', 'MerchantController@getIndexReportDetail');
		Route::get('merchant/message', 'MerchantController@getIndexMessage');
		Route::get('merchant/order', 'MerchantController@getIndexOrder'); // done
		Route::get('merchant/order/doTransactionSent/{id}', 'MerchantController@doTransactionSent')->where('id', '[0-9]+'); // done
		Route::get('merchant/orderDetail/{id}', 'MerchantController@getIndexOrderDetail')->where('id', '[0-9]+');
		Route::get('merchant/orderDetail/doAcceptOrder/{id}', 'MerchantController@doAcceptOrder')->where('id', '[0-9]+');
		Route::get('merchant/orderDetail/doDeclineOrder/{id}', 'MerchantController@doDeclineOrder')->where('id', '[0-9]+');
		Route::get('merchant/acceptedOrder', 'MerchantController@getIndexAcceptedOrder'); // done
		Route::get('merchant/acceptedOrderDetail/{id}', 'MerchantController@getIndexAcceptedOrderDetail')->where('id', '[0-9]+');
		Route::get('merchant/rejectedOrderDetail/{id}', 'MerchantController@getIndexRejectedOrderDetail')->where('id', '[0-9]+');
		Route::post('merchant/acceptedOrderDetail/doInsertResi', 'MerchantController@doInsertResi');
		Route::get('merchant/acceptedOrder', 'MerchantController@getIndexAcceptedOrder'); // done
		Route::post('merchant/doUpdatePassword', 'MerchantController@doUpdatePassword'); // done
		Route::post('merchant/doUpdateGeneralInformation', 'MerchantController@doUpdateGeneralInformation'); // done
		Route::post('merchant/doUpdatePaymentInformation', 'MerchantController@doUpdatePaymentInformation'); // done
		Route::post('merchant/doUpdateAddressInformation', 'MerchantController@doUpdateAddressInformation'); // done
	}
});

// Route::get('hashmake', function(){ 
// 	return Hash::make('qwe'); 
// });

// Route::get('tespdf', function(){
// 	$html = View::make('other.tes');

// 	$data['link'] = 'asd';

// 	return PDF::loadView('other.tes', $data)->stream();
// });

// Route::get('tesCom', function(){
// 	$mlm = new Mlm();
// 	$upline_list = array();
// 	$upline = 26;
// 	for($i=0; $i<5; $i++){
// 		$temp_upline = $mlm->getUpline($upline);
// 		if(empty($temp_upline)) break;
// 		else{
// 			$upline = $temp_upline->id;
// 			array_push($upline_list, $temp_upline);
// 		}
// 	}

// 	foreach($upline_list as $list){
// 		echo $list->email.'<br>';
// 	}

// 	$fees = FeeRate::all()->toArray();
// 	echo $fees[0]['percentage'];
// });


App::missing(function($exception)
{
	$data["message"] = "Halaman yang Anda cari tidak dapat kami temukan";
	$data["code"] = 404;
    return Response::view('other.404', $data, 404);
});

// App::error(function($exception, $code) {
// 	$category_root = new CategoryRoot();
// 	$category_parent = new CategoryParent();
// 	$category_child = new CategoryChild();
// 	$category_grand_child = new CategoryGrandChild();
// 	$data['category_root'] = $category_root->getAll();
// 	$data['category_parent'] = $category_parent->getAll();
// 	$data['category_child'] = $category_child->getAll();
// 	$data['category_grand_child'] = $category_grand_child->getAll();

// 	$data_category_parent = Category::where('parent', '=', 0)->orderBy('name','asc')->get();
// 	$data_category_child = Category::where('parent', '!=', 0)->orderBy('name','asc')->get();

// 	$data['categories'] = DB::table('category_grand_child as cgc')
// 								->leftJoin('category_child as cc', 'cgc.id_child', '=', 'cc.id')
// 								->leftJoin('category_parent as cp', 'cc.id_parent', '=', 'cp.id')
// 								->leftJoin('category_root as cr', 'cp.id_root', '=', 'cr.id')
// 								->select(
// 									'cr.id as crid',
// 									'cr.name as crname',
// 									'cp.id as cpid',
// 									'cp.name as cpname',
// 									'cc.id as ccid',
// 									'cc.name as ccname',
// 									'cc.commision as cccommision',
// 									'cgc.id as cgcid',
// 									'cgc.name as cgcname',
// 									'cgc.commision as cgccommision'
// 									)
// 								->orderBy('cr.name','asc')
// 								->orderBy('cp.name','asc')
// 								->orderBy('cc.name','asc')
// 								->orderBy('cgc.name','asc')
// 								->get();
								
//  	switch ($code) {
//  		case 403:
// 			$data["message"] = "Anda tidak diperbolehkan untuk melakukan itu";
// 			$data["code"] = 403;
//  			return Response::view('other.404', $data, 403);

// 		case 404:
// 			$data["message"] = "Halaman yang Anda cari tidak dapat kami temukan";
// 			$data["code"] = 404;
// 		    return Response::view('other.404', $data, 404);

// 		case 500:
// 			$data["message"] = "Maaf, server kami sedang ada gangguan. Coba lagi dalam beberapa saat";
// 			$data["code"] = 500;
// 			Log::error($exception);
// 		    return Response::view('other.404', $data, 500);

// 		default:
// 			$data["message"] = "Maaf, terjadi kesalahan. Akan kami perbaiki secepatnya :)";
// 			$data["code"] = $code;
// 		    return Response::view('other.404', $data, $code);
// 	}
	
// });

