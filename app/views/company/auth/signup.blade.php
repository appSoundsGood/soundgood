@extends('company.layout')

@section('body')
<main class="background-auth">
	<div class="auth-container-color">
		<div class="container">
		    <div class="row text-center">
		        <h1 class="margin-top-xl">Sign Up for {{ SITE_NAME }}</h1>
		    </div>
		    <div class="row text-center">
		    	<h4>( Company )</h4>
		    </div>
		    
		    <div class="col-sm-4 col-sm-offset-4 margin-top-lg">
		        @if ($errors->has())
		        <div class="alert alert-danger alert-dismissibl fade in">
		            <button type="button" class="close" data-dismiss="alert">
		                <span aria-hidden="true">&times;</span>
		                <span class="sr-only">Close</span>
		            </button>
		            @foreach ($errors->all() as $error)
		        		<p>{{ $error }}</p>		
		        	@endforeach
		        </div>
		        @endif    
		        
		        <?php if (isset($alert)) { ?>
		        <div class="alert alert-<?php echo $alert['type'];?> alert-dismissibl fade in">
		            <button type="button" class="close" data-dismiss="alert">
		                <span aria-hidden="true">&times;</span>
		                <span class="sr-only">Close</span>
		            </button>
		            <p>
		                <?php echo $alert['msg'];?>
		            </p>
		        </div>
		        <?php } ?>
		    </div>    
		    
		    <form method="POST" action="{{ URL::route('company.auth.doSignup') }}" role="form" class="form-login margin-top-normal">
		        @foreach ([
		            'email' => 'Email *',
		            'password' => 'Password *',
		            'password_confirmation' => 'Confirm Password:',
		            'name' => 'Company Name *',
		            'city_id' => 'Location *',
		        ] as $key => $value)
		            <div class="row margin-top-normal">
		                <div class="col-sm-4 col-sm-offset-4">
		                    <div class="form-group">
		                        <label>{{ Form::label($key, $value) }}</label>
		                        @if ($key == 'password')
		                            {{ Form::password($key, ['class' => 'form-control']) }} 
		                        @elseif ($key == 'password_confirmation')
		                        	{{ Form::password($key, ['class' => 'form-control']) }}
		                        @elseif ($key == 'teamsize_id')
			                    	<select class="form-control" name="teamsize_id" id="teamsize_id">
			                    		@foreach ($teamsizes as $item)
			                    		<option value="{{ $item->id }}">{{ $item->min." ~ ".$item->max }}</option>
			                    		@endforeach
			                    	</select>
			                    @elseif ($key == 'category_id')
		                            {{ Form::select($key
		                               , $categories->lists('name', 'id')
		                               , null
		                               , array('class' => 'form-control')) }}
		                        @elseif ($key == 'city_id')
		                            {{ Form::select($key
		                               , $cities->lists('name', 'id')
		                               , null
		                               , array('class' => 'form-control')) }} 		                       
		                        @else
		                            {{ Form::text($key, null, ['class' => 'form-control']) }}
		                        @endif
		                    </div>
		                </div>
		            </div>        
		        @endforeach   
		        
		        <div class="row margin-top-normal padding-bottom-xl">
		            <div class="col-sm-2 col-sm-offset-5">
		                <button class="btn btn-lg btn-primary text-uppercase btn-block" style="background-color: #125B9B;">Submit <span class="glyphicon glyphicon-ok-circle"></span></button>
		            </div>
		        </div>
		    </form> 
		</div>
	</div>           
</main>
@stop

@stop