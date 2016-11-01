<?php
use Illuminate\Support\Facades\Form;
?>
@extends('user.layout')

@section('custom-styles')
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
	{{ HTML::style('/assets/css/components.css') }}
    {{ HTML::style('/assets/css/plugins.css') }}
    {{ HTML::style('/assets/css/summernote.css') }}
    {{ HTML::style('/assets/css/post.css') }}
@stop

@section('body')
<div class="bs-docs-masthead gray-container" role="main" id = "mainDiv">
	<div class="background-dashboard" style="z-index: 0;background:none;"></div>
    <div class="container">
		{{ Form::model($post, [
								'route' => 'user.post.save', 
								$post->id,
								'files' => true,
								'id' => 'submit_form', 
								'class'=>'form-horizontal'
							]) }} 
			<div class="form-wizard">
				<div class="form-body">
					<ul class="nav nav-pills nav-justified steps">
						<li id = "step1" class = "active">
							<a href="#tab1" data-toggle="tab" class="step">
								<span class="number">1 </span>
								<span class="desc"><i class="fa fa-check"></i> Create Advertisement</span>
							</a>
						</li>
						<li id = "step2">
							<a href="#tab2" data-toggle="tab" class="step">
								<span class="number">2 </span>
								<span class="desc"><i class="fa fa-check"></i> Preview Advertisement </span>
							</a>
						</li>
					</ul>
					<div id="bar" class="progress progress-striped" role="progressbar">
						<div class="progress-bar progress-bar-success">
						</div>
					</div>
					<div class="tab-content">
						<?php if (count($errors)): ?>
						<div class="col-md-8 col-md-offset-2">
							<div class="alert alert-danger">
								<button class="close" data-dismiss="alert"></button>
								{{ HTML::ul($errors->all()) }}
							</div>
						</div>
						<?php endif;?>
						<div class = "col-md-12"></div>
						<div class="tab-pane active" id="tab1">
							<h3 class="block">Post</h3>
							<?php echo Form::hidden('id') ?>
							<div class="form-group">
								<!-- <label class="control-label col-md-2">Title<span class="required">*</span></label> -->
								<?= Form::label('title', 'Product', ['class' => 'control-label col-md-2']) ?>
								<div class="col-md-8">
									<?= Form::text('title', null, ['class' => 'form-control', 'required']) ?>
								</div>
							</div>
							<div class="form-group">
								<?= Form::label('content', 'Description', ['class' => 'control-label col-md-2']) ?>
								<div class="col-md-8">
									<textarea name="content" id="summernote_1">
										<?php echo $post->content ?>
									</textarea>
								</div>
							</div>
							<div class="form-group" style="text-align: center">
								<?php echo Form::label('image', 'Image', ['class' => 'control-label col-md-2']) ?>
								<div class="col-md-8">
									<?php echo Form::file('image'); ?>
								</div>
							</div>
							<div class="form-group">
								<?= Form::label('price_original', 'Original Price', ['class' => 'control-label col-md-2']) ?>
								<div class="col-md-8">
									<?= Form::text('price_original', null, ['class' => 'form-control']) ?>
								</div>
							</div>
							<div class="form-group">
								<?= Form::label('price_sale', 'Sale Price', ['class' => 'control-label col-md-2']) ?>
								<div class="col-md-8">
									<?= Form::text('price_sale', null, ['class' => 'form-control']) ?>
								</div>
							</div>
							<div class="form-group">
								<?= Form::label('duration', 'Duration', ['class' => 'control-label col-md-2']) ?>
								<div class="col-md-8">
									<?= Form::number('duration', null, ['class' => 'form-control']) ?>
								</div>
							</div>
							<div class="form-group">
								<?= Form::label('vendor', 'Vendor', ['class' => 'control-label col-md-2']) ?>
								<div class="col-md-8">
									<?= Form::text('vendor', null, ['class' => 'form-control']) ?>
								</div>
							</div>
							<div class="form-group">
								<?= Form::label('tags', 'Tags', ['class' => 'control-label col-md-2']) ?>
								<div class="col-md-8">
									<?= Form::select('tags[]', [
											'Cuisine' => $cuisines,
											'Diet' => $diets,
											'Type' => $types,
										], explode(',', $post->tags),
										[
											'class' => 'form-control select2',
											'multiple' => 'multiple'
										]) ?>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab2">
							<div class="form-group">
								<div class="col-md-8">
									<h3 id = "titlePreview"></h3>
								</div>
							</div>
							<div class="form-group">
								<img id="preview-image" alt="No image" src="<?=$post->image ? asset('uploads/ads/'. $post->image) : '' ?>">
							</div>
							<div class="form-group">
								<div class="col-md-8">
									<div id="previewArticle">
									</div>
								</div>
							</div>
							<div class="form-group">
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions fluid">
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-offset-3 col-md-9" style = "margin-bottom:20px;">
								<a onclick="backform()" class="btn default button-previous"><i class="m-icon-swapleft"></i> Back </a>
								<a onclick="nextform()" class="btn blue button-next">Continue <i class="m-icon-swapright m-icon-white"></i></a>
								{{ Form::submit('Save', array('class'=>'btn green button-submit', 'style'=>'display:none')) }}
							</div>
						</div>
					</div>
				</div>
			</div>
		{{ Form::close() }}
		 
    </div> 
</div>


@stop

@section('custom-scripts')
 {{ HTML::script('/assets/js/jquery.slimscroll.js') }}
 {{ HTML::script('/assets/js/summernote.min.js') }}
 {{ HTML::script('/assets/js/components-editors.js') }}
 {{ HTML::script('/assets/js/jquery.form.js') }}
 {{ HTML::script('/assets/js/script/post.js') }}
  
 @include('js.post.postNew')
@stop