@extends('company.layout')

@section('custom-styles')
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
@stop

@section('body')
<main class="bs-docs-masthead gray-container" role="main">
	<div class="user-photo-div">
		<?php if ($user->cover_image != '') {?>
			<img src="{{ HTTP_PHOTO_PATH.$user->cover_image }}" width="100%" height="100%">
		<?php }?>
	</div>
	<div class="container">
		<div class="row" style="margin-top:130px;">
			<div class="col-sm-4 col-sm-offset-4 text-center user-name-div" style="height: 145px;">
				<div class="col-sm-12" style="color: white; font-size: 35px;">
					I am {{ $user->name }}
				</div>
				<div class="col-sm-12" style="color: white; font-size: 15px;">
					{{ $user->professional_title }}
				</div>
			</div>
		</div>
	</div>
	<div class="container" style="margin-top: -198px;">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4 text-center">
				<img style="width:100px; height:100px; border: 2px solid #FFF;" src="{{ HTTP_PHOTO_PATH.$user->profile_image }}" class="img-circle">
			</div>
		</div>
	</div>
	
	<div class="user-view-menu">
		<div class="container">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="col-sm-2 text-center">
					<button class="btn btn-link btn-sm btn-user-view" data-target="div_about" onclick="scrollToDiv(this)"><i class="fa fa-file-text-o"></i> ABOUT</button>
				</div>	
				<div class="col-sm-2 text-center">
					<button class="btn btn-link btn-sm btn-user-view" data-target="div_skills" onclick="scrollToDiv(this)"><i class="fa fa-bar-chart-o"></i> SKILLS</button>
				</div>
				<div class="col-sm-2 text-center">
					<button class="btn btn-link btn-sm btn-user-view" data-target="div_education" onclick="scrollToDiv(this)"><i class="fa fa-bank"></i> EDUCATION</button>
				</div>
				<div class="col-sm-2 text-center">
					<button class="btn btn-link btn-sm btn-user-view" data-target="div_experience" onclick="scrollToDiv(this)"><i class="fa fa-building-o"></i> EXPERIENCE</button>
				</div>
				<div class="col-sm-2 text-center">
					<button class="btn btn-link btn-sm btn-user-view" data-target="div_contact" onclick="scrollToDiv(this)"><i class="fa fa-bookmark"></i> PORTFOLIO</button>
				</div>
				<div class="col-sm-2 text-center">
					<button class="btn btn-link btn-sm btn-user-view" data-target="div_contact" onclick="scrollToDiv(this)"><i class="fa fa-envelope"></i> CONTACT</button>
				</div>		
			</div>
		</div>
	</div>
	<div class="container padding-bottom-sm">
		<div class="col-sm-10 col-sm-offset-1">
		
			<!-- Div for About -->
			<div class="row margin-top-sm" id="div_about">
				<div class="col-sm-9">
					
					<!-- Div for Name -->
					<div class="row">
						<span style="color: #16a085; font-size: 25px;">{{ $user->name }}</span>
					</div>
					<!--  -->
					
					
					<!-- Div for Professional Title -->
					<div class="row">
						<span style="color: #999999; font-size: 18px;">{{ $user->level->name.' '.$user->professional_title }}</span>
					</div>
					<!--  -->
					
					<!-- Div for Job Type -->
					<div class="row margin-top-sm">
						<div class="col-sm-3 user-view-experience-container">
							<div class="col-sm-4 text-center user-view-exp-icon">
								<i class="fa fa-clock-o"></i>
							</div>
							<div class="col-sm-8 text-center"  style="background: #16a085; color: white;">
								<div class="row"  style="font-weight:bold; padding-top: 1px;">
									<span>{{ $user->year.'+ YEARS' }}</span>
								</div>
								<div class="row"  style="font-size: 10px; padding-bottom: 3px;">
									<span>OF EXPERIENCE</span>
								</div>
							</div>
						</div>
						
						<div class="col-sm-9">
							<div class="col-sm-4 user-view-rate-container">
								<div class="col-sm-4 text-center user-view-rate-icon">
									<i class="fa fa-money"></i>
								</div>
								<div class="col-sm-8 text-center"  style="background: #e74c3c; color: white;">
									<div class="row"  style="font-weight:bold; padding-top: 1px;">
										<span>${{ $user->renumeration_amount }}</span>
									</div>
									<div class="row"  style="font-size: 10px; padding-bottom: 3px;">
										<span>/ MONTH</span>
									</div>
								</div>
							</div>
							<div class="col-sm-7 col-sm-offset-1">
								<div class="row">
									<span style="color: #666666; font-weight: bold;">JOB TYPES I AM LOOKING FOR:</span>
								</div>
								<div class="row">
									<?php 
										$flag = 0;
										if ($user->is_freelance) {
											$flag = 1;
									?>
									<span style="color: #e74c3c;">Freelance</span>
									<?php 
										}
										if ($user->is_parttime) {
											if ($flag == 1) {
									?>
									<span>, </span>
									<?php 
											}
											$flag = 1;
									?>
									<span style="color: #3498db;">Part-Time</span>
									<?php 
										}
										if ($user->is_fulltime) {
											if ($flag == 1) {
									?>
									<span>, </span>
									<?php 
											}
											$flag = 1;
									?>
									<span style="color: #16a085;">Full-Time</span>
									<?php 
										}
										if ($user->is_internship) {
											if ($flag == 1) {
									?>
									<span>, </span>
									<?php 
											}
											$flag = 1;
									?>							
									<span>Internship</span>
									<?php 
										}
										if ($user->is_volunteer) {
											if ($flag == 1) {
									?>
									<span>, </span>
									<?php 
											}
									?>		
									<span>Volunteer</span>
									<?php 
										}
									?>
								</div>						
							</div>
						</div>
					</div>
					<!--  -->
					
					<!-- Div for Description -->
					<div class="row margin-top-sm user-view-text">
						{{ $user->about }}
					</div>
					<!--  -->
				</div>
			</div>
			<!--  -->
			
			<!-- Div for Skills -->
			<div class="row margin-top-sm padding-top-sm" style="background-color: white;" id="div_skills">
				<div class="col-sm-12 text-center">
					<span class="user-view-field-title"><i class="fa fa-bar-chart-o"></i> Skills</span>
				</div>
				<div class="col-sm-12 text-center margin-top-xs">
					<span class="user-view-field-description">Here's an overview of my skills.</span>
				</div>
				<div class="col-sm-6 margin-top-xs">
					<hr />
					<div class="row">
						<div class="col-sm-6">
							<span class="user-view-small-title">COMMUNICATION</span>
						</div>
						<div class="col-sm-6">
							<div class="progress user-view-progress">
							    <div class="progress-bar progress-bar-success" style="width: {{ $user->communication_value }}%">
							        <span class="sr-only">{{ $user->communication_value }}% Complete</span>
							    </div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 user-view-text">
							{{ $user->communication_note }}
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-12">
							<hr/>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<span class="user-view-small-title">ORGANISATIONAL</span>
						</div>
						<div class="col-sm-6">
							<div class="progress user-view-progress">
							    <div class="progress-bar progress-bar-danger" style="width: {{ $user->organisational_value }}%">
							        <span class="sr-only">{{ $user->organisational_value }}% Complete</span>
							    </div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 user-view-text">
							{{ $user->organisational_note }}
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-12">
							<hr/>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<span class="user-view-small-title">JOB RELATED</span>
						</div>
						<div class="col-sm-6">
							<div class="progress user-view-progress">
							    <div class="progress-bar progress-bar-info" style="width: {{ $user->job_related_value }}%; background-color: #34495e;">
							        <span class="sr-only">{{ $user->job_related_value }}% Complete</span>
							    </div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 user-view-text">
							{{ $user->job_related_note }}
						</div>
					</div>
				</div>
				
				
				<div class="col-sm-6 margin-top-xs">
					<hr />
					
					<?php foreach ($user->skills as $skill) {?>
					<div class="row">
						<div class="col-sm-6">
							<span class="user-view-small-title text-uppercase" style="color: #999999;">{{ $skill->name }}</span>
						</div>
						<div class="col-sm-6">
							<div class="progress user-view-progress">
							    <div class="progress-bar progress-bar-info" style="width: {{ $skill->value }}%; background-color: #2980b9;">
							        <span class="sr-only">{{ $skill->value }}% Complete</span>
							    </div>
							</div>
						</div>
					</div>
					<?php }?>
					
					<div class="row">
						<div class="col-sm-12">
							<hr/>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<span class="user-view-small-title text-uppercase">{{ count($user->languages)+1 }} languages</span>
						</div>
						<div class="col-sm-6">
							<span class="text-uppercase" style="color: #666666;">{{ $user->language->name }}</span><span style="color: #cccccc;"> (NATIVE)</span>
						</div>
					</div>
					
					<?php foreach($user->languages as $language) {?>
						<div class="row margin-top-xs">
							<div class="col-sm-12">
								<span class="text-uppercase user-view-bold-text">{{ $language->language->name }}</span>
							</div>
						</div>
						<div class="row margin-top-xs">
							<div class="col-sm-6">
								<span class="user-view-text">Understanding</span>
							</div>
							<div class="col-sm-6">
								<img src="{{ HTTP_IMAGE_PATH.'mark'.$language->understanding.'.png' }}">
							</div>
						</div>
						<div class="row margin-top-xs">
							<div class="col-sm-6">
								<span class="user-view-text">Speaking</span>
							</div>
							<div class="col-sm-6">
								<img src="{{ HTTP_IMAGE_PATH.'mark'.$language->speaking.'.png' }}">
							</div>
						</div>
						<div class="row margin-top-xs">
							<div class="col-sm-6">
								<span class="user-view-text">Writting</span>
							</div>
							<div class="col-sm-6">
								<img src="{{ HTTP_IMAGE_PATH.'mark'.$language->writing.'.png' }}">
							</div>
						</div>
					<?php }?>
				</div>
				
				<div class="col-sm-12">
					<hr/>
				</div>
				
				<div class="col-sm-12 text-center">
					<span class="user-view-field-title"><i class="fa fa-gamepad"></i> Hobbies</span>
				</div>
				<div class="col-sm-12 text-center margin-top-xs">
					<span class="user-view-field-description">What I like to do in my free time.</span>
				</div>
				
				<div class="col-sm-12 margin-top-normal text-center margin-bottom-sm">
					<?php 
						$hobbies = explode(',', str_replace(' ', '', $user->hobbies));
						foreach($hobbies as $hobby) {
					?>
						<span class="user-view-bold-text user-view-hobby">{{ $hobby }}</span>
					<?php }?>
				</div>
			</div>
			<!-- End for Skills -->
			
			
			<!-- Div for Education -->
			<div class="row margin-top-sm" id="div_education">
				<div class="col-sm-8">
					<div class="col-sm-12 text-center">
						<span class="user-view-field-title"><i class="fa fa-bank"></i> Education</span>
					</div>
					<div class="col-sm-12 text-center margin-top-xs margin-bottom-normal">
						<span class="user-view-field-description">Here's an overview of education institutions I attended.</span>
					</div>
					
					<?php foreach($user->educations as $education) {?>
					<div class="col-sm-12 text-center">
						<div class="user-view-education-background">
							<div class="col-sm-12 text-center" style="margin-top: 18px;">
								<span style="color: white; font-weight: bold;">{{ $education->start }}</span>
							</div>
							<div class="col-sm-12 text-center">
								<span style="color: white; font-weight: bold;">-</span>
							</div>
							<div class="col-sm-12 text-center">
								<span style="color: white; font-weight: bold;">{{ $education->end }}</span>
							</div>							
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6" style="border-right: 1px solid #16a085; height: 10px;"></div>
					</div>
					
					<div class="row margin-top-xs">
						<div class="col-sm-12 text-center">
							<span class="user-view-bold-text" style="font-size: 17px;">{{ $education->name }}</span>
						</div>
						<div class="col-sm=12 text-center">
							<span class="user-view-text-small">{{ $education->faculty}}</span>
						</div>
						<div class="col-sm=12 text-center">
							<span class="user-view-text-small"><i class="fa fa-map-marker"></i> {{ $education->location}}</span>
						</div>
						
						<div class="col-sm-12 text-center margin-top-xs">
							<span class="user-view-text">{{ $education->notes }}</span>
						</div>
					</div>
					<?php }?>						
				</div>
				
				<div class="col-sm-4 padding-top-sm padding-bottom-sm" style="background-color: white;">
					<div class="col-sm-12 text-center">
						<span class="user-view-field-title"><i class="fa fa-trophy"></i> Awards & Honors</span>
					</div>
					<div class="col-sm-12 margin-bottom-normal">
						<hr/>
					</div>
					
					<?php foreach($user->awards as $award) {?>
					<div class="col-sm-12 text-center">
						<div class="user-view-award-background">
							<div class="col-sm-12 text-center" style="margin-top: 18px;">
								<span style="color: white; font-weight: bold; font-size: 25px;"><i class="fa fa-trophy"></i></span>
							</div>
							<div class="col-sm-12 text-center">
								<span style="color: white; font-weight: bold;">{{ $award->year }}</span>
							</div>						
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6" style="border-right: 1px solid #e74c3c; height: 10px;"></div>
					</div>
					
					<div class="row margin-top-xs">
						<div class="col-sm-12 text-center">
							<span class="user-view-bold-text" style="font-size: 17px;">{{ $award->name }}</span>
						</div>
						<div class="col-sm=12 text-center">
							<span class="user-view-text-small">{{ $award->prize}}</span>
						</div>
						<div class="col-sm=12 text-center">
							<span class="user-view-text-small"><i class="fa fa-map-marker"></i> {{ $award->location}}</span>
						</div>
					</div>
					<?php }?>					
				</div>
			</div>
			<!-- End for Education -->
			
			<!-- Div for Experience -->
			<div class="row margin-top-sm padding-top-normal padding-bottom-normal" style="background-color: white;" id="div_experience">
				<div class="col-sm-12 text-center">
					<span class="user-view-field-title"><i class="fa fa-building-o"></i> Work Experience</span>
				</div>
				<div class="col-sm-12 text-center margin-top-xs margin-bottom-normal">
					<span class="user-view-field-description">Here's a list of companies where I worked and gained my professional experience.</span>
				</div>
				<div class="col-sm-12">
					<hr/>
				</div>
				
				<?php $t = 0;?>
				<?php foreach($user->experiences as $experience){?>	
				<?php $t ++;?>
				<div class="row">
					<div class="col-sm-3 padding-bottom-normal margin-top-sm">
						<div class="col-sm-12">
							<span class="user-view-experiencce-name">{{ $experience->name }}</span>
						</div>
						<div class="col-sm-12">
							<span class="user-view-experience-position">{{ $experience->position }}</span>
						</div>
					</div>
					
					<div class="col-sm-3 padding-bottom-normal margin-top-sm">
						<div class="row">
							<div class="col-sm-2">
								<div class="user-view-experience-circle-mark"></div>
							</div>
							<div class="col-sm-10">
								<div class="row">
									<span class="user-view-bold-text">{{ $experience->start.' - '.$experience->end }}</span>
								</div>
								<div class="row">
									<span style="color: #16a085;">{{ $experience->type->name }}</span>
								</div>							
							</div>						
						</div>
					</div>
					
					<div class="col-sm-6 padding-bottom-normal margin-top-sm">
						<div class="col-sm-12">
							<span class="margin-top-sm user-view-text">{{ $experience->notes }}</span>
						</div>
					</div>
				</div>
				
				<?php if (count($user->experiences) != $t) {?>
				<div class="row">
					<div class="col-sm-3">
						<div class="col-sm-12">
							<hr style="border-top: 1px solid #16a085;"/>						
						</div>
					</div>
					<div class="col-sm-6 col-sm-offset-3">
						<div class="col-sm-12">
							<hr/>
						</div>
					</div>
				</div>	
				<?php }?>		
				<?php }?>
				
				<div class="col-sm-12">
					<hr/>
				</div>
				
				<div class="col-sm-12 text-center margin-top-sm">
					<span class="user-view-field-title"><i class="fa fa-comment"></i> Testimonials</span>
				</div>
				<div class="col-sm-12 text-center margin-top-xs margin-bottom-normal">
					<span class="user-view-field-description">Here's what people are saying about me.</span>
				</div>
				
				<?php foreach($user->testimonials as $testimonial) {?>
				<div class="row">
					<div class="col-sm-12 text-center">
						<div class="user-view-testimonial-profile">
							<div class="col-sm-12" style="margin-top: 40px;">
								<span style="color: #cccccc; font-size: 35px;"><i class="fa fa-quote-right"></i></span>
							</div>
						</div>
					</div>
					
					<div class="col-sm-12 margin-top-normal text-center">
						<span class="user-view-text"> {{ $testimonial->notes }}</span>
					</div>
					<div class="col-sm-12 margin-top-xs text-center">
						<span class="user-view-field-description"> {{ $testimonial->name }}</span>
					</div>
				</div>
				<?php }?>
			</div>
			<!-- End for Experience -->
			
			<!-- Div for Contact -->
			<div class="row margin-top-sm padding-top-normal padding-bottom-normal" style="background-color: white;" id="div_contact">
				
				<!-- Commented for change -->
				<!-- 
				<div class="col-sm-8">
					<div class="col-sm-12">
						<span class="user-view-field-title"><i class="fa fa-list-ul"></i> Contact Form</span>
					</div>
					<div class="col-sm-12 margin-top-xs margin-bottom-normal">
						<span class="user-view-field-description">Use this contact form to send an email.</span>
					</div>
					
					<div class="col-sm-6">
						{{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'name']) }}
					</div>
					
					<div class="col-sm-6">
						{{ Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'email']) }}
					</div>
					
					<div class="row">
						<div class="col-sm-12 margin-top-xs">
							<div class="col-sm-12">
								{{ Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => 'Message']) }}
							</div>
						</div>					
					</div>

					
					<div class="row margin-top-sm">
						<div class="col-sm-12">
							<div class="col-sm-3">
								<button class="btn btn-success btn-sm btn-user-view-contact" id="js-btn-check-apply" data-id="4">SEND EMAIL</button>
							</div>
						</div>
					</div>
				</div>
				 -->
				 
				<div class="col-sm-12">
					<div class="col-sm-12 margin-bottom-normal">
						<span class="user-view-field-title"><i class="fa fa-envelope"></i> Contact Detail</span>
					</div>
					
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-12">
									<div class="col-sm-2">
										<span style="color:#16a085;"><i class="fa fa-map-marker"></i></span>
									</div>
									<div class="col-sm-10">
										<span style="color: #666666">{{ $user->address }}</span>
									</div>
								</div>
							</div>					
						</div>
						
						<div class="row margin-top-sm">
							<div class="col-sm-12">
								<div class="col-sm-12">
									<div class="col-sm-2">
										<span style="color:#16a085;"><i class="fa fa-mobile-phone"></i></span>
									</div>
									<div class="col-sm-10">
										<span style="color: #666666">{{ $user->phone }}</span>
									</div>
								</div>
							</div>					
						</div>
						
						<div class="row margin-top-sm">
							<div class="col-sm-12">
								<div class="col-sm-12">
									<div class="col-sm-2">
										<span style="color:#16a085;"><i class="fa fa-envelope-o"></i></span>
									</div>
									<div class="col-sm-10">
										<span style="color: #666666">
											@if ($user->is_published)
												{{ $user->email }}
											@else
												<i class="fa fa-warning"></i> Not published by user
											@endif
										</span>
									</div>
								</div>
							</div>					
						</div>
						
						<div class="row margin-top-sm">
							<div class="col-sm-12">
								<div class="col-sm-12">
									<div class="col-sm-2">
										<span style="color:#16a085;"><i class="fa fa-gears"></i></span>
									</div>
									<div class="col-sm-10">
										<span style="color: #009cff">{{ $user->website }}</span>
									</div>
								</div>
							</div>					
						</div>					
					</div>
					
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-12">
									<div class="col-sm-2">
										<span style="color:#16a085;"><i class="fa fa-facebook-square"></i></span>
									</div>
									<div class="col-sm-10">
										<span style="color: #009cff"><a>Facebook</a></span>
									</div>
								</div>
							</div>					
						</div>
						
						<div class="row margin-top-sm">
							<div class="col-sm-12">
								<div class="col-sm-12">
									<div class="col-sm-2">
										<span style="color:#16a085;"><i class="fa fa-linkedin-square"></i></span>
									</div>
									<div class="col-sm-10">
										<span style="color: #009cff"><a>Linkedin</a></span>
									</div>
								</div>
							</div>					
						</div>
						
						<div class="row margin-top-sm">
							<div class="col-sm-12">
								<div class="col-sm-12">
									<div class="col-sm-2">
										<span style="color:#16a085;"><i class="fa fa-twitter-square"></i></span>
									</div>
									<div class="col-sm-10">
										<span style="color: #009cff"><a>Twitter</a></span>
									</div>
								</div>
							</div>					
						</div>
						
						<div class="row margin-top-sm">
							<div class="col-sm-12">
								<div class="col-sm-12">
									<div class="col-sm-2">
										<span style="color:#16a085;"><i class="fa fa-google-plus-square"></i></span>
									</div>
									<div class="col-sm-10">
										<span style="color: #009cff"><a>Google+</a></span>
									</div>
								</div>
							</div>					
						</div>
					</div>
				
				</div>
					
			</div>
			<!-- End for Contact -->
		</div>
	</div>
</main>
@stop

@section('custom-scripts')
	@include('js.user.dashboard.view')
@stop