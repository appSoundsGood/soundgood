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
							<span style="color: #717785; font-size: 13px;"></span>
						</div>
						<div class="row">
							<a href="{{ URL::route('user.view', $user->id) }}" style="font-size: 20px;">{{ $user->name }}</a>
						</div>
					</div>
				</div>
				<div class="col-sm-12 margin-top-normal text-center">
				
					<div class="row">
                        <a class="btn btn-primary" type="submit" id="js-btn-subscriber" href = "/recipe">My Recipes</a>
                    </div>
					<div class="row">
                        <a class="btn btn-primary" type="submit" id="js-btn-subscriber" href = "/follwers">Followers</a>
                    </div>
					<div class="row">
                        <a class="btn btn-primary" type="submit" id="js-btn-subscriber" href = "/follwing">Following</a>
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
						
                </div>
				
			</div>
			<!-- End for Profile -->
			
			<!-- Div for My Jobs -->
			
			<!-- End for My Jobs -->
		</div>  
		<div class="col-sm-6">
	        <div class="row text-center margin-top-sm">
	            <h1 class="color-home" style="color: white;">Profile</h1>
	        </div>
            <div class="row" style="min-height: 600px;margin-left:0px;">
                <div class="row">
                    @foreach ($data as $key => $value)
                    
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="panel panel-default">
                                <?php if($value->type == "post"){?>
                                <div class="panel-heading"><a href="#" class="pull-right">View all</a> <h4>{{ $value->post->title}}</h4></div>
                                <div class="panel-body">
                                    {{ $value->post->content}}
                                </div>
                                <?php }else{?>
                                <div class="panel-heading"><a href="#" class="pull-right">View all</a> <h4>{{ $value->recipe->name}}</h4></div>
                                <div class="panel-body">
                                    {{ $value->recipe->content}}
                                </div>
                                <?php } ?>
                        <!-- End for Applications sent -->
                            </div>
                        </div>
                        <!-- Div for Newest Jobs -->
                    </tr>
                    @endforeach
	         	  </div>
	        </div> 
		</div>  
		<div class="col-sm-3">
			<!-- Div for Profile -->
			<!-- Div for My Jobs -->
			<a href="/profile/edit" class="btn btn-sm btn-danger" style ="visibility:hidden;">
                    <span class="glyphicon glyphicon-edit"></span> Edit
            </a>
			<div class="row div-gray-box margin-top-sm">
				
				<div class="col-sm-12 div-gray-title-box">
					<i class="fa fa-tasks"></i>&nbsp <span>My Ads</span>
				</div>
				<div class="col-sm-12 div-myjobs-box padding-bottom-sm" style="height: 280px;">
					
					<div class="col-sm-12 margin-top-sm">
						<span><a href=""></a></span>
					</div>
				
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