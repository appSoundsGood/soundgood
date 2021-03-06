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
		<h3 class="page-title">Teamsize Management</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<span>Teamsize</span>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<span>Edit</span>
			</li>
		</ul>
	</div>
</div>

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-pencil-square-o"></i> Edit Teamsize
		</div>
	</div>
    <div class="portlet-body">
        <form class="form-horizontal" role="form" method="post" action="{{ URL::route('admin.teamsize.store') }}">
        
        	<input type="hidden" name="teamsize_id" value="{{ $teamsize->id }}">
        
            @foreach ([
                'min' => 'Min',
                'max' => 'Max',
            ] as $key => $value)
            <div class="form-group">
                <label class="col-sm-2 control-label">{{ Form::label($key, $value) }}</label>
                <div class="col-sm-10">
                	{{ Form::text($key, $teamsize->{$key}, ['class' => 'form-control']) }}
                </div>
            </div>
            @endforeach
			
			<div class="form-group">
			  <div class="col-sm-offset-2 col-sm-10 text-center">
				  <button class="btn btn-success">
					  <span class="glyphicon glyphicon-ok-circle"></span> Save
				  </button>
				  <a href="{{ URL::route('admin.teamsize') }}" class="btn btn-primary">
					  <span class="glyphicon glyphicon-share-alt"></span> Back
				  </a>
			  </div>
			</div>        

        </form>
    </div>
</div>
@stop

@stop
