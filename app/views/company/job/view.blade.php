@extends('company.layout')

@section('custom-styles')	
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
@stop

@section('body')
<main class="bs-docs-masthead gray-container padding-top-normal padding-bottom-normal" role="main">
	<div class="container" style="background-color: #FFF;">
		<div class="row margin-top-normal">
			<div class="col-sm-6 company-job-title">
				{{ $job->name }}
			</div>
			<div class="col-sm-2 text-center">
				<div class="row">
					<span class="job-span-title-normal">CREATED AT</span>
				</div>
				<div class="row company-info-value">
					{{ $job->created_at }}
				</div>				
			</div>
			<div class="col-sm-2 text-center">
				<div class="row">
					<span class="job-span-title-normal">SALARY</span>
				</div>
				<div class="row company-info-value company-info-number">
					${{ $job->salary }}
				</div>
			</div>
			<div class="col-sm-2 text-center">
				<div class="row">
					<span class="job-span-title-normal">TYPE</span>
				</div>
				<div class="row company-info-value">
					{{ $job->type->name }}
				</div>
			</div>

			<div class="col-sm-12">
				<hr/>
			</div>
		</div>	
		<div class="row">
			<div class="col-sm-6" style="border-right: 1px solid #EEE;">
				<div>
					<span class="job-span-title-normal">Description:</span>
				</div>
				<div class="margin-top-xs">
					{{ nl2br($job->description) }}
				</div>
				<div class="margin-top-normal">
					<span class="job-span-title-normal">Additional requirements:</span>
				</div>
				<div class="margin-top-xs">
					{{ $job->requirements }}
				</div>
				
				<div class="margin-top-normal">
					<span class="job-span-title-normal">Required Skills:</span>
				</div>
				<div class="margin-top-xs">
					<?php foreach($job->skills as $skill) {?>
						<label class="job-skill-label" style="color: #333;">{{ $skill->name }}</label>
					<?php }?>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="col-sm-4 text-center">
					<span class="company-job-info-span">{{ $job->views }}</span> Views
				</div>
				<div class="col-sm-4 text-center">
					<span class="company-job-info-span">{{ count($job->applies) }}</span> Bids
				</div>
				<div class="col-sm-4 text-center">
					<span class="company-job-info-span">{{ count($job->hints) }}</span> Hints
				</div>
			</div>
			
			<div class="col-sm-12">
				<hr/>
			</div>
		</div>
		
		<?php if (count($job->applies) != 0) {?>
		<div class="row margin-top-sm">
			<div class="col-sm-12">
				<span class="job-view-small-title">Bidder List</span>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<hr/>
			</div>
		</div>
		<?php }?>
		
		<div class="row">
			<?php foreach($job->applies as $apply){?>
				<div id = "div_apply">
					<div class="row">
						<div class="col-sm-2 text-center">
							<img style="width: 50px; height: 50px;" src="{{ HTTP_PHOTO_PATH.$apply->user->profile_image }}" class="img-circle">
						</div>
						<div class="col-sm-2 text-center margin-top-xs">
							<a href="{{ URL::route('user.view', $apply->user->id) }}">{{ $apply->user->name }}</a>
						</div>
						<div class="col-sm-2 text-center margin-top-xs">
							<i class="fa fa-clock-o"></i>&nbsp {{ $apply->created_at }}
						</div>
						<div class="col-sm-4 text-center col-sm-offset-2" style="margin-top: 4px;">
							<button class="btn btn-link btn-sm btn-common" id="js-btn-view-proposal" super-data-target="div_apply" data-target="div_notes" other-data-target="div_proposal" onclick="showView(this)">Note</button>
							<button class="btn btn-link btn-sm btn-common" id="js-btn-view-proposal" super-data-target="div_apply" data-target="div_proposal" other-data-target="div_notes" onclick="showView(this)" data-id="{{ $apply->id }}">View Proposal</button>
							<button class="btn btn-link btn-sm btn-common" id="js-btn-open-message" super-data-target="div_apply">Send Message</button>
						</div>
					</div>
					
					<!-- Div for Proposal -->
					<div class="row  margin-top-sm" id="div_proposal" style="display: none;">
						<div class="col-sm-12">
							<div class="col-sm-12">
								<div class="alert alert-success alert-dismissibl fade in" style="margin-bottom: 0px;">
						            <button type="button" class="close" data-target="div_proposal" onclick="hideView(this)">
						                <span aria-hidden="true">&times;</span>
						                <span class="sr-only">Close</span>
						            </button>
									<p>
										<span class="span-job-description-title">{{ $apply->name }}</span>
									</p>
									<p>	
										<span class="span-job-descripton-note">{{ nl2br($apply->description) }}</span>
									</p>
						        </div>
							</div>
						</div>
					</div>
					<!-- End for Proposal -->
					
					<!-- Div for Notes -->
					<div class="row  margin-top-sm" id="div_notes" style="display:none;">
						<div class="col-sm-12">
							<div class="col-sm-12">
								<div class="alert alert-success alert-dismissibl fade in" style="margin-bottom: 0px;">
						            <button type="button" class="close" data-target="div_notes" onclick="hideView(this)">
						                <span aria-hidden="true">&times;</span>
						                <span class="sr-only">Close</span>
						            </button>
									<div class="row">
										<div class="col-sm-11">
											<textarea class="form-control" name="notes" rows="3" id="notes">{{ $apply->notes }}</textarea>
										</div>
									</div>
									<div class="row margin-top-xs">
						            	<div class="col-sm-11 text-center">
											<div class="row margin-top-xs">
												<a class="btn btn-success btn-sm btn-home" style="padding: 5px 30px;" id="js-btn-notes" data-id="{{ $apply->id }}">Save</a>
											</div>	
						            	</div>
						            </div>
						        </div>
							</div>
						</div>
					</div>
					<!-- End for Notes -->
					
					<!-- Modal Div for Send Message -->
					<div class="modal fade" id="msgModal" tabindex="-1" role="dialog" aria-labelledby="msgModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					        <h4 class="modal-title" id="msgModalLabel">Send Message</h4>
					      </div>
					      <div class="modal-body">
					          <div class="form-group ">
					              <textarea class="form-control" rows="8" id="txt_message"></textarea>
					          </div>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					        <button type="button" class="btn btn-primary" id="js-btn-send-message" data-id="{{ $apply->id }}">Send</button>
					      </div>
					    </div>
					  </div>
					</div> 
					<!-- End Div for Send Message -->
	
					<div class="col-sm-12">
						<hr/>
					</div>
				</div>
			<?php }?>		
		</div>
		
		<?php if (count($job->hints) != 0) {?>
		<div class="row margin-top-sm">
			<div class="col-sm-12">
				<span class="job-view-small-title">Hint List</span>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<hr/>
			</div>
		</div>
		<?php }?>
		
		<!-- Div for Hint List -->
		<div class="row">
			<?php foreach($job->hints as $hint){?>
				<div id = "div_hint">
					<div class="row">
						<div class="col-sm-2 text-center">
							<img style="width: 50px; height: 50px;" src="{{ HTTP_PHOTO_PATH.$hint->user->profile_image }}" class="img-circle">
						</div>
						<div class="col-sm-2 text-center margin-top-xs">
							<a href="{{ URL::route('user.view', $hint->user->id) }}">{{ $hint->user->name }}</a>
						</div>
						<div class="col-sm-2 text-center margin-top-xs">
							<i class="fa fa-clock-o"></i>&nbsp {{ $hint->created_at }}
						</div>
						<div class="col-sm-4 text-center col-sm-offset-2" style="margin-top: 4px;">
							<button class="btn btn-link btn-sm btn-common" id="js-btn-view-proposal" super-data-target="div_hint" data-target="div_notes" other-data-target="div_proposal" onclick="showView(this)">Note</button>
							<button class="btn btn-link btn-sm btn-common" id="js-btn-view-proposal" super-data-target="div_hint" data-target="div_proposal" other-data-target="div_notes" onclick="showView(this)">View Hint</button>
							<button class="btn btn-link btn-sm btn-common" id="js-btn-open-message" super-data-target="div_hint">Send Message</button>
						</div>
					</div>
					
					<!-- Div for proposal -->
					<div class="row  margin-top-sm" id="div_proposal" style="display: none;">
						<div class="col-sm-12">
							<div class="col-sm-12">
								<div class="alert alert-success alert-dismissibl fade in" style="margin-bottom: 0px;">
						            <button type="button" class="close" data-target="div_proposal" onclick="hideView(this)">
						                <span aria-hidden="true">&times;</span>
						                <span class="sr-only">Close</span>
						            </button>
						            
						            <?php if ($hint->name != '') {?>
									<div class="row margin-bottom-xs">
										<div class="col-sm-2">
											<span class="span-job-description-title">Name:</span>
										</div>
										<div class="col-sm-9">
											<span class="span-job-descripton-note">{{ $hint->name }}</span>
										</div>
									</div>
									<?php }?>
									
						            <?php if ($hint->email != '') {?>
									<div class="row margin-bottom-xs">
										<div class="col-sm-2">
											<span class="span-job-description-title">Email:</span>
										</div>
										<div class="col-sm-9">
											<span class="span-job-descripton-note">{{ $hint->email }}</span>
										</div>
									</div>
									<?php }?>
									
						            <?php if ($hint->phone != '') {?>
									<div class="row margin-bottom-xs">
										<div class="col-sm-2">
											<span class="span-job-description-title">Phone number:</span>
										</div>
										<div class="col-sm-9">
											<span class="span-job-descripton-note">{{ $hint->phone }}</span>
										</div>
									</div>
									<?php }?>
									
						            <?php if ($hint->currentJob != '') {?>
									<div class="row margin-bottom-xs">
										<div class="col-sm-2">
											<span class="span-job-description-title">Current job:</span>
										</div>
										<div class="col-sm-9">
											<span class="span-job-descripton-note">{{ $hint->currentJob }}</span>
										</div>
									</div>
									<?php }?>
									
						            <?php if ($hint->previousJobs != '') {?>
									<div class="row margin-bottom-xs">
										<div class="col-sm-2">
											<span class="span-job-description-title">Previous jobs:</span>
										</div>
										<div class="col-sm-9">
											<span class="span-job-descripton-note">{{ $hint->previousJobs }}</span>
										</div>
									</div>
									<?php }?>
									
						            <?php if ($hint->description != '') {?>
									<div class="row margin-bottom-xs">
										<div class="col-sm-2">
											<span class="span-job-description-title">Description:</span>
										</div>
										<div class="col-sm-9">
											<span class="span-job-descripton-note">{{ nl2br($hint->description) }}</span>
										</div>
									</div>
									<?php }?>
									
						        </div>
							</div>
						</div>
					</div>
					<!-- End for proposal -->
					
					<!-- Div for Notes -->
					<div class="row  margin-top-sm" id="div_notes" style="display:none;">
						<div class="col-sm-12">
							<div class="col-sm-12">
								<div class="alert alert-success alert-dismissibl fade in" style="margin-bottom: 0px;">
						            <button type="button" class="close" data-target="div_notes" onclick="hideView(this)">
						                <span aria-hidden="true">&times;</span>
						                <span class="sr-only">Close</span>
						            </button>
									<div class="row">
										<div class="col-sm-11">
											<textarea class="form-control" name="notes" rows="3" id="notes">{{ $hint->notes }}</textarea>
										</div>
									</div>
									<div class="row margin-top-xs">
						            	<div class="col-sm-11 text-center">
											<div class="row margin-top-xs">
												<a class="btn btn-success btn-sm btn-home" style="padding: 5px 30px;" id="js-btn-hint-notes" data-id="{{ $hint->id }}">Save</a>
											</div>	
						            	</div>
						            </div>
						        </div>
							</div>
						</div>
					</div>
					<!-- End for Notes -->
					
					
					<!-- Modal Div for Send Message -->
					<div class="modal fade" id="msgModal" tabindex="-1" role="dialog" aria-labelledby="msgModalLabel" aria-hidden="true">
					  <div class="modal-dialog">
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					        <h4 class="modal-title" id="msgModalLabel">Send Message</h4>
					      </div>
					      <div class="modal-body">
					          <div class="form-group ">
					              <textarea class="form-control" rows="8" id="txt_message"></textarea>
					          </div>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					        <button type="button" class="btn btn-primary" id="js-btn-send-message-hint" data-id="{{ $hint->id }}">Send</button>
					      </div>
					    </div>
					  </div>
					</div> 
					<!-- End Div for Send Message -->
	
					<div class="col-sm-12">
						<hr/>
					</div>
				</div>
			<?php }?>		
		</div>
		<!-- End for Hint List -->
		  
	</div>	 
</main> 
@stop


@section('custom-scripts')
    @include('js.company.job.view')
@stop