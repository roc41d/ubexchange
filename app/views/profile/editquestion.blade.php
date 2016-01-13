@extends('layouts.profile')

{{-- web site title --}}
@section('title')
@parent
edit question
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
          <div class="panel-heading"><h3>Edit question</h3></div>
              <div class="panel-body">
                  {{Form::open(array('url'=>'profile/editquestion'))}}

                      <input type="hidden" name="special"  value="{{$questionToEdit->id}}" />
                      <div class="form-group">
                          <label for="inputEmail" class="control-label">Title</label>
                          <div class="">
                            <input type="text" class="form-control" id="inputEmail" name="title" value="{{ Input::old('title') != NULL ? Input::old('title') : $questionToEdit->title }}" placeholder="What's your programming question? Be specific." autofocus>
                            <span class="badge alert-danger">{{ ($errors->has('title') ? $errors->first('title') : '') }}</span>
                          </div>
                      </div>
                      <div class="form-group">
                          <label for="inputEmail" class="control-label">Body</label>
                          <div class="">
                            <textarea class="form-control" name="body" id="question" rows="7">{{$questionToEdit->description}}</textarea>
                            <span class="badge alert-danger">{{ ($errors->has('body') ? $errors->first('body') : '') }}</span>
                          </div>
                      </div>
                      <div class="form-group">
                          <div class="">
                            <a href="{{URL::to('')}}" class="btn btn-primary">Cancel</a>
                            <button type="submit" class="btn btn-primary pull-right">Save Edits</button>
                          </div>
                      </div>
                  </form>
              </div>
      </div>
  </div>

  <div class="col-sm-3">
    <div class="well">
        <h3>How to Edit</h3>
        <ul>
          <li>fix grammatical or spelling errors</li>
          <li>clarify meaning without changing it</li>
          <li>correct minor mistakes</li>
          <li>add related resources or links</li>
          <li><b><em>always respect</em></b> the original author</li>
        </ul>
    </div>
    <div class="well">
        <h3>How to Format</h3>
        <p>Under the <b>Format</b> menu, you will find some usefull tags that will help you format your question.</p>
        <p>Please use the <b>Pre</b> tag which is located under <small><b>Formate ->Formats ->Blocks ->Pre</b></small> when adding source codes to your question.</p>
    </div>
  </div>
</div>
@stop