@extends('main')
@section('styles')
    {{ HTML::style('/assets/css/style_user.css') }}
    {{ HTML::style('/assets/css/style_common.css') }}
	{{ HTML::style('/assets/metronic/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}
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