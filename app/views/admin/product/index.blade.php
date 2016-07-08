@extends('admin.layout')

@section('content')
<?php if (isset($alert)) { ?>
<div class="alert alert-<?php echo $alert['type'];?> alert-dismissibl fade in">
    <button type="button" class="close" data-dismiss="alert">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
    <p>
        <?php echo $alert['msg'];?>
    </p>
</div>
<?php } ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Product List</h3>
    </div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" method="get" action="{{ URL::route('admin.product.search') }}">    
            <div class="col-md-9 text-right">
                <div id="sample_editable_1_filter" class="dataTables_filter">
                    <label>Search:
                        <input type="search" class="form-control input-small input-inline" aria-controls="sample_editable_1" name = "search">
                    </label>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <input type="submit" class="btn btn-u" id="submit" value="Submit" />
                </div>
            </div>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>UPC</th>
                    <th>BRAND</th>
                    <th>ITEM NAME</th>
                    <th>SIZE</th>   
                    <th>RETAIL</th>   
                    <th>NBD</th>  
                    <th>Created At</th>
                    <th style="width: 80px;">Edit</th>
                    <th style="width: 80px;">Delete</th>
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
                        <td>{{ $value->retail }}</td>
                        <td>{{ $value->nbd }}</td>
                        <td>{{ $value->created_at }}</td>
                        <td>
                            <a href="{{ URL::route('admin.product.edit', $value->id)  }}" class="btn btn-sm btn-info">
                                <span class="glyphicon glyphicon-edit"></span> Edit
                            </a>
                        </td>
                        <td>
                            <a href="{{ URL::route('admin.product.delete', $value->id)  }}" class="btn btn-sm btn-danger" id="js-a-delete">
                                <span class="glyphicon glyphicon-trash"></span> Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pull-right">{{ $products->appends(Input::except('page'))->links() }}</div>
    </div>
</div>    
@stop
@section('custom_scripts')
    {{ HTML::script('/assets/js/bootbox.js') }}
    @include('js.admin.user.index')
@stop

@stop
