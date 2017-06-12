@extends('user.layout')

@section('custom-styles')
@stop

@section('body')
<main class="bs-docs-masthead" role="main">
	<div class="background-dashboard"></div>      
    <div class="container">
    	<div class="margin-top-lg"></div>
        <div class="row text-center margin-top-normal margin-bottom-normal">
            <h2 class="home color-white">Products</h2>
        </div> 
        
        <div class="row">
            <div class="actions" style = "float:right;margin-bottom:10px;">
                <a href="{{ URL::route('user.store.product.create', $store_id) }}" class="btn btn-default btn-sm">
                    <span class="glyphicon glyphicon-plus"></span>&nbsp;Create
                </a>                                    
            </div>
            <table class="table table-store-list">
                <thead style="background-color: #F7F7F7">
                    <tr>
                        <th>#</th>
                         
                        <th>UPC</th>   
                        <th>BRAND</th>   
                        <th>ITEM NAME</th>   
                        <th>SIZE</th>   
                        <th>NBD</th>  
                        <th>Created At</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value->upcCode }}</td>
                        <td>{{ $value->brand }}</td>
                        <td>{{ $value->itemName }}</td>
                        <td>{{ $value->size }}</td>
                        <td>{{ $value->nbd }}</td>
                        <td>{{ $value->created_at }}</td>
                        <td>                                                                                                              
                            <a href="{{ URL::route('user.store.product.edit', [$store_id, $value->id]) }}" class="btn btn-sm btn-info">
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
        <div class="pull-right margin-top-sm margin-bottom-normal">{{ $products->links() }}</div>
    </div>
</main>
@stop

@section('custom-scripts')
@stop