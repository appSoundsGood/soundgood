@extends('user.layout')

@section('custom-styles')
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	{{ HTML::style('/assets/css/components.css') }}
    {{ HTML::style('/assets/css/plugins.css') }}
    {{ HTML::style('/assets/css/summernote.css') }}
    {{ HTML::style('/assets/css/post.css') }}
@stop

@section('body')
<main class="bs-docs-masthead gray-container" role="main" id = "mainDiv">
	<div class="background-dashboard" style="z-index: 0;background:none;"></div>
    <div class="container">
		<div class="form-horizontal" id="submit_form" method="POST">
								<div class="form-wizard">
									<div class="form-body">
										<ul class="nav nav-pills nav-justified steps">
											<li id = "step1" class = "active">
												<a href="#tab1" data-toggle="tab" class="step">
												<span class="number">
												1 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Create Advertisement </span>
												</a>
											</li>
											<li id = "step2">
												<a href="#tab2" data-toggle="tab" class="step">
												<span class="number">
												2 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Preview Advertisement </span>
												</a>
											</li>
											<li id = "step3">
												<a href="#tab3" data-toggle="tab" class="step active">
												<span class="number">
												3 </span>
												<span class="desc">
												<i class="fa fa-check"></i> Check Email for Link </span>
												</a>
											</li>
											<li id = "step4">
												<a href="#tab4" data-toggle="tab" class="step">
												<span class="number">
												4 </span>
												<span class="desc">
												<i class="fa fa-check"></i> All Done </span>
												</a>
											</li>
										</ul>
										<div id="bar" class="progress progress-striped" role="progressbar">
											<div class="progress-bar progress-bar-success">
											</div>
										</div>
										<div class="tab-content">
											<div class = "col-md-8 col-md-offset-2">
												<div class="alert alert-danger">
													<button class="close" data-dismiss="alert"></button>
													<p id = "errorNotice" style = ""></p>
												</div>
											</div> 
											<div class = "col-md-12"></div>
											<div class="tab-pane active" id="tab1">
												<h3 class="block"></h3>
												<div class="form-group">
													<label class="control-label col-md-2">Title<span class="required">
													* </span>
													</label>
													<div class="col-md-8">
														<input type="text" class="form-control" name="" id = "title"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-2">Description <span class="required">
													* </span>
													</label>
													<div class="col-md-8">
														<div name="summernote" id="summernote_1">
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-2">Location<span class="required">
													* </span>
													</label>
													<div class="col-md-8">
														<input type="text" class="form-control" name="" id = "location"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-2">Email<span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="" id = "email"/>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-2">Confirm Email<span class="required">
													* </span>
													</label>
													<div class="col-md-4">
														<input type="text" class="form-control" name="" id = "confirmMail">
													</div>
												</div>
												<form action = "<?php echo URL::route('user.post.postData'); ?>" method = "post" id = "imageForm">
													<div class="form-group">
														<label class="control-label col-md-2">Add Video<span class="required">
														* </span>
														</label>
														<div class="col-md-4">
															<input type = "hidden" name = "postId" value = "" id = "postId"/>
															<input type = "file" name = "postVideo" />
														</div>
													</div>
													<div class="form-group">
														<label class="control-label col-md-2">Add Images<span class="required">
														* </span>
														</label>
														<div class="col-md-4">
															<input type = "file" name = "postImage[]" />
															<br/>
															<input type = "file" name = "postImage[]" />
															<br/>
															<input type = "file" name = "postImage[]" />
															<br/>
															<input type = "file" name = "postImage[]" />
															<br/>
															<input type = "file" name = "postImage[]" />
															<br/>
															<input type = "file" name = "postImage[]" />
															<br/>
															<input type = "file" name = "postImage[]" />
															<br/>
															<input type = "file" name = "postImage[]" />
															<br/>
															<input type = "file" name = "postImage[]" />
															<br/>
															<input type = "file" name = "postImage[]" />
															<br/>
															<input type = "file" name = "postImage[]" />
															<br/>
															<input type = "file" name = "postImage[]" />
														</div>
													</div>
												</form>
												<div class="form-group">
													<label class="control-label col-md-2">Auto Repost Ad</label>
													<div class="col-md-4">
														<dl id="autoRepostAd" class="clearfix" style="position:relative;margin-bottom:1em;">
      														<dt style="float:left;"><input style="position: relative; top: -3px;" type="checkbox" name="autoRepostAd" value="Yes"></dt>
															      <dd style="line-height:1.5;margin-left:30px;">
															        <div class="editAdText" id="repostFreq">
															          Move your ad to the top of the listings every:
															     	  <select name="repostCycle" onchange="">
															              <option value="1" selected="">1 day</option>
															              <option value="2">2 days</option>
															              <option value="3">3 days</option>
															              <option value="4">4 days</option>
															              <option value="5">5 days</option>
															              <option value="6">6 days</option>
															              <option value="7">7 days</option>
															              <option value="8">8 days</option>
															              <option value="9">9 days</option>
															              <option value="10">10 days</option>
															              <option value="11">11 days</option>
																		  <option value="12">12 days</option>
																		  <option value="13">13 days</option>
																		  <option value="14">14 days</option>
																		  <option value="15">15 days</option>
																		  <option value="16">16 days</option>
															              <option value="17">17 days</option>
															              <option value="18">18 days</option>
															              <option value="19">19 days</option>
																		  <option value="20">20 days</option>
															              <option value="21">21 days</option>
															              <option value="22">22 days</option>
															              <option value="23">23 days</option>
															              <option value="24">24 days</option>
															              <option value="25">25 days</option>
															              <option value="26">26 days</option>
															              <option value="27">27 days</option>
															              <option value="28"> 28 days</option>
															              <option value="29">29 days</option>
															              <option value="30">30 days</option>
															          </select>     
															          &nbsp;after&nbsp;
																	  <select name="repostTime" onchange="document.f.autoRepostAd.checked=true;">
															              <option value="12:00 AM"> 12:00 AM</option>
															              <option value="01:00 AM">1:00 AM</option>
															              <option value="02:00 AM">2:00 AM</option>
																		  <option value="03:00 AM">3:00 AM</option>
															              <option value="04:00 AM">4:00 AM</option>
																		  <option value="05:00 AM">5:00 AM</option>
															              <option value="06:00 AM">6:00 AM</option>
															              <option value="07:00 AM">7:00 AM</option>
															              <option value="08:00 AM">8:00 AM</option>
															              <option value="09:00 AM">9:00 AM</option>
															              <option value="10:00 AM">10:00 AM</option>
															              <option value="11:00 AM">11:00 AM</option>
															              <option value="12:00 PM">12:00 PM</option>
															              <option value="01:00 PM">1:00 PM</option>
															              <option value="02:00 PM">2:00 PM</option>
															              <option value="03:00 PM">3:00 PM</option>
															              <option value="04:00 PM">4:00 PM</option>
															              <option value="05:00 PM">5:00 PM</option>
															              <option value="06:00 PM">6:00 PM</option>
															              <option value="07:00 PM">7:00 PM</option>
															              <option value="08:00 PM" selected="">8:00 PM</option>
															              <option value="09:00 PM">9:00 PM</option>
															              <option value="10:00 PM">10:00 PM</option>
															              <option value="11:00 PM">11:00 PM</option>
															          </select>
															        </div>
															        <div class="editAdText" id="repostNumber" style="margin-top:1em;">
															          Number of times:
															          <select name="autoRepost" onchange="document.f.autoRepostAd.checked=true;">
															               <option value="26" data-scale="6">26 times for $1.02
															               </option><option value="52" data-scale="12">52 times for $2.04
															               </option><option value="104" data-scale="24">104 times for $4.08
															         	   </option></select>
															        </div>
															      </dd>
													    </dl>
																										
													</div>
												</div>
											</div>
											<div class="tab-pane" id="tab2">
												
												<div class="form-group">
													<label class="control-label col-md-2"><span class="required">
													</span>
													</label>
													<div class="col-md-8">
														<p  id = "titlePreview"></p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-2"> <span class="required">
													</span>
													</label>
													<div class="col-md-8">
														<div name="summernote" id="previewArticle">
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-2"><span class="required">
													</span>
													</label>
													<div class="col-md-8">
														<p  id = "locationPreview"></p>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-2"><span class="required">
													</span>
													</label>
													<div class="col-md-8">
														<p  id = "emailPreview"></p>
													</div>
												</div>
											</div>
											<div class="tab-pane" id="tab3">
												<div class="form-group">
													<label class="control-label col-md-2"><span class="required">
													</span>
													</label>
													<div class="col-md-8">
														<p  id = "successEmail"></p>
													</div>
												</div>
												
											</div>
											<div class="tab-pane" id="tab4">
												<div class="form-group">
													<label class="control-label col-md-2"><span class="required">
													</span>
													</label>
													<div class="col-md-8">
														<a style = "cursor:pointer;list-style:none;"><p  id = "gotoPage"></p></a>
													</div>
												</div>
												
											</div>
										</div>
									</div>
									<div class="form-actions fluid">
										<div class="row">
											<div class="col-md-12">
												<div class="col-md-offset-3 col-md-9" style = "margin-bottom:20px;">
													<a onclick="backform()" class="btn default button-previous">
													<i class="m-icon-swapleft"></i> Back </a>
													<a onclick="nextform()" class="btn blue button-next">
													Continue <i class="m-icon-swapright m-icon-white"></i>
													</a>
													<a onclick="singUp();" class="btn green button-submit">
													Submit <i class="m-icon-swapright m-icon-white"></i>
													</a>
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
 {{ HTML::script('/assets/js/jquery.slimscroll.js') }}
 {{ HTML::script('/assets/js/summernote.min.js') }}
 {{ HTML::script('/assets/js/components-editors.js') }}
 {{ HTML::script('/assets/js/jquery.form.js') }}
 {{ HTML::script('/assets/js/script/post.js') }}
 
 @include('js.post.postNew')
 
@stop