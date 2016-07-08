<?php 
	$reviewFlag = 1;
	
	if (!isset($userId)) {
		$reviewFlag = 0;
	}else {
		foreach ($company->reviews as $review) {
			if ($review->user->id == $userId) {
				$reviewFlag = 0;
				break;
			}
		}
	}
	
	$rating = round($company->reviews()->avg('score'));
	
?>

@extends('user.layout')

@section('custom-styles')
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	{{ HTML::style('/assets/css/star-rating.min.css') }}
@stop

@section('body')
<main class="bs-docs-masthead" role="main" style="background-color: #F2F5F7;">
	<div class="background-map-div">
		<div id="mapdiv" style="height:300px;"></div>
		<div class="col-sm-3 padding-top-normal company-view-title-div">
			<div class="col-sm-12">
				<div class="row">
					<i class="fa fa-star-o" style="float: left; margin-top: 14px;"></i>
					<div style="float:left;">
						<span style="font-size: 30px; font-weight: bold; color: #3c3c3c;">&nbsp{{ $company->name }}</span>
					</div>
				</div>
				<div class="row" style="font-size: 15px; color: #838383;">
					<span>&nbsp&nbsp"{{ $company->tag }}"</span>
				</div>

				<div class="row margin-top-sm">
					<img src="{{ HTTP_LOGO_PATH.$company->logo }}" width="90%" style="margin-left: 5%;">
					
					<!-- Commented for change -->
					<!-- 
					<div class="margin-top-sm text-center">
						<a class="a-job"><i class="fa fa-envelope"></i> &nbsp WRITE A MESSAGE</a>
					</div>
					 -->
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="col-sm-12 margin-top-sm margin-bottom-sm" style="background: white;">
			<div class="form-group">
				<div class="col-sm-8" style="border-right: 1px solid #EEE;">
					<div class="col-sm-12">
				
						<div class="row margin-top-sm">
							<div class="col-sm-3 user-view-experience-container">
								<div class="col-sm-4 text-center user-view-exp-icon">
									<i class="fa fa-clock-o"></i>
								</div>
								<div class="col-sm-8 text-center" style="background: #16a085; color: white;">
									<div class="row" style="font-weight:bold; padding-top: 1px;">
										<span>{{ $company->year }}+ YEARS</span>
									</div>
									<div class="row" style="font-size: 10px; padding-bottom: 3px;">
										<span>OF FOUNDATION</span>
									</div>
								</div>
							</div>
							<div class="col-sm-8 col-sm-offset-1">
								<div class="row">
									<span class="span-job-descripton-note"><b>Expertise:</b>&nbsp</span>
								</div>			
								<div class="row">
									<span class="span-job-descripton-note">{{ $company->expertise }}</span>
								</div>			
							</div>
						</div>
						
						<div class="row margin-top-sm">
							<div class="col-sm-12">
								<div class="row">
									<span class="span-job-descripton-note">{{ $company->description }}</span>
								</div>
								
								<div class="row">
									<hr/>
								</div>
							</div>
						</div>
						
						<!-- Div for View Rating -->
						<div class="row">
							<div class="col-sm-6">
								<div class="row text-center padding-top-xs padding-bottom-xs">
									<?php for ($i = 1; $i <= $rating; $i ++) {?>
									<img src="/assets/img/star-full.png" style="width: 40px;">
									<?php }?>
									<?php for ($i = $rating+1; $i <= 5; $i ++) {?>
									<img src="/assets/img/star-blank.png" style="width: 40px;">
									<?php }?>
								</div>
								<div class="row text-center margin-top-xs">
									<span class="job-company-info-title">Rating:</span>
								</div>
								<div class="row text-center margin-top-xs">
									<span class="job-company-info-text">{{ $rating }}</span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="row text-center">
									<span style="font-size: 40px; color: #009cff;"><i class="fa fa-thumbs-up"></i></span>
								</div>
								<div class="row text-center margin-top-xs">
									<span class="job-company-info-title">Reviews:</span>
								</div>
								<div class="row text-center margin-top-xs">
									<span class="job-company-info-text">{{ count($company->reviews) }}</span>
								</div>
							</div>
							
							<!-- 
							<div class="col-sm-4">
								<div class="row text-center">
									<span style="font-size: 40px; color: #009cff;"><i class="fa fa-comment"></i></span>
								</div>
								<div class="row text-center margin-top-xs">
									<span class="job-company-info-title">Comments:</span>
								</div>
								<div class="row text-center margin-top-xs">
									<span class="job-company-info-text">4</span>
								</div>
							</div>
							 -->
						</div>
						<!-- End for View Rating -->
						
						
						<!-- Div for Service -->
						<div class="row">
							<div class="col-sm-12">
								@if (count($company->services) > 0)
								<div class="row margin-top-lg">
									<span class="span-job-descripton-note"><b>OUR SERVICES</b></span>
								</div>
								
								<div class="row">
									<hr/>
								</div>
								
								@foreach ($company->services as $service)
								<div class="row">
									<div style="width: 100%; display: inline-block;">
										<i class="fa fa-star-o" style="float: left; margin-top: 7px; color: #b4b7bb;"></i>
										<div style="float:left;">
											<span style="font-size: 15px; font-weight: bold;">&nbsp;{{$service->service->name}}</span>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 user-view-text">
										{{ $service->description }}
									</div>								
								</div>
								<div class="row">
									<hr/>
								</div>
								@endforeach
								
								@endif
							</div>
						</div>
						<!-- End for Service -->
						
						
						<!-- Commented for change -->
						<!-- 
						<div class="row">
							<div class="col-sm-3" style="padding-left: 0px;">
								<button class="btn btn-success btn-sm btn-company-blue" id="js-btn-apply" data-id="2"><i class="fa fa-save"></i> FOLLOW COMPANY</button>
							</div>
							<div class="col-sm-3">
								<button class="btn btn-success btn-sm btn-company-blue" id="js-btn-apply" data-id="2"><i class="fa fa-check"></i> SEND APPLICATION</button>
							</div>
							<div class="col-sm-4">
								<button class="btn btn-success btn-sm btn-company-blue" id="js-btn-apply" data-id="2"><i class="fa fa-money"></i> RECOMMENDED A FRIEND</button>
							</div>
						</div>
						
						<div class="row">
							<hr/>
						</div>
						 -->
						
						
						<?php if (count($company->jobs) > 0) {?>
						<div class="row margin-top-lg">
							<span class="span-job-descripton-note"><b>OUR OPENNING JOBS</b></span>
						</div>
						
						<div class="row">
							<hr/>
						</div>
						<?php }?>
						
						<?php foreach($company->jobs as $companyJob) {?>
							<div class="row">
								<div class="col-sm-8" style="padding-left: 0px;">
									<div style="width: 100%; display: inline-block;">
										<i class="fa fa-star-o" style="float: left; margin-top: 7px; color: #b4b7bb;"></i>
										<div class="col-sm-11" style="float:left; padding-left: 0px;">
											<span style="font-size: 17px; font-weight: bold; color: #3c3c3c;">&nbsp<a href="{{ URL::route('user.dashboard.viewJob', $companyJob->id) }}" style="cursor: pointer; color: #3b3b3b;">{{ $companyJob->name }}</a></span>
										</div>
									</div>
									<div style="margin-left:17px; font-size: 12px;">
										<p>
											<span style="color: #84cbc9;">{{ $companyJob->category->name }}</span>
											<span style="color: #91949b;">{{ ' ('.$companyJob->city->name.')' }}</span>
										</p>
									</div>
								</div>
								<div class="col-sm-4" style="padding-right: 0px;">
									<div class="text-right" style="width: 100%; display: inline-block;">
										<span class="company-job-created-label">{{ $companyJob->created_at }}</span>
										<label class="company-job-type-label">{{ $companyJob->type->name }}</label>
									</div>
									<div class="text-right" style="margin-top: 5px;">
										<?php 
											$skillFlag = 0;
											$skillLength = 0;
										    foreach($companyJob->skills as $jobSkill) {
												$skillLength += strlen($jobSkill->name);
												if ($skillLength >= 12) {
													$skillFlag = 1;
													break;
												}	
										?>
											<label class="company-job-skill-label">{{ $jobSkill->name }}</label>
										<?php }
											if ($skillFlag == 1) {
										?>
											<label class="company-job-skill-label">...</label>
										<?php }?>
									</div>
								</div>
							</div>
							
							<div class="row">
								<hr/>
							</div>
						<?php }?>
						
						<!-- Div for View Feedback -->
						@if (count($company->reviews) > 0)
						
						<div class="row margin-top-lg">
							<span class="span-job-descripton-note"><b>EMPLOYEE FEEDBACK</b></span>
						</div>
						
						<div class="row">
							<hr/>
						</div>
						
						@foreach ($company->reviews as $review)
						<div class="row margin-bottom-normal">
						 	<div class="col-sm-2">
						 		<img style="width: 80px; height: 80px;" src="{{ HTTP_PHOTO_PATH.$review->user->profile_image }}" class="img-circle">
						 	</div>
						 	<div class="col-sm-10">
						 		<div class="row">
						 			<a href="{{ URL::route('user.view', $review->user->id) }}">{{ $review->user->name }}</a><span style="font-size: 12px; color: #B0B0B0;"> - posted {{ explode(" ", $review->created_at)[0] }}</span>
						 		</div>
						 		<div class="row margin-top-xs">
									{{ nl2br($review->description) }}		 		
						 		</div>
						 	</div>
						</div>					
						@endforeach
												
						@endif
						<!-- End for View Feedback -->
						
						<!-- Div for Review -->
						<?php if ($reviewFlag == 1) {?>
						<div class="row margin-top-lg">
							<span class="span-job-descripton-note"><b>LEAVE FEEDBACK</b></span>
						</div>
						
						<div class="row">
							<hr/>
						</div>
						
						<div class="row">
							<input id="input-rate" name="rating" class="rating" data-size="sm" data-default-caption="{rating}" data-star-captions="{}">
						</div>
						<div class="row margin-top-sm">
							<textarea class="form-control" id="description" name="description" rows="7" placeholder="Message"></textarea>
						</div>
						<div class="row margin-top-sm margin-bottom-sm">
							<div class="col-sm-3" style="padding-left: 0px;">
								<button class="btn btn-success btn-sm btn-job-apply" id="js-btn-review" data-id="{{ $company->id }}">Submit</button>
							</div>
						</div>
						<?php }?>
						<!-- End for Review -->
					</div>
				</div>
				<div class="col-sm-4">
					<div class="row margin-top-sm">
						<div class="col-sm-12">
						
							<div class="col-sm-12">
								<i class="fa fa-star-o" style="float: left; margin-top: 14px;"></i>
								<div style="float:left;">
									<span style="font-size: 30px; font-weight: bold; color: #3c3c3c;">&nbsp{{ $company->name }}</span>
								</div>
							</div>
							<div class="col-sm-12" style="font-size: 15px; color: #838383;">
								<span>&nbsp&nbsp"{{ $company->tag }}"</span>
							</div>
							
							<div class="col-sm-12">
								<hr/>
							</div>
				
							<div class="col-sm-12">
								<div class="padding-bottom-xs">
									<span class="span-job-descripton-note"><b style="color: #3b3b3b;">Location:</b>&nbsp{{ $company->city->name }}</span>
								</div>
								<div class="padding-bottom-xs">
									<span class="span-job-descripton-note"><b style="color: #3b3b3b;">Phone Number:</b>&nbsp{{ $company->phone }}</span>
								</div>
								<div class="padding-bottom-xs">
									<span class="span-job-descripton-note"><b style="color: #3b3b3b;">Website:</b>&nbsp{{ $company->website }}</span>
								</div>
								<div class="padding-bottom-xs">
									<span class="span-job-descripton-note"><b style="color: #3b3b3b;">Number of Employees:</b>&nbsp{{ $company->teamsize->min.'-'.$company->teamsize->max }}</span>
								</div>
								<div class="padding-bottom-xs">
									<span class="span-job-descripton-note">
										<b style="color: #3b3b3b;">Email:</b>&nbsp
										@if ($company->is_published)
										{{ $company->email }}
										@else
										<i class="fa fa-warning"></i> Not published by company
										@endif
									</span>
								</div>
								<div class="padding-bottom-xs">
									<span class="span-job-descripton-note"><b style="color: #3b3b3b;">Address:</b>&nbsp{{ $company->address }}</span>
								</div>
							</div>
							
							<div class="col-sm-12">
								<hr/>
							</div>
						</div>
					</div>						
				</div>
			</div>
		</div>
	</div>
</main>
@stop

@section('custom-scripts')
	{{ HTML::script('/assets/js/star-rating.min.js') }}
    @include('js.company.dashboard.view')
@stop