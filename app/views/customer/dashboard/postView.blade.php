@extends('customer.layout')

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
											
										</ul>
										<div id="bar" class="progress progress-striped" role="progressbar">
											<div class="progress-bar progress-bar-success">
											</div>
										</div>
										<div class="tab-content">
											
											<div class = "col-md-12"></div>
												<?php foreach($posts as $post){?>	
												<div class="col-md-8">
													<label class="control-label col-md-2"><?php echo  $post->title;?></label>
												</div>
												<div class="col-md-8">
													<label class="control-label col-md-2"><?php echo  $post->content;?></label>
												</div>
												<?php }?>
												<?php foreach($postVideos as $postVideo){?>
													<img src = "<?php echo $postVideo->url;?>" />
												<?php }?>
												<?php foreach($postImages as $postImage){?>
													<img src = "<?php echo $postImage->url;?>" />
												<?php }?>
												
												
												
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