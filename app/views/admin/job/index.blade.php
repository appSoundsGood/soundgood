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

<div class="row">
	<div class="col-md-12">
		<h3 class="page-title">Job Management</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<span>Job</span>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<span>List</span>
			</li>
		</ul>
		
	</div>
</div>
                    
<div class="portlet box blue">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-navicon"></i> Job List
		</div>
		<div class="actions">
			<a href="{{ URL::route('admin.job.create') }}" class="btn btn-default btn-sm">
				<span class="glyphicon glyphicon-plus"></span>&nbsp;Create
			</a>								    
		</div>
	</div>
    <div class="portlet-body">
        <table class="table table-striped table-bordered table-hover dataTable no-footer">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Salary</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th style="width: 80px;">Edit</th>
                    <th style="width: 80px;">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobs as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->type->name }}</td>
                        <td>{{ $value->salary }}</td>
                        <td>{{ ($value->is_active == 0) ? 'Deactive':'Active' }}</td>
                        <td>{{ $value->created_at }}</td>
                        <td>
                            <a href="{{ URL::route('admin.job.edit', $value->id)  }}" class="btn btn-sm btn-info">
                                <span class="glyphicon glyphicon-edit"></span> Edit
                            </a>
                        </td>
                        <td>
                            <a href="{{ URL::route('admin.job.delete', $value->id)  }}" class="btn btn-sm btn-danger" id="js-a-delete">
                                <span class="glyphicon glyphicon-trash"></span> Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
        	<div class="col-sm-12">
        		<div class="pull-right">{{ $jobs->links() }}</div>
        	</div>
        </div>
    </div>
</div>    
@stop

@section('custom_scripts')
    {{ HTML::script('/assets/js/bootbox.js') }}
    @include('js.admin.job.index')
@stop

@stop
