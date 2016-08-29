<!DOCTYPE html">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{ public_path() }}/favicon.ico">
    <title>
        @section('title')
            {{ SITE_NAME }}
        @show
    </title>

    {{ HTML::style('/assets/css/bootstrap.min.css') }}
    {{ HTML::style('/assets/metronic/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}
    {{ HTML::style('/assets/css/common.css') }}
    @yield('styles')
    @yield('custom-styles')
    
    {{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js') }}
	{{ HTML::script('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js') }}
</head>
<body>
	<div class="content">
		@yield('header')
	    
	    @yield('body')
	    
	    @yield('footer')
	</div>
    
    @yield('scripts')
    @yield('custom-scripts')
    {{ HTML::script('/assets/js/jquery.scrollbox.js') }}
    {{ HTML::script('/assets/js/script/home.js') }}
</body>
</html>