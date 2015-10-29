@extends('layouts.profile')

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
</div><hr />

<div class="row">
  
  @include('profile.sidebar')

  <div class="col-sm-9">
      <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-md-6">
            <h4>account details</h4>
          </div>
          <div class="col-md-6">
            <a href="#" class="btn btn-success btn-sm pull-right" >Edit account datails</a> 
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div style="padding-left:40px; padding-right:40px;">
          <p>Display name: <strong id="pad"> {{$user->name}}</strong> </p><hr>
          <p>Email: <strong id="pad"> {{$user->email}}</strong> </p><hr>
          <!--<p>About<strong id="pad"></strong> </p><hr>
          <p>Last login<strong id="pad">last login date time</strong> </p><hr>-->
        </div>
        <h2>
        <i class="fa fa-chevron-up" ></i><br />
        <i class="fa fa-check active"></i><br />
        <i class="fa fa-chevron-down" ></i>
        </h2>

      </div><!--/panel-body-->
  </div><!--/panel-->        
    
  </div>
</div>
@stop