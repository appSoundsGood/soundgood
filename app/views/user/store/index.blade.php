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
            <div class="actions" style = "float:right;margin-bottom:10px;">
                <a href="{{ URL::route('user.store.create') }}" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-plus"></span> Request to Add Store
                </a>                                    
            </div>
            <table class="table table-store-list">
                <thead style="background-color: #F7F7F7">
                    <tr>
                        <th>#</th>
                        <th>Store Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ustores as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value->store->name}}</td>
                        <td>{{ $value->store->address }}</td>
                        <td>{{ $value->store->phone }}</td>
                        <td>{{ $value->created_at }}</td>
                        <td>
                        	<div class="btn-group">
							  	<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    	Settings <span class="caret"></span>
							  	</button>
							  	<ul class="dropdown-menu">
							    	<li><a href="{{ URL::route('user.store.edit', $value->store->id) }}">Edit</a></li>
							    	<li><a href="#">Delete</a></li>
							    	<li role="separator" class="divider"></li>
							    	<li><a href="{{ URL::route('user.store.product', $value->store->id) }}">Manage Products</a></li>
							  	</ul>
							</div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div> 
        <div class="pull-right margin-top-sm margin-bottom-normal">{{ $ustores->links() }}</div>
    </div>
</main>
@stop

@section('custom-scripts')
@stop