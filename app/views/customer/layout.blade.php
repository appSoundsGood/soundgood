@extends('main')

@section('styles')
    {{ HTML::style('/assets/css/style_user.css') }}
    {{ HTML::style('/assets/css/style_common.css') }}
	{{ HTML::style('/assets/font-awesome/css/font-awesome.min.css') }}
	
@stop
@section('header')
    <header class="header">
        <div class="header-content">
        	<div class="container">
        	      
		        <a href = "/home">
		      		<div class="pull-left soundgoodLogo">
		      		</div>
		      	</a>
		      	
	            <div class="pull-right margin-top-xs">
	                <ul class="nav nav-pills nav-top">
	          <?php if (!isset($pageNo)) { $pageNo = 0; } ?>
	                    @if (Session::has('user_id'))
	                    	<li class="{{ ($pageNo == 5) ? 'active' : ''}}"><a href="{{ URL::route('customer.home') }}">Recommendations</a></li>               
	                        <li class="{{ ($pageNo == 10) ? 'active' : ''}}"><a href="{{ URL::route('customer.dashboard.cabinet') }}">Cabinet</a></li>
	                        <li class="{{ ($pageNo == 11) ? 'active' : ''}}" style = "display:none;"><a href="{{ URL::route('user.post') }}">Post</a></li>
	                        <li class="{{ ($pageNo == 13) ? 'active' : ''}}"><a href="{{ URL::route('customer.shop') }}">Browse</a></li> 
	                        <li class="{{ ($pageNo == 15) ? 'active' : ''}}"><a href="{{ URL::route('customer.shoppinglist') }}">Shopping List</a></li>
	                        <li class="{{ ($pageNo == 16) ? 'active' : ''}}"><a href="{{ URL::route('customer.profile') }}">Profile</a></li>
	                       	<li><a href="{{ URL::route('user.auth.doLogout') }}">Sign Out</a></li>
	                    @else
	                      <li class="{{ ($pageNo == 1) ? 'active' : ''}}" style = "display:none;"><a href="{{ URL::route('user.home') }}">Home</a></li>
	                        <li class="dropdown">
	                            <a href="">SIGN UP</a>
	                            <ul class="dropdown-menu signin-dropdown-menu register-dropdown-menu">
	                                <li><a href="{{ URL::route('user.auth.signup') }}">Register as Store</a></li>
	                                <li><a href="{{ URL::route('user.customer.signup') }}">Register as Customer</a></li>
	                            </ul>
	                        </li>
	                        <li><a>|</a></li>
	                        <li class="dropdown">
	                          <a >SIGN IN</a>
	                          <ul class="dropdown-menu signin-dropdown-menu register-dropdown-menu">
	                            <li><a href="{{ URL::route('user.auth.login') }}">Sign in as Store</a></li>
	                            <li><a href="{{ URL::route('user.customer.login') }}">Sign in as Customer</a></li>
	                          </ul>
	                        </li>
	                    @endif
	                </ul>
	            </div>
            	<div class="clearfix"></div>
            </div>
        </div>
    </header>
    
@stop
	
@section('body')
@yield('content')
@stop

@section('footer')
<div class="footer-like">
	<?php if(strstr($_SERVER['REQUEST_URI'], "external")) { ?>
    <div class="footer-like-content">
    	<div class="container">
	        <div class="row">
	            <div class = "col-sm-6 text-center" id = "likeRecipe" style = "border-right: 1px solid #ffffff;cursor:pointer;<?php if($isLike == 1){echo 'display:none';}?>;" onclick = "likeRecipe('{{ $userId}}' , '{{$recipeId}}')">
	                LIKE
	            </div>
	            <div class = "col-sm-6 text-center" id = "unlikeRecipe"  style = "border-right: 1px solid #ffffff;cursor:pointer;<?php if($isLike == 0){echo 'display:none';}?>;" onclick = "unlikeRecipe('{{ $userId}}' , '{{$recipeId}}')">
	                UNLIKE
	            </div>
	             <div class = "col-sm-6 text-center" style = "cursor:pointer;" onclick = "makeMeal('{{ $userId}}' , '{{$recipeId}}')">
	                COOK RECIPE
	            </div>
	        </div>
	     </div>
	</div>
    <?php } ?>  
</div>
@stop

@section('scripts')
    {{ HTML::script('/assets/js/alert.js') }}
    {{ HTML::script('/assets/js/bootbox.js') }}
    {{ HTML::script('/assets/js/bootstrap-datepicker.js') }}
	{{ HTML::script('/assets/js/node_modules/socket.io/node_modules/socket.io-client/dist/socket.io.js') }}
	{{ HTML::script('/assets/js/nodeClient.js') }}
	@include('js.user.layout')
@stop

<!-- {{ HTML::script('/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }} -->

