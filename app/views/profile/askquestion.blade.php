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

      @include('site.nav')
    </div>

  </div>
</div><hr />

<div class="row">
  <div class="col-sm-9">
      <div class="panel panel-default">
          <div class="panel-heading"><h3>Ask a question</h3></div>
              <div class="panel-body">
                  {{Form::open(array('url'=>'profile/askquestion'))}}
                      <div class="form-group">
                          <label for="inputEmail" class="control-label">Title</label>
                          <div class="">
                            <input type="text" class="form-control" id="inputEmail" name="title" value="{{ Input::old('title') != NULL ? Input::old('title') : '' }}" placeholder="What's your programming question? Be specific.">
                            <span class="badge alert-danger">{{ ($errors->has('title') ? $errors->first('title') : '') }}</span>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="inputEmail" class="control-label">Body</label>
                          <div class="">
                            <textarea class="form-control" name="body" id="question" rows="7"></textarea>
                            <span class="badge alert-danger">{{ ($errors->has('body') ? $errors->first('body') : '') }}</span>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="">
                            <button type="submit" class="btn btn-primary pull-right">Post Your Question</button>
                          </div>
                      </div>
                  </form>
              </div>
      </div>
  </div>

  <div class="col-sm-3">
    <div class="well">
        <h3>How to Ask</h3>
        <p><b>Is your question about programming?</b></p>
        <p>We prefer questions that can be answered, not just discussed.</p>
        <p>Provide details. Share your research.</p>
    </div>
    <div class="well">
        <h3>How to Format</h3>
        <p>Under the <b>Formate</b> menu, you will find some usefull tags that will help you formate your question.</p>
        <p>Please use the <b>Pre</b> tag which is located under <small><b>Formate ->Formats ->Blocks ->Pre</b></small> when adding source codes to your question.</p>
    </div>
  </div>
</div>
@stop