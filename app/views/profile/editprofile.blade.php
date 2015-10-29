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
      <p>some text ...</p>
  </div>
  <div class="col-md-8 ">
    <div class="pull-right">

      @include('site.nav')
    </div>

  </div>

</div>
<div id="menun"> <br />
<ul class="nav nav-tabs">
  <li><a href="{{URL::to('profile')}}"><small>Profile</small></a></li>
  <li><a href="{{URL::to('profile/activity')}}"><small>Activity</small></a></li>
  <li class="active"><a href="{{URL::to('profile/editprofile')}}"><small>Profile & Settings</small></a></li>
</ul>
</div><br />


<div class="row">
  
  @include('profile.sidebar')

  <div class="col-sm-9">
      <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-md-6">
            <h4>edit profile and settings</h4>
          </div>
          <div class="col-md-6">
            <a href="#" class="btn btn-success btn-sm pull-right" >Edit account datails</a> 
          </div>
        </div>
      </div>
      <div class="panel-body">

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