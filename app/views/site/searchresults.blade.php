@extends('layouts.layout')

{{-- web site title --}}
@section('title')
@parent
search
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
</div>

<div class="row"><br /><br />
    <div class="col-sm-9">

    <div class="row" id="searchswag">
          <div class="col-sm-12">
            {{Form::open(array('url'=>'search', 'method'=>'get'))}}
              <div class="input-group">
                <input type="text" class="form-control" name="search" value="{{Input::get('search')}}" placeholder="Keywords">
                <span class="input-group-btn" style="padding-left: 15px;">
                  <button class="btn btn-primary" type="submit">
                      <span><i class="fa fa-search"></i> search</span>
                  </button>
                </span>
              </div><!-- /input-group -->
            {{Form::close()}}
          </div><!-- /.col-lg-6 -->
      </div><br />

      <h4>{{$count}} resutl(s)</h4><hr />
      @if($count == 0)
        <h5>No result found.</h5>
      @endif
      <!--<h3>{{$count}} resutl(s)</h3><hr /> -->
      @foreach($searchResults as $question)
      <div class="row">
        <div class="col-sm-1" id="questions">
            {{Qvote::where('question_id','=',$question->id)->count()}}<br />
          <small>votes</small><br /><br />
          {{Answer::where('question_id','=',$question->id)->count()}}<br />
          <small>answers</small>
        </div>
        <div class="col-sm-11" id="q">
          <h4><a href="{{URL::to('question/'. $question->id. '/'. $question->slug)}}">{{$question->title}}</a></h4>
          <p>{{substr(str_ireplace(Input::get('search'), '<mark>'.Input::get('search').'</mark>', $question->description), 0, 250)}}</p>
          <small class="pull-right">asked {{date("F jS, Y -- g:i A",strtotime($question->created_at))}} by: <a href="{{URL::to('user/'. $question->user_id. '/'. $users->find($question->user_id)->name)}}">{{$users->find($question->user_id)->name}}</a></small>
        </div>
      </div><hr >
       @endforeach
       {{$searchResults->links()}}



    </div>

    <div class="col-sm-3">
        <img src="http://placehold.it/260x500">
    </div>
</div>
@stop