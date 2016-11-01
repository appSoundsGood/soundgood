<?php
use Illuminate\Support\Facades\Session;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{ public_path() }}/favicon.ico">
    <title>
        @section('title')
            {{ SITE_NAME }}
        @show
    </title>

    {{ HTML::style('/assets/css/bootstrap.min.css') }}
    {{ HTML::style('/assets/css/style_bootstrap.css') }}
    {{ HTML::style('/assets/css/style_common.css') }}
    @yield('styles')
    @yield('custom-styles')
    
    {{ HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js') }}
    {{ HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js') }}
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<!-- Header -->
	<?php if (!isset($pageNo)) { $pageNo = 0; } ?>
	<header class="header">
    	<div class="header-content">
        	<div class="container">      
		        <a href = "/home">
		      		<span class="pull-left soundgoodLogo"></span>
		      	</a>
		      	
	            <div class="pull-right margin-top-xs">
	                <ul class="nav nav-pills nav-top">
					<?php if(Session::has('user_id')): ?>
						<?php if (Session::get('user_type') == 'user'): ?>
							<li class="{{ ($pageNo == 5) ? 'active' : ''}}" style = "display:none;"><a href="{{ URL::route('user.home') }}">Home</a></li>
	                        <li class="{{ ($pageNo == 10) ? 'active' : ''}}"><a href="{{ URL::route('user.dashboard.profile') }}">Profile</a></li>
	                        <li class="{{ ($pageNo == 11) ? 'active' : ''}}"><a href="{{ URL::route('user.post') }}">Advertise</a></li>
	                        <li class="{{ ($pageNo == 12) ? 'active' : ''}}"><a href="{{ URL::route('user.store') }}">Stores</a></li> 
	                        <li class="{{ ($pageNo == 13) ? 'active' : ''}}"><a href="{{ URL::route('user.product') }}">Product</a></li>  
							<li class="{{ ($pageNo == 14) ? 'active' : ''}}"><a href="{{ URL::route('user.popular') }}">Popular</a></li>  
	                        <li><a href="{{ URL::route('user.auth.doLogout') }}">Sign Out</a></li>
						<?php elseif (Session::get('user_type') == 'customer'): ?>
							<li class="{{ ($pageNo == 5) ? 'active' : ''}}"><a href="{{ URL::route('customer.home') }}">Recommendations</a></li>               
	                        <li class="{{ ($pageNo == 10) ? 'active' : ''}}"><a href="{{ URL::route('customer.dashboard.cabinet') }}">Cabinet</a></li>
	                        <li class="{{ ($pageNo == 11) ? 'active' : ''}}" style = "display:none;"><a href="{{ URL::route('user.post') }}">Post</a></li>
	                        <li class="{{ ($pageNo == 13) ? 'active' : ''}}"><a href="{{ URL::route('customer.shop') }}">Browse</a></li> 
	                        <li class="{{ ($pageNo == 15) ? 'active' : ''}}"><a href="{{ URL::route('customer.shoppinglist') }}">Shopping List</a></li>
	                        <li class="{{ ($pageNo == 16) ? 'active' : ''}}"><a href="{{ URL::route('customer.profile') }}">Profile</a></li>
	                       	<li><a href="{{ URL::route('user.auth.doLogout') }}">Sign Out</a></li>
						<?php endif;?>
					<?php else: ?>
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
	                    	<a>SIGN IN</a>
	                        <ul class="dropdown-menu signin-dropdown-menu register-dropdown-menu">
	                         	<li><a href="{{ URL::route('user.auth.login') }}">Sign in as Store</a></li>
	                           	<li><a href="{{ URL::route('user.customer.login') }}">Sign in as Customer</a></li>
	                        </ul>
	                	</li>
					<?php endif;?>
					</ul>
				</div>
			</div>
		</div>
	</header>
	<!-- Header end -->    
    
    @yield('body')
    
    @yield('footer')
   
    @yield('scripts')
    @yield('custom-scripts')
    {{ HTML::script('/assets/js/jquery.scrollbox.js') }}
    {{ HTML::script('/assets/js/script/home.js') }}
    
</body>
</html>
