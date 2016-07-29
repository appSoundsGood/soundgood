@extends('main')
@section('styles')
    {{ HTML::style('/assets/css/style_user.css') }}
    {{ HTML::style('/assets/css/style_common.css') }}
	{{ HTML::style('/assets/metronic/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}
@stop
@section('header')
    <header class="header">
        <div class="container">
            
            <a href = "/home">
			<div class="pull-left soundgoodLogo">
			</div>
			</a>
            <div class="pull-right margin-top-xs">
                <ul class="nav nav-pills nav-top">
					<?php if (!isset($pageNo)) { $pageNo = 0; } ?>
                    @if (Session::has('user_id'))
                    	<li class="{{ ($pageNo == 5) ? 'active' : ''}}" style = "display:none;"><a href="{{ URL::route('user.home') }}">Home</a></li>
                        <li class="{{ ($pageNo == 10) ? 'active' : ''}}"><a href="{{ URL::route('user.dashboard.profile') }}">Profile</a></li>
                        <li class="{{ ($pageNo == 11) ? 'active' : ''}}"><a href="{{ URL::route('user.post') }}">Post</a></li>
                        <li class="{{ ($pageNo == 12) ? 'active' : ''}}"><a href="{{ URL::route('user.store') }}">Store</a></li> 
                        <li class="{{ ($pageNo == 13) ? 'active' : ''}}"><a href="{{ URL::route('user.product') }}">Product</a></li>  
						<li class="{{ ($pageNo == 14) ? 'active' : ''}}"><a href="{{ URL::route('user.popular') }}">Popular</a></li>  
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
    </header>
@stop
	@yield('content')
@section('footer')
<div class="footer-container">
    <div class="container footer-menu">
        <div class="row color-white">
            <div class="col-sm-3">
                <p class="text-uppercase margin-bottom-20"><b>Company Info</b></p>
                <ul>
                    <li><a href="#">About us</a></li>
					<li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Contact &amp; Support</a></li>
                </ul>
            </div>
            <div class="col-sm-3 color-white">
                <p class="text-uppercase margin-bottom-20"><b>HOW IT WORKS</b></p>
                <ul>
                    <li><a href="#">How it works?</a></li>
					<li><a href="#">Partnerships</a></li>
                </ul>
            </div>
            <div class="col-sm-3 color-white">
                <p class="text-uppercase margin-bottom-20"><b>FOLLOW US</b></p>
                <ul>
                    <li><a href="#"><i class="fa fa-facebook" style="width: 18px;"></i>&nbsp;Facebook</a></li>
                    <li><a href="#"><i class="fa fa-twitter" style="width: 18px;"></i>&nbsp;Twitter</a></li>
                </ul>            
            </div>
            <div class="col-sm-3 color-white">
                <p class="text-uppercase margin-bottom-20"><b>NEWS LETTERS</b></p>
                <input type="text" class="form-control" placeholder="Email"/>
            </div>                                    
        </div>
    </div>
    <footer class="footer-area" style ="display:none;">
        <div class="container">
            <div class="footer-logo pull-left">
                <a href="/" style = "text-decoration:none;"></a>
            </div>
            <div class="clearfix"></div>
        </div>
    </footer>
</div>
@stop

@section('scripts')
    {{ HTML::script('/assets/js/alert.js') }}
    {{ HTML::script('/assets/js/bootbox.js') }}
	{{ HTML::script('/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}
    {{ HTML::script('/assets/js/bootstrap-datepicker.js') }}
	{{ HTML::script('/assets/js/node_modules/socket.io/node_modules/socket.io-client/dist/socket.io.js') }}
	{{ HTML::script('/assets/js/nodeClient.js') }}
	
	@include('js.user.layout')
@stop

@stop