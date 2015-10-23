<?php

class ProfileController extends BaseController
{

    public function __construct() {
    }

    public function getIndex() {

        $data['user'] = User::find(Auth::user()->id);

        return View::make('profile.index')->with($data);

    }

    public function getActivity() {

        return View::make('profile.activity');
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
                    return Redirect::to('profile')->with('alertMessage', 'your password has been changed.');
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


    //=====================================================
    //  ask question methods
    //=====================================================
    public function getAskquestion(){

        if (Auth::check()== NULL) {

            return Redirect::to('login')
                 ->with('alertError', "you must be logged in to ask a question on UbExchange<br /> log in below or sign up");
            
        }
        return View::make('profile.askquestion');

    }

    public function postAskquestion(){
        $registerData = Input::all();
        $registerRules = array(
            'title'     =>'required',
            'body'      =>'required',
            );
        $registerValidator = Validator::make($registerData,$registerRules);
        if($registerValidator->fails()) {
            return Redirect::back()->withInput()->withErrors($registerValidator);
        }
        if( $registerValidator->passes()) {
            $question = new Question();
            $question->title = Input::get('title');
            $question->description = Input::get('body');
            $question->user_id = Auth::user()->id;
            $question->save();
            

            return Redirect::to('profile')->with('alertMessage',"question posted successfully.");
        }

    }


    //=====================================================
    //  answer question methods
    //=====================================================

    public function postAnswer(){
        $registerData = Input::all();
        $registerRules = array(
            'answer'     =>'required',
            );
        $registerValidator = Validator::make($registerData,$registerRules);
        if($registerValidator->fails()) {
            return Redirect::back()->withInput()->withErrors($registerValidator);
        }
        if($registerValidator->passes()) {
            $answer = new Answer();
            $answer->user_id = Auth::user()->id;
            $answer->question_id = Input::get('special');
            $answer->description = Input::get('answer');
            $answer->save();
            

            return Redirect::back()->with('alertMessage',"answer posted successfully.");
        }

    }

    
}
