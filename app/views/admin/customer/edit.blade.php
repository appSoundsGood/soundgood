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
        <form class="form-horizontal" role="form" method="post" action="{{ URL::route('admin.customer.store') }}">
        
        	<input type="hidden" name="user_id" value="{{ $user->id }}">
        
            @foreach ([
            	'photo' => 'Photo',
            	'name' => 'Name',
                'email' => 'Email',
                'phone' => 'Phone',
            ] as $key => $value)
            <div class="form-group">
                <label class="col-sm-2 control-label">{{ Form::label($key, $value) }}</label>
                <div class="col-sm-10">
 					@if ($key === 'photo')
 					    <div class="text-center margin-top-xs">
                            <img src="" style="height: 100px;"/>
                        </div> 
                        {{ Form::file($key, ['class' => 'form-control']) }}
                    @else
                        {{ Form::text($key, $user->{$key}, ['class' => 'form-control']) }}
                    @endif
                </div>
            </div>
            @endforeach
			
			<div class="form-group">
			  <div class="col-sm-offset-2 col-sm-10 text-center">
				  <button class="btn btn-success">
					  <span class="glyphicon glyphicon-ok-circle"></span> Save
				  </button>
				  <a href="{{ URL::route('admin.customer') }}" class="btn btn-primary">
					  <span class="glyphicon glyphicon-sshare-alt"></span> Back
				  </a>
			  </div>
			</div>        

        </form>
    </div>
</div>
@stop

@stop
