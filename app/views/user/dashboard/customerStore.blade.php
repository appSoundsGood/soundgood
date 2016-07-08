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
                    <span class="glyphicon glyphicon-plus"></span>&nbsp;Create
                </a>                                    
            </div>
            <table class="table table-store-list">
                <thead style="background-color: #F7F7F7">
                    <tr>
                        <th>#</th>
                        <th class="text-center">Store Name</th>
                        <th>Created At</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value->store->name}}</td>
                        <td>{{ $value->created_at }}</td>
                        <td>
                            <a href="{{ URL::route('admin.apply.edit', $value->id)  }}" class="btn btn-sm btn-info">
                                <span class="glyphicon glyphicon-edit"></span> Edit
                            </a>
                        </td>
                        <td>
                            <a href="{{ URL::route('admin.apply.delete', $value->id)  }}" class="btn btn-sm btn-danger" id="js-a-delete">
                                <span class="glyphicon glyphicon-trash"></span> Delete
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div> 
        <div class="pull-right margin-top-sm margin-bottom-normal">{{ $user->links() }}</div>
    </div>
</main>
@stop

@section('custom-scripts')
@stop