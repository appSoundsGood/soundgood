<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{ public_path() }}/favicon.ico">
    <title>
        @section('title')
            {{ SITE_NAME }}
        @show
    </title>

    {{ HTML::style('/assets/css/bootstrap.min.css') }}
    {{ HTML::style('/assets/css/style_bootstrap.css') }}
    {{ HTML::style('/assets/css/style_common.css') }}
    @yield('styles')
    @yield('custom-styles')
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>    
    @yield('header')
    
    @yield('body')
    
    @yield('footer')
    
    {{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js') }}
    {{ HTML::script('//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js') }}
    @yield('scripts')
    @yield('custom-scripts')
    {{ HTML::script('/assets/js/jquery.scrollbox.js') }}
    {{ HTML::script('/assets/js/script/home.js') }}
    
</body>
</html>
