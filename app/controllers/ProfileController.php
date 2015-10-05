<?php

class ProfileController extends BaseController
{

    public function __construct() {
    }

    public function getIndex() {

        /*if(User::find(User::find(Auth::user())->id) == 1){
            return 'upload profile photo';//View::make('profile.welcome');
        }*/
        return 'profile index page';//View::make('profile.index');

    }

    //=====================================================
    //  change user password
    //=====================================================
    public function getSettings(){
        
        return View::make('password.account');
    }

    public function postSettings(){
        
        $validator = Validator::make(Input::all(),
            array(
                'current_password'      => 'required',
                'new_password'          => 'required|min:6',
                'confirm_new_password'  => 'required|same:new_password'

            )
        );

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {

            $user               = User::find(Auth::user()->id);
            $current_password   = Input::get('current_password');
            $new_password       = Input::get('new_password');

            if (Hash::check($current_password, $user->getAuthPassword())) {
                $user->password = Hash::make($new_password);

                if ($user->save()) {
                    return Redirect::back()->with('alertMessage', 'your password has been changed.');
                }

            } else {
                return Redirect::back()->with('alertError', 'Oops! your old password is not correct.');
            }
        }

        return Redirect::back()->with('alertError', 'your password could not be changed.');

    }

    //=====================================================
    //  end change user password
    //=====================================================
    
}
