@extends('customer.layout')

@section('custom-styles')
@stop

@section('body')
<main class="bs-docs-masthead" role="main">
	<div class="background-dashboard"></div>      
    <div class="container">
    	<div class="margin-top-lg"></div>
        <div class="row text-center margin-top-normal margin-bottom-normal">
            <h2 class="home color-white"> Advertisements</h2>
        </div>  
        <div class="row">
            <table class="table table-store-list">
                <thead style="background-color: #F7F7F7">
                    <tr>
                        <th>Post TITLE</th>
                        <th class="text-center">APPLIED DATE</th>
                        <th class="text-center">STATE</th>
                        <th><a href="/newPost" class="btn btn-success btn-sm btn-home">Post Ad</a></th>
                    </tr>
                </thead>
                <tbody>
                	<?php foreach($posts as $post){?>
                    <tr>
                        <td><a href="" style = "cursor:pointer;text-decoration:none;"><?php echo $post->title;?></a></td>
                        <td class="text-center"><?php echo $post->created_at;?></td>
                        <td class="text-center"></td>
                        	
                        </td>
                        <td class="text-center">
                            <a href="<?php echo "/post/view/".$post->title;?>" class="btn btn-success btn-sm btn-home">View</a>
                        </td>
                    </tr>
                    <?php }?>
                    <?php if(count($posts) == 0){?>
                    <tr>
                        <td colspan="7" class="text-center">There is no jobs</td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        <div class="pull-right margin-top-sm margin-bottom-normal">{{ $posts->links() }}</div>
    </div>
</main>
@stop

@section('custom-scripts')
@stop