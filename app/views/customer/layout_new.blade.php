@extends('main_new')

@section('styles')
    
@stop

@section('header')
<header class="header">
	<nav class="navbar navbar-custom">
		<div class="navbar-header">
	    	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
	        	<span class="sr-only">Toggle navigation</span>
	        	<span class="icon-bar"></span>
	        	<span class="icon-bar"></span>
	        	<span class="icon-bar"></span>
	         </button>
	    	<a class="navbar-brand" href="/home">
	    		<span class="helper"></span>
	    		<img class="soundsgood-logo" src="<?=asset('assets/site/logo.png')?>" />
			</a>
	 	</div>
	    <div id="navbar" class="navbar-collapse collapse">    	
	      	<ul class="nav navbar-nav">
	      	<?php
	      	if (!isset($pageNo)) $pageNo = 0;
	      	if (Session::has('user_id')) {
	      	?>
	      		<li class="{{ ($pageNo == 5) ? 'active' : 'active'}}"><a href="{{ URL::route('customer.home') }}">Recommendations</a></li>               
	            <li class="{{ ($pageNo == 10) ? 'active' : ''}}"><a href="{{ URL::route('customer.dashboard.cabinet') }}">Cabinet</a></li>
	            <li class="{{ ($pageNo == 15) ? 'active' : ''}}"><a href="{{ URL::route('customer.shoppinglist') }}">Shopping List</a></li>
	      	<?php }else { ?>
	      		<li class="dropdown">
	            	<a href="">SIGN UP</a>
	                <ul class="dropdown-menu signin-dropdown-menu register-dropdown-menu">
	                   	<li><a href="{{ URL::route('user.auth.signup') }}">Register as Store</a></li>
	                    <li><a href="{{ URL::route('user.customer.signup') }}">Register as Customer</a></li>
	                </ul>
	          	</li>
	            <li><a> | </a></li>
	            <li class="dropdown">
	             	<a >SIGN IN</a>
	                <ul class="dropdown-menu signin-dropdown-menu register-dropdown-menu">
	                	<li><a href="{{ URL::route('user.auth.login') }}">Sign in as Store</a></li>
	                    <li><a href="{{ URL::route('user.customer.login') }}">Sign in as Customer</a></li>
	                </ul>
	          	</li>
	      	<?php } ?>
	      	</ul>
	      	<?php if (Session::has('user_id')) { ?>
	      		<ul class="nav navbar-nav navbar-right">
	      			<li class="dropdown">
		      			<a href="">Account</a>
		      			<ul class="dropdown-menu">
		      				<li class="{{ ($pageNo == 16) ? 'active' : ''}}"><a href="{{ URL::route('customer.profile') }}">My Profile</a></li>
		      				<li><a href="{{ URL::route('user.auth.doLogout') }}">Sign Out</a></li>
		      			</ul>
	      			</li>
	      		</ul>
	      	<?php } ?>
	      	<form id="search-form" class="navbar-form">
	        	<div class="form-group">
	        		<div class="input-group">
	      				<input type="text" class="form-control" placeholder="Search for...">
	      				<span class="input-group-btn">
	        				<button type="submit" class="btn btn-success"><span class="fa fa-search"></span> S</button>
	      				</span>
	    			</div>
	            </div>
	      	</form>
	  	</div><!--/.navbar-collapse -->
	</nav>
</header>
    
@stop

<!-- @yield('content') -->
@section('body')
<div class="main-content">
	<div class="title-bar">
		<h1 class="title">Recommended for you</h1>
		<div class="pull-right">
			<div class="btn-group">
				<button type="button" class="btn btn-darkred dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter by <span class="caret"></span></button>
			  	<ul class="dropdown-menu">
			    	<li><a href="#">Maze</a></li>
			    	<li><a href="#">Salad</a></li>
			    	<li><a href="#">Soup</a></li>
			  	</ul>
			</div>
		</div>
	</div>
</div>
@stop

@section('footer')

@stop

@section('scripts')
    {{ HTML::script('/assets/js/alert.js') }}
    {{ HTML::script('/assets/js/bootbox.js') }}
    {{ HTML::script('/assets/js/bootstrap-datepicker.js') }}
	{{ HTML::script('/assets/js/node_modules/socket.io/node_modules/socket.io-client/dist/socket.io.js') }}
	{{ HTML::script('/assets/js/nodeClient.js') }}
	@include('js.user.layout')
@stop