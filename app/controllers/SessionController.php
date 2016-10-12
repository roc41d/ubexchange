<?php

class SessionController extends BaseController {

	// function for displaying login form
	public function login() {	

		return View::make('site.login');
	}

	// function for handling userLogin
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

		    Auth::user()->last_login = new DateTime();
    		Auth::user()->save();
		    return Redirect::to('profile');
		}

		else {
			return Redirect::back()->with('alertError', "invalid account details.");
		}

	}

	// function for displaying registration page
	public function register() {	
		return View::make('site.register');
	}

	// function for handling userRegistraton
	public function handleRegister() {
		$registerData = Input::all();
		$registerRules = array(
			'name'					=>'required|unique:users|alpha_dash|min:4',
			'email'	  				=>'required|email|unique:users',
			'password'				=>'required|alpha_num|min:6',
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
			$user->activation_state = "on";
			$user->save();
			// send activation link
			/*$mailData = array(
				'name'=> Input::get('name'),
				'link'=> $user->activation_key
				);
			Mail::send('emails.activate',$mailData, 
				function($message) {
					$message->subject("ubexchange account activation");
					$message->to(Input::get('email'));
				}
			);*/
			return Redirect::to('login')->with('alertMessage',"check email, to activate account.");
		}
		if($registerValidator->fails()) {
			return Redirect::back()->withInput()->withErrors($registerValidator);
		}
	}

	// function for handling Logout
	public function logout() {
		Auth::logout();
		return Redirect::to('/');
	}

	// function for handling account activaton
	public function activate($key) {
		$activationCheck = User::where('activation_key','=',$key)->count();
		if($activationCheck == 1) {
			$activateAccount = User::where('activation_key','=',$key)->first();
			$activateAccount->activation_state = "on";
			$activateAccount->activation_key = NULL;
			$activateAccount->save();
			return Redirect::to('login')->with('alertMessage',"account activated, you can now login.");
		}
		else {
			return Redirect::to('/');
		}
		
	}

	// function for displaying reset password form
	public function remind(){

		return View::make('site.remind');
	}

	// function for sending email for password reset
	public function handleRemind(){

		$validator = Validator::make(
            Input::all(),
            array('email' => 'required|email')
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {

            $user = User::where('email', '=', Input::get('email'));

            if ($user->count()) {
                $user = $user->first();

                $code = str_random(120);

                $user->remind = $code;
                $user->save();

                $mailData = array(
                'email' => Input::get('email'),
                'link' => $code,
                );
	            
	            //return $mailData['email'] . $training->title;

	            Mail::send('emails.remind',$mailData,
	            	function($message) {
	                     $message->subject("ubexchange password reset");
	                     $message->to(Input::get('email'));
	                 }
	             );

                return Redirect::back()->with('alertMessage', 'a link has been send to your email to reset your password.');

            } else {
                return Redirect::back()->with('alertError', 'we can not find a user with that email address.');

            }

        }
	}

	// function for displaying reset page through email link
	public function recovery($link){

		$user = User::where('remind', '=', $link)->first();

		//return var_dump($user->id);

		if ($user->count()) {
			return View::make('password.reset')->with('user', $user);
		} else {
			return Redirect::back()->with('alertError', 'invalid reset code');

		}

	}

	// function for handling reset password
	public function handleRecovery(){

		$messages = array(
            'same'    => 'The :attribute and :other must match.',
            'required' => 'The :attribute field is required.',
            'min'       =>'The :attribute must be atleast :min characters'
        );
        $editData = Input::all();
        $editRules = array(
            'new_password' =>'required|min:6',
            'confirm_new_password' => 'required|same:new_password'
        );

        $editValidator = Validator::make($editData,$editRules);
        if($editValidator->fails()) {   
            return Redirect::back()->withInput()->withErrors($editValidator);
        } 

        if ($editValidator->passes()) {
        	$userToUpdate = User::find(Input::get('special'));
        	$userToUpdate->password = Hash::make(Input::get('new_password'));
        	$userToUpdate->save();

        	return 'done.'; //to user profile index page
        	//return Redirect::to('login')->with('alertMessage',"password reseted successfully. Login now!!!");
        }
	}
}