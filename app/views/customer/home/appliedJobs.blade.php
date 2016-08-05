@extends('customer.layout')

@section('custom-styles')
@stop

@section('body')
<main class="bs-docs-masthead" role="main">
	<div class="background-dashboard"></div>      
    <div class="container">
    	<div class="margin-top-lg"></div>
        <div class="row text-center margin-top-normal margin-bottom-normal">
            <h2 class="home color-white"> Applied Jobs</h2>
        </div>  
        <div class="row">
            <table class="table table-store-list">
                <thead style="background-color: #F7F7F7">
                    <tr>
                        <th>PROJECT TITLE</th>
                        <th class="text-center">BY</th>
                        <th class="text-center">APPLIES</th>
                        <th class="text-center">POSTED DATE</th>
                        <th class="text-center">BUDGET</th>
                        <th class="text-center">APPLIED DATE</th>
                        <th class="text-center">STATE</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->applies as $apply)
                    <tr>
                        <td><a href="{{ URL::route('user.dashboard.viewJob', $apply->job->id) }}">{{ $apply->job->name }}</a></td>
                        <td class="text-center"><a href="{{ URL::route('company.view', $apply->job->company->id) }}">{{ $apply->job->company->name }}</a></td>
                        <td class="text-center">{{ count($apply->job->applies) }}</td>
                        <td class="text-center">{{ $apply->job->created_at }}</td>
                        <td class="text-center">{{ '$'.$apply->job->salary }}</td>
                        <td class="text-center">{{ $apply->created_at }}</td>
                        <td class="text-center">
                        	@if ($apply->status == 1)
                        		{{ 'Read' }} 
                        	@endif
                        </td>
                        <td class="text-center">
                            <a href="{{ URL::route('user.dashboard.viewJob', $apply->job->id) }}" class="btn btn-success btn-sm btn-home">View</a>
                        </td>
                    </tr>
                    @endforeach
                    @if (count($user->applies) == 0)
                    <tr>
                        <td colspan="7" class="text-center">There is no jobs</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</main>
@stop

@section('custom-scripts')
@stop