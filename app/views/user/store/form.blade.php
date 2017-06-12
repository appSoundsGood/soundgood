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
								'route' => 'user.store.save', 
								$model->id,
								'files' => false,
								'id' => 'submit_form', 
								'class'=>'form-horizontal'
							]) }} 
				{{ Form::hidden('id') }}
              <div class="form-group">
                  <label class="col-sm-2 control-label" style = "color:#ffffff;">Name</label>
                  <div class="col-sm-6">
                      <?= Form::text('name', null, ['class' => 'form-control', 'required']) ?>
                  </div>
              </div>
              	<div class="form-group">
              		<?= Form::label('address', 'Address', ['class'=>'col-sm-2 control-label']) ?>
                  	<div class="col-sm-6">
                    	<?= Form::text('address', null, ['class' => 'form-control']) ?>
                  	</div>
              	</div>
              	<div class="form-group">
              		<?= Form::label('phone', 'Phone', ['class'=>'col-sm-2 control-label']) ?>
                  	<div class="col-sm-6">
                    	<?= Form::text('phone', null, ['class' => 'form-control']) ?>
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
            {{ Form::close() }}

        </div> 
    </div>
</main>
@stop

@section('custom-scripts')
@stop