<?php 
	
?>
@extends('customer.layout')
@section('custom-styles')
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	{{ HTML::style('/assets/css/demo.css') }}
	{{ HTML::style('/assets/css/home.css') }}
@stop
@section('body')
<main class="bs-docs-masthead" role="main" style="min-height: 0px;">
	<div class="col-sm-12" style="padding: 0px">
			
			<div class="container search-box margin-bottom-sm">
	        <div class="row">
	            <div class="col-sm-10 col-sm-offset-1 margin-top-xl padding-bottom-normal" style="background: rgba(0, 157, 255,0.65);">
	            	<div class="row">
	                    <div class="col-sm-12 text-center margin-top-normal">
	                          <table class="table table-striped table-bordered table-hover dataTable no-footer">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Recipe</th>
                                        <th>Created At</th>
                                        <th style="width: 80px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($likes as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $value->recipe->name }}</td>
                                            <td>{{ $value->created_at }}</td>                                            
                                            <td>
                                                <button onclick="unlikeRecipe({{ $value->id }})" class="btn btn-sm btn-danger" id="js-a-delete">
                                                    <span class="glyphicon glyphicon-trash"></span> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
	                    </div>
	                </div>
	            </div>
	        </div>
    </div>          	
		
	</div>
</main>
<script type="text/javascript">
function unlikeRecipe(like_id){
  $.ajax({
      url: "<?php echo URL::route('customer.deleteLike'); ?>",
      dataType : "json",
      type : "POST",
      data : { 
              like_id : like_id
          },
      success : function(data) {
          if (data.result == 'success')
    	  	location.reload();
          else {
        	alert("Failed to remove the item!");
      		console.log(data);
          }
      },
      error: function(error) {
    	alert("Failed to remove the item!");
		console.log(error);
      }
   });
}
</script>
@stop
