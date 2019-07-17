<!DOCTYPE html>
<html class="no-js" lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="msvalidate.01" content="7CF45520D2EC0902867F4A849C3902A6" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- SEO OPTIMIZATION -->
        @yield('meta')

        <!-- Site Title -->
        <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
        
        <!--=============================================
                CSS
        ============================================= -->
        <link rel="stylesheet" href="{{ asset('assets/frontend/themes/tv/css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/themes/tv/css/theme.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/themes/tv/css/skins/themes.css') }}">
        
        <!-- Fonts -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="{{ asset('assets/frontend/themes/css/linearicons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/themes/css/font-awesome.min.css') }}">
        <link href="{{ asset('assets/frontend/themes/css/ionicons.css') }}" rel="stylesheet">
        
        
        
        
        <!-- Media Vendors -->
        <link href="{{ asset('assets/frontend/themes/tv/css/mediaelementplayer.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/tv/layerslider/css/layerslider.css') }}">
        
        <!-- OwlCarousel -->
        <link rel="stylesheet" href="{{ asset('assets/frontend/themes/tv/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/themes/tv/css/owl.theme.default.min.css') }}">

        <link rel="stylesheet" href="{{ asset('assets/frontend/themes/tv/css/responsive.css') }}">
        
        <!-- Vendors -->
        <link rel="stylesheet" href="{{ asset('assets/frontend/themes/tv/css/jquery.kyco.easyshare.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/themes/tv/vendor/css/demo.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        @stack('css')
    </head>
    <body id="default">
        <div class="off-canvas-wrapper">
            <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
                @include('layouts.dev.partial.global.canvas')
                <div class="off-canvas-content" data-off-canvas-content>
                    @include('layouts.dev.nav')

                    @yield('content')

                    @include('layouts.dev.partial.global.footer')
                </div><!--end off canvas content-->
            </div><!--end off canvas wrapper inner-->
        </div><!--end off canvas wrapper-->
        
        <!-- script files -->
        <script src="{{ asset('assets/frontend/themes/tv/js/jquery/dist/jquery.js') }}"></script>
        <script src="{{ asset('assets/frontend/themes/tv/js/mediaelement-and-player.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/frontend/themes/tv/js/what-input/what-input.js') }}"></script>
        <script src="{{ asset('assets/frontend/themes/tv/js/foundation-sites/dist/foundation.js') }}"></script>
        <script src="{{ asset('assets/frontend/themes/tv/js/jquery.showmore.src.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/frontend/themes/tv/js/app.js') }}"></script>
        <!-- // <script src="{{ asset('assets/tv/js/sticky.js') }}"></script> -->
        <script src="{{ asset('assets/frontend/themes/tv/layerslider/js/greensock.js') }}" type="text/javascript"></script>
        
        <!-- LayerSlider script files -->
        <script src="{{ asset('assets/frontend/themes/tv/layerslider/js/layerslider.transitions.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/frontend/themes/tv/layerslider/js/layerslider.kreaturamedia.jquery.js') }}" type="text/javascript"></script>
        
        <!-- Vendors -->
        <script src="{{ asset('assets/frontend/themes/tv/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/themes/tv/js/inewsticker.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/frontend/themes/tv/js/jquery.kyco.easyshare.js') }}" type="text/javascript"></script>
        
        <!-- // <script src="{{ asset('assets/tv/vendor/js/demo.js') }}"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        
        {!! Toastr::message() !!}
        <script>
            @if($errors->any())
                @foreach($errors->all() as $error)
                toastr.error('{{ $error }}','Error',{
                    closeButton:true,
                    progressBar:true,
                });
                @endforeach
            @endif
        </script>
        @stack('js')
    </body>
</html>