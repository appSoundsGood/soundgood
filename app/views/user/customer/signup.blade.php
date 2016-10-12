@extends('user.layout')

@section('body')
<main class="backgroundDiv">
	<div class="">
		<div class="container">
		    <form method="POST" action="{{URL::route('user.customer.doSignup')}}" role="form" class="soundgoodform form-login margin-top-normal col-sm-4 col-md-offset-4">
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
                    <div class="row text-center">
                       <div class = "col-sm-10  col-sm-offset-1">
                            <div class = "soundgoodLogo container"></div>
                       </div>
                    </div>       
                    <div class="row">
                        <div class="form-group">
                        	<label>Name</label>
                            <input class="form-control" name="name" type="text" placeholder = "Name" required>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="form-group">
                        	<label>E-mail</label>
                            <input class="form-control" name="email" type="email" placeholder = "Email" required>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="form-group">
                        	<label>Account Number</label>
                            <input class="form-control" name="accNumber" type="text" placeholder = "Account Number" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                        	<label>Password</label>
                            <input class="form-control" name="password" type="password" placeholder = "Password" required>
                        </div>
                    </div>                     
                    <div class="row">
                        <div class="form-group">
                        	<label>Confirm Password</label>              
                            <input class="form-control" name="password_confirmation" type="password" placeholder = "Confirm Password" required>
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