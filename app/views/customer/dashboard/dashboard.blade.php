@extends('user.layout')

@section('custom-styles')
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
@stop

@section('body')
<main class="bs-docs-masthead gray-container" role="main">
	<div class="background-dashboard" style="z-index: 0;"></div>
    <div class="container">
    	<div class="margin-top-lg"></div>
		<div class="col-sm-3">
			<!-- Div for Profile -->
			<div class="row margin-top-lg div-gray-box">
				<div class="col-sm-12 div-gray-title-box">
					<i class="fa fa-user"></i>&nbsp <span>My Profile</span>
				</div>
				<div class="col-sm-12 margin-top-normal">
					<div class="col-sm-6">
						<img style="width: 80px; height: 80px; border-radius: 5px;" src="{{ HTTP_PHOTO_PATH.$user->profile_image }}">
					</div>
					<div class="col-sm-6">
						<div class="row">
							<span style="color: #717785; font-size: 13px;">Welcome back,</span>
						</div>
						<div class="row">
							<a href="{{ URL::route('user.view', $user->id) }}" style="font-size: 20px;">{{ $user->name }}</a>
						</div>
					</div>
				</div>
				<div class="col-sm-12 margin-top-normal text-center">
				
					<div class="row">
                        <button class="btn btn-primary" type="submit" id="js-btn-subscriber">Out Call</button>
                    </div>
					<div class="row">
                        <button class="btn btn-primary" type="submit" id="js-btn-subscriber">Older Posts</button>
                    </div>
				</div>
				<div class="col-sm-12 margin-top-sm" style = "display:none;">
					<div class="col-sm-12">
						<span style="font-size: 13px;">Setup your account</span>
						<span style="font-size: 17px; float:right;">%</span>
					</div>
					<div class="col-sm-12">
						<div class="progress">
						    <div class="progress-bar progress-bar-success" style="">
						        <span class="sr-only">% Complete</span>
						    </div>
						</div>
					</div>
				</div>
				<div class="col-sm-12 margin-top-sm" style = "margin-bottom:20px;">
					  <div class="iframeDiv">
                        <iframe width="100%" height="" src="//www.youtube.com/embed/eFSqX4xAaUY?feature=player_detailpage" frameborder="0" allowfullscreen=""></iframe> 
                	  </div>  	
                </div>
				
			</div>
			<!-- End for Profile -->
			
			<!-- Div for My Jobs -->
			
			<!-- End for My Jobs -->
		</div>  
		<div class="col-sm-7">
	        <div class="row text-center margin-top-sm">
	            <h1 class="color-home" style="color: white;">Profile</h1>
	        </div>
	        
	        <div class="row" style="min-height: 600px;margin-left:0px;visibility:hidden;">
				<div class="row">
					<!-- Div for Applications sent -->
					<div class="col-sm-5">
						<!-- Div for My Jobs -->
						<div class="row div-gray-box margin-top-xs" style = "margin-left:0px;">
							<div class="col-sm-12 div-light-gray-box">
								<i class="fa fa-tasks"></i>&nbsp <span>Applications Sent</span>
							</div>
							<div class="col-sm-12 div-myjobs-box padding-bottom-sm">
								<?php foreach($posts as $post){?>
								<div class="col-sm-12 margin-top-sm">
									<span><a href=""><?php echo $post->title;?>sdfsdfsd</a></span>
								</div>
								<?php }?>
								<div class="col-sm-12">
									<hr style="margin-top: 10px; margin-bottom: 0px;"/>
								</div>
							
							</div>
							
							<div class="col-sm-12 text-center margin-top-sm margin-bottom-sm">
								<span>There are no applied jobs.</span>
							</div>
							
						</div>
						<!-- End for My Jobs -->					
					</div>
					<!-- End for Applications sent -->
					
					<!-- Div for Newest Jobs -->
					<div class="col-sm-5 col-sm-offset-1">
						<!-- Div for My Jobs -->
						<div class="row div-gray-box margin-top-xs">
							<div class="col-sm-12 div-light-gray-box">
								<i class="fa fa-tasks"></i>&nbsp <span>New Jobs</span>
							</div>
							
							<div class="col-sm-12 div-myjobs-box padding-bottom-sm">
							
								<div class="col-sm-12 margin-top-sm">
									<span><a href=""></a></span>
								</div>
								
								<div class="col-sm-12 margin-top-xxs">
									
									sdfsdfsd
									
								</div>
								<div class="col-sm-12">
									<hr style="margin-top: 10px; margin-bottom: 0px;"/>
								</div>
								
							</div>
							
							<div class="col-sm-12 text-center margin-top-sm margin-bottom-sm">
								<span>There are no matched jobs.</span>
							</div>
							
						</div>
						<!-- End for Newest Jobs -->					
					</div>
					<!-- End for Applications opened -->
				</div>
	
	        </div> 
		</div>  
		<div class="col-sm-2">
			<!-- Div for Profile -->
			<!-- Div for My Jobs -->
			<a href="/profile/edit" class="btn btn-sm btn-danger">
                    <span class="glyphicon glyphicon-edit"></span> Edit
            </a>
			<div class="row div-gray-box margin-top-sm">
				
				<div class="col-sm-12 div-gray-title-box">
					<i class="fa fa-tasks"></i>&nbsp <span>My Posts</span>
				</div>
				<div class="col-sm-12 div-myjobs-box padding-bottom-sm" style="height: 280px;">
					
					<div class="col-sm-12 margin-top-sm">
						<span><a href=""></a></span>
					</div>
					<?php foreach($posts as $post){?>
					<div class="col-sm-12 margin-top-xxs">
						<?php echo $post->title;?>
					</div>
					<div class="col-sm-12">
						<hr style="margin-top: 10px; margin-bottom: 0px;"/>
					</div>
					<?php }?>
				</div>
				<div class="col-sm-12 text-center margin-top-sm margin-bottom-sm">
					<span></span>
				</div>
				
			</div>
			<!-- End for My Jobs -->
		</div>  
		 
    </div> 
</main>
@stop

@section('custom-scripts')
@stop