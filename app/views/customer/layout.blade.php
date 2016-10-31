@extends('main')

@section('styles')
    {{ HTML::style('/assets/css/style_user.css') }}
    {{ HTML::style('/assets/css/style_common.css') }}
	{{ HTML::style('/assets/font-awesome/css/font-awesome.min.css') }}
	
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

