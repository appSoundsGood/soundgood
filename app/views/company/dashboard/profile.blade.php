@extends('company.layout')

@section('custom-styles')
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">	
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
	    
	    
	    <form method="POST" action="{{ URL::route('company.saveProfile') }}" role="form" class="form-login margin-top-normal" enctype="multipart/form-data">
	    
	    	<input type="hidden" name="company_id" value="{{ $company->id }}">
	    	
	    	<div class="text-center">
	    		<h2 class="signup-sub-title"><i class="fa fa-briefcase"></i> Edit Company Profile</h2>
	    		<p class="signup-sub-description">Hey,it's easier than it looks. Take a deep breath and complete the fields below. You'll have a beautiful company page!</p>
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
				            'email' => 'Email:',
				            'password' => 'Password:',
				            'password_confirmation' => 'Confirm Password:',
				            'name' => 'Name:',
							'tag' => 'Tag Line:',
							'year' => 'Foundation Year:',
							'teamsize_id' => 'Team size:',
							'category_id' => 'Category:',
							'city_id' => 'Location:',        
				        ] as $key => $value)
				            <div class="row margin-top-sm">
			                    <div class="form-group">
			                        <label class="col-sm-5">{{ Form::label($key, $value, ['class' => 'margin-top-xs']) }}</label>
			                        <div class="col-sm-7">
										@if ($key == 'city_id')
				                            {{ Form::select($key
				                               , $cities->lists('name', 'id')
				                               , $company->city_id
				                               , array('class' => 'form-control')) }}   
				                        @elseif ($key == 'category_id') 
				                            {{ Form::select($key
				                               , $categories->lists('name', 'id')
				                               , $company->category_id
				                               , array('class' => 'form-control')) }}
				                        @elseif ($key == 'teamsize_id')
					                    	<select class="form-control" name="teamsize_id" id="teamsize_id">
					                    		@foreach ($teamsizes as $item)
					                    		<option value="{{ $item->id }}" {{ $company->teamsize_id == $item->id ? 'selected':'' }}>{{ $item->min." ~ ".$item->max }}</option>
					                    		@endforeach
					                    	</select>
					                    @elseif ($key == 'password')
					                    	{{ Form::password($key, array('class' => 'form-control')) }}  	
					                    @elseif ($key == 'password_confirmation')
					                    	{{ Form::password($key, array('class' => 'form-control')) }}		                        	                          		                            
				                        @else
				                            {{ Form::text($key, $company->{$key}, ['class' => 'form-control']) }}
				                        @endif
			                        </div>
			                    </div>
				            </div>        
				        @endforeach  				
					</div>
					<div class="col-sm-5 padding-left-normal">
			            <div class="row margin-top-sm">
		                    <div class="form-group">
		                    	<?php if($company->logo != '') {?>
		                    		<div>
		                    			<img src="{{ HTTP_LOGO_PATH.$company->logo}}" style="width: 100%;">
		                    		</div>
			                    	<div>
			                    		<div class="col-sm-4">
			                    			<label>{{ Form::label('about', 'Description:') }}</label>
			                    		</div>	
			                    		<div class="col-sm-4 col-sm-offset-4" style="padding: 0px;">
				                    		<div class="fileUpload">
											    <span><i class="fa fa-picture-o"></i> Change Logo</span>
											    <input type="file" class="upload" name="logo"/>
											</div>
			                    		</div>                    		
			                    	</div>
			                        <div>
										{{ Form::textarea('description', $company->description, ['class' => 'form-control']) }}
			                        </div>
		                    	<?php }else {?>
			                    	<div>
			                    		<div class="col-sm-4">
			                    			<label>{{ Form::label('about', 'Description:') }}</label>
			                    		</div>	
			                    		<div class="col-sm-4 col-sm-offset-4" style="padding: 0px;">
				                    		<div class="fileUpload">
											    <span><i class="fa fa-picture-o"></i> Logo</span>
											    <input type="file" class="upload" name="logo"/>
											</div>
			                    		</div>                    		
			                    	</div>
			                        <div>
										{{ Form::textarea('description', $company->description, ['class' => 'form-control auth-about']) }}
			                        </div>
		                    	<?php }?>

		                    </div>
			            </div> 				
					</div>
				</div>
			</div>
			
			
	    	<div class="text-center col-sm-10 col-sm-offset-1 margin-top-lg">
	    		<h2 class="signup-sub-title"><i class="fa fa-bar-chart-o"></i> Services</h2>
	    		<p class="signup-sub-description">Describe your services and expertise.</p>
	    	</div>
	    	
			<div class="form-group">
				<div class="col-sm-10 col-sm-offset-1 margin-top-sm">
					<hr/>
				</div>
			</div>
			
			<div id="service_list"></div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-sm-2 col-sm-offset-1">
						<div class="row margin-top-sm padding-left-sm">
							<div class="form-group">
								<label for="" class="margin-top-xs">Expertise:</label>
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="row margin-top-sm signup-long-input">
							<div class="form-group">
								<input class="form-control" name="expertise" type="text" value="{{ $company->expertise }}">
							</div>
						</div>
					</div>
					<div class="col-sm-2 col-sm-offset-1">
					</div>
					<div class="col-sm-8">
						<div class="row signup-long-input">
							<div class="form-group">
								<p>Insert multiple expertise areas and separate them using commas.</p>
							</div>
						</div>
					</div>
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
								<label class="col-sm-5">{{ Form::label('', 'Address:', ['class' => 'margin-top-xs']) }}</label>
								<div class="col-sm-7">
									{{ Form::text('address', $company->address, ['class' => 'form-control']) }}
								</div>
							</div>
						</div>        				
					</div>
					<div class="col-sm-5 padding-left-normal">
						<div class="row margin-top-sm">
							<div class="form-group">
								<label class="col-sm-6">{{ Form::label('', 'Facebook:', ['class' => 'margin-top-xs']) }}</label>
								<div class="col-sm-6">
									{{ Form::text('facebook', $company->facebook, ['class' => 'form-control']) }}
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
							<div class="form-group">
								<label class="col-sm-5">{{ Form::label('', 'Phone number:', ['class' => 'margin-top-xs']) }}</label>
								<div class="col-sm-7">
									{{ Form::text('phone', $company->phone, ['class' => 'form-control']) }}
								</div>
							</div>
						</div>        				
					</div>
					<div class="col-sm-5 padding-left-normal">
						<div class="row margin-top-sm">
							<div class="form-group">
								<label class="col-sm-6">{{ Form::label('', 'Linkedin:', ['class' => 'margin-top-xs']) }}</label>
								<div class="col-sm-6">
									{{ Form::text('linkedin', $company->linkedin, ['class' => 'form-control']) }}
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
							<div class="form-group">
								<label class="col-sm-5">{{ Form::label('', 'Website:', ['class' => 'margin-top-xs']) }}</label>
								<div class="col-sm-7">
									{{ Form::text('website', $company->website, ['class' => 'form-control']) }}
								</div>
							</div>
						</div>        				
					</div>
					<div class="col-sm-5 padding-left-normal">
						<div class="row margin-top-sm">
							<div class="form-group">
								<label class="col-sm-6">{{ Form::label('', 'Twitter:', ['class' => 'margin-top-xs']) }}</label>
								<div class="col-sm-6">
									{{ Form::text('twitter', $company->twitter, ['class' => 'form-control']) }}
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
				                    {{ Form::checkbox('is_published', $company->is_published, null, ['class' => 'checkbox-normal', 'id' => 'is_published']) }}
				                    <label class="control-checkbox">Publish my email address</label>
								</div>
							</div>
						</div>        				
					</div>
					<div class="col-sm-5 padding-left-normal">
						<div class="row margin-top-sm">
							<div class="form-group">
								<label class="col-sm-6">{{ Form::label('', 'Google+:', ['class' => 'margin-top-xs']) }}</label>
								<div class="col-sm-6">
									{{ Form::text('google', $company->google, ['class' => 'form-control']) }}
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
								{{ Form::text('latlng', $company->lat.', '.$company->long, ['class' => 'form-control', 'readonly', 'id' => 'latlng']) }}
							</div>
						</div>
					</div>
				</div>
			</div>
			
	        <input type="hidden" name="lat" value="{{ $company->lat }}" id="lat">
	        <input type="hidden" name="lng" value="{{ $company->long }}" id="lng">
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
	                <button class="btn btn-lg btn-primary text-uppercase btn-block">Save <span class="glyphicon glyphicon-ok-circle"></span></button>
	            </div>
	        </div>
	    </form>    
    </div>
           
</main>

<!-- Model Div for Service -->
<div id="clone_div_service" class="hidden"> 
	<input type="hidden" name="service_id[]" value="" id="service_id">
	<div class="form-group" style="margin-bottom: 0px;">	
		<div class="row">
			<div class="col-sm-6 col-sm-offset-1">
				<div class="row margin-top-sm">
					<div class="form-group">
						<label class="col-sm-4 control-label margin-top-xs">Sevice Name:</label>	
						<div class="col-sm-8">
							<input class="form-control" type="text" name="service_name[]" id="service_name">
						</div>				
					</div>
				</div>
			</div>
			
			<div class="col-sm-4 padding-left-normal">
				<div class="row margin-top-sm">
					<div class="form-group">
						<label class="col-sm-5 margin-top-xs"> Icon code:</label>
						<div class="col-sm-7">
							<input class="form-control" type="text" name="icon_code[]" readonly id="icon_code">
						</div>
					</div>
				</div>
			</div>
		</div>				                   
	</div>
	
	<div class="form-group" style="margin-bottom: 0px;">
		<div class="row">
			<div class="col-sm-2 col-sm-offset-1">
				<div class="row margin-top-sm" style="padding-left: 15px;">
					<div class="form-group">
						{{ Form::label('', 'Service Description:', ['class' => 'margin-top-xs']) }}
					</div>
				</div>
			</div>
			<div class="col-sm-8">
				<div class="row margin-top-sm" style="padding: 0 15px 0 15px;">
					<div class="form-group">
						<textarea class="form-control" name="service_description[]" id="service_description" placeholder="Brief Description..." style="height: 100px;"></textarea>
					</div>
				</div>
			</div>
			<div class="col-sm-2 col-sm-offset-1">
			</div>
		</div>
	</div> 
	
	<div class="form-group">	
		<div class="row">
			<div class="col-sm-6 col-sm-offset-1">
				<div class="row">
					<div class="form-group">	
						<div class="col-sm-8 col-sm-offset-4">
							<a style="color: #2980b9; cursor: pointer;" onclick="onAddService('', '', '', '');"><i class="fa fa-plus-circle"></i> Add New Service</a>
						</div>				
					</div>
				</div>
			</div>
			
			<div class="col-sm-4 padding-left-normal">
				<div class="row">
					<div class="form-group">
						<div class="col-sm-7 col-sm-offset-5">
							<a style="color: #e74c3c; cursor: pointer;" onclick="onDeleteService(this);"><i class="fa fa-trash"></i> Delete Service</a>
						</div>
					</div>
				</div>
			</div>
		</div>				                   
	</div>
	<div class="form-group">
		<div class="col-sm-10 col-sm-offset-2">
			<hr/>
		</div>
	</div>	
</div>
<!--  -->

@stop

@stop

@section('custom-scripts')
    @include('js.company.dashboard.profile')
@stop