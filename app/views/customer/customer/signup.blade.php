@extends('user.layout')

@section('body')
<main class="background-auth">
	<div class="auth-container-color">
		<div class="container">
		    <div class="row text-center">
		        <h1 class="margin-top-xl">Sign Up for {{ SITE_NAME }}</h1>
		    </div>
		    <div class="row text-center">
		    	<h4></h4>
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
		    <form method="POST" action="/customer/doSignup" role="form" class="form-login margin-top-normal">
		            <div class="row margin-top-normal">
		                <div class="col-sm-6 col-sm-offset-3">
		                    <div class="form-group">
		                        <label><label for="name">Your Name *</label></label>
		                        <input class="form-control" name="name" type="text" id="name">
		                    </div>
		                </div>
		            </div>        
		        	<div class="row margin-top-normal">
		                <div class="col-sm-6 col-sm-offset-3">
		                    <div class="form-group">
		                        <label><label for="email">Email *</label></label>
		                        <input class="form-control" name="email" type="text" id="email">
		                   </div>
		                </div>
		            </div>  
                    <div class="row margin-top-normal">
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="form-group">
                                <label><label for="email">Account Number *</label></label>
                                <input class="form-control" name="accNumber" type="text" id="email">
                           </div>
                        </div>
                    </div>        
		        	<div class="row margin-top-normal">
		                <div class="col-sm-6 col-sm-offset-3">
		                    <div class="form-group">
		                        <label><label for="password">Password *</label></label>
		                        <input class="form-control" name="password" type="password" value="" id="password">
		                    </div>
		                </div>
		            </div>        
		        	<div class="row margin-top-normal">
		                <div class="col-sm-6 col-sm-offset-3">
		                    <div class="form-group">
		                        <label><label for="password_confirmation">Confirm Password *</label></label>
		                        <input class="form-control" name="password_confirmation" type="password" value="" id="password_confirmation">
		                    </div>
		                </div>
		            </div>        
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