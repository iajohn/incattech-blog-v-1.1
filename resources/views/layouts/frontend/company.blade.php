<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <!-- Site Title -->
        <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

        <meta name="description" content="">
		<!-- Mobile Specific Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bing Verify -->
        <meta name="msvalidate.01" content="7CF45520D2EC0902867F4A849C3902A6" />

        <!-- SEO OPTIMIZATION -->
        @yield('meta')
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Favicon-->
        <link rel="shortcut icon" href="{{ asset('assets/frontend/themes/img/incattech/icon.ico') }}">

        <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet'>
        
        <!-- Syntax Highlighter -->
        <link rel="stylesheet" type="text/css" 
              href="{{ asset('assets/frontend/themes/company/syntax-highlighter/styles/shCore.css') }}" media="all">
        <link rel="stylesheet" type="text/css" 
              href="{{ asset('assets/frontend/themes/company/syntax-highlighter/styles/shThemeDefault.css') }}" media="all">
		
		<!-- Fonts CSS-->
        <link rel="stylesheet" href="{{ asset('assets/frontend/themes/company/css/font-awesome.min.css') }}">
        <link href="{{ asset('assets/frontend/themes/css/ionicons.css') }}" rel="stylesheet">

        <!-- Vendor - Normalize/Reset/Demo CSS-->
		<link rel="stylesheet" href="{{ asset('assets/frontend/themes/company/css/normalize.min.css') }}">
		<link rel="stylesheet" href="{{ asset('assets/frontend/themes/css/vendor/demo.css') }}"> 
		
		<!-- Main CSS-->
        <link rel="stylesheet" href="{{ asset('assets/frontend/themes/company/css/main.css') }}">
		@stack('css')

    </head>
	
    <body id="welcome">

    	@yield('content')

    	<!-- Back to top -->
        <div id="back-to-top"></div>
        <!-- Back to top -->
		
		
		<!-- Essential JavaScript Libraries
		==============================================-->
        <script type="text/javascript" src="{{ asset('assets/frontend/themes/company/js/jquery-1.11.0.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/themes/company/js/jquery.nav.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/frontend/themes/company/syntax-highlighter/scripts/shCore.js') }}"></script> 
        <script type="text/javascript" src="{{ asset('assets/frontend/themes/company/syntax-highlighter/scripts/shBrushXml.js') }}"></script> 
        <script type="text/javascript" src="{{ asset('assets/frontend/themes/company/syntax-highlighter/scripts/shBrushCss.js') }}"></script> 
        <script type="text/javascript" src="{{ asset('assets/frontend/themes/company/syntax-highlighter/scripts/shBrushJScript.js') }}"></script> 
        <script type="text/javascript" src="{{ asset('assets/frontend/themes/company/syntax-highlighter/scripts/shBrushPhp.js') }}"></script> 
        <script type="text/javascript">
            SyntaxHighlighter.all()
        </script>
        <script type="text/javascript" src="{{ asset('assets/frontend/themes/company/js/custom.js') }}"></script>
        <script src="{{ asset('assets/frontend/themes/js/main.js') }}"></script>
        <script src="{{ asset('assets/frontend/themes/js/vendor/demo.js') }}"></script>
		@stack('js')

    </body>
</html>
