@extends('user.layout')

@section('custom-styles')
@stop

@section('body')
<main class="bs-docs-masthead" role="main">
	<div class="background-dashboard"></div>        
    <div class="container">
    	<div class="margin-top-lg"></div>
        <div class="row text-center margin-top-normal margin-bottom-normal">
            <h2 class="home color-white"> My Application Cart</h2>
        </div>  
        <div class="row">
            <table class="table table-store-list">
                <thead style="background-color: #F7F7F7">
                    <tr>
                    	<th></th>
                        <th>PROJECT TITLE</th>
                        <th class="text-center">BY</th>
                        <th class="text-center">APPLIES</th>
                        <th class="text-center">POSTED DATE</th>
                        <th class="text-center">BUDGET</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->carts as $cart)
                    <tr>
                    	<td>{{ Form::checkbox(null, 0, null, ['class' => 'checkbox-normal', 'id' => 'job_select_checkbox', 'data-id' => $cart->job->id]) }}</td>
                        <td><a href="{{ URL::route('user.dashboard.viewJob', $cart->job->id) }}">{{ $cart->job->name }}</a></td>
                        <td class="text-center"><a href="{{ URL::route('company.view', $cart->job->company->id) }}">{{ $cart->job->company->name }}</a></td>
                        <td class="text-center">{{ count($cart->job->applies) }}</td>
                        <td class="text-center">{{ $cart->job->created_at }}</td>
                        <td class="text-center">{{ '$'.$cart->job->salary }}</td>
                        <td class="text-center">
                            <a data-id="{{ $cart->id }}" onclick="removeThisJob(this);" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    @if (count($user->carts) == 0)
                    <tr>
                        <td colspan="7" class="text-center">There is no jobs</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <?php if (count($user->carts) != 0) {?>
            <div class="margin-top-xs" style="margin-left: 10px;">
            	<a style="cursor:pointer;" onclick="checkAll()">Select All</a>
            </div>
            <?php }?>
        </div>
        
        <?php if (count($user->carts) != 0) {?>
        <div class="row margin-bottom-normal">
        	<div class="col-sm-2 col-sm-offset-5">
        		<button class="btn btn-success btn-sm btn-job-apply" id="js-btn-apply">Apply</button>
        	</div>
        </div>
        <?php }?>
        
        <div id="apply-div" class="hidden">
	        <div class="row margin-bottom-normal">
	        	<div class="col-sm-10 col-sm-offset-1 jop-apply-div">
	        	
					<div class="row">
						<div class="col-sm-2 col-sm-offset-1">
							{{ Form::label('', 'Pattern', ['class' => 'margin-top-xs']) }}
						</div>
						<div class="col-sm-8">
							<select class="form-control" onchange="changePattern(this);">
								@foreach($patterns as $pattern)
								<option value="{{ $pattern->name }}" data-description="{{ $pattern->description }}">{{ $pattern->name }}</option>
								@endforeach
								<option value="" data-descripton="">Other</option>
							</select>
						</div>
					</div>
	        	
					<div class="row margin-top-xs">
						<div class="col-sm-2 col-sm-offset-1">
							{{ Form::label('', 'Title', ['class' => 'margin-top-xs']) }}
						</div>
						<div class="col-sm-8">
							{{ Form::text('title', $patterns[0]->name, ['class' => 'form-control', 'id' => 'title']) }}
						</div>
					</div>
					
					<div class="row margin-top-xs">
						<div class="col-sm-2 col-sm-offset-1">
							{{ Form::label('', 'Description', ['class' => 'margin-top-xs']) }}
						</div>
						<div class="col-sm-8">
							{{ Form::textarea('description', $patterns[0]->description, ['class' => 'form-control job-description', 'rows' => '5', 'id' => 'description']) }}
						</div>
					</div>
					
					<div class="row margin-top-sm">
						<div class="col-sm-8 col-sm-offset-3 text-right">
							<div class="col-sm-4 col-sm-offset-8 text-center">
								<button class="btn btn-sm btn-primary text-uppercase btn-block" id="js-btn-submit">SUBMIT</button>
							</div>
						</div>
					</div>
	        	</div>
	        </div>       
        </div>

    </div>
</main>
@stop

@section('custom-scripts')
	@include('js.user.dashboard.myApply')
@stop