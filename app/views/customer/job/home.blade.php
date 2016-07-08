<?php 
	$bid_flag = array();
	$cart_flag = array();
	
	foreach ($jobs as $job) {
		$bid_flag[$job->id] = 0;
		$cart_flag[$job->id] = 0;
	}
	
	if (isset($user)) {		
		foreach ($user->applies as $apply) {
			$bid_flag[$apply->job_id] = 1;
		}
		
		foreach ($user->carts as $cart) {
			$cart_flag[$cart->job_id] = 1;
		}
	}
?>
@extends('user.layout')

@section('custom-styles')
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
@stop

@section('body')
<main class="bs-docs-masthead" role="main" style="min-height: 0px;">
	<div class="col-sm-6" style="padding: 0px">
		<a href="#">
			 <div class="home-switch-part1">
				<h1 class="color-white text-center padding-top-lg">Looking for a job?</h1>                                       
			</div>           	
		</a>
	</div>
	<div class="col-sm-6" style="padding: 0px;">
		<a href="#">
			<div class="home-switch-part2">
				<h1 class="color-white text-center padding-top-lg">Looking for a employee?</h1>                                       
			</div>
		</a>
	</div>
</main>
<div>
    <div class="container">
        <div class="row text-center margin-top-normal">
            <h1 class="color-home">How it works?</h1>
        </div>
        
        <div class="row">
            <div class="col-sm-2 col-sm-offset-3 color-gray-dark">
                <div class="step-item">
                    <h3 class="color-gray-dark"><b>Step 1</b></h3>
                    <p>Post project</p>
                </div>
            </div>
            <div class="col-sm-2 color-gray-dark">
                <div class="step-item">
                    <h3 class="color-gray-dark"><b>Step 2</b></h3>
                    <p>Compare proposals</p>
                </div>
            </div>
            <div class="col-sm-2 color-gray-dark">
                <div class="step-item">
                    <h3 class="color-gray-dark"><b>Step 3</b></h3>
                    <p>Choose provider</p>
                </div>
            </div>
        </div>
        
        <div class="row text-center margin-top-normal margin-bottom-normal">
            <h1 class="home color-home">{{ count($jobs). ' Jobs available'}} </h1>
        </div>        
    </div>
    <?php if (!isset($category)) { $category = 0; } ?>
    <div class="container">
        <div class="row margin-top-30">
            <ul class="nav nav-tabs nav-justified ul-project-category" role="tablist">
                <li class="{{ ($category == 0) ? 'active' : '' }}">
                    <a href="/">Latest Projects</a>
                </li>
                @foreach ($categories as $item)
                <li class="{{ ($category == $item->id) ? 'active' : '' }}">
                    <a href="/home/{{ $item->id }}">{{ $item->name }}</a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>    
</div>
<div class="gray-container">    
    <div class="container">
        <div class="row">
			<div class="row margin-top-xs">
				<div class="col-sm-12">
					<div class="col-sm-3">
						<span class="table-header-span">Job</span>
					</div>
					<div class="col-sm-1 text-center">
						<span class="table-header-span">Bids</span>
					</div>
					<div class="col-sm-3">
						<span class="table-header-span">By</span>
					</div>
					<div class="col-sm-1 text-center" style="padding-left: 0px; padding-right: 0px;">
						<span class="table-header-span">Started</span>
					</div>
					<div class="col-sm-2 text-center">
						<span class="table-header-span">Recruitment Bonus</span>
					</div>
					<div class="col-sm-1">
						<span class="table-header-span">Salary</span>
					</div>
				</div>
			</div>
			
			@foreach ($jobs as $job)
			<div class="row margin-top-xs" id="div_job">
				<div class="row table-job-row padding-top-xs">
					<div class="row">
						<div class="col-sm-12">
							<div class="col-sm-3 padding-top-xxs">
								<span><a href="{{ URL::route('user.dashboard.viewJob', $job->id) }}">{{ $job->name }}</a></span>
							</div>
							<div class="col-sm-1 text-center padding-top-xxs">
								<span>{{ count($job->applies) }}</span>
							</div>
							<div class="col-sm-3" style="position:relative;">
								<div style="display: inline-block; margin-top: 5px;">
									<span><a href="{{ URL::route('company.view', $job->company->id) }}">{{ $job->company->name }}</a></span>
								</div>
								<?php $rating = round($job->company->reviews()->avg('score'));?>
								@if ($rating > 0)
								<div style="display: inline-block; position:absolute; margin-top: 3px; margin-left: 5px;">
									<?php for ($i = 1; $i <= $rating; $i ++) {?>
									<img src="/assets/img/star-full.png" style="width: 17px;">
									<?php }?>
									<?php for ($i = $rating+1; $i <= 5; $i ++) {?>
									<img src="/assets/img/star-blank.png" style="width: 17px;">
									<?php }?>
								</div>
								@endif
							</div>
							<div class="col-sm-1 text-center padding-top-xxs" style="padding-left: 0px; padding-right: 0px;">
								<span> {{ explode(" ", $job->created_at)[0] }}</span>	
							</div>
							<div class="col-sm-2 text-center padding-top-xxs">
								<span>${{ $job->bonus }}</span>
							</div>
							<div class="col-sm-1 text-center padding-top-xxs">
								<span>${{ $job->salary }}</span>
							</div>
							<div class="col-sm-1 text-right">
								<?php if ($bid_flag[$job->id] == 1) {?>
								<div style="padding-top: 4px;">
									<span class="span-bid">Applied</span>
								</div>
								<?php }else {?>
								<button class="btn btn-success btn-sm btn-home" other-target="div_more" other-target-second="div_hint" other-target-third="div_overview" data-target="div_apply" onclick="showView(this)">Apply</button>
								<?php }?>
							</div>
						</div>
					</div>
					
					<div class="row margin-top-xxs">
						<div class="col-sm-12">
							<div class="col-sm-3">
								<button class="btn btn-link btn-sm text-uppercase btn-job-table" other-target="div_more" other-target-second="div_hint" other-target-third="div_apply" data-target="div_overview" onclick="showView(this)"> Overview</button>
								<!-- Commented for change -->
								<!-- 
								<button class="btn btn-link btn-sm text-uppercase btn-job-table"> Reviews</button>
								 -->
								<button class="btn btn-link btn-sm text-uppercase btn-job-table" other-target="div_overview" other-target-second="div_hint" other-target-third="div_apply" data-target="div_more" onclick="showView(this)"> More</button>
							</div>
							<div class="col-sm-4 col-sm-offset-1" style="padding-top: 2px;">
								<?php 
									$skillFlag = 0;
									$skillLength = 0;
								    foreach($job->skills as $skill) {
										$skillLength += strlen($skill->name);
										if ($skillLength >= 25) {
											$skillFlag = 1;
											break;
										}	
								?>
									<label class="job-skill-label">{{ $skill->name }}</label>
								<?php }
									if ($skillFlag == 1) {
								?>
									<label class="job-skill-label">...</label>
								<?php }?>
							</div>
							<div class="col-sm-2 text-center">
								<button class="btn btn-link btn-sm text-uppercase btn-job-table" other-target="div_more" other-target-second="div_overview" other-target-third="div_apply" data-target="div_hint" onclick="showView(this)"><i class="fa fa-check"></i> Give us a hint</button>
							</div>
							<div class="col-sm-2">
								@if ($bid_flag[$job->id] == 0)
									@if ($cart_flag[$job->id] == 0)
									<button class="btn btn-link btn-sm text-uppercase btn-job-table" data-id="{{ $job->id }}" id="js-btn-addToCart"><i class="fa fa-save"></i> Add to application cart</button>
									@else 
									<div style="padding-top: 3px;">
										<span class="text-uppercase span-cart">Added to application cart</span>
									</div>
									@endif
								@endif
							</div>
						</div>
					</div>
					
					
					<!-- Div for Overview -->
					<div class="row" id="div_overview" style="display: none;">
						<div class="col-sm-12">
							<div class="col-sm-12">
								<div class="alert alert-success alert-dismissibl fade in">
						            <button type="button" class="close" data-target="div_overview" onclick="hideView(this)">
						                <span aria-hidden="true">&times;</span>
						                <span class="sr-only">Close</span>
						            </button>
									<p>
										<span class="span-job-description-title">Job description:</span>
									</p>
									<p>	
										<span class="span-job-descripton-note">{{ nl2br($job->description) }}</span>
									</p>
									<p>&nbsp</p>
									<p>
										<span class="span-job-description-title">Additional requirements:</span>
									</p>
									<p>	
										<span class="span-job-descripton-note">{{ $job->requirements }}</span>
									</p>
						        </div>
							</div>
						</div>
					</div>
					<!-- End for Overview -->
					
					<!-- Div for More -->
					<div class="row" id="div_more" style="display: none;">
						<div class="col-sm-12">
							<div class="col-sm-12">
								<div class="alert alert-success alert-dismissibl fade in">
						            <button type="button" class="close" data-target="div_more" onclick="hideView(this)">
						                <span aria-hidden="true">&times;</span>
						                <span class="sr-only">Close</span>
						            </button>
									<p>
										<span class="span-job-description-title">Similar Jobs:</span>
									</p>
									@foreach($job->category->jobs as $sjob)
									<?php if ($sjob->id == $job->id) continue;?>
									<p>	
										<span class="span-job-descripton-note"><a href="{{ URL::route('user.dashboard.viewJob', $sjob->id) }}">{{ $sjob->name }}</a></span>
									</p>
									@endforeach
						        </div>								
							</div>
						</div>
					</div>
					<!-- End for More -->
					
					<!-- Div for Hint -->
					<div class="row" id="div_hint" style="display: none;">
						<div class="col-sm-12">
							<div class="col-sm-12">
								<div class="alert alert-success alert-dismissibl fade in">
						            <button type="button" class="close" data-target="div_hint" onclick="hideView(this)">
						                <span aria-hidden="true">&times;</span>
						                <span class="sr-only">Close</span>
						            </button>
						            
						            <div class="row">
						     			
						     			<input type="hidden" name="is_name" id="is_name" value="{{ $job->is_name }}">
						     			<input type="hidden" name="is_phonenumber" id="is_phonenumber" value="{{ $job->is_phonenumber }}">
						     			<input type="hidden" name="is_email" id="is_email" value="{{ $job->is_email }}">
						     			<input type="hidden" name="is_currentjob" id="is_currentjob" value="{{ $job->is_currentjob }}">
						     			<input type="hidden" name="is_previousjobs" id="is_previousjobs" value="{{ $job->is_previousjobs }}">
						     			<input type="hidden" name="is_description" id="is_description" value="{{ $job->is_description }}">
						     			
						            	<div class="col-sm-6">
											<?php if ($job->is_name) {?>
											<div class="row">
												<div class="col-sm-5 padding-top-xs text-right">
													<span class="span-job-description-title">Name *:</span>
												</div>
												<div class="col-sm-7">
													<input class="form-control" name="name" type="text" id="name">
												</div>
											</div>
											<?php }?>
											<?php if ($job->is_phonenumber) {?>
											<div class="row margin-top-xs">
												<div class="col-sm-5 padding-top-xs text-right">
													<span class="span-job-description-title">Phonenumber *:</span>
												</div>
												<div class="col-sm-7">
													<input class="form-control" name="phone" type="text" id="phone">
												</div>
											</div>
											<?php }?>
											<?php if ($job->is_email) {?>
											<div class="row margin-top-xs">
												<div class="col-sm-5 padding-top-xs text-right">
													<span class="span-job-description-title">Email *:</span>
												</div>
												<div class="col-sm-7">
													<input class="form-control" name="email" type="text" id="email">
												</div>
											</div>
											<?php }?>
											<?php if ($job->is_currentjob) {?>
											<div class="row margin-top-xs">
												<div class="col-sm-5 padding-top-xs text-right">
													<span class="span-job-description-title">Current Job *:</span>
												</div>
												<div class="col-sm-7">
													<input class="form-control" name="currentJob" type="text" id="currentJob">
												</div>
											</div>
											<?php }?>
											<?php if ($job->is_previousjobs) {?>
											<div class="row margin-top-xs">
												<div class="col-sm-5 padding-top-xs text-right">
													<span class="span-job-description-title">Previous jobs *:</span>
												</div>
												<div class="col-sm-7">
													<input class="form-control" name="previousJobs" type="text" id="previousJobs">
												</div>
											</div>
											<?php }?>						            		
						            	</div>
						            	
						            	<div class="col-sm-5">
						            			
											<?php if ($job->is_description) {?>
											<div class="row">
												<div class="col-sm-12 text-left">
													<span class="span-job-description-title">Description *:</span>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12">
													<textarea class="form-control" name="description" rows="3" id="description"></textarea>
												</div>
											</div>
											<?php }?>
						            	</div>
						            </div>
						            
						            <div class="row margin-top-xs">
						            	<div class="col-sm-12 text-center">
											<div class="row margin-top-xs">
												<a class="btn btn-success btn-sm btn-home" style="padding: 5px 30px;" id="js-a-hint" data-id="{{ $job->id }}">Submit</a>
											</div>	
						            	</div>
						            </div>													
						        </div>								
							</div>
						</div>					
					</div>
					<!-- End for Hint -->
					
					<!-- Div for Apply -->
					<div class="row" id="div_apply" style="display: none;">
						<div class="col-sm-12">
							<div class="col-sm-12">
								<div class="alert alert-success alert-dismissibl fade in">
						            <button type="button" class="close" data-target="div_apply" onclick="hideView(this)">
						                <span aria-hidden="true">&times;</span>
						                <span class="sr-only">Close</span>
						            </button>
						            
									<div class="row">
										<div class="col-sm-2 col-sm-offset-1">
											{{ Form::label('', 'Pattern', ['class' => 'margin-top-xs job-form-label']) }}
										</div>
										<div class="col-sm-8">
											<select class="form-control" onchange="changePattern(this);">
												@foreach($patterns as $pattern)
												<option value="{{ $pattern->name }}" data-description="{{ $pattern->description }}">{{ $pattern->name }}</option>
												@endforeach
												<option value="" data-descripton="">Other</option>
											</select>
										</div>
									</div>
						            
									<div class="row margin-top-xs">
										<div class="col-sm-2 col-sm-offset-1">
											{{ Form::label('', 'Title', ['class' => 'margin-top-xs job-form-label']) }}
										</div>
										<div class="col-sm-8">
											{{ Form::text('title', $patterns[0]->name, ['class' => 'form-control', 'id' => 'title']) }}
										</div>
									</div>
									
									<div class="row margin-top-xs">
										<div class="col-sm-2 col-sm-offset-1">
											{{ Form::label('', 'Description', ['class' => 'margin-top-xs job-form-label']) }}
										</div>
										<div class="col-sm-8">
											{{ Form::textarea('description', $patterns[0]->description, ['class' => 'form-control job-description', 'rows' => '5', 'id' => 'description']) }}
										</div>
									</div>
									
									<div class="row margin-top-sm">
										<div class="col-sm-8 col-sm-offset-3 text-right">
											<div class="col-sm-4 col-sm-offset-8 text-right">
												<button class="btn btn-sm btn-primary text-uppercase btn-block" id="js-btn-apply" data-id="{{ $job->id }}">SUBMIT</button>
											</div>
										</div>
									</div>
						        </div>								
							</div>
						</div>
					</div>
					<!-- End for Apply -->
				</div>
			</div>
			@endforeach
			
			<?php if (count($jobs) == 0) {?>
			<div class="row">
				<div class="col-sm-12">
					<div class="col-sm-12 padding-top-sm padding-bottom-sm text-center" style="background-color: white;">
						There are no jobs.
					</div>
				</div>
			</div>
			<?php }?>
			
            <div class="pull-right">{{ $jobs->links() }}</div>
        </div>
        <div class="row padding-bottom-normal padding-top-normal">
            <div class="col-sm-6" style="background-image: url('/assets/img/home01.jpg'); background-size: cover; padding: 0px;">
                <div class="home-desc-part1">
                    <h1 class="color-white text-center" style="margin-top: 0px; padding-top: 30px;">For Consumers</h1>
                    <div class="home-desc-step">
                        <div class="pull-left home-desc-step-icon">
                            <span class="glyphicon glyphicon-chevron-right color-white"></span>
                        </div>
                        <div class="pull-left home-desc-step-text">
                            <span class="color-gray-dark"><b>Connect with all relevant service providers</b></span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="home-desc-step">
                        <div class="pull-left home-desc-step-icon">
                            <span class="glyphicon glyphicon-chevron-right color-white"></span>
                        </div>
                        <div class="pull-left home-desc-step-text">
                            <span class="color-gray-dark"><b>Connect with all relevant service providers</b></span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="home-desc-step">
                        <div class="pull-left home-desc-step-icon">
                            <span class="glyphicon glyphicon-chevron-right color-white"></span>
                        </div>
                        <div class="pull-left home-desc-step-text">
                            <span class="color-gray-dark"><b>Connect with all relevant service providers</b></span>
                        </div>
                        <div class="clearfix"></div>
                    </div>                                        
                </div>
            </div>
            <div class="col-sm-6" style="background-image: url('/assets/img/home02.jpg'); background-size: cover; padding: 0px;">
                <div class="home-desc-part2">
                    <h1 class="color-blue text-center" style="margin-top: 0px; padding-top: 30px;">For businesses</h1>
                    <div class="home-desc-step">
                        <div class="pull-left home-desc-step-icon">
                            <span class="glyphicon glyphicon-chevron-right color-white"></span>
                        </div>
                        <div class="pull-left home-desc-step-text">
                            <span class="color-gray-dark"><b>Connect with all relevant service providers</b></span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="home-desc-step">
                        <div class="pull-left home-desc-step-icon">
                            <span class="glyphicon glyphicon-chevron-right color-white"></span>
                        </div>
                        <div class="pull-left home-desc-step-text">
                            <span class="color-gray-dark"><b>Connect with all relevant service providers</b></span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    
                    <div class="home-desc-step">
                        <div class="pull-left home-desc-step-icon">
                            <span class="glyphicon glyphicon-chevron-right color-white"></span>
                        </div>
                        <div class="pull-left home-desc-step-text">
                            <span class="color-gray-dark"><b>Connect with all relevant service providers</b></span>
                        </div>
                        <div class="clearfix"></div>
                    </div>                                        
                </div>
            </div>
        </div>    
    </div>
</div>
@stop

@section('custom-scripts')
	@include('js.user.job.home')
@stop