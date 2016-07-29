@extends('main')

@section('styles')
    {{ HTML::style('/assets/css/style_user.css') }}
    {{ HTML::style('/assets/css/style_common.css') }}
	{{ HTML::style('/assets/metronic/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}
	
@stop
@section('header')
    <header class="header">
			<a href="/customer/home" style = "font-size:30px;">
            <div class="pull-left soundLogo">
                
            </div>
			</a>

            <div class="form-group navbar-form navbar-left searchForm">
                <form>
                    <div class="icon-addon addon-md">
                        <input type="text" placeholder="Search the recipes" class="form-control searchInput" id="email">
                        <label for="email" class="glyphicon glyphicon-search" rel="tooltip" title="email"></label>
                    </div>
                </form>
            </div>
            <div class="pull-right profileDiv">
                 <div class = "col-sm-2">
                       <div class = "container messageImg"></div>
                 </div>
                 <div class = "col-sm-2 addImg">
                    +
                 </div>
                 <div class = "col-sm-2 profileImg">
                    
                     </div>
                 <div class = "col-sm-4 profileName">
                    {{$username}}
                 </div>
                 <div class = "col-sm-2">
                     <div class="dropdown">
                        <button class="" type="button" data-toggle="dropdown" style = "background: #ffffff;margin-top:5px;">
                        <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                          <li><a href="#">Profile</a></li>
                          <li><a href="{{ URL::route('user.auth.doLogout') }}">Sign Out</a></li>
                          
                        </ul>
                      </div>
                 </div>
            </div>
            <div class="clearfix"></div>
            <nav class="navbar navbar-default soundgoodNav" style = "width:100%;">
              <div class="container-fluid">
                <div class="row text-center">
                    <ul class="nav navbar-nav">
                      <li class="threelineDiv"><a href="#"></a></li>
                      <li class = "soundgoodLi soundgoodHome"><a href="/customer/home">For You</a></li>
                      <li class = "soundgoodLi"><a href="{{ URL::route('customer.popular') }}">Popular</a></li> 
                      <li class = "soundgoodLi"><a href="#">Shop</a></li> 
                      <li class = "soundgoodLi"><a href="#">Health</a></li> 
                      <li class = "soundgoodLi"><a href="#">Fitness</a></li> 
                      <li class = "soundgoodLi"><a href="#">Collections</a></li> 
                      <li class = "soundgoodLi"><a href="#">Support</a></li> 
                    </ul>
                  
                </div>
              </div>
            </nav>

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
    <footer class="footer-area" style = "display:none;">
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
