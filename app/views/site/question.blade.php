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
            <a href="{{URL::to('votes/upvotequestion/'. $question->id. '/'. $question->user_id)}}" title="This question shows research effort; it is useful and clear" style="color: grey"><i class="fa fa-chevron-up" ></i></a><br />
            {{$question->votes}}<br />
            <a href="{{URL::to('votes/downvotequestion/'. $question->id. '/'. $question->user_id)}}" title="This question does not show research effort; it is unclear and not useful" style="color: grey"><i class="fa fa-chevron-down" ></i></a>
        </div>
        
        <div class="col-sm-11" id="q">
          <div id="wmd-preview" class="wmd-panel1 wmd-preview">{{$question->description}}</div>
          @if(Auth::check() && Auth::user()->reputation >= 50)
          <small><a href="{{URL::to('profile/editquestion/'. $question->id. '/'. $question->slug)}}">improve this question</a></small>
          @endif
          <p class="pull-right">
              @if($question->user_edit_id > 0)
              <small id="editbyswag">edited {{date("F jS -- g:i A",strtotime($question->edit_time))}} by: <a href="{{URL::to('user/'. $question->user_edit_id. '/'. $users->find($question->user_edit_id)->name)}}">{{$users->find($question->user_edit_id)->name}}</a></small>
              @endif
              <small>ask {{date("F jS -- g:i A",strtotime($question->created_at))}} by: <a href="{{URL::to('user/'. $question->user_id. '/'. $users->find($question->user_id)->name)}}">{{$users->find($question->user_id)->name}}</a></small>
          </p><br /><br />

          <div class="addthis_native_toolbox"></div><br /><hr>

          @foreach($comments as $comment)
            <small>{{$comment->comment}} by: <a href="{{URL::to('user/'. $comment->user_id. '/'. $users->find($comment->user_id)->name)}}">{{$users->find($comment->user_id)->name}}</a></small><hr>

          @endforeach

          @if(Auth::check())
          <button class="btn btn-xs btn-default" id="show">add comment</button>
            <div id="comment" style="display:none">
              {{Form::open(array('url'=>'profile/comment'))}}
                  <input type="hidden" name="special"  value="{{$question->id}}" />
                  <div class="form-group">
                      <div class="">
                        <textarea class="form-control" name="comment" id="description" rows="3"></textarea>
                        <span class="badge alert-danger">{{ ($errors->has('comment') ? $errors->first('comment') : '') }}</span>
                      </div>
                  </div>
                  <div class="form-group">
                      <div class="">
                        <button type="submit" class="btn btn-xs btn-primary pull-right">post comment</button>
                      </div>
                  </div>
              {{Form::close()}}
              <button class="btn btn-xs btn-danger" id="hide">hide form</button>
            </div>
          @endif           
        </div>
      </div> <br/><br />

      <h4>{{$count}} Answers</h4><hr />
      @foreach($answers as $answer)
      <div class="row">
        <div class="col-sm-1" id="votes">
            <a href="{{URL::to('votes/upvoteanswer/'. $answer->id. '/'. $answer->user_id)}}" title="This question shows research effort; it is useful and clear" style="color: grey"><i class="fa fa-chevron-up" ></i></a><br />
            {{$answer->votes}}<br />
            <a href="{{URL::to('votes/downvoteanswer/'. $answer->id. '/'. $answer->user_id)}}" title="This question does not show research effort; it is unclear and not useful" style="color: grey"><i class="fa fa-chevron-down" ></i></a><br />     
          @if($answer->status != NULL)
            <i class="fa fa-check fa-2x accept"></i>
          @endif    
        </div>
        <div class="col-sm-11" id="q">
          <div id="wmd-preview" class="wmd-panel1 wmd-preview">{{$answer->description}}</div>
          @if(Auth::check())

            @if(Auth::user()->reputation >= 100 || Auth::user()->id == $answer->user_id)
              <small><a href="{{URL::to('profile/editanswer/'. $answer->id. '/'.$question->id)}}">improve this answer</a></small>
            @endif

             @if($question->status == NULL && Auth::user()->id == $users->find($question->user_id)->id)
            <small id="acceptswag"><a href="{{URL::to('profile/acceptanswer/'. $answer->id. '/'. $question->id. '/'. $answer->user_id)}}">accept answer</a></small>
            @endif

          @endif
          <p class="pull-right">
            @if($answer->user_edit_id > 0)
            <small id="editbyswag">edited {{date("F jS -- g:i A",strtotime($answer->edit_time))}} by: <a href="{{URL::to('user/'. $answer->user_edit_id. '/'. $users->find($answer->user_edit_id)->name)}}">{{$users->find($answer->user_edit_id)->name}}</a></small>
            @endif
            <small>answered {{date("F jS -- g:i A",strtotime($answer->created_at))}} by: <a href="{{URL::to('user/'. $answer->user_id. '/'. $users->find($answer->user_id)->name)}}">{{$users->find($answer->user_id)->name}}</a></small>
          </p><br />
        </div>
      </div><hr />
      @endforeach

      <br/><br />
      <div class="row">
            @if(Auth::check())
            <div class="panel panel-default">
                <div class="panel-heading"><h3>Your Answer</h3></div>
                  <div class="panel-body">
                    <div class="well">
                        <p>Under the <b>Format</b> menu, you will find some usefull tags that will help you format your answer.</p>
                        <p>Please use the <b>Pre</b> tag which is located under <small><b>Format ->Formats ->Blocks ->Pre</b></small> when adding source codes to your answer.</p>
                    </div>
                    {{Form::open(array('url'=>'profile/answer'))}}
                        <input type="hidden" name="special"  value="{{$question->id}}" />
                        <div class="form-group">
                            <div class="">
                              <textarea class="form-control" name="answer" id="question" rows="7"></textarea>
                              <span class="badge alert-danger">{{ ($errors->has('answer') ? $errors->first('answer') : '') }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="">
                              <button type="submit" class="btn btn-primary pull-right">Post Your Answer</button>
                            </div>
                        </div>
                    {{Form::close()}}
                </div>
          </div>
          @endif
          @if(Auth::check() == NULL)
            <h4><a href="{{URL::to('login')}}">Login</a> or <a href="{{URL::to('register')}}">Sign up</a> to answer this question</h4>
          @endif
      </div>

    </div>

    <div class="col-sm-3">
        <img src="http://placehold.it/260x500">
    </div>
</div>
@stop