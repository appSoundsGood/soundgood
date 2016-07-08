@extends('company.layout')

@section('custom-styles')
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">	
@stop

@section('body')
<main class="auth">
    
    <div class="container">
	    <div class="row">
		    <div class="col-sm-4 col-sm-offset-4 margin-top-lg">
		        @if ($errors->has())
		        <div class="alert alert-danger alert-dismissibl fade in">
		            <button type="button" class="close" data-dismiss="alert">
		                <span aria-hidden="true">&times;</span>
		                <span class="sr-only">Close</span>
		            </button>
		            @foreach ($errors->all() as $error)
		        		<p>{{ $error }}</p>		
		        	@endforeach
		        </div>
		        @endif    
		        
		        <?php if (isset($alert)) { ?>
		        <div class="alert alert-<?php echo $alert['type'];?> alert-dismissibl fade in">
		            <button type="button" class="close" data-dismiss="alert">
		                <span aria-hidden="true">&times;</span>
		                <span class="sr-only">Close</span>
		            </button>
		            <p>
		                <?php echo $alert['msg'];?>
		            </p>
		        </div>
		        <?php } ?>
		    </div>    
	    </div> 
	    
	    
	    <form method="POST" action="{{ URL::route('company.job.doAddJob') }}" role="form" class="form-login margin-top-normal" enctype="multipart/form-data">
	    
	    	<input type="hidden" name="company_id" value="{{ $company_id }}">
	    
	    	<div class="text-center">
	    		<h2 class="signup-sub-title"><i class="fa fa-file-text-o"></i> Add Job Offer</h2>
	    		<p class="signup-sub-description">Hey,it's easier than it looks. Take a deep breath and complete the fields below. You'll have a beautiful job offer!</p>
	    	</div>
	    	
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-1 margin-top-sm">
					<hr/>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5 col-sm-offset-1">
				        @foreach ([
				            'name' => 'Job Title:',
				            'level_id' => 'Career Level:',
				            'presence_id' => 'Presence:',
				            'year' => 'Years of experience:',
				            'category_id' => 'Industry',
				            'city_id' => 'Location',						            
				        ] as $key => $value)
				            <div class="row margin-top-sm">
			                    <div class="form-group">
			                        <label class="col-sm-5">{{ Form::label($key, $value, ['class' => 'margin-top-xs']) }}</label>
			                        <div class="col-sm-7">
										@if ($key == 'city_id')
				                            {{ Form::select($key
				                               , $cities->lists('name', 'id')
				                               , null
				                               , array('class' => 'form-control')) }}   
				                        @elseif ($key == 'category_id') 
				                            {{ Form::select($key
				                               , $categories->lists('name', 'id')
				                               , null
				                               , array('class' => 'form-control')) }}
										@elseif ($key == 'presence_id')
				                            {{ Form::select($key
				                               , $presences->lists('name', 'id')
				                               , null
				                               , array('class' => 'form-control')) }}
				                        @elseif ($key == 'level_id')
				                            {{ Form::select($key
				                               , $levels->lists('name', 'id')
				                               , null
				                               , array('class' => 'form-control')) }}				                        													                        	                          		                            
				                        @else
				                            {{ Form::text($key, null, ['class' => 'form-control']) }}
				                        @endif
			                        </div>
			                    </div>
				            </div>        
				        @endforeach  				
					</div>
					<div class="col-sm-5 padding-left-normal">
			            <div class="row margin-top-sm">
		                    <div class="form-group">
		                    	<div>
		                    		<div class="col-sm-4">
		                    			<label>{{ Form::label('about', 'Job Description:') }}</label>
		                    		</div>	                    		
		                    	</div>
		                        <div>
									{{ Form::textarea('description', null, ['class' => 'form-control job-description']) }}
		                        </div>
		                    </div>
			            </div> 				
					</div>
				</div>
			</div>
			
			
	    	<div class="text-center col-sm-10 col-sm-offset-1 margin-top-lg">
	    		<h2 class="signup-sub-title"><i class="fa fa-bar-chart-o"></i> Required Skills</h2>
	    		<p class="signup-sub-description">Describe the required skills and expertise for this job.</p>
	    	</div>
	    	
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-1 margin-top-sm">
					<hr/>
				</div>
			</div>
						
			<div id="skill_list"></div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5 col-sm-offset-1">
			            <div class="row margin-top-sm">
		                    <div class="form-group">
		                        <label class="col-sm-5" style="color:#34495e;">{{ Form::label('', 'Native Language:', ['class' => 'margin-top-xs']) }}</label>
		                        <div class="col-sm-7">
		                            {{ Form::select('native_language_id'
		                               , $languages->lists('name', 'id')
		                               , null
		                               , array('class' => 'form-control')) }} 
		                        </div>
		                    </div>
			            </div>        				
					</div>
					<div class="col-sm-5 padding-left-normal">
			            <div class="row margin-top-sm">
		                    <div class="form-group">
								<div class="col-sm-12 margin-top-xs">
									<a style="color: #2980b9; cursor: pointer;" onclick="onAddForeignLanguage();"><i class="fa fa-plus-circle"></i> Add Foreign Language</a>
								</div>							
		                    </div>
			            </div> 				
					</div>
				</div>
			</div>
			
			<div id="language_list"></div>
			
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-1 margin-top-sm">
					<hr/>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2 col-sm-offset-1">
						<div class="row margin-top-sm padding-left-xs">
							<div class="form-group">
								{{ Form::label('', 'Additional Requirements:', ['class' => 'margin-top-xs']) }}
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="row margin-top-sm signup-long-input">
							<div class="form-group">
								{{ Form::text('requirements', null, ['class' => 'form-control']) }}
							</div>
						</div>
					</div>
					<div class="col-sm-2 col-sm-offset-1">
					</div>
					<div class="col-sm-8">
						<div class="row signup-long-input">
							<div class="form-group">
								<p>Insert multiple requirements and separate them using commas.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-1 margin-top-sm">
					<hr/>
				</div>
			</div>

			
	    	<div class="text-center col-sm-10 col-sm-offset-1 margin-top-lg">
	    		<h2 class="signup-sub-title"><i class="fa fa-envelope-o"></i> Recruitment bonus</h2>
	    		<p class="signup-sub-description">We're almost done! Fill in the contact details accuratelly.</p>
	    	</div>
	    	
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-1 margin-top-sm">
					<hr/>
				</div>
			</div>
						
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5 col-sm-offset-1">
						<div class="row margin-top-sm">
							<div class="form-group">
								<label class="col-sm-5">{{ Form::label('', 'Bonus:', ['class' => 'margin-top-xs']) }}</label>
								<div class="col-sm-7">
									{{ Form::text('bonus', null, ['class' => 'form-control']) }}
								</div>
							</div>
						</div>        				
					</div>
					<div class="col-sm-5 padding-left-normal">
						<div class="row margin-top-sm">
							<div class="form-group">
								<label class="col-sm-6">{{ Form::label('', 'Bonus paid after:', ['class' => 'margin-top-xs']) }}</label>
								<div class="col-sm-6">
									{{ Form::text('paid_after', null, ['class' => 'form-control']) }}
								</div>
							</div>
						</div> 				
					</div>				
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-9 col-sm-offset-2">
						<div class="row margin-top-sm signup-long-input">
							<div class="form-group margin-top-xs text-center">
								<div class="col-sm-2">
				                    {{ Form::checkbox('is_name', 1, null, ['class' => 'checkbox-normal', 'id' => 'is_name', 'checked']) }}
				                    <label class="control-checkbox">Name</label>
								</div>
								<div class="col-sm-2" style="padding-left: 0px; padding-right: 0px;">
				                    {{ Form::checkbox('is_phonenumber', 0, null, ['class' => 'checkbox-normal', 'id' => 'is_phonenumber']) }}
				                    <label class="control-checkbox">Phonenumber</label>
								</div>
								<div class="col-sm-2">
				                    {{ Form::checkbox('is_email', 1, null, ['class' => 'checkbox-normal', 'id' => 'is_email', 'checked']) }}
				                    <label class="control-checkbox">Email</label>
								</div>
								<div class="col-sm-2">
				                    {{ Form::checkbox('is_currentjob', 0, null, ['class' => 'checkbox-normal', 'id' => 'is_currentjob']) }}
				                    <label class="control-checkbox">Current job</label>
								</div>
								<div class="col-sm-2">
				                    {{ Form::checkbox('is_previousjobs', 0, null, ['class' => 'checkbox-normal', 'id' => 'is_previousjobs']) }}
				                    <label class="control-checkbox">Previous jobs</label>
								</div>	
								<div class="col-sm-2">
				                    {{ Form::checkbox('is_description', 1, null, ['class' => 'checkbox-normal', 'id' => 'is_description', 'checked']) }}
				                    <label class="control-checkbox">Description</label>
								</div>																							
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2 col-sm-offset-1">
						<div class="row margin-top-sm padding-left-xs">
							<div class="form-group">
								{{ Form::label('', 'Description:', ['class' => 'margin-top-xs']) }}
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="row margin-top-sm signup-long-input">
							<div class="form-group">
								{{ Form::text('bonus_description', null, ['class' => 'form-control']) }}
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-1 margin-top-sm">
					<hr/>
				</div>
			</div>
			
	    	<div class="text-center col-sm-10 col-sm-offset-1 margin-top-lg">
	    		<h2 class="signup-sub-title"><i class="fa fa-money"></i> Salary & Benefits</h2>
	    		<p class="signup-sub-description">Let companies know your financial expectations.</p>
	    	</div>
	    	
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-1 margin-top-sm">
					<hr/>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5 col-sm-offset-1">
						<div class="row margin-top-sm">
							<div class="form-group">
								<label class="col-sm-5">{{ Form::label('', 'Job Type:', ['class' => 'margin-top-xs']) }}</label>
								<div class="col-sm-7">
		                            {{ Form::select('type_id'
		                               , $types->lists('name', 'id')
		                               , null
		                               , array('class' => 'form-control')) }} 
								</div>
							</div>
						</div>        				
					</div>
					<div class="col-sm-5 padding-left-normal">
						<div class="row margin-top-sm">
							<div class="form-group">
								<label class="col-sm-4">{{ Form::label('', 'Salary:', ['class' => 'margin-top-xs']) }}</label>
								<div class="col-sm-4">
									{{ Form::text('salary', null, ['class' => 'form-control']) }}
								</div>
								<div class="col-sm-4">
									{{ Form::label('', '/ Month', ['class' => 'margin-top-xs']) }}
								</div>
							</div>
						</div> 				
					</div>											
				</div>
			</div>
			
			
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-1 margin-top-sm">
					<hr/>
				</div>
			</div>
			
			<div id="benefit_list"></div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5 col-sm-offset-1">
						<div class="row">
							<div class="form-group">
								<div class="col-sm-7 col-sm-offset-5">
									<a style="color: #2980b9; cursor: pointer;" onclick="onAddBenefit();"><i class="fa fa-plus-circle"></i> Add New Benefit</a>
								</div>
							</div>
						</div>        				
					</div>											
				</div>
			</div>
			
			
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-1 margin-top-sm">
					<hr/>
				</div>
			</div>
			
			
	    	<div class="text-center col-sm-10 col-sm-offset-1 margin-top-lg">
	    		<h2 class="signup-sub-title"><i class="fa fa-bookmark"></i> Contact Details</h2>
	    		<p class="signup-sub-description">We're almost done! Fill in the contact details accuratelly.</p>
	    	</div>
	    	
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-1 margin-top-sm">
					<hr/>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5 col-sm-offset-1">
						<div class="row margin-top-sm">
							<div class="form-group">
								<label class="col-sm-5">{{ Form::label('', 'Phone number:', ['class' => 'margin-top-xs']) }}</label>
								<div class="col-sm-7">
									{{ Form::text('phone', null, ['class' => 'form-control']) }}
								</div>
							</div>
						</div>        				
					</div>
					<div class="col-sm-5 padding-left-normal">
						<div class="row margin-top-sm">
							<div class="form-group">
								<label class="col-sm-6">{{ Form::label('', 'Contact Email:', ['class' => 'margin-top-xs']) }}</label>
								<div class="col-sm-6">
									{{ Form::text('email', null, ['class' => 'form-control']) }}
								</div>
							</div>
						</div> 				
					</div>	
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-5 col-sm-offset-1">
						<div class="row margin-top-sm">
							<div class="form-group margin-top-xs">
								<div class="col-sm-7 col-sm-offset-5">
				                    {{ Form::checkbox('is_published', 0, null, ['class' => 'checkbox-normal', 'id' => 'is_published']) }}
				                    <label class="control-checkbox">Publish my email address</label>
								</div>
							</div>
						</div>        				
					</div>
				</div>
			</div>
			
			
			<div class="form-group" style="margin-bottom: 0px;">
				<div class="row">
					<div class="col-sm-2 col-sm-offset-1">
						<div class="row margin-top-sm padding-left-sm">
							<div class="form-group">
								{{ Form::label('', 'Google Maps Address:', ['class' => 'margin-top-xs']) }}
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="row margin-top-sm signup-long-input">
							<div class="form-group">
								{{ Form::text('latlng', null, ['class' => 'form-control', 'readonly', 'id' => 'latlng']) }}
							</div>
						</div>
					</div>
				</div>
			</div>
			
	        <input type="hidden" name="lat" value="" id="lat">
	        <input type="hidden" name="lng" value="" id="lng">
	        <input type="hidden" name="is_finished" value="1" id="is_finished">
	        
			<div class="form-group">
				<div class="row">
					<div class="col-sm-8 col-sm-offset-3">
						<div class="row signup-long-input">
							<div id="mapdiv" style="height:200px;"></div>
						</div>
					</div>
				</div>
			</div>			
	 
	        
	        <div class="row padding-bottom-xl">
	            <div class="col-sm-2 col-sm-offset-5 margin-top-normal">
	                <button class="btn btn-lg btn-primary text-uppercase btn-block">SUBMIT <span class="glyphicon glyphicon-ok-circle"></span></button>
	            </div>
	        </div>
	    </form>    
    </div>
           
</main>


<!-- Model Div for Skill -->
<div id="clone_div_skill" class="hidden row">
	<div class="form-group">
		<div class="col-sm-5 col-sm-offset-1">
			<div class="row margin-top-sm">
				<div class="form-group">
					<label class="col-sm-5">{{ Form::label('', 'Skill Name:', ['class' => 'margin-top-xs']) }}</label>
					<div class="col-sm-7">
						<input class="form-control" name="skill_name[]" type="text">
					</div>
				</div>
			</div>        				
		</div>
		<div class="col-sm-5">
			<div class="row margin-top-sm">
				<div class="form-group">
					<div class="col-sm-3">
						<input class="form-control" name="skill_value[]" type="text">
					</div>							
					<label class="col-sm-4">{{ Form::label('', '% (1 to 100 value)', ['class' => 'margin-top-xs']) }}</label>
					<div class="col-sm-5 margin-top-xs">
						<a style="color: #e74c3c; cursor: pointer;" onclick="onDeleteSkill(this);"><i class="fa fa-trash"></i> Delete Skill</a>
					</div>
				</div>
			</div> 				
		</div>
		<div class="col-sm-5 col-sm-offset-1">
			<div class="row margin-top-sm">
				<div class="form-group">
					<label class="col-sm-5"></label>
					<div class="col-sm-7">
						<a style="color: #2980b9; cursor: pointer;" onclick="onAddSkill();"><i class="fa fa-plus-circle"></i> Add New Skill</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-1 margin-top-sm">
			<hr/>
		</div>
	</div>
</div>
<!--  -->

<!-- Model Div for Language -->
<div id="clone_div_language" class="hidden">
	<div class="form-group">
		<div class="row">
			<div class="col-sm-5 col-sm-offset-1">
	            <div class="row margin-top-sm">
                    <div class="form-group">
                        <label class="col-sm-5" style="color:#34495e;">{{ Form::label('', 'Foreign Language:', ['class' => 'margin-top-xs']) }}</label>
                        <div class="col-sm-7">
                            {{ Form::select('foreign_language_id[]'
                               , $languages->lists('name', 'id')
                               , null
                               , array('class' => 'form-control')) }} 
                        </div>
                        <div class="col-sm-5"></div>
                        <div class="col-sm-7 margin-top-xs">
                        	<a style="color: #e74c3c; cursor: pointer;" onclick="onDeleteForeignLanguage(this);"><i class="fa fa-trash"></i> Delete Foreign Language</a>
                        </div>		           
                    </div>
	            </div>        				
			</div>
			<div class="col-sm-5 padding-left-normal">
	            <div class="row margin-top-sm">
                    <div class="form-group">
                        <label class="col-sm-5" style="color:#34495e;">{{ Form::label('', 'Understanding:', ['class' => 'margin-top-xs']) }}</label>
                        <div class="col-sm-7">
							<select class="form-control" id="understanding" name="understanding[]">
								<option value="1">Very bad</option>
								<option value="2">Bad</option>
								<option value="3">Normal</option>
								<option value="4">Good</option>
								<option value="5">Best</option>
							</select>
                        </div>
                        <label class="col-sm-5 margin-top-sm" style="color:#34495e;">{{ Form::label('', 'Speaking:', ['class' => 'margin-top-xs']) }}</label>
                        <div class="col-sm-7 margin-top-sm">
							<select class="form-control" id="speaking" name="speaking[]">
								<option value="1">Very bad</option>
								<option value="2">Bad</option>
								<option value="3">Normal</option>
								<option value="4">Good</option>
								<option value="5">Best</option>
							</select>
                        </div>
                        <label class="col-sm-5 margin-top-sm" style="color:#34495e;">{{ Form::label('', 'Writing:', ['class' => 'margin-top-xs']) }}</label>
                        <div class="col-sm-7 margin-top-sm">
							<select class="form-control" id="writing" name="writing[]">
								<option value="1">Very bad</option>
								<option value="2">Bad</option>
								<option value="3">Normal</option>
								<option value="4">Good</option>
								<option value="5">Best</option>
							</select>
                        </div>
                    </div>
	            </div> 				
			</div>
		</div>
	</div>
</div>
<!--  -->

<!-- Model Div for Benefit -->
<div id="clone_div_benefit" class="hidden">
	<div class="form-group">
		<div class="row">
			<div class="col-sm-5 col-sm-offset-1">
				<div class="row margin-top-sm">
					<div class="form-group">
						<label class="col-sm-5">{{ Form::label('', 'Benefit Name:', ['class' => 'margin-top-xs']) }}</label>
						<div class="col-sm-7">
							<input class="form-control" name="benefit_name[]" type="text">
						</div>
						<div class="col-sm-7 col-sm-offset-5 margin-top-xs">
							<a style="color: #e74c3c; cursor: pointer;" onclick="onDeleteBenefit(this);"><i class="fa fa-trash"></i> Delete Benefit</a>
						</div>
					</div>
				</div>        				
			</div>											
		</div>
	</div>
</div>
<!--  -->

@stop

@stop

@section('custom-scripts')
    @include('js.company.job.add')
@stop