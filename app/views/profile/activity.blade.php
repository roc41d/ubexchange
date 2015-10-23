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
      <p></p>
  </div>
  <div class="col-md-8 ">
    <div class="pull-right">
      <h4>
          <a href="#" class="label label-default">Questions</a>
          <!--<a href="#" class="label label-default">Tags</a>-->
          <a href="#" class="label label-default">Users</a>
          <a href="#" class="label label-default">Unanswerd</a>
          <a href="#" class="label label-default">Ask Question</a>
      </h4>
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
            <h4>activity</h4>
          </div>
          <!--<div class="col-md-6">
            <a href="#" class="btn btn-success btn-sm pull-right" >Edit account datails</a> 
          </div>-->
        </div>
      </div>
      <div class="panel-body">


        <h2>
        <i class="fa fa-chevron-up" ></i>
        <i class="fa fa-chevron-down" ></i>
        </h2>

      </div><!--/panel-body-->
  </div><!--/panel-->        
    
  </div>
</div>
@stop