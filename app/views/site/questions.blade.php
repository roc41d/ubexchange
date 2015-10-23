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

<div class="row">
    <div class="col-sm-9">
      <h3>All Questions</h3><hr />
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
          <small class="pull-right">asked {{date("F jS, Y -- g:i A",strtotime($question->created_at))}} by: <a href="{{URL::to('user/'. $question->user_id. '/'. $users->find($question->user_id)->name)}}">{{$users->find($question->user_id)->name}}</a></small>
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