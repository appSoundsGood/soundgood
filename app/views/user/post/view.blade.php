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
    	<h1><?= $post->title ?></h1>
    	@if($post->image != '')
    	<img src="{{ asset('uploads/ads/'. $post->image) }}">
    	@endif
    	<dl>
    		<dt>Original Price</dt>
    		<dd>{{ $post->price_original }}</dd>
    		<dt>Sale Price</dt>
    		<dd>{{ $post->price_sale }}</dd>
    		
    		<dt>Vendor</dt>
    		<dd>{{ $post->vendor }}</dd>
    		<dt>Tags</dt>
    		<dd>
    		<?php
    			$tags = $post->getTags();
    			foreach ($tags as $t) {
    				echo '['. $t->name. '] ';
    			}
    		?>
    		</dd>
    	</dl>
    	<div class="adver-content">
    		<?php echo $post->content ?>
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