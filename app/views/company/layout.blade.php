@extends('main')

@section('styles')
    {{ HTML::style('/assets/css/style_user.css') }}
    {{ HTML::style('/assets/css/style_company.css') }}
@stop

@section('header')
    <header class="header">
        <div class="container">
            <div class="pull-left">
                <a href="/">
                    <img src="/assets/img/logo.jpg" style="margin-top: 14px;"/>
                </a>
            </div>
            <div class="pull-right">
                <ul class="nav nav-pills nav-top">
                    <?php if (!isset($pageNo)) { $pageNo = 0; } ?>
                    @if (Session::has('company_id'))
                    	<li class="{{ ($pageNo == 3) ? 'active' : ''}}"><a href="{{ URL::route('company.dashboard') }}">Dashboard</a></li>
                    	<li class="{{ ($pageNo == 1) ? 'active' : ''}}"><a href="{{ URL::route('company.job.add') }}">Post Job</a></li>
                        <li class="{{ ($pageNo == 2) ? 'active' : ''}}"><a href="{{ URL::route('company.job.myjobs' )}}">My Jobs</a></li>
                        <li class="{{ ($pageNo == 4) ? 'active' : ''}}"><a href="{{ URL::route('company.profile') }}">Profile</a></li>
                        <li><a href="{{ URL::route('company.auth.doLogout') }}">Sign Out</a></li>
                    @else
                    	<li class="{{ ($pageNo == 1) ? 'active' : ''}}"><a href="{{ URL::route('user.job.search') }}">Find Job</a></li>
                        <li class="{{ ($pageNo == 98) ? 'active' : ''}} dropdown">
                        	<a class="dropdown-toggle" data-toggle="dropdown" href="">Sign in</a>
                        	<ul class="dropdown-menu signin-dropdown-menu">
                        		<li><a href="{{ URL::route('user.auth.login') }}">Sign in as Employeer</a></li>
                        		<li><a href="{{ URL::route('company.auth.login') }}">Sign in as Company</a></li>
                        	</ul>
                        </li>
                        <li class="{{ ($pageNo == 99) ? 'active' : ''}} dropdown">
                        	<a href="">Register</a>
                        	<ul class="dropdown-menu signin-dropdown-menu register-dropdown-menu">
                        		<li><a href="{{ URL::route('user.auth.signup') }}">Register as Employeer</a></li>
                        		<li><a href="{{ URL::route('company.auth.signup') }}">Register as Company</a></li>
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
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Contact &amp; Support</a></li>
                </ul>
            </div>
            <div class="col-sm-3 color-white">
                <p class="text-uppercase margin-bottom-20"><b>HOW IT WORKS</b></p>
                <ul>
                    <li><a href="#">How it works?</a></li>
                    <li><a href="#">Media solutions</a></li>
                    <li><a href="#">Partnerships</a></li>
                </ul>
            </div>
            <div class="col-sm-3 color-white">
                <p class="text-uppercase margin-bottom-20"><b>FOLLOW US</b></p>
                <ul>
                    <li><a href="#"><i class="fa fa-facebook" style="width: 18px;"></i>&nbsp;Facebook</a></li>
                    <li><a href="#"><i class="fa fa-twitter" style="width: 18px;"></i>&nbsp;Twitter</a></li>
                    <li><a href="#"><i class="fa fa-google-plus" style="width: 18px;"></i>&nbsp;Google Plus</a></li>
                </ul>            
            </div>
            <div class="col-sm-3 color-white">
                <p class="text-uppercase margin-bottom-20"><b>NEWS LETTERS</b></p>
                <input type="text" class="form-control" placeholder="Email"/>
                
            </div>                                    
        </div>
    </div>
    <footer class="footer-area">
        <div class="container">
            <div class="footer-logo pull-left">
                <a href="/">Social HeaderHunter</a>
            </div>
            <div class="clearfix"></div>
        </div>
    </footer>
</div>
@stop

@section('scripts')
    {{ HTML::script('/assets/js/alert.js') }}
    {{ HTML::script('/assets/js/bootbox.js') }}
    @include('js.user.layout')
@stop

@stop