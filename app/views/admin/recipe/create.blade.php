@extends('admin.layout')

@section('content')

@if ($errors->has())
<div class="alert alert-danger alert-dismissibl fade in">
    <button type="button" class="close" data-dismiss="alert">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    @foreach ($errors->all() as $error)
		{{ $error }}		
	@endforeach
</div>
@endif

<div class="row">
	<div class="col-md-12">
		<h3 class="page-title">Recipe Management</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<span>Recipe</span>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<span>Add</span>
			</li>
		</ul>
	</div>
</div>

<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-pencil-square-o"></i> Create Recipe
		</div>
	</div>
    <div class="portlet-body">
        <form class="form-horizontal" role="form" method="post" action="{{ URL::route('admin.recipe.store') }}" enctype="multipart/form-data">
           
          <div class="form-group">
                <div class = "row">
                    <div class="col-sm-2 col-md-offset-2">
                        <div id="div-cover-image">
                            <img src="" id="img-cover" width="100%" height="200px" style="display: none;">
                        </div>
                        <div id="div-profile-image">
                            <img style="width:100px; height:100px; border: 2px solid #FFF;" id="img-profile" />
                        </div>
                    </div>
                    <div>
                        <div class="col-sm-7" style="padding: 0px;">
                            <div class="fileUpload">
                                <input type="file" class="upload" name="profile_image" onchange="reloadProfileImage(this)">
                            </div>
                        </div>
                    </div>
                </div>
               
          </div>
          <br/>
          <div class="form-group">
              <label class="col-sm-2 control-label">Name</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" name="name">
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">Prep Time</label>
              <div class="col-sm-4">
                   <select class="form-control" name = "prepTime">
                      <?php for($i= 1; $i < 200; $i++ ){?>    
                      <option value = "<?php echo $i;?>"><?php echo $i;?></option>
                      <?php } ?> 
                    </select>

              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">Nutritional Infomation</label>
              <div class="col-sm-10">
                   <textarea  class="form-control" name="nutriInfo"></textarea>    
              </div>
          </div> 
          <div class="form-group">
              <label class="col-sm-2 control-label">Servings</label>
              <div class="col-sm-4">
                   <select class="form-control" name = "servings">
                      <?php for($i= 1; $i < 40; $i++ ){?>  
                      <option value = "<?php echo $i;?>"><?php echo $i;?></option>
                      <?php } ?>
                    </select>

              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">Quick Bios</label>
              <div class="col-sm-10">
                  <textarea  class="form-control" name="quickBios"></textarea>
              </div>
          </div> 
         
          <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10 text-center">
                  <button class="btn btn-success">
                      <span class="glyphicon glyphicon-ok-circle"></span> Save
                  </button>
                  <a href="{{ URL::route('admin.category') }}" class="btn btn-primary">
                      <span class="glyphicon glyphicon-share-alt"></span> Back
                  </a>
              </div>
          </div>
        </form>
    </div>
</div>
@stop

@stop
@section('custom-scripts')   
    {{ HTML::script('/assets/js/typeahead.min.js') }}
    @include('js.user.dashboard.profile')
@stop
