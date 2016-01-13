<?php

class ProfileController extends BaseController {

    public function __construct() {
        //$this->filter('before', 'auth');
    }

    // function for displaying user index page
    public function getIndex() {

        $data['user'] = User::find(Auth::user()->id);

        if ($data['user']->photo == "") {

            $data['count'] = Gravatar::all()->count();
            $rand = rand(1, $data['count']);
            $data['gravatar'] = Gravatar::find($rand);

            //$data['imageData'] = Identicon::getImageData('rocard');
            
            return View::make('profile.complete')->with($data);
        }

        //return var_dump($data['user']->photo);

        return View::make('profile.index')->with($data);

    }

    // function for handling photo when user complete profile registration
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

    // function for displaying complete registrattion page
    public function getCompleteregistration($id){

        $gravatar = Gravatar::find($id);
        $userEdit = User::find(Auth::user()->id);

        $photo = bin2hex(openssl_random_pseudo_bytes(20)). '_'. $gravatar->image;
        $photo_thumbnail = bin2hex(openssl_random_pseudo_bytes(20)). '_'. 'thumbnail'. '_'.$gravatar->image;

        File::copy('gravatar/'.$gravatar->image, 'photo/'.$photo);
        File::copy('photo/'.$photo, 'photo/'.$photo_thumbnail);

        Image::make('photo/'.$photo)->resize(300, 300)->save('photo/'.$photo);
        Image::make('photo/'.$photo_thumbnail)->resize(48, 48)->save('photo/'.$photo_thumbnail);

        $userEdit->photo = $photo;
        $userEdit->photo_thumbnail = $photo_thumbnail;
        $userEdit->save();

        return Redirect::to('profile');

    }

    // function for displaying userActivity page
    public function getActivity() {
        
        $data['user'] = User::find(Auth::user()->id);
        $data['userQustions'] = Question::where('user_id', '=', User::find(Auth::user()->id)->id)->orderBy('created_at', 'desc')->get();
        $data['questionsCount'] = $data['userQustions']->count();

        $data['userAnswers'] = Answer::where('user_id', '=', User::find(Auth::user()->id)->id)->orderBy('created_at', 'desc')->get();
        $data['answersCount'] = $data['userAnswers']->count();

        return View::make('profile.activity')->with($data);
    }

    // function for displaying editUser page
    public function getEditprofile() {

        $data['user'] = User::find(Auth::user()->id);

        return View::make('profile.editprofile')->with($data);
    }

    // function for handling photo upload during edit user process
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

    // function for handling userPublic info
    public function postPublicinfo(){

        $userToUpdate = User::find(Auth::user()->id);
        $userToUpdate->name = Input::get('name');
        $userToUpdate->faculty = Input::get('faculty');
        $userToUpdate->about = Input::get('about_me');
        $userToUpdate->save();

        return Redirect::back();
    }

    // function for handling userWebPresence info
    public function postWebpresence(){
        $rules = array(
            'website' => 'url',
            "twitter" => 'url',
            "git"      => 'url',
            );
        $messages = array(
            'url' => 'add http://',
            );
        $theValidator = Validator::make(Input::all(), $rules, $messages);
        if ($theValidator->fails()) {
            return Redirect::back()->withInput()->withErrors($theValidator);
        }

        $userToUpdate = User::find(Auth::user()->id);
        $userToUpdate->website = Input::get('website');
        $userToUpdate->git = Input::get('git');
        $userToUpdate->twitter = Input::get('twitter');
        $userToUpdate->save();
        return Redirect::back();
    }

    // function for handling userPrivate info
    public function postPrivateinfo(){

        $userToUpdate = User::find(Auth::user()->id);
        $userToUpdate->real_name = Input::get('name');
        $userToUpdate->email = Input::get('email');
        $userToUpdate->save();
        return Redirect::back();
    }

    // function for deleting user profile
    public function getDeleteprofile(){

        $userTodelete = User::find(Auth::user()->id);
        $userTodelete->delete();

        return Redirect::to('/');    
    }

    // function for displaying form for user password change
    public function getSettings(){
        
        return View::make('password.account');
    }

    // function for handling userPassword change
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

    // function for displaying askQuestion form
    public function getAskquestion(){

        if (Auth::check()== NULL) {

            return Redirect::to('login')
                 ->with('alertError', "you must be logged in to ask a question on UbExchange<br /> log in below or sign up");
            
        }
        return View::make('profile.askquestion');

    }

    // function for handling askQuestion
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

    // function for displaying editQuestion form
    public function getEditquestion($id, $slug){

        $data['questionToEdit'] = Question::find($id);

        return View::make('profile.editquestion')->with($data);

    }

    // function for handling editQuestion
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
            

            return Redirect::to('question/'.$questionToEdit->id. '/'.$questionToEdit->slug)->with('alertMessage',"question edited successfully.");
            //return Redirect::to('question')->with('alertMessage',"question edited successfully.");
        }

    }

    // function for handling Answer
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
            $q_data = Question::find(Input::get('special'));
            
            $answer = new Answer();
            $answer->user_id = Auth::user()->id;
            $answer->question_id = Input::get('special');
            $answer->description = Input::get('answer');
            $answer->question_title = $q_data->title;
            $answer->save();

            // sent email to notify the user who asked the question
            //$q_data = Question::find(Input::get('special'));
            $user_data = User::find($q_data->user_id);

            $mailData = array(
                'name'=> $user_data->name,
                'q_id'=> $q_data->id,
                'q_slug' => $q_data->slug,
                );
            $mailMan = array('email' => $user_data->email);

            Mail::send('emails.question_alert',$mailData, 
                function($message) use ($mailMan) {
                    $message->subject("ubexchange question alert");
                    $message->to($mailMan['email']);
                }
            );
            
            return Redirect::back()->with('alertMessage',"answer posted successfully.");
        }

    }

    // function for displaying editAnswer form
    public function getEditanswer($id, $qID){

        $data['answerToEdit'] = Answer::find($id);
        $data['questionToEdit'] = $qID;

        return View::make('profile.editanswer')->with($data);

    }

    // function for handling editAswer
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

            $question = Question::find(Input::get('qID'));

            return Redirect::to('question/'.$question->id. '/'.$question->slug)->with('alertMessage',"question edited successfully.");
        }

    }

    // function for handling acceptAnswer  and userReputation
    public function getAcceptanswer($aID, $qID, $uID){

        //return $aID. ' '. $qID;
        $answerToAccept = Answer::find($aID);
        $answerToAccept->status = 'accepted';
        $answerToAccept->save();

        $questionToUpdate = Question::find($qID);
        $questionToUpdate->status = 'solved';
        $questionToUpdate->save();

        $userToUpdate = User::find($uID);
        $reputation = $userToUpdate->reputation;
        $userToUpdate->reputation = $reputation + 15;
        $userToUpdate->save();

        $answerReputation = new Areputation();
        $answerReputation->user_id = $uID;
        $answerReputation->answer_id = $aID;
        $answerReputation->points = "+15";
        $answerReputation->action = "accept";
        $answerReputation->save();

        $authReputation = new Areputation();
        $authReputation->user_id = Auth::user()->id;
        $authReputation->answer_id = $aID;
        $authReputation->points = "+2";
        $authReputation->action = "accept";
        $authReputation->save();

        $userReputation = User::find(Auth::user()->id);
        $rep = $userReputation->reputation;
        $userReputation->reputation = $rep + 2;
        $userReputation->save();

        return Redirect::back();
    }

    // function for handling userComments
    public function postComment() {
        $commentData = Input::all();
        $commentRules = array(
            'comment'     =>'required',
            );
        $commentValidator = Validator::make($commentData,$commentRules);
        if($commentValidator->fails()) {
            return Redirect::back()->withInput()->withErrors($commentValidator);
        }
        if($commentValidator->passes()) {
            $comment = new Comment();
            $comment->user_id = Auth::user()->id;
            $comment->question_id = Input::get('special');
            $comment->comment = Input::get('comment');
            $comment->save();
            
            return Redirect::back()->with('alertMessage',"comment posted successfully.");
        }
    }

    
}
