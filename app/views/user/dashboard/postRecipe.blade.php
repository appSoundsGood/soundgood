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
												<i class="fa fa-check"></i> Create Recipe </span>
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
												<a href="#tab3" data-toggle="tab" class="step">
												<span class="number">
												3</span>
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