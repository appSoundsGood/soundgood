@extends('company.layout')

@section('custom-styles')
@stop

@section('body')
 
<main class="bs-docs-masthead" role="main">
	<div class="background-dashboard"></div>    
    <div class="container">
    	<div class="margin-top-50"></div>
        <div class="row text-center margin-top-normal margin-bottom-normal">
            <h2 class="home color-white">Job Management</h2>
        </div>
        
        <div class="row">
            <table class="table table-store-list" style="width: 100%;">
                <thead style="background-color: #F7F7F7">
                    <tr>
                        <th class="text-center">TITLE</th>
                        <th class="text-center">STATUS</th>
                        <th class="text-center">VIEWS</th>
                        <th class="text-center">BIDS</th>
                        <th class="text-center">BUDGET</th>
                        <th class="text-center">POSTED DATE</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jobs as $item)
                    <tr>
                        <td class="text-center"><a href="{{ URL::route('company.job.view', $item->id) }}">{{ $item->name }}</a></td>
                        <td class="text-center">
                        	<?php if ($item->status == 0) {?>
                        		<label class="job-open">OPEN</label>
                        	<?php }else {?>
                        		<label class="job-progress">PROGRESS</label>
                        	<?php }?>
                        </td>
                        <td class="text-center">{{ $item->views }}</td>
                        <td class="text-center">{{ count($item->applies) }}</td>
                        <td class="text-center">{{ '$'.$item->salary }}</td>
                        <td class="text-center">{{ $item->created_at }}</td>
                        <td class="text-center">
                            <a href="{{ URL::route('company.job.view', $item->id) }}" class="btn btn-success btn-sm btn-home">View</a>
                        </td>
                    </tr>
                    @endforeach
                    @if (count($jobs) == 0)
                    <tr>
                        <td colspan="7" class="text-center">There is no jobs</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div class="pull-right">{{ $jobs->links() }}</div>
        </div>   
    </div>  
</main>   

@stop

@section('custom-scripts')
@stop