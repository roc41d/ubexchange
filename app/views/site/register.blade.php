@extends('layouts.layout')

{{-- web site title --}}
@section('title')
@parent
register
@stop

{{-- website content --}}
@section('content')
<div class="row">
  <div class="col-md-6 col-md-offset-3">
      <div class="panel panel-default">
          <div class="panel-heading"><h3>Join ubExchange</h3></div>
              <div class="panel-body">
                  {{Form::open(array('url'=>'register'))}}
                      <div class="form-group">
                          <label for="inputEmail" class="control-label">Display Name</label>
                          <div class="">
                            <input type="text" class="form-control" id="inputEmail" name="name" value="{{ Input::old('name') != NULL ? Input::old('name') : '' }}" placeholder="Mc Rocard">
                            <span class="badge alert-danger">{{ ($errors->has('name') ? $errors->first('name') : '') }}</span>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="inputEmail" class="control-label">Email (required but never shown)</label>
                          <div class="">
                            <input type="text" class="form-control" id="inputEmail" name="email" value="{{ Input::old('email') != NULL ? Input::old('email') : '' }}" placeholder="you@example.com">
                            <span class="badge alert-danger">{{ ($errors->has('email') ? $errors->first('email') : '') }}</span>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="inputEmail" class="control-label">Password</label>
                          <div class="">
                            <input type="password" class="form-control" id="inputEmail" name="password" placeholder="********">
                            <span class="badge alert-danger">{{ ($errors->has('password') ? $errors->first('password') : '') }}</span>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="inputEmail" class="control-label">Comfirmed Password</label>
                          <div class="">
                            <input type="password" class="form-control" id="inputEmail" name="comfirmed_password" placeholder="********">
                            <span class="badge alert-danger">{{ ($errors->has('comfirmed_password') ? $errors->first('comfirmed_password') : '') }}</span>
                          </div>
                      </div>
                      <div class="checkbox">
                          <label>
                            <input type="checkbox" name="terms"> Agree to terms and Conditions
                            <span class="badge alert-danger">{{ $errors->first('terms') }}</span>
                          </label>
                       </div>
                      <div class="form-group">
                          <div class="">
                            <button type="submit" class="btn btn-success pull-right">Join</button>
                          </div>
                      </div>
                  </form>
              </div>
      </div>
  </div>

</div> <br />
@stop