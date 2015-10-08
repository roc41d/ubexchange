@extends('layouts.layout')

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
      <p class="label label-default" style="">Questions</p>
      <p class="label label-default">Unanswerd</p>
      <p class="label label-default">Ask Question</p>
    </div>

  </div>
</div> <br />

<div class="row">
    <div class="col-md-8">
      <h3>Recently Asked Questions</h3><hr />

              <div class="row">
                    <div class="col-lg-6">
                        <div class="bs-component">
                            <div class="list-group">
                                <div class="list-group-item">
                                    <div class="row-action-primary">
                                        <i class="mdi-file-folder"></i>
                                    </div>
                                    <div class="row-content">
                                        <div class="least-content">15m</div>
                                        <h4 class="list-group-item-heading">Tile with a label</h4>
                                        <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus.</p>
                                    </div>
                                </div>
                                <div class="list-group-separator"></div>
                                <div class="list-group-item">
                                    <div class="row-action-primary">
                                        <i class="mdi-file-folder"></i>
                                    </div>
                                    <div class="row-content">
                                        <div class="least-content">10m</div>
                                        <h4 class="list-group-item-heading">Tile with a label</h4>
                                        <p class="list-group-item-text">Maecenas sed diam eget risus varius blandit.</p>
                                    </div>
                                </div>
                                <div class="list-group-separator"></div>
                                <div class="list-group-item">
                                    <div class="row-action-primary">
                                        <i class="mdi-file-folder"></i>
                                    </div>
                                    <div class="row-content">
                                        <div class="least-content">8m</div>
                                        <h4 class="list-group-item-heading">Tile with a label</h4>
                                        <p class="list-group-item-text">Maecenas sed diam eget risus varius blandit.</p>
                                    </div>
                                </div>
                                <div class="list-group-separator"></div>
                            </div>
                        </div>
                    </div>
                    </div>


    </div>

    <div class="col-md-4">
        <img src="http://placehold.it/320x500">
    </div>
</div>
@stop