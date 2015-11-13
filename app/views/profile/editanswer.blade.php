@extends('layouts.profile')

{{-- web site title --}}
@section('title')
@parent
edit answer
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
  <div class="col-sm-9">
      <div class="panel panel-default">
          <div class="panel-heading"><h3>Edit answer</h3></div>
              <div class="panel-body">
                  {{Form::open(array('url'=>'profile/editanswer'))}}
                      <input type="hidden" name="special"  value="{{$answerToEdit->id}}" />
                      <input type="hidden" name="qID"  value="{{$questionToEdit}}" />
                      <div class="form-group">
                            <div class="">
                              <textarea class="form-control" name="answer" id="answer" rows="7">{{$answerToEdit->description}}</textarea>
                              <span class="badge alert-danger">{{ ($errors->has('answer') ? $errors->first('answer') : '') }}</span>
                            </div>
                        </div>
                      <div class="form-group">
                          <div class="">
                            <a href="{{URL::to('')}}" class="btn btn-primary">Cancel</a>
                            <button type="submit" class="btn btn-success pull-right">Save Edits</button>
                          </div>
                      </div>
                  </form>
              </div>
      </div>
  </div>

  <div class="col-sm-3 well">
        <h3>How to Edit</h3>
        <ul>
          <li>fix grammatical or spelling errors</li>
          <li>clarify meaning without changing it</li>
          <li>correct minor mistakes</li>
          <li>add related resources or links</li>
          <li><b><em>always respect</em></b> the original author</li>
        </ul>
    </div>
</div>
@stop