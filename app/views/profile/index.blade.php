@extends('layouts.profile')

{{-- web site title --}}
@section('title')
@parent
{{$user->name}}
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
    <li class="active"><a href="{{URL::to('profile')}}"><small>Profile</small></a></li>
    {{-- <li><a href="{{URL::to('profile/activity')}}"><small>Activity</small></a></li> --}}
    <li><a href="{{URL::to('profile/editprofile')}}"><small>Profile & Settings</small></a></li>
  </ul>
  </div><br />
@else
<div id="menun"> <br />
<ul class="nav nav-tabs">
  <li class="active"><a href="{{URL::to('user/' .$user->id . '/' .$user->name)}}"><small>Profile</small></a></li>
  {{-- <li><a href="{{URL::to('activity/' .$user->id . '/' .$user->name)}}"><small>Activity</small></a></li> --}}
</ul>
</div><br />
@endif

<div class="row">

  <div class="col-sm-12">
      <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-md-6">
            <h4>account details</h4>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="row" id="profilepad">
            <div class="col-sm-2" id="editswag" style="border: 1px solid #eee;"><br />
              <img src="{{URL::to('photo/'.$user->photo)}}" class="img-rounded" id="imageswag" /><br />
              {{-- <h3>1</h3>
              <small>REPUTATION</small> --}}
            </div>
          <div class="col-sm-7">
            <h4>{{$user->name}}</h4>
            <p>
              {{$user->about}}
            </p>
          </div>
          <div class="col-sm-3"><br />
            @if($user->faculty != "")
            <p><i class="fa fa-building"></i>&nbsp; {{$user->faculty}}</p>
            @endif
            @if($user->website != "")
            <p><i class="fa fa-link fa-fw"></i>&nbsp; <a href="{{$user->website}}" target="_blank">{{$user->website}}</a></p>
            @endif
            @if($user->git != "")
            <p><i class="fa fa-github fa-fw"></i>&nbsp; <a href="{{$user->git}}" target="_blank">{{$user->git}}</a></p>
            @endif
            @if($user->twitter != "")
            <p><i class="fa fa-twitter fa-fw"></i>&nbsp; <a href="{{$user->twitter}}" target="_blank">{{$user->twitter}}</a></p>
            @endif
            <p><i class="fa fa-undo fa-fw"></i>&nbsp; Members since&nbsp; {{date("F j, Y",strtotime($user->created_at))}}</p>
            @if(Auth::check() == NULL)
            <p><i class="fa fa-clock-o fa-fw"></i>&nbsp; Last login&nbsp;{{date("F j, Y",strtotime($user->last_login))}} </p>
            @endif
          </div>
          
        </div><!--/profile-->

      </div><!--/panel-body-->
  </div><!--/panel-->        
    
  </div>
</div>
@stop