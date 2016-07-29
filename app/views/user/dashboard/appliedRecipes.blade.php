@extends('user.layout')

@section('custom-styles')
@stop

@section('body')
<main class="bs-docs-masthead" role="main">
	<div class="background-dashboard"></div>      
    <div class="container">
    	<div class="margin-top-lg"></div>
        <div class="row text-center margin-top-normal margin-bottom-normal">
            <h2 class="home color-white"> Recipes</h2>
        </div>  
        <div class="row">
            <table class="table table-store-list">
                <thead style="background-color: #F7F7F7">
                    <tr>
                        <th>Recipe Name</th>
                        <th class="text-center">APPLIED DATE</th>
                        <th class="text-center">STATE</th>
                        <th><a href="/newRecipe" class="btn btn-success btn-sm btn-home">Post Recipe</a></th>
                    </tr>
                </thead>
                <tbody>
                	@foreach ($recipes as $key => $value)
                    <tr>
                        <td><a href="" style = "cursor:pointer;text-decoration:none;">{{ $value->recipe->name}}</a></td>
                        <td class="text-center">{{ $value->created_at}}</td>
                        <td class="text-center"></td>
                        	
                        </td>
                        <td class="text-center">
                            <a href="/post/view/{{ $value->recipe->name}}" class="btn btn-success btn-sm btn-home">View</a>
                        </td>
                    </tr>
                    @endforeach
                    <?php if(count($recipes) == 0){?>
                    <tr>
                        <td colspan="7" class="text-center">There is no jobs</td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        <div class="pull-right margin-top-sm margin-bottom-normal">{{ $recipes->links() }}</div>
    </div>
</main>
@stop

@section('custom-scripts')
@stop