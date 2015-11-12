<?php

class ProfileController extends BaseController {

    public function __construct() {
        //$this->filter('before', 'auth');
    }

    public function getIndex() {

        $data['user'] = User::find(Auth::user()->id);

        if ($data['user']->photo == "") {

            $data['count'] = Gravatar::all()->count();
            $rand = rand(1, $data['count']);
            $data['gravatar'] = Gravatar::find($rand);

            $data['imageData'] = Identicon::getImageData('rocard');
            
            return View::make('profile.complete')->with($data);
        }

        //return var_dump($data['user']->photo);

        return View::make('profile.index')->with($data);

    }

    public function postUploadpoto(){
        //$destinationPath = 'photo/';
        $userEdit = User::find(Auth::user()->id);

        // uploading and setting of new logo
        $photo = bin2hex(openssl_random_pseudo_bytes(20)). '_'. '.'.Input::file('photo')->getClientOriginalExtension();
        $photo_thumbnail = bin2hex(openssl_random_pseudo_bytes(20)). '_'. 'thumbnail'. '.'.Input::file('photo')->getClientOriginalExtension();
        Input::file('photo')->move('photo/', $photo);
        File::copy('photo/'.$photo, 'photo/'.$photo_thumbnail);

        Image::make('photo/'.$photo)->resize(300, 300)->save('photo/'.$photo);
        Image::make('photo/'.$photo_thumbnail)->resize(48, 48)->save('photo/'.$photo_thumbnail);

        $userEdit->photo = $photo;
        $userEdit->photo_thumbnail = $photo_thumbnail;
        $userEdit->save();

        return Redirect::to('profile');
        
    }

    public function getCompleteregistration($id){

        $gravatar = Gravatar::find($id);
        $userEdit = User::find(Auth::user()->id);

        $photo = bin2hex(openssl_random_pseudo_bytes(20)). '_'. $gravatar->image;
        $photo_thumbnail = bin2hex(openssl_random_pseudo_bytes(20)). '_'. 'thumbnail'. '_'.$gravatar->image;

        File::copy('gravatar/'.$gravatar->image, 'photo/'.$photo);
        File::copy('photo/'.$photo, 'photo/'.$photo_thumbnail);

        Image::make('photo/'.$photo)->resize(300, 300)->save('photo/'.$photo);
        Image::make('photo/'.$photo_thumbnail)->resize(32, 32)->save('photo/'.$photo_thumbnail);

        $userEdit->photo = $photo;
        $userEdit->photo_thumbnail = $photo_thumbnail;
        $userEdit->save();

        return Redirect::to('profile');

    }

    public function getActivity() {
        $data['userQustions'] = Question::where('user_id', '=', User::find(Auth::user()->id)->id)->orderBy('created_at', 'desc')->paginate(4);
        $data['questionsCount'] = $data['userQustions']->count();

        $data['userAnswers'] = Answer::where('user_id', '=', User::find(Auth::user()->id)->id)->orderBy('created_at', 'desc')->paginate(4);
        $data['answersCount'] = $data['userAnswers']->count();

        return View::make('profile.activity')->with($data);
    }

    //=====================================================
    //  edit profile
    //=====================================================
    public function getEditprofile() {

        $data['user'] = User::find(Auth::user()->id);

        return View::make('profile.editprofile')->with($data);
    }

    public function postUploadedit(){
        //$destinationPath = 'photo/';
        $userEdit = User::find(Auth::user()->id);

        // delete existing logo if any
        if ($userEdit->photo != null) {
            File::delete('photo/'.$userEdit->photo);
            File::delete('photo/'.$userEdit->photo_thumbnail);
        }

        // uploading and setting of new logo
        $photo = bin2hex(openssl_random_pseudo_bytes(20)). '_'. '.'.Input::file('photo')->getClientOriginalExtension();
        $photo_thumbnail = bin2hex(openssl_random_pseudo_bytes(20)). '_'. 'thumbnail'. '.'.Input::file('photo')->getClientOriginalExtension();
        Input::file('photo')->move('photo/', $photo);
        File::copy('photo/'.$photo, 'photo/'.$photo_thumbnail);

        Image::make('photo/'.$photo)->resize(300, 300)->save('photo/'.$photo);
        Image::make('photo/'.$photo_thumbnail)->resize(48, 48)->save('photo/'.$photo_thumbnail);

        $userEdit->photo = $photo;
        $userEdit->photo_thumbnail = $photo_thumbnail;
        $userEdit->save();

        return Redirect::back();
        
    }

    public function postPublicinfo(){

        $userToUpdate = User::find(Auth::user()->id);
        $userToUpdate->name = Input::get('name');
        $userToUpdate->faculty = Input::get('faculty');
        $userToUpdate->about = Input::get('about_me');
        $userToUpdate->save();

        return Redirect::back();
    }

    public function postWebpresence(){

        $userToUpdate = User::find(Auth::user()->id);
        $userToUpdate->website = Input::get('website');
        $userToUpdate->git = Input::get('git');
        $userToUpdate->twitter = Input::get('twitter');
        $userToUpdate->save();
        return Redirect::back();
    }

    public function postPrivateinfo(){

        $userToUpdate = User::find(Auth::user()->id);
        $userToUpdate->real_name = Input::get('name');
        $userToUpdate->email = Input::get('email');
        $userToUpdate->save();
        return Redirect::back();
    }

    public function getDeleteprofile(){

        $userTodelete = User::find(Auth::user()->id);
        $userTodelete->delete();

        return Redirect::to('/');    
    }
    //=====================================================
    //  end edit profile
    //=====================================================

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
            

            return Redirect::to('/')->with('alertMessage',"question posted successfully.");
        }

    }

    public function getEditquestion($id, $slug){

        $data['questionToEdit'] = Question::find($id);

        return View::make('profile.editquestion')->with($data);

    }

    public function postEditquestion(){
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
            $questionToEdit = Question::find(Input::get('special'));
            $questionToEdit->title = Input::get('title');
            $questionToEdit->description = Input::get('body');
            $questionToEdit->user_edit_id = Auth::user()->id;
            $questionToEdit->edit_time = new DateTime();
            $questionToEdit->save();
            

            return Redirect::to('profile')->with('alertMessage',"question edited successfully.");
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

    public function getEditanswer($id){

        $data['answerToEdit'] = Answer::find($id);

        return View::make('profile.editanswer')->with($data);

    }

    public function postEditanswer(){
        $registerData = Input::all();
        $registerRules = array(
            'answer'     =>'required',
            );
        $registerValidator = Validator::make($registerData,$registerRules);
        if($registerValidator->fails()) {
            return Redirect::back()->withInput()->withErrors($registerValidator);
        }
        if( $registerValidator->passes()) {
            $answerToEdit = Answer::find(Input::get('special'));
            $answerToEdit->description = Input::get('answer');
            $answerToEdit->user_edit_id = Auth::user()->id;
            $answerToEdit->edit_time = new DateTime();
            $answerToEdit->save();
            
            return Redirect::to('profile')->with('alertMessage',"question edited successfully.");
        }

    }

    
}
