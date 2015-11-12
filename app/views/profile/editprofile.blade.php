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
  
  <div class="col-sm-3 list-group">
  <a class="list-group-item" href="{{URL::to('profile/editprofile')}}" id="pronavswag"><i class="fa fa-edit fa-fw"></i>&nbsp; Edit Profile</a>
  <a class="list-group-item" href="#"><i class="fa fa-book fa-fw"></i>&nbsp; </a>
  <a class="list-group-item" href="#"><i class="fa fa-gears fa-fw"></i>&nbsp; Change Password</a>
  <a class="list-group-item" href="{{URL::to('profile/deleteprofile')}}" onclick='return confirm("Are you sure you want to delete your profile?")'><i class="fa fa-trash fa-fw"></i>&nbsp; Delete Profile</a>
</div>

  <div class="col-sm-9">
      <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-md-6">
            <h4>Edit your profile</h4>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="row" id="profilepad">
          <h4>Public information</h4><br />
          <div class="col-sm-3" id="editswag" style="border: 1px solid #eee;"><br />
            <img src="{{URL::to('photo/'.$user->photo)}}" class="img-rounded" id="imageswag" /><br /><br />
            <small><a href="#" data-toggle="modal" data-target="#form">change photo</a></small>
          </div>
          <div class="col-sm-9"><br /><br />
            {{Form::open(array('url'=>'profile/publicinfo'))}}
                <div class="form-group">
                    <label for="inputEmail" class="control-label">Display name</label>
                    <div class="">
                      <input type="text" class="form-control" id="inputName" name="name" value="{{ Input::old('name') != NULL ? Input::old('name') : $user->name }}">
                      <span class="badge alert-danger">{{ ($errors->has('name') ? $errors->first('name') : '') }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputEmail" class="control-label">Faculty</label>
                    <div class="">
                      <input type="text" class="form-control" id="inputName" name="faculty" value="{{ Input::old('faculty') != NULL ? Input::old('faculty') : $user->faculty }}" placeholder="eg. Engineering">
                      <span class="badge alert-danger">{{ ($errors->has('faculty') ? $errors->first('faculty') : '') }}</span>
                    </div><br /><br /><br />
                </div>
                
            </div>
            <div class="form-group">
                <label for="inputEmail" class="control-label">About me</label>
                <div class="">
                  <textarea class="form-control" name="about_me" id="question" rows="7">{{$user->about}}</textarea>
                  <span class="badge alert-danger">{{ ($errors->has('about_me') ? $errors->first('about_me') : '') }}</span>
                </div>
            </div>

            <div class="form-group">
                <div class="">
                  <button type="submit" class="btn btn-primary pull-right">Save</button>
                </div>
            </div>
              {{Form::close()}}
          
        </div><!--/public info-->

        <div class="row" id="profilepad"><hr />
          <h4>Web presence</h4><br />
          {{Form::open(array('url'=>'profile/webpresence'))}}
            <div class="col-sm-4">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-link fa-fw"></i></span>
                    <input type="text" id="website" name="website" class="form-control" value="{{$user->website}}" placeholder="Website link">
                    <span class="badge alert-danger">{{ ($errors->has('website') ? $errors->first('website') : '') }}</span>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-github fa-fw"></i></span>
                    <input type="text" id="email" name="git" class="form-control" value="{{$user->git}}" placeholder="GitHub link or username">
                </div>
            </div>
            <div class="col-sm-4">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-twitter fa-fw"></i></span>
                    <input type="text" id="email" name="twitter" class="form-control" value="{{$user->twitter}}" placeholder="Twitter link or username">
                </div>
            </div>
            <div class="form-group">
                <div class="">
                  <button type="submit" class="btn btn-primary pull-right">Save</button>
                </div>
            </div>
          {{Form::close()}}

        </div><!--/web presence-->

        <div class="row" id="profilepad"><hr />
          <h4>Private information (not shown publicly)</h4><br />
          {{Form::open(array('url'=>'profile/privateinfo'))}}
          <div class="col-sm-6">
            <div class="form-group">
                <label for="inputEmail" class="control-label">Real name</label>
                <div class="">
                  <input type="text" class="form-control" id="inputName" name="name" value="{{ Input::old('name') != NULL ? Input::old('name') : $user->real_name }}">
                  <span class="badge alert-danger">{{ ($errors->has('name') ? $errors->first('name') : '') }}</span>
                </div>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
                <label for="inputEmail" class="control-label">Email</label>
                <div class="">
                  <input type="text" class="form-control" id="inputEmail" name="email" value="{{ Input::old('email') != NULL ? Input::old('email') : $user->email }}">
                  <span class="badge alert-danger">{{ ($errors->has('email') ? $errors->first('email') : '') }}</span>
                </div>
            </div>
          </div>
          <div class="form-group">
                <div class="">
                  <button type="submit" class="btn btn-primary pull-right">Save</button>
                </div>
            </div>

          {{Form::close()}}
          
        </div><!--/private info-->

      </div><!--/panel-body-->
  </div><!--/panel-->

  <!-- modal for profile photo upload -->
        <div class="modal fade" id="form">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Upload profile photo</h4>
              </div><hr />
              <div class="modal-body">
                {{Form::open(array('url'=>'profile/uploadedit', 'enctype'=>'multipart/form-data'))}}
                  <input type="hidden" name="special"  value="" />
                  <div class="row">
                      <div class="form-group">
                          <label for="inputFile" class="control-label">File</label><br />
                          <div class="">
                              <input type="text" readonly class="form-control floating-label" name="photo" placeholder="Browse...">
                              <input type="file" id="inputFile" name="photo" multiple>
                          </div>
                      </div>
                      
                  </div>
              
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-sm"> Upload</button>
              </div>
              {{Form::close()}}
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->       
    
  </div>
</div>
@stop