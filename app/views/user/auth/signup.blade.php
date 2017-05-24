@extends('user.layout')

@section('body')
<main class="backgroundDiv">
	<div class="">
		<div class="container">
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
		    <form method="POST" action="{{URL::route('user.auth.doSignup')}}" role="form" class="soundgoodform form-login margin-top-normal col-sm-4 col-md-offset-4">
                <div class="row text-center">
                   <div class = "col-sm-10  col-sm-offset-1">
                        <div class = "soundgoodLogo container"></div>
                   </div>
                </div>
                <div class="row">
                    <div class="form-group">
                    	<label>Name</label>
                        <input class="form-control" name="name" type="text" placeholder = "Company Name" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                    	<label>E-mail</label>
                        <input class="form-control" name="email" type="email" placeholder = "Email">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                    	<label>Participating Store</label>
                        <input class="form-control" name="store_name" type="text" placeholder = "Store Name">
                    </div>
                </div>        
                <div class="row">
                    <div class="form-group">
                    	<label>Address</label>
                        <input class="form-control" name="store_address" type="text" placeholder = "Store Address">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                    	<label>Phone</label>
                        <input class="form-control" name="store_phone" type="tel" placeholder = "Phone Number">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                    	<label>Password</label>
                        <input class="form-control" name="password" type="password" placeholder = "Password">
                    </div>
                </div> 
                <div class="row">
                    <div class="form-group">
                    	<label>Confirm Password</label>
                        <input class="form-control" name="password_confirmation" type="password" placeholder = "Confirm Password">
                    </div>
                </div> 
                <div class="row">
                    <div class="row">
                        <button class="btn btn-lg btn-primary text-uppercase btn-block" style="background-color: #B12020;">Sign Up</button>
                    </div>
                </div>
		    </form>
		</div>
	</div>           
</main>
@stop

@stop