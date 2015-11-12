@extends('layouts.layout')

{{-- web site title --}}
@section('title')
@parent
remind
@stop

{{-- website content --}}
@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3">

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
        <div class="panel-heading"><h3>Forget Password</h3></div>
            <div class="panel-body">
                {{Form::open(array('url'=>'remind'))}}
                    <p>Forgotten your password? Enter your email address below to begin the reset process.
                    </p>
                    <div class="form-group">
                        <label for="inputEmail" class="control-label">Email</label>
                        <div class="">
                            <input type="text" class="form-control" id="inputEmail" name="email" value="{{ Input::old('email') != NULL ? Input::old('email') : '' }}" placeholder="you@example.com">
                            <span class="badge alert-danger">{{ ($errors->has('email') ? $errors->first('email') : '') }}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="">
                            <button type="submit" class="btn btn-success pull-right">Send</button>
                        </div>
                    </div>
                </form>
            </div>
      </div>
  </div>
</div> <br /><br /><br />

@stop