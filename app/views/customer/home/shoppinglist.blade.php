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
                                        <th>Product Name</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th style="width: 80px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $value->product->itemName }}</td>
                                            <td>{{ $value->product->productImg }}</td>
                                            <td>{{ $value->product->retail }}</td>
                                            <td>{{ $value->product->size }}</td>
                                            <td style = "display:none;">
                                                <a href="{{ URL::route('customer.postApply', $value->id)  }}" class="btn btn-sm btn-info">
                                                    <span class="glyphicon glyphicon-edit"></span> Apply
                                                </a>
                                            </td>
                                            <td style = "">
                                                <button class="btn btn-sm btn-danger" id="js-a-delete" onclick="deleteItem({{$value->id}})">
                                                    <span class="glyphicon glyphicon-trash"></span> Remove
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

<script>
function deleteItem(cp_id) {
	if (!confirm("Are you sure you want to remove this item from Shopping list?"))
		return;

	$.ajax({
		type: 'POST',
		url: '<?php echo URL::route('customer.deleteApply'); ?>',
		data: {
			'id': cp_id
		},
		dataType: 'json',
		success: function(data) {			
			location.reload();
		},
		error: function(error) {
			alert("Failed to remove the item!");
			console.log(error);
		}
	});
}
</script>
@stop
