
@extends('customer.layout')
@section('custom-styles')
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    {{ HTML::style('/assets/css/demo.css') }}
    {{ HTML::style('/assets/css/home.css') }}
@stop
@section('body')
<main class="bs-docs-masthead" role="main" style="min-height: 0px;">
    <div class="col-sm-12" style="padding: 0px" >
        <div class="container search-box margin-bottom-sm">
            <div class="row">
                 {{$html}}
            </div>
        </div>              
    </div>
</main>

@stop
@section('custom-scripts')
@include('js.customer.follow')
@stop