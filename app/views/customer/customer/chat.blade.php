@extends('customer.layout')

@section('custom-styles')
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	{{ HTML::style('/assets/css/chat.css') }}
@stop

@section('body')
<main class="bs-docs-masthead gray-container" role="main">
	<div class="background-dashboard" style="z-index: 0;"></div>
    <div class="container text-center">
    	<div class="margin-top-lg"></div>
    	
		<div class="col-sm-6 col-md-offset-3">
			<!-- Div for Profile -->
			<div class="row text-center margin-top-sm">
	        	<h1 class="color-home" style="color: white;">Chat</h1>
	   		</div>
			<div class="row margin-top-lg div-gray-box containerChat">
				
				<div class="Area" style = "display:none;">
				    <div class="L">
				      <a href="https://twitter.com/SamiMassadeh">
				    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRrEyVlaWx0_FK_sz86j-CnUC_pfEqw_Xq_xZUm5CMIyEI_-X2hRUpx1BHL"/>
				        <div class="tooltip">Sami Massadeh - 28 Years<br/>Doctor <br/>Jordan</div></a>
				    </div>
				    <div class="text R textR">Hi Mariam, How Are You?
				    </div>
			  </div>

			   <div class="Area" style = "display:none;">  
			    <div class="R">
			      	<a href="https://twitter.com/MariamMassadeh">
				    	<img src="https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcSxU35znsBhAWQd5BouLIVtH1P4WNa0JZ_XXpyViHOIARbM2igbNgC6_kp5"/>
				        <div class="tooltip">Mariam Massadeh - 23 Years<br/>Computer Engineer<br/>Jordan</div>
				   	</a>
			    </div>    
			    <div class="text L textL">Hi Sami, Fine, Thank You, How Are You?
			    </div>    
			  </div>

   

		    <div class="Area">
			    <textarea placeholder="Participate in coversation" id = "messageText"></textarea>
			      <br/><br/>
			      <input type="button" onclick="clickX()" value="SEND"/>
			      <div class="validation" style = "display:none;">You Are Not Registered</div>
			      <br/>
			   
		  </div>
				
				
			</div>
			<!-- End for Profile -->
			
			<!-- Div for My Jobs -->
			
			<!-- End for My Jobs -->
		</div>  
		
		
		 
    </div> 
</main>
@stop

@section('custom-scripts')
 {{ HTML::script('/assets/js/prefixfree.min.js') }}
 {{ HTML::script('/assets/js/modernizr.js') }}
 {{ HTML::script('/assets/js/customerChat.js') }}

@stop