@extends('customer.layout')

@section('body')
<main class="auth">
    <div class="container">
	    <div class="row">
		    <div class="col-sm-4 col-sm-offset-4 margin-top-lg">
		        @if ($errors->has())
		        <div class="alert alert-danger alert-dismissibl fade in">
		            <button type="button" class="close" data-dismiss="alert">
		                <span aria-hidden="true">&times;</span>
		                <span class="sr-only"></span>
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
		                <span class="sr-only"></span>
		            </button>
		            <p>
		                <?php echo $alert['msg'];?>
		            </p>
		        </div>
		        <?php } ?>
		    </div>    
	    </div> 
	    <form method="POST" action="{{ URL::route('user.dashboard.saveProfile') }}" role="form" class="form-login margin-top-normal" id="js_user_profile_form" enctype="multipart/form-data">
	    
	    	<input type="hidden" name="user_id" value="<?php echo $user->id?>">
	    	<input type="hidden" name="preview" value="0" id="js_user_preview">
			
			<div class="text-center">
	    		<h2 class="signup-sub-title"><i class="fa fa-file-text-o"></i> Edit Profile</h2>
	    		<p class="signup-sub-description"></p>
	    	</div>

            <div class="form-group">
	    	    <div class="col-sm-12 margin-top-lg">
                    <ul class="nav nav-tabs custom-nav-tabs text-center">
                        <li class="active"><a href="#tab-general" data-toggle="tab"><i class="fa fa-file-text-o"></i>Profile </a></li>
                        <li class=""><a href="#tab-skills" data-toggle="tab"><i class="fa fa-bar-chart-o"></i>Data </a></li>
                        <li class=""><a href="#tab-analytics" data-toggle="tab"><i class="fa fa-bar-chart-o"></i>View Analytics </a></li>
                    </ul>

                    <div class="tab-content" id="custom-tab-content">
                        <div class="tab-pane row fade active in" id="tab-general">
                            <div class="form-group" id="div_general">
                                <div class="col-sm-6">
                                        <div class="row margin-top-sm">
                                            <div class="form-group">
                                                <label class="col-sm-5"><label for="name" class="margin-top-xs">Full Name:</label></label>
                                                <div class="col-sm-7">
                                                  <input class="form-control" name="name" type="text" value="<?php echo $user->name;?>" id="name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row margin-top-sm">
                                            <div class="form-group">
                                                <label class="col-sm-5"><label for="email" class="margin-top-xs">Email:</label></label>
                                                <div class="col-sm-7">
                                                	<input class="form-control" readonly="readonly" name="email" type="text" value="<?php echo $user->email;?>" id="email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row margin-top-sm">
                                            <div class="form-group">
                                                <label class="col-sm-5"><label for="password" class="margin-top-xs">Password:</label></label>
                                                <div class="col-sm-7">
                                                    <input class="form-control" name="password" type="password" value="<?php echo $user->password;?>" id="password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row margin-top-sm">
                                            <div class="form-group">
                                                <label class="col-sm-5"><label for="password_confirmation" class="margin-top-xs">Confirm Password:</label></label>
                                                <div class="col-sm-7">
                                                    <input class="form-control" name="password_confirmation" type="password" value="" id="password_confirmation">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row margin-top-sm">
                                            <div class="form-group">
                                                <label class="col-sm-5"><label for="company_name" class="margin-top-xs">Company Name:</label></label>
                                                <div class="col-sm-7">
                                                    <input class="form-control" name="company_name"  value="<?php echo $user->companyName;?>" id="company_name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row margin-top-sm">
                                            <div class="form-group">
                                                <label class="col-sm-5"><label for="address" class="margin-top-xs">Address:</label></label>
                                                <div class="col-sm-7">
                                                    <input class="form-control" name="address" value="<?php echo $user->address;?>" id="address">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row margin-top-sm">
                                            <div class="form-group">
                                                <label class="col-sm-5"><label for="state" class="margin-top-xs">State:</label></label>
                                                <div class="col-sm-7">
                                                    <input class="form-control" name="state" value="<?php echo $user->state;?>" id="state">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row margin-top-sm">
                                            <div class="form-group">
                                                <label class="col-sm-5"><label for="city" class="margin-top-xs">City:</label></label>
                                                <div class="col-sm-7">
                                                    <input class="form-control" name="city" value="<?php echo $user->city;?>" id="city">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row margin-top-sm">
                                            <div class="form-group">
                                                <label class="col-sm-5"><label for="zip_code" class="margin-top-xs">Zip Code:</label></label>
                                                <div class="col-sm-7">
                                                    <input class="form-control" name="zip_code" value="<?php echo $user->zipCode;?>" id="zip_code">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row margin-top-sm">
                                            <div class="form-group">
                                                <label class="col-sm-5"><label for="phone_number" class="margin-top-xs">Phone Number:</label></label>
                                                <div class="col-sm-7">
                                                    <input class="form-control" name="phone_number" value="<?php echo $user->phoneNumber;?>" id="phone_number">
                                                </div>
                                            </div>
                                        </div>
                                        
                                </div>
                                <div class="col-sm-6 padding-left-normal">
                                    <div class="row margin-top-sm">
                                        <div id="div-cover-image">
                                            <img src="" id="img-cover" width="100%" height="200px" style="display: none;">
                                        </div>
                                        <div id="div-profile-image">
                                            <img style="width:100px; height:100px; border: 2px solid #FFF;"
											<?php if($user->profile_image != ""){?>src="<?php echo HTTP_PHOTO_PATH.$user->profile_image;?>" <?php }else{?>src="/assets/photos/default.png"<?php }?> id="img-profile" class="img-circle">
                                        </div>
                                    </div>
                                    <div class="row margin-top-sm">
                                        <div class="form-group">
                                            <div>
                                                <div class="col-sm-4">
                                                    <label><label for="about">About me:</label></label>
                                                </div>
                                                <div class="col-sm-4" style="padding: 0px;">
                                                    <div class="fileUpload">
                                                        <span><i class="fa fa-camera"></i> Profile Picture</span>
                                                        <input type="file" class="upload" name="profile_image" onchange="reloadProfileImage(this)">
                                                    </div>
                                                </div>
											</div>
                                            <div>
                                                <textarea class="form-control user-auth-about" name="about" cols="50" rows="10" id="about"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane row fade" id="tab-skills">
                            <div class="form-group" id="div_general">
                                <div class="col-sm-6 padding-left-normal">
                                    <div class="row margin-top-sm">
                                        <div class="form-group">
                                            <label class="col-sm-5"><label for="name" class="margin-top-xs">Stock:</label></label>
                                            <div class="col-sm-7">
                                              <input class="form-control" name="stock" type="text" value="<?php echo $user->stock;?>" id="name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row margin-top-sm">
                                         <div class="form-group">
                                            <label class="col-sm-5"><label for="name" class="margin-top-xs">Coupon:</label></label>
                                            <div class="col-sm-7">
                                              <input class="form-control" name="coupon" type="text" value="<?php echo $user->coupon;?>" id="name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row margin-top-sm">
                                         <div class="form-group">
                                            <label class="col-sm-5"><label for="name" class="margin-top-xs">Price:</label></label>
                                            <div class="col-sm-7">
                                              <input class="form-control" name="price" type="text" value="<?php echo $user->price;?>" id="name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row margin-top-sm">
                                    
                                         <div class="form-group">
                                            <label class="col-sm-5"><label for="name" class="margin-top-xs">Push Notification:</label></label>
                                            <div class="col-sm-7">
                                              <div class="form-group">
                                                  <select class="form-control" id="sel1">
                                                    <option value = "1">Set</option>
                                                    <option value = "1">UnSet</option>
                                                  </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane row fade" id="tab-analytics">
                           
                        </div>
                        <div class="tab-pane row fade" id="tab-awards">
							
                            <div class="form-group">
                                <div class="col-sm-12 margin-top-sm">
                                    <hr/>
                                </div>
                            </div>

                            <div id="award_list"></div>
                        </div>
                        <div class="tab-pane row fade" id="tab-experience">
                            <div class="text-center col-sm-10 col-sm-offset-1 margin-top-lg" id="div_experience">
                                <h2 class="signup-sub-title"><i class="fa fa-building-oy77"></i> </h2>
                                <p class="signup-sub-description"></p>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12 margin-top-sm">
                                    <hr/>
                                </div>
                            </div>

                            <div id="work_list"></div>

                            <div id="worked_company_list">

                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-5 col-sm-offset-1">
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-sm-7 col-sm-offset-5">
                                                    <a style="color: #2980b9; cursor: pointer;" onclick="onAddWorkedCompany(0);"><i class="fa fa-plus-circle"></i> </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="text-center col-sm-10 col-sm-offset-1 margin-top-lg">
                                <h2 class="signup-sub-title"><i class="fa fa-comment"></i> </h2>
                                <p class="signup-sub-description"></p>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12 margin-top-sm">
                                    <hr/>
                                </div>
                            </div>

                            <div id="testimonial_list"></div>
                        </div>
                        <div class="tab-pane row fade" id="tab-salary">
                            <div class="text-center col-sm-10 col-sm-offset-1 margin-top-lg" id="div_salary">
                	    		<h2 class="signup-sub-title"><i class="fa fa-money"></i> </h2>
                	    		<p class="signup-sub-description"></p>
                	    	</div>

                			<div class="form-group">
                				<div class="col-sm-12 margin-top-sm">
                					<hr/>
                				</div>
                			</div>

                			<div class="form-group">
                				<div class="row">
                					<div class="col-sm-6">
                						<div class="row margin-top-sm">
                							<div class="form-group">
                								<label class="col-sm-5"></label>
                								<div class="col-sm-7">
                									
                								</div>
                							</div>
                						</div>
                					</div>
                					<div class="col-sm-6 padding-left-normal">
                						<div class="row margin-top-sm">
                							<div class="form-group">
                								<label class="col-sm-6"></label>
                								<div class="col-sm-6">
                									
                								</div>
                							</div>
                						</div>
                					</div>
                				</div>
                			</div>

                			<div class="form-group">
                				<div class="row">
                					<div class="col-sm-2 margin-top-sm">
                                        
                					</div>
                                    <div class="col-sm-2 margin-top-sm">
                                        <label class="control-checkbox"></label>
                                    </div>
                                    <div class="col-sm-2 margin-top-sm">
                                        <label class="control-checkbox"></label>
                                    </div>
                                    <div class="col-sm-2 margin-top-sm">
                                        <label class="control-checkbox"></label>
                                    </div>
                                    <div class="col-sm-2 margin-top-sm">
                                        <label class="control-checkbox"></label>
                                    </div>
                                    <div class="col-sm-2 margin-top-sm">
                                        <label class="control-checkbox"></label>
                                    </div>
                				</div>
                			</div>

                			<div class="form-group">
                				<div class="col-sm-12 margin-top-sm">
                					<hr/>
                				</div>
                			</div>
                        </div>
                        <div class="tab-pane row fade" id="tab-contact">
                            <div class="text-center col-sm-10 col-sm-offset-1 margin-top-lg" id="div_contact">
                	    		<h2 class="signup-sub-title"><i class="fa fa-bookmark"></i> </h2>
                	    		<p class="signup-sub-description"></p>
                	    	</div>

                			<div class="form-group">
                				<div class="col-sm-12 margin-top-sm">
                					<hr/>
                				</div>
                			</div>

                			<div class="form-group">
                				<div class="row">
                					<div class="col-sm-6">
                						<div class="row margin-top-sm">
                							<div class="form-group">
                								<label class="col-sm-4"></label>
                								<div class="col-sm-8">
                								</div>
                							</div>
                						</div>
                					</div>
                					<div class="col-sm-6 padding-left-normal">
                						<div class="row margin-top-sm">
                							<div class="form-group">
                								<label class="col-sm-4"></label>
                								<div class="col-sm-8">
                								</div>
                							</div>
                						</div>
                					</div>
                				</div>
                			</div>

                			<div class="form-group">
                				<div class="row">
                					<div class="col-sm-6">
                						<div class="row margin-top-sm">
                							<div class="form-group">
                								<label class="col-sm-4"></label>
                								<div class="col-sm-8">
                									
                								</div>
                							</div>
                						</div>
                					</div>
                					<div class="col-sm-6 padding-left-normal">
                						<div class="row margin-top-sm">
                							<div class="form-group">
                								<label class="col-sm-4"></label>
                								<div class="col-sm-8">
                									
                								</div>
                							</div>
                						</div>
                					</div>
                				</div>
                			</div>

                			<div class="form-group">
                				<div class="row">
                					<div class="col-sm-6">
                						<div class="row margin-top-sm">
                							<div class="form-group">
                								<label class="col-sm-4"></label>
                								<div class="col-sm-8">
                									
                								</div>
                							</div>
                						</div>
                					</div>
                					<div class="col-sm-6 padding-left-normal">
                						<div class="row margin-top-sm">
                							<div class="form-group">
                								<label class="col-sm-4"></label>
                								<div class="col-sm-8">
                									
                								</div>
                							</div>
                						</div>
                					</div>
                				</div>
                			</div>



                	        <input type="hidden" name="lat" value id="lat">
                	        <input type="hidden" name="lng" value="" id="lng">
                	        <input type="hidden" name="is_finished" value="1" id="is_finished">

                			<div class="form-group">
                				<div class="row">
                					<div class="col-sm-12">
                						<div class="row signup-long-input">
                							<div id="mapdiv" style="height:200px;"></div>
                						</div>
                					</div>
                				</div>
                			</div>
                        </div>
                    </div>
                </div>
            </div>
	    	
	        <div class="row padding-bottom-xl">
	            <div class="col-sm-4 col-sm-offset-4 margin-top-normal">
	                <div class="col-sm-6">
	            		<button class="btn btn-lg btn-primary text-uppercase btn-block"><span class="glyphicon glyphicon-ok-circle">Save</span></button>
	            	</div>
	            </div>
	        </div>
	    </form>    
    </div>
</main>
<!-- Model Div for Skill -->
<div id="clone_div_skill" class="hidden row">

	<input type="hidden" name="skill_id[]" value="" id="skill_id">
	
	<div class="form-group">
		<div class="col-sm-6">
			<div class="row margin-top-sm">
				<div class="form-group">
					<label class="col-sm-5"></label>
					<div class="col-sm-7">
						<input class="form-control typeahead tt-query" id="skill_name" name="skill_name[]" type="text" autocomplete="off" spellcheck="false">
					</div>
				</div>
			</div>        				
		</div>
		<div class="col-sm-6">
			<div class="row margin-top-sm">
				<div class="form-group">
					<div class="col-sm-3">
						<input class="form-control" id="skill_value" name="skill_value[]" type="text">
					</div>							
					<label class="col-sm-4"></label>
					<div class="col-sm-5 margin-top-xs">
						<a style="color: #e74c3c; cursor: pointer;" onclick="onDeleteSkill(this);"><i class="fa fa-trash"></i> </a>
					</div>
				</div>
			</div> 				
		</div>
		<div class="col-sm-6">
			<div class="row margin-top-sm">
				<div class="form-group">
					<label class="col-sm-5"></label>
					<div class="col-sm-7">
						<a style="color: #2980b9; cursor: pointer;" onclick="onAddSkill('', '', '');"><i class="fa fa-plus-circle"></i> </a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12 margin-top-sm">
			<hr/>
		</div>
	</div>
</div>
<!--  -->

<!-- Model Div for Language -->
<div id="clone_div_language" class="hidden">
	<div class="form-group">
		<div class="row">
			<div class="col-sm-6">
	            <div class="row margin-top-sm">
                    <div class="form-group">
                        <label class="col-sm-5" style="color:#34495e;"></label>
                        <div class="col-sm-7">
                            
                        </div>
                        <div class="col-sm-5"></div>
                        <div class="col-sm-7 margin-top-xs">
                        	<a style="color: #e74c3c; cursor: pointer;" onclick="onDeleteForeignLanguage(this);"><i class="fa fa-trash"></i></a>
                        </div>		           
                    </div>
	            </div>        				
			</div>
			<div class="col-sm-6 padding-left-normal">
	            <div class="row margin-top-sm">
                    <div class="form-group">
                        <label class="col-sm-5" style="color:#34495e;"></label>
                        <div class="col-sm-7">
							<select class="form-control" id="understanding" name="understanding[]">
								<option value="1"></option>
								<option value="2"></option>
								<option value="3"></option>
								<option value="4"></option>
								<option value="5"></option>
							</select>
                        </div>
                        <label class="col-sm-5 margin-top-sm" style="color:#34495e;"></label>
                        <div class="col-sm-7 margin-top-sm">
							<select class="form-control" id="speaking" name="speaking[]">
								<option value="1"></option>
								<option value="2"></option>
								<option value="3"></option>
								<option value="4"></option>
								<option value="5"></option>
							</select>
                        </div>
                        <label class="col-sm-5 margin-top-sm" style="color:#34495e;"></label>
                        <div class="col-sm-7 margin-top-sm">
							<select class="form-control" id="writing" name="writing[]">
								<option value="1"></option>
								<option value="2"></option>
								<option value="3"></option>
								<option value="4"></option>
								<option value="5"></option>
							</select>
                        </div>
                    </div>
	            </div> 				
			</div>
		</div>
	</div>
</div>
<!--  -->

<!-- Model Div for Institution -->
<div id="clone_div_institution" class="hidden">
	<div class="form-group">
		<div class="col-sm-6">
			<div class="row margin-top-sm">
				<div class="form-group">
					<label class="col-sm-5"></label>
					<div class="col-sm-7">
						<input class="form-control" id="institution_name" name="institution_name[]" type="text">
					</div>
				</div>
			</div>        				
		</div>
		<div class="col-sm-6 padding-left-normal">
			<div class="row margin-top-sm">
				<div class="form-group">
					<label class="col-sm-6"></label>
					<div class="col-sm-6">
						<input class="form-control" id="qualification" name="qualification[]" type="text">
					</div>
				</div>
			</div> 				
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-6">
			<div class="row margin-top-sm">
				<div class="form-group">
					<label class="col-sm-5"></label>
					<div class="col-sm-3">
						<input class="form-control" id="period_start" name="period_start[]" type="text">
					</div>
					<div class="col-sm-1"></div>
					<div class="col-sm-3">
						<input class="form-control" id="period_end" name="period_end[]" type="text">
					</div>
					
					<label class="col-sm-5 margin-top-sm"></label>
					<div class="col-sm-7 margin-top-sm">
						<input class="form-control" id="location" name="location[]" type="text">
					</div>
					<div class="col-sm-7 col-sm-offset-5 margin-top-sm">
						<a style="color: #2980b9; cursor: pointer;" onclick="onAddInstitution();"><i class="fa fa-plus-circle"></i> </a>
					</div>
				</div>
			</div>        				
		</div>
		<div class="col-sm-6 padding-left-normal">
			<div class="row margin-top-sm">
				<div class="form-group">
					<div class="col-sm-12">
						<textarea class="form-control" placeholder="Notes..." style="height: 104px;" id="institution_note" name="institution_note[]" cols="50" rows="10"></textarea>
					</div>
					<div class="col-sm-12 margin-top-sm text-right">
						<a style="color: #e74c3c; cursor: pointer;" onclick="onDeleteInstitution(this);"><i class="fa fa-trash"></i> </a>
					</div>
				</div>
			</div> 				
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-12 margin-top-sm">
			<hr/>
		</div>
	</div>
</div>
<!--  -->


<!-- Model Div for Award -->
<div id="clone_div_award" class="hidden">
	<div class="form-group">
		<div class="col-sm-6">
			<div class="row margin-top-sm">
				<div class="form-group">
					<label class="col-sm-5"></label>
					<div class="col-sm-7">
						<input class="form-control" id="competition_name" name="competition_name[]" type="text">
					</div>
				</div>
			</div>        				
		</div>
		<div class="col-sm-6 padding-left-normal">
			<div class="row margin-top-sm">
				<div class="form-group">
					<label class="col-sm-6"></label>
					<div class="col-sm-6">
						<input class="form-control" id="prize" name="prize[]" type="text">
					</div>
				</div>
			</div> 				
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-6">
			<div class="row margin-top-sm">
				<div class="form-group">
					<label class="col-sm-5"></label>
					<div class="col-sm-7">
						<input class="form-control" id="competition_year" name="competition_year[]" type="text">
					</div>
				</div>
			</div>        				
		</div>
		<div class="col-sm-6 padding-left-normal">
			<div class="row margin-top-sm">
				<div class="form-group">
					<label class="col-sm-6"></label>
					<div class="col-sm-6">
						<input class="form-control" id="competition_location" name="competition_location[]" type="text">
					</div>
				</div>
			</div> 				
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-6">
			<div class="row margin-top-sm">
				<div class="form-group">
					<label class="col-sm-5"></label>
					<div class="col-sm-7">
						<a style="color: #2980b9; cursor: pointer;" onclick="onAddAward('', '', '', '');"><i class="fa fa-plus-circle"></i> </a>
					</div>
				</div>
			</div>        				
		</div>
		<div class="col-sm-6 padding-left-normal">
			<div class="row margin-top-sm">
				<div class="form-group">
					<label class="col-sm-6"></label>
					<div class="col-sm-6 text-right">
						<a style="color: #e74c3c; cursor: pointer;" onclick="onDeleteAward(this);"><i class="fa fa-trash"></i> </a>
					</div>
				</div>
			</div> 				
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-12 margin-top-sm">
			<hr/>
		</div>
	</div>
</div>
<!--  -->

<!-- Model Div for Work -->
<div id="clone_div_work" class="hidden">

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="col-sm-6">
                    <div class="row margin-top-sm">
                        <div class="form-group">
                            <label class="col-sm-5"></label>
                            <div class="col-sm-7">
                                <input class="form-control" id="name" name="organisation_name[]" type="text">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 padding-left-normal">
                    <div class="row margin-top-sm">
                        <div class="form-group">
                            <label class="col-sm-6"></label>
                            <div class="col-sm-6">
                                <input class="form-control" id="position" name="job_position[]" type="text">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<div class="form-group">
		<div class="col-sm-6">
			<div class="row margin-top-sm">
				<div class="form-group">
					<label class="col-sm-5"></label>
					<div class="col-sm-3">
						<input class="form-control" id="start" name="work_period_start[]" type="text">
					</div>
					<div class="col-sm-1"></div>
					<div class="col-sm-3">
						<input class="form-control" id="end" name="work_period_end[]" type="text">
					</div>
					
					<label class="col-sm-5 margin-top-sm"></label>
					<div class="col-sm-7 margin-top-sm">
						
					</div>
					<div class="col-sm-7 col-sm-offset-5 margin-top-sm">
						<a style="color: #2980b9; cursor: pointer;" onclick="onAddWork('', '', '', '', '', '');"><i class="fa fa-plus-circle"></i></a>
					</div>
				</div>
			</div>        				
		</div>
		<div class="col-sm-6 padding-left-normal">
			<div class="row margin-top-sm">
				<div class="form-group">
					<div class="col-sm-12">
						<textarea class="form-control" placeholder="Notes..." style="height: 104px;" id="notes" name="work_note[]" cols="50" rows="10"></textarea>
					</div>
					<div class="col-sm-12 margin-top-sm text-right">
						<a style="color: #e74c3c; cursor: pointer;" onclick="onDeleteWork(this);"><i class="fa fa-trash"></i> </a>
					</div>
				</div>
			</div> 				
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-12 margin-top-sm">
			<hr/>
		</div>
	</div>
</div>
<!--  -->

<!-- Model Div for Testimonial -->
<div id="clone_div_testimonial" class="hidden">
	<div class="form-group">
		<div class="col-sm-6">
			<div class="row margin-top-sm">
				<div class="form-group">
					<label class="col-sm-5"></label>
					<div class="col-sm-7">
						<input class="form-control" id="name" name="testimonial_name[]" type="text">
					</div>
					
					<label class="col-sm-5 margin-top-sm"></label>
					<div class="col-sm-7 margin-top-sm">
						<input class="form-control" id="organisation" name="testimonial_organisation[]" type="text">
					</div>
					<div class="col-sm-7 col-sm-offset-5 margin-top-sm">
						<a style="color: #2980b9; cursor: pointer;" onclick="onAddTestimonial();"><i class="fa fa-plus-circle"></i> </a>
					</div>
				</div>
			</div>        				
		</div>
		<div class="col-sm-6 padding-left-normal">
			<div class="row margin-top-sm">
				<div class="form-group">
					<div class="col-sm-12">
						<textarea class="form-control" placeholder="Testimonial..." style="height: 104px;" id="notes" name="testimonial_note[]" cols="50" rows="10"></textarea>
					</div>
					<div class="col-sm-12 margin-top-sm text-right">
						<a style="color: #e74c3c; cursor: pointer;" onclick="onDeleteTestimonial(this);"><i class="fa fa-trash"></i> </a>
					</div>
				</div>
			</div> 				
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-12 margin-top-sm">
			<hr/>
		</div>
	</div>
</div>
<!--  -->

<!-- Model Div for Worked Company -->
<div id="clone_div_workedCompany" class="hidden">
    <div class="row">
        <div class="col-sm-12">
            <div class="col-sm-3">
                <div class="row margin-top-sm padding-left-sm">
                    <div class="form-group">
                        <label for="" class="margin-top-xs">:</label>
                    </div>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="row margin-top-sm signup-long-input">
                    <div class="form-group">
                        <select class="form-control" name="worked_company_id[]" id="worked_company_id">
                            <option value="0"></option>
                            
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 text-right">
                <div class="row margin-top-sm signup-long-input">
                    <div class="form-group margin-top-xs">
                        <a style="color: #e74c3c; cursor: pointer;" onclick="onDeleteWorkedCompany(this);"><i class="fa fa-trash"></i> </a>
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
	{{ HTML::script('/assets/js/typeahead.min.js') }}
    @include('js.user.dashboard.profile')
@stop