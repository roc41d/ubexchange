<?php

class SessionController extends BaseController {

	public function login() {	

		return View::make('site.login');
	}

	public function handleLogin() {
		if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password'))))
		{
		    //  check if account is active
		    if(Auth::user()->activation_state == "off")
		    {
		    	Auth::logout();
		    	return Redirect::back()->with('alertError', "please check your mail to activate account.");
		    }

		    if(Auth::user()->activation_state == "deactivate")
		    {
		    	Auth::logout();
		    	return Redirect::back()->with('alertError', "contact support@ubexchange.com, your account has been blocked.");
		    }
		     // redirect user to profile page
		    return Redirect::to('profile');
		}

		else {
			return Redirect::back()->with('alertError', "invalid account details.");
		}

	}

	public function register() {	
		return View::make('site.register');
	}

	public function handleRegister() {
		$registerData = Input::all();
		$registerRules = array(
			'name'					=>'required|unique:users|alpha_dash|min:4',
			'email'	  				=>'required|email|unique:users',
			'password'				=>'required|alpha_num|min:4',
			'comfirmed_password'	=>'required|alpha_num|same:password',
			'terms'	   				=>'required'
			);
		$registerValidator = Validator::make($registerData,$registerRules);
		if( $registerValidator->passes()) {
			$user = new User();
			$user->name = Input::get('name');
			$user->email = Input::get('email');
			$user->password = Hash::make(Input::get('password'));
			$user->activation_key = bin2hex(openssl_random_pseudo_bytes(16));
			$user->activation_state = "off";
			$user->save();
			// send activation link
			$mailData = array(
				'name'=> Input::get('name'),
				'link'=> $user->activation_key
				);
			Mail::send('emails.activate',$mailData, 
				function($message) {
					$message->subject("techexchange account activation");
					$message->to(Input::get('email'));
				}
			);
			return Redirect::to('login')->with('alertMessage',"check email, to activate account.");
		}
		if($registerValidator->fails()) {
			return Redirect::back()->withInput()->withErrors($registerValidator);
		}
	}

	public function logout() {
		Auth::logout();
		return Redirect::to('/');
	}

	public function activate($key) {
		$activationCheck = User::where('activation_key','=',$key)->count();
		if($activationCheck == 1) {
			$activateAccount = User::where('activation_key','=',$key)->first();
			$activateAccount->activation_state = "on";
			$activateAccount->activation_key = NULL;
			$activateAccount->save();
			return Redirect::to('/')->with('alertMessage',"account activated, you can now login.");
		}
		else {
			return Redirect::to('/');
		}
		
	}
}