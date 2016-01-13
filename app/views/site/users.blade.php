@extends('layouts.layout')

{{-- web site title --}}
@section('title')
@parent
users
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
  <div class="col-md-3">
      <p></p>
  </div>
  <div class="col-md-9 ">
    <div class="pull-right">

      @include('site.nav')
    </div>

  </div>
</div> <br />

<div class="row">
    <div class="col-md-12">
      <h3>Users</h3><hr />
      @foreach($users as $user)
        <div class="col-md-3">
          <ul class="media-list">
            <li class="media">
              <div class="media-left">
                <a href="{{URL::to('user/'. $user->id. '/'. $user->name)}}">
                  <img class="media-object" src="{{URL::to('photo/'.$user->photo_thumbnail)}}" alt="user image">
                </a>
              </div>
              <div class="media-body">
                <a href="{{URL::to('user/'. $user->id. '/'. $user->name)}}">
                <h4 class="media-heading">{{$user->name}}</h4></a>
                @if($user->faculty != "")
                <small>{{$user->faculty}}</small><br />
                @endif
                <small>{{$user->reputation}}</small>
              </div>
            </li>
          </ul>
        </div>
       @endforeach
    </div>
    {{$users->links()}}
</div>
@stop