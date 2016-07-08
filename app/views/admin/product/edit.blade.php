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

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Edit Customer</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" method="post" action="{{ URL::route('admin.product.store') }}">
        
        	<input type="hidden" name="product_id" value="{{ $product->id }}">
        
            @foreach ([
            	'upcCode' => 'UpcCode',
            	'itemName' => 'ItemName',
                'size' => 'Size',
                'nbd' => 'Nbd',
            ] as $key => $value)
            <div class="form-group">
                <label class="col-sm-2 control-label">{{ Form::label($key, $value) }}</label>
                <div class="col-sm-10">
                    {{ Form::text($key, $product->{$key}, ['class' => 'form-control']) }}
                </div>
            </div>
            @endforeach
			
			<div class="form-group">
			  <div class="col-sm-offset-2 col-sm-10 text-center">
				  <button class="btn btn-success">
					  <span class="glyphicon glyphicon-ok-circle"></span> Save
				  </button>
				  <a href="{{ URL::route('admin.product') }}" class="btn btn-primary">
					  <span class="glyphicon glyphicon-sshare-alt"></span> Back
				  </a>
			  </div>
			</div>        

        </form>
    </div>
</div>
@stop

@stop
