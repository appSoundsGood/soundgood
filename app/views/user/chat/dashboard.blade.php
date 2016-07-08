<?php 

	/* Calculate percent of profile complete */
	$total_count = count($user->getAllColumnsNames()) + 6;
	$reg_count = 0;
	
	foreach ($user->getAllColumnsNames() as $key) {
		$value = $user->{$key};
		$type = gettype($value);
		
		if ($key == 'profile_image') {
			if ($value != 'default.png') $reg_count ++;
			continue;
		}
		
		if ($type == 'integer') {
			if ($value > 0) $reg_count ++;
		}else if ($type == 'string') {
			if (strlen($value) > 0) $reg_count ++;
		}else if ($type == 'double') {
			if ($value > 0) $reg_count ++;
		}else if ($type == 'boolean') {
			$reg_count ++;
		}
	}
	
	if (count($user->awards) > 0) $reg_count ++;
	if (count($user->educations) > 0) $reg_count ++;
	if (count($user->experiences) > 0) $reg_count ++;
	if (count($user->testimonials) > 0) $reg_count ++;
	if (count($user->skills) > 0) $reg_count ++;
	if (count($user->languages) > 0) $reg_count ++;
	
	$rate = round($reg_count / $total_count * 100);
	

?>

@extends('user.layout')

@section('custom-styles')
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
@stop

@section('body')
<main class="bs-docs-masthead gray-container" role="main">
	<div class="background-dashboard" style="z-index: 0;"></div>
    <div class="container">
    	<div class="margin-top-lg"></div>
		<div class="col-sm-9">
	        <div class="row text-center margin-top-sm">
	            <h1 class="color-home" style="color: white;">Dashboard</h1>
	        </div>
	        
	        <div class="row" style="min-height: 600px;">
				<div class="row margin-top-normal">
					<div class="col-sm-2 alert alert-info1 text-center color-blue" style="height: 130px;">
						<div class="col-sm-12">
							<p><b>Applications sent</b></p>
						</div>
						<p style="color: #009cff; font-size: 30px;">{{ $user->applies()->count() }}</p>
					</div>
					<div class="col-sm-2 alert alert-info1 text-center col-sm-offset-2 color-blue" style="height: 130px;">
						<div class="col-sm-12">
							<p><b>Applications opened</b></p>
						</div>
						<p style="color: #009cff; font-size: 30px;">{{ $user->applies()->where('status', '=', '2')->count(); }}</p>
					</div>
					<div class="col-sm-2 alert alert-info1 text-center col-sm-offset-2 color-blue" style="height: 130px;">
						<div class="col-sm-12">
							<p><b>Applications in cart</b></p>
						</div>
						<p style="color: #009cff; font-size: 30px;">{{ $user->carts()->count() }}</p>
					</div>                       
				</div>
				
				<div class="row">
					<!-- Div for Applications sent -->
					<div class="col-sm-5">
						<!-- Div for My Jobs -->
						<div class="row div-gray-box margin-top-xs">
							<div class="col-sm-12 div-light-gray-box">
								<i class="fa fa-tasks"></i>&nbsp <span>Applications Sent</span>
							</div>
							@if (count($user->applies) > 0)
							<div class="col-sm-12 div-myjobs-box padding-bottom-sm">
								@foreach ($user->applies as $apply)
								<div class="col-sm-12 margin-top-sm">
									<span><a href="{{ URL::route('user.dashboard.viewJob', $apply->job->id) }}">{{$apply->job->name}}</a></span>
								</div>
								<div class="col-sm-12 margin-top-xxs">
									@if ($apply->job->status == 0) 
									<label class="lavel-opened">Opened</label>
									@else
									<label class="lavel-inprogress">In Progress</label>
									@endif
								</div>
								<div class="col-sm-12">
									<hr style="margin-top: 10px; margin-bottom: 0px;"/>
								</div>
								@endforeach
							</div>
							@else
							<div class="col-sm-12 text-center margin-top-sm margin-bottom-sm">
								<span>There are no applied jobs.</span>
							</div>
							@endif
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
							@if (count($jobs) > 0)
							<div class="col-sm-12 div-myjobs-box padding-bottom-sm">
								@foreach ($jobs as $job)
								<div class="col-sm-12 margin-top-sm">
									<span><a href="{{ URL::route('user.dashboard.viewJob', $job->id) }}">{{$job->name}}</a></span>
								</div>
								<div class="col-sm-12 margin-top-xxs">
									@if ($apply->job->status == 0) 
									<label class="lavel-opened">Opened</label>
									@else
									<label class="lavel-inprogress">In Progress</label>
									@endif
								</div>
								<div class="col-sm-12">
									<hr style="margin-top: 10px; margin-bottom: 0px;"/>
								</div>
								@endforeach
							</div>
							@else
							<div class="col-sm-12 text-center margin-top-sm margin-bottom-sm">
								<span>There are no matched jobs.</span>
							</div>
							@endif
						</div>
						<!-- End for Newest Jobs -->					
					</div>
					<!-- End for Applications opened -->
				</div>
	
	        </div> 
		</div>  
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
				<div class="col-sm-12 margin-top-sm">
					<div class="col-sm-12">
						<span style="font-size: 13px;">Setup your account</span>
						<span style="font-size: 17px; float:right;">{{ $rate }}%</span>
					</div>
					<div class="col-sm-12">
						<div class="progress">
						    <div class="progress-bar progress-bar-success" style="width: {{ $rate }}%">
						        <span class="sr-only">{{ $rate }}% Complete</span>
						    </div>
						</div>
					</div>
				</div>
			</div>
			<!-- End for Profile -->
			
			<!-- Div for My Jobs -->
			<div class="row div-gray-box margin-top-sm">
				<div class="col-sm-12 div-gray-title-box">
					<i class="fa fa-tasks"></i>&nbsp <span>My Jobs</span>
				</div>
				@if (count($user->applies()->where('status', '=', '2')->get()) > 0)
				<div class="col-sm-12 div-myjobs-box padding-bottom-sm" style="height: 280px;">
					@foreach ($user->applies()->where('status', '=', '2')->get() as $apply)
					<div class="col-sm-12 margin-top-sm">
						<span><a href="{{ URL::route('user.dashboard.viewJob', $apply->job->id) }}">{{$apply->job->name}}</a></span>
					</div>
					<div class="col-sm-12 margin-top-xxs">
						@if ($apply->job->status == 1) 
						<label class="lavel-inprogress">In Progress</label>
						@else
						<label class="lavel-inprogress">In Progress</label>
						@endif
					</div>
					<div class="col-sm-12">
						<hr style="margin-top: 10px; margin-bottom: 0px;"/>
					</div>
					@endforeach
				</div>
				@else
				<div class="col-sm-12 text-center margin-top-sm margin-bottom-sm">
					<span>There are no opened jobs.</span>
				</div>
				@endif
			</div>
			<!-- End for My Jobs -->
		</div>   
    </div> 
</main>
@stop

@section('custom-scripts')
@stop