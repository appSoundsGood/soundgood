@extends('admin.layout')

@section('content')

@if ($errors->has())
<div class="alert alert-danger alert-dismissibl fade in">
    <button type="button" class="close" data-dismiss="alert">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    @foreach ($errors->all() as $error)
		{{ $error }}		
	@endforeach
</div>
@endif

<div class="row">
	<div class="col-md-12">
		<h3 class="page-title">Ingredient Management</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<span>Ingredient</span>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<span>Add</span>
			</li>
		</ul>
	</div>
</div>

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-pencil-square-o"></i> Create Ingredient
		</div>
	</div>
    <div class="portlet-body">
        <form class="form-horizontal" role="form" method="post" action="{{ URL::route('admin.ingredient.store') }}" enctype="multipart/form-data">
           
          <div class="form-group">
              <label class="col-sm-2 control-label">Name</label>
              <div class="col-sm-6">
                  <input type="text" class="form-control" name="name">
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">NBD</label>
              <div class="col-sm-6">
                  <input type="text" class="form-control" name="nbd">
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">Preperation</label>
              <div class="col-sm-6">
                  <input type="text" class="form-control" name="preperation">
              </div>
          </div>
          <input type="hidden" class="form-control" name="recipeId" value="{{$recipeId}}">
              
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
@stop

@stop
@section('custom-scripts')   
    {{ HTML::script('/assets/js/typeahead.min.js') }}
    @include('js.user.dashboard.profile')
@stop
