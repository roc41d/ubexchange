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
            <h4>Change Password</h4>
          </div>
        </div>
      </div>
      <div class="panel-body">

  <div class="col-sm-8 col-sm-offset-2">

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

      <div class="panel panel-default">
              <div class="panel-body">
                  {{Form::open(array('url'=>'profile/settings'))}}
                      <div class="form-group">
                          <label for="inputEmail" class="control-label">Current Password</label>
                          <div class="">
                              <input type="password" class="form-control" id="inputPassword" name="current_password" placeholder="********">
                              <span class="badge alert-danger">{{ ($errors->has('current_password') ? $errors->first('current_password') : '') }}</span>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="inputEmail" class="control-label">New Password</label>
                          <div class="">
                            <input type="password" class="form-control" id="inputPassword" name="new_password" placeholder="********">
                            <span class="badge alert-danger">{{ ($errors->has('new_password') ? $errors->first('new_password') : '') }}</span>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="inputEmail" class="control-label">Confirm New Password</label>
                          <div class="">
                            <input type="password" class="form-control" id="inputPassword" name="confirm_new_password" placeholder="********">
                            <span class="badge alert-danger">{{ ($errors->has('confirm_new_password') ? $errors->first('confirm_new_password') : '') }}</span>
                          </div>
                      </div>
                      <div class="form-group">
                           <div class="">
                              <a href="{{URL::to('')}}" class="btn btn-danger">Back</a>
                              <button type="submit" class="btn btn-success pull-right">Change Password</button>
                          </div>
                      </div>
                  </form>
              </div>
      </div>
  </div>

        

      </div><!--/panel-body-->
  </div><!--/panel-->        
    
  </div>
</div>
@stop