@extends('layouts.layout')

{{-- web site title --}}
@section('title')
@parent
home
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
@if(Auth::check()==NULL)
<div class="panel panel-default">
  <div class="panel-body">
    <h2 class="text-muted">Welcome!</h2>
    <p>
      ubexchange is a platform where computer enthusiasts all over the University of Buea can ask
      <em>programming related questions</em> and get answers from lecturers, experience programmers, and more.
    </p>
    <p><a href="{{URL::to('register')}}" class="btn btn-primary btn-lg">get started</a></p>

      <!--<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      </ol>
     

      <div class="carousel-inner">
        <div class="item active">
          <img src="http://placehold.it/1200x315" alt="...">
          <div class="carousel-caption">
              <h3>Caption Text</h3>
          </div>
        </div>
        <div class="item">
          <img src="http://placehold.it/1200x315" alt="...">
          <div class="carousel-caption">
              <h3>Caption Text</h3>
          </div>
        </div>
        <div class="item">
          <img src="http://placehold.it/1200x315" alt="...">
          <div class="carousel-caption">
              <h3>Caption Text</h3>
          </div>
        </div>
      </div>
     

      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="fa fa-angle-right-left"></span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="fa fa-angle-right"></span>
      </a>
    </div>  -->
    <!-- Carousel -->

  </div>
</div>

<br />
@endif

<div class="row">
    <div class="col-sm-9">
      <h3>Recently Asked Questions</h3><hr />
      @if($count == 0)
        <h5>No question(s) available.</h5>
      @endif
      @foreach($questions as $question)
      <div class="row">
        <div class="col-sm-1" id="questions">
            {{$question->votes}}<br />
          <small>votes</small><br /><br />
            {{Answer::where('question_id','=',$question->id)->count()}}<br />
          <small>answers</small>
        </div>
        <div class="col-sm-11" id="q">
          <h4><a href="{{URL::to('question/'. $question->id. '/'. $question->slug)}}">{{$question->title}}</a></h4>
          <p>{{substr(strip_tags($question->description), 0, 250)}}</p>
          <small class="pull-right">asked {{date("F jS -- g:i A",strtotime($question->created_at))}} by: <a href="{{URL::to('user/'. $question->user_id. '/'. $users->find($question->user_id)->name)}}">{{$users->find($question->user_id)->name}}</a></small>
        </div>
      </div><hr >
       @endforeach
       {{$questions->links()}}



    </div>

    <div class="col-sm-3">
        <h4>
          {{$count}}<br />
          <small>questions</small>
        </h4>
        <img src="http://placehold.it/260x500">
    </div>
</div>
@stop