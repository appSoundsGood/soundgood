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
		<h3 class="page-title">Recipe Management</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<span>Recipe</span>
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
			<i class="fa fa-navicon"></i> Recipe List
		</div>
		<div class="actions">
			<a href="{{ URL::route('admin.recipe.create') }}" class="btn btn-default btn-sm">
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
                    <th>Image</th>
                    <th>Ingredients</th>
                    <th>Bio’s and Instructions</th>
                    <th style="width: 80px;">Edit</th>
                    <th style="width: 80px;">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recipes as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value->name }}</td>
                        <td>   <img style="width:100px; height:100px; border: 2px solid #FFF;"
                                <?php if($value->image != ""){?>src="<?php echo ABS_LOGO_PATH_REL.$value->image;?>" <?php }else{?>src="/assets/logos/default.png"<?php }?> id="img-profile" ></td>
                        <td>
                            <a href="{{ URL::route('admin.recipe.viewIngredient', $value->id)  }}" class="btn btn-sm btn-info">
                                <span class="glyphicon glyphicon-edit"></span> View
                            </a>
                        </td>
                        <td>
                            {{ $value->quickBios }}
                        </td>
                        <td>
                            <a href="{{ URL::route('admin.recipe.edit', $value->id)  }}" class="btn btn-sm btn-info">
                                <span class="glyphicon glyphicon-edit"></span> Edit
                            </a>
                        </td>
                        <td>
                            <a href="{{ URL::route('admin.recipe.delete', $value->id)  }}" class="btn btn-sm btn-danger" id="js-a-delete">
                                <span class="glyphicon glyphicon-trash"></span> Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
        	<div class="col-sm-12">
        		<div class="pull-right">{{ $recipes->links() }}</div>
        	</div>
        </div>
    </div>
</div>    
@stop
@section('custom_scripts')
    {{ HTML::script('/assets/js/bootbox.js') }}
    @include('js.admin.category.index')
@stop
@stop
