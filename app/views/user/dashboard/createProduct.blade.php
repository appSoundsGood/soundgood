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
            <form class="form-horizontal" role="form" method="post" action="{{ URL::route('user.product.save') }}" enctype="multipart/form-data">
              
              <div class = "row">
                  <div class="form-group">
                      
                      <label class="col-sm-2 control-label">Store list:</label>
                      <div class="col-sm-6"> 
                          <select class="form-control" id="" name = "storeId">
                            @foreach($stores as $value)
                            <option value = "{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                          </select>
                      </div>
                        
                  </div>
              </div>
              <div class = "row">
                  <div class="form-group">
                      
                      <label class="col-sm-2 control-label">Category list:</label>
                      <div class="col-sm-6"> 
                          <select class="form-control" id="" name = "categoryId">
                            @foreach($categorys as $value)
                            <option value = "{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                          </select>
                      </div>
                        
                  </div>
              </div>
              <div class = "row">  
                  <div class="form-group">
                      <label class="col-sm-2 control-label">UPC Code</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" name="upcCode">
                      </div>
                  </div>
              </div>              
              <div class = "row">  
                  <div class="form-group">
                      <label class="col-sm-2 control-label">Brand</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" name="brand">
                      </div>
                  </div>
              </div>              
              <div class = "row">  
                  <div class="form-group">
                      <label class="col-sm-2 control-label">Item Name</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" name="itemName">
                      </div>
                  </div>
              </div>
              <div class = "row">  
                  <div class="form-group">
                      <label class="col-sm-2 control-label">Size</label>
                      <div class="col-sm-6">
                          <input type="text" class="form-control" name="size">
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
                          <a href="{{ URL::route('admin.category') }}" class="btn btn-primary">
                              <span class="glyphicon glyphicon-share-alt"></span> Back
                          </a>
                      </div>
                  </div>
              </div>
            </form>

        </div> 
    </div>
</main>
@stop

@section('custom-scripts')
    @include('js.user.dashboard.profile') 
@stop