@extends('layouts.layout')

{{-- web site title --}}
@section('title')
@parent
{{$question->slug}}
@stop

{{-- website content --}}
@section('content')

@if(Session::has('alertMessage'))
<div class="alert alert-dismissable alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{Session::get('alertMessage')}}</strong>
</div>
@endif

@if(Session::has('alertError'))
<div class="alert alert-dismissable alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{Session::get('alertError')}}</strong>
</div>
@endif

<div class="row">
  <div class="col-md-4">
      <p></p>
  </div>
  <div class="col-md-8 ">
    <div class="pull-right">

      @include('site.nav')
    </div>

  </div>
</div> <br />

<div class="row">
    <div class="col-sm-9">
      <h3>{{$question->title}}</h3><hr />

      <div class="row">
        <div class="col-sm-1" id="votes">
            <a href="{{URL::to('votes/upvotequestion/'. $question->id)}}" title="This question shows research effort; it is useful and clear"><i class="fa fa-chevron-up" ></i></a><br />
            {{$question->votes}}<br />
            <a href="{{URL::to('votes/downvotequestion/'. $question->id)}}" title="This question does not show research effort; it is unclear and not useful"><i class="fa fa-chevron-down" ></i></a>
        </div>
        
        <div class="col-sm-11" id="q">
          <p>{{$question->description}}</p>
          <small class="pull-right">ask {{date("F jS, Y -- g:i A",strtotime($question->created_at))}} by: <a href="{{URL::to('user/'. $question->user_id. '/'. $users->find($question->user_id)->name)}}">{{$users->find($question->user_id)->name}}</a></small>
        </div>
      </div> <br/><br />

      <h4>{{$count}} Answers</h4><hr />
      @foreach($answers as $answer)
      <div class="row">
        <div class="col-sm-1" id="votes">
            <a href="{{URL::to('votes/upvoteanswer/'. $answer->id)}}" title="This question shows research effort; it is useful and clear"><i class="fa fa-chevron-up" ></i></a><br />
            {{$answer->votes}}<br />
            <a href="{{URL::to('votes/downvoteanswer/'. $answer->id)}}" title="This question does not show research effort; it is unclear and not useful"><i class="fa fa-chevron-down" ></i></a>
        </div>
        <div class="col-sm-11" id="q">
          <p>{{$answer->description}}</p>
          <small class="pull-right">answered {{date("F jS, Y -- g:i A",strtotime($answer->created_at))}} by: <a href="{{URL::to('user/'. $question->user_id. '/'. $users->find($question->user_id)->name)}}">{{$users->find($answer->user_id)->name}}</a></small>
        </div>
    
      </div><hr />
      @endforeach

      <br/><br />
      <div class="row">
            @if(Auth::check())
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Your Answer</h3></div>
                  <div class="panel-body">
                    {{Form::open(array('url'=>'profile/answer'))}}
                        <input type="hidden" name="special"  value="{{$question->id}}" />
                        <div class="form-group">
                            <div class="">
                              <textarea class="form-control" name="answer" id="answer" rows="7"></textarea>
                              <span class="badge alert-danger">{{ ($errors->has('answer') ? $errors->first('answer') : '') }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="">
                              <button type="submit" class="btn btn-success pull-right">Post Your Answer</button>
                            </div>
                        </div>
                    {{Form::close()}}
                </div>
          </div>
          @endif
          <h4><a href="{{URL::to('login')}}">Login</a> or <a href="{{URL::to('register')}}">Sign up</a> to answer this question</h4>
      </div>

    </div>

    <div class="col-sm-3">
        <img src="http://placehold.it/260x500">
    </div>
</div>
@stop