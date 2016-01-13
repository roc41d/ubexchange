@extends('layouts.profile')

{{-- web site title --}}
@section('title')
@parent
activity
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

  </div>
  <div class="col-md-8 ">
    <div class="pull-right">

      @include('site.nav')
    </div>

  </div>

</div>
@if(Auth::check() && Auth::user()->id == $user->id)
<div id="menun"> <br />
<ul class="nav nav-tabs">
  <li><a href="{{URL::to('profile')}}"><small>Profile</small></a></li>
  <li class="active"><a href="{{URL::to('profile/activity')}}"><small>Activity</small></a></li>
  <li><a href="{{URL::to('profile/editprofile')}}"><small>Profile & Settings</small></a></li>
</ul>
</div><br />
@else
<div id="menun"> <br />
<ul class="nav nav-tabs">
  <li><a href="{{URL::to('user/' .$user->id . '/' .$user->name)}}"><small>Profile</small></a></li>
  <li class="active"><a href="{{URL::to('activity/' .$user->id . '/' .$user->name)}}"><small>Activity</small></a></li>
</ul>
</div><br />
@endif


<div class="row">
  <div class="col-sm-12">
      <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-md-6">
            <h4>activities summary</h4>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="col-md-6">
          <h5 class="activityswag">{{$questionsCount}} Qusetions</h5>
          @foreach($userQustions as $question)
            <div class="row">
              <div class="col-sm-1" id="questions">
                  {{$question->votes}}
              </div>
              <div class="col-sm-11" id="q">
                  <h5><a href="{{URL::to('question/'. $question->id. '/'. $question->slug)}}">{{$question->title}}</a></h5>
              </div>
            </div><hr >
          @endforeach
        </div>
        <div class="col-md-6">
          <h5 class="activityswag">{{$answersCount}} Answers</h5>
          @foreach($userAnswers as $anwser)
            <h5><a href="#">{{$anwser->question_title}}</a></h5>
          @endforeach
        </div> <br />

      </div><!--/panel-body-->
  </div><!--/panel-->        
    
  </div>
</div>
@stop