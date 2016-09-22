@extends('customer.layout')
@section('custom-styles')
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	{{ HTML::style('/assets/css/demo.css') }}
	{{ HTML::style('/assets/css/home.css') }}
@stop
@section('body')
<div>
    <div class="container">
		<div class = "row">
	    	<div class="col-sm-12 text-center margin-top-normal">
				<table class="table table-striped table-bordered table-hover dataTable no-footer">
					<thead>
					    <tr>
						<th>#</th>
						<th>Item Name</th>
						<th>Image</th>
						<th>UPC</th>
						<th>Brand</th>
						<th>Size</th>
						<th>Retail</th>
						<th style="width: 80px;"></th>
					    </tr>
					</thead>
					<tbody>
					    @foreach ($products as $key => $value)
						<tr>
						    <td>{{ $key + 1 }}</td>
						    <td>{{ $value->itemName }}</td>
						    <td>{{ $value->productImg }}</td>
						    <td>{{ $value->upcCode }}</td>
						    <td>{{ $value->brand }}</td>
						    <td>{{ $value->size }}</td>
						    <td>{{ $value->retail }}</td>
						    <td>
							<a class="btn btn-sm btn-info" onclick="addToList({{ $value->id }})">
							    <span class="glyphicon glyphicon-plus"></span> Add to List
							</a>
						    </td>
						</tr>
					    @endforeach
					</tbody>
				</table>
			</div>
			<div class="pull-right margin-top-sm margin-bottom-normal">{{ $products->links() }}</div>
		</div>
    </div>
</div>
<<script type="text/javascript">
function addToList(product_id) {
	$.ajax({
		type: 'POST',
		url: '<?php echo URL::route('customer.addItem'); ?>',
		data: {
			'productId': product_id
		},
		dataType: 'json',
		success: function(data) {
		},
		error: function(error) {
		}
	});
}
</script>
@stop
