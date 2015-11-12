@extends('layouts.profile')

{{-- web site title --}}
@section('title')
@parent
complete profile
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
  <div class="col-sm-5 col-sm-offset-4">

  <!--<h4>You're almost there!</h4><hr>
  <small>Edit your profile photo if you'd like, then click "Complete Registration"</small>
  <div> <br />
    <img src="{{URL::to('gravatar')}}/image.png" class="img-rounded" id="imageswag" /><br /><br />
    <small style="padding-left: 25px;"><a href="#" data-toggle="modal" data-target="#form">change photo</a></small> <br />
    <a href="#" class="btn btn-primary btn-sm">Complete Registration</a>
  </div>-->
    <div class="panel panel-default">
      <div class="panel-heading"><h3>You're almost there!</h3></div>
          <div class="panel-body" id="completeswag">
            <small>Edit your profile photo if you'd like, then click "Complete Registration"</small>
            <div> <br />
              <img src="{{URL::to('gravatar/'.$gravatar->image)}}" class="img-rounded" id="imageswag" /><br /><br />
              <small><a href="#" data-toggle="modal" data-target="#form">change photo</a></small> <br />
              <a href="{{URL::to('profile/completeregistration/'. $gravatar->id)}}" class="btn btn-primary btn-sm">Complete Registration</a><br />
              <!--<img src="{{ Identicon::getImageDataUri('rocard') }}" alt="bar Identicon" id="imageswag"/> -->
            </div>
          </div>
    </div>

  <!-- modal for profile photo upload -->
        <div class="modal fade" id="form">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Upload profile photo</h4>
              </div><hr />
              <div class="modal-body">
                {{Form::open(array('url'=>'profile/uploadpoto', 'enctype'=>'multipart/form-data'))}}
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