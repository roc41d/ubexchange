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
      <p class="label label-default" style="">Questions</p>
      <p class="label label-default">Unanswerd</p>
      <p class="label label-default">Ask Question</p>
    </div>

  </div>
</div> <br />
@if(Auth::check()==NULL)
<div class="jumbotron">
  <h1>ubexchange</h1>
    <p>
      is a platform where computer enthusiasts all over the University of Buea can ask
      <em>programming related questions</em> and get answers from lecturers, experience programmers, and more.
    </p>
    <p><a href="{{URL::to('register')}}" class="btn btn-primary btn-lg">get started</a></p>
</div>
@endif

<div class="row">
    <div class="col-md-8">
      <h3>Recently Asked Questions</h3>

    </div>

    <div class="col-md-4">
        <img src="http://placehold.it/320x500">
    </div>
</div>
@stop