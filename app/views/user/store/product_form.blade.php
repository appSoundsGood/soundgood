@extends('user.layout')

@section('custom-styles')
@stop

@section('body')
<main class="bs-docs-masthead" role="main">
	<div class="background-dashboard"></div>      
    <div class="container">
   		<div class="margin-top-lg"></div>
        <div class="row text-center margin-top-normal margin-bottom-normal">
            <h2 class="home color-white">Stores</h2>
        </div> 
        
        <div class="row">
        	{{ Form::model($model, [
								'route' => 'user.store.product.save', 
								$model->id,
								'files' => true,
								'class'=>'form-horizontal'
							]) }} 
				{{ Form::hidden('id') }}
              	
              	<div class="row">  
                	<div class="form-group">
                    	<label class="col-sm-2 control-label">UPC Code</label>
                    	<div class="col-sm-6">
                        	<?= Form::text('upcCode', null, ['class' => 'form-control', 'required']) ?>
                    	</div>
                  	</div>
              	</div>              
              	<div class = "row">  
                	<div class="form-group">
                    	<label class="col-sm-2 control-label">Brand</label>
                    	<div class="col-sm-6">
                        	<?= Form::text('brand', null, ['class' => 'form-control']) ?>
                      	</div>
                  	</div>
              	</div>              
              	<div class = "row">  
                	<div class="form-group">
                    	<label class="col-sm-2 control-label">Item Name</label>
                      	<div class="col-sm-6">
                      		<?= Form::text('itemName', null, ['class' => 'form-control', 'required']) ?>
                      	</div>
                  	</div>
              	</div>
              	<div class = "row">  
                	<div class="form-group">
                    	<label class="col-sm-2 control-label">Size</label>
                      	<div class="col-sm-6">
                        	<?= Form::text('size', null, ['class' => 'form-control']) ?>
                      	</div>
                  	</div>
              	</div>
     		</div>
            <div class = "row">
            	<div class="form-group">
                	<div class="col-sm-offset-2 col-sm-10 text-center">
                    	<button class="btn btn-success">
                        	<span class="glyphicon glyphicon-ok-circle"></span> Save
						</button>
                        <a href="{{ URL::route('user.store.product', $store_id) }}" class="btn btn-primary">
							<span class="glyphicon glyphicon-share-alt"></span> Back
						</a>
					</div>
				</div>
			</div>
		{{ Form::close() }}
	</div> 
</main>
@stop

@section('custom-scripts')
@stop