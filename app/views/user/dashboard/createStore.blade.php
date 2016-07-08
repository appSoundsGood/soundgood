@extends('user.layout')

@section('custom-styles')
@stop

@section('body')
<main class="bs-docs-masthead" role="main">
	<div class="background-dashboard"></div>      
    <div class="container">
    	<div class="margin-top-lg"></div>
        <div class="row text-center margin-top-normal margin-bottom-normal">
            <h2 class="home color-white">Stores</h2>
        </div> 
        
        <div class="row">
            <form class="form-horizontal" role="form" method="post" action="{{ URL::route('user.store.save') }}" enctype="multipart/form-data">
           
              <div class="form-group">
                  <label class="col-sm-2 control-label">Name</label>
                  <div class="col-sm-6">
                      <input type="text" class="form-control" name="name">
                  </div>
              </div>
              
              <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10 text-center">
                      <button class="btn btn-success">
                          <span class="glyphicon glyphicon-ok-circle"></span> Save
                      </button>
                      <a href="{{ URL::route('admin.category') }}" class="btn btn-primary">
                          <span class="glyphicon glyphicon-share-alt"></span> Back
                      </a>
                  </div>
              </div>
            </form>

        </div> 
    </div>
</main>
@stop

@section('custom-scripts')
@stop