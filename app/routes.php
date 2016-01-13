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


Route::get('/', function () {

    $data['users'] = User::all();
    //$data['questions'] = DB::select( DB::raw("SELECT * FROM  `questions` ORDER BY  `created_at` DESC LIMIT 1") );
    $data['questions'] = Question::orderBy('created_at', 'desc')->paginate(10);
    $data['count'] = Question::all()->count();

        return View::make('site.home')->with($data);
});

Route::get('questions', function () {

    $data['users'] = User::all();
    $data['questions'] = Question::orderBy('created_at', 'desc')->paginate(10);
    $data['count'] = Question::all()->count();

    return View::make('site.questions')->with($data);
        
});

Route::get('question/{id}/{slug}', function ($id, $slug) {

    $data['users'] = User::all();
    $data['qvotes'] = Qvote::where('question_id', '=', $id)->get();
    $data['question'] = Question::find($id);
    $data['answers'] = Answer::where('question_id', '=', $id)->orderBy('votes', 'desc')->get();
    $data['comments'] = Comment::where('question_id', '=', $id)->orderBy('created_at', 'desc')->get();
    $data['count'] = Answer::where('question_id', '=', $id)->count();

        return View::make('site.question')->with($data);
});

Route::get('users', function () {

    $data['users'] = User::orderBy('reputation', 'desc')->paginate(20);

        return View::make('site.users')->with($data);
});

Route::get('user/{id}/{slug}', function ($id, $slug) {

    $data['user'] = User::find($id);

    //return var_dump($data['user']->website);

    return View::make('profile.index')->with($data);
});

Route::get('activity/{id}/{slug}', function ($id, $slug) {

    $data['user'] = User::find($id);
    $data['userQustions'] = Question::where('user_id', '=', $id)->orderBy('created_at', 'desc')->paginate(4);
    $data['questionsCount'] = $data['userQustions']->count();

    $data['userAnswers'] = Answer::where('user_id', '=', $id)->orderBy('created_at', 'desc')->paginate(4);
    $data['answersCount'] = $data['userAnswers']->count();

        return View::make('profile.activity')->with($data);
});

Route::get('unanswer', function () {

    $data['users'] = User::all();
    $data['unanswer'] = Question::where('status', '=', NULL)->orderBy('created_at', 'desc')->paginate(10);
    $data['count'] = $data['unanswer']->count();

    return View::make('site.unansweredquestions')->with($data);
});

Route::get('search', function () {

    $data['users'] = User::all();
    $data['searchResults'] = Question::where('description', 'like', '%'.Input::get('search').'%')->paginate(10);
        
        $data['count'] =  $data['searchResults']->count();
        return View::make('site.searchresults')->with($data);
});

Route::get('contact_us', function () {
        return Redirect::back();
});

Route::get('privacy_policy', function () {
        return Redirect::back();
});

/*
    |--------------------------------------------------------------------------
    | Session Controller Routes
    |--------------------------------------------------------------------------
    |
    | Routes to handle session things
    |
    */
Route::get('logout', 'SessionController@logout');
Route::get('login', 'SessionController@login');
Route::post('login', 'SessionController@handleLogin')->before('csrf');
Route::get('register', 'SessionController@register');
Route::post('register', 'SessionController@handleRegister')->before('csrf');
Route::get('activate/{key}', 'SessionController@activate');

Route::get('remind', 'SessionController@remind');
Route::post('remind', 'SessionController@handleRemind');
Route::get('recovery/{link}', 'SessionController@recovery');
Route::post('recovery', 'SessionController@handleRecovery');


/*
    |--------------------------------------------------------------------------
    | Profile Controller Routes
    |--------------------------------------------------------------------------
    |
    | Routes to handle user profile
    |
    */

Route::group(array('before' => 'auth'), function(){

    Route::controller('profile', 'ProfileController');

    Route::controller('votes', 'VoteController');

});

/*
    |--------------------------------------------------------------------------
    | Profile Controller Routes
    |--------------------------------------------------------------------------
    |
    | Routes to handle user profile
    |
    */
    Route::controller('social', 'SocialController');

/*
    |--------------------------------------------------------------------------
    | Search Controller Routes
    |--------------------------------------------------------------------------
    |
    | Routes to handle questions and answers in the public area
    |
    */

    Route::get('answers', function () {

        $data['answers'] = DB::select( DB::raw("SELECT 'q.title' FROM questions q, answers a WHERE 'q.id' = 'a.question_id'") );

        return $data['answers'];

        //SELECT * FROM questions q, answers a WHERE q.id = a.question_id
        
});

    Route::get('string', function () {

    //$myString = "java, php, laravel, ci, html, c, c++, css, javascript";
    //$myArray = explode(',', $myString);
        $str="java, php, html, css, swift, javascript, xml";
        $arr=explode(",",$str);

        echo "<b>". $arr[0]. "<b>";
        
});


Route::get('demo', function () {


        return View::make('site.demo');
});

    /*Route::get('photo', function () {

        $data['count'] = Gravatar::all()->count();
        $rand = rand(1, $data['count']);
        $data['gravatar'] = Gravatar::find($rand);

        //return $rand;

        return $data['gravatar']->image;
        
});*/
     //$date = date("F j, Y, g:i a");
