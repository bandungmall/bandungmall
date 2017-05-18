<?php

class LoginFacebookController extends \BaseController {

	private $fb;

	public function __construct(FacebookHelper $fb){
		$this->fb = $fb;
	}

	public function login(){
		//return Redirect::to($this->fb->getUrlLogin());
		
		// get data from input
		$code = Input::get( 'code' );

		// get fb service
		$fb = Artdarek\OAuth\Facade\OAuth::consumer("Facebook");

		// check if code is valid

		// if code is provided get user data and sign in
		if ( !empty( $code ) ) {

			// This was a callback request from facebook, get the token
			$token = $fb->requestAccessToken( $code );

			// Send a request with it
			$result = json_decode( $fb->request( '/me' ), true );

			$user = User::where('uid_fb', '=', $result['id'])->first();
			if($user ===NULL){
	           $user = new User;
				$user->email = $result['id']."@facebook.com";					
			   $user->first_name = $result['name'];//$user_fb->getProperty('first_name');
			   $user->last_name = "";//$user_fb->getProperty('last_name');
				   $user->uid_fb = $result['id'];//$user_fb->getProperty('id');
			   $user->password = Hash::make(str_random(10));
							
				$user->access_token_fb = $code;

			   $user->save();
			}
		
			Auth::login($user);
			
			//$message = 'Your unique facebook user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
			//echo $message. "<br/>";

			//Var_dump
			//display whole array().
			return Redirect::to('/');

		}
		// if not ask for permission first
		else {
			// get fb authorization
			$url = $fb->getAuthorizationUri();

			// return to facebook login url
			 return Redirect::to( (string)$url );
		}
	}

	public function callback(){
		
		$user = User::where('uid_fb', '=', $user_fb->getProperty('id'))->first();

		if($user === NULL){
	           $user = new User;
		   $user->email = "facebook";//$user_fb->getProperty('email');
		   $user->first_name = $user_fb->getProperty('first_name');
		   $user->last_name = $user_fb->getProperty('last_name');
	           $user->uid_fb = $user_fb->getProperty('id');
		   $user->password = Hash::make(str_random(10));
                        
                   $user->access_token_fb = $this->fb->getToken();

		   $user->save();
		}
		

		//Auth::login($user);

		return Redirect::to('/');
	}

}