<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <!-- meta character set -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Mobile Specific Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bing Verify -->
        <meta name="msvalidate.01" content="7CF45520D2EC0902867F4A849C3902A6" />
        
        <!-- SEO OPTIMIZATION -->
        @yield('meta')

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Site Title -->
        <title>@yield('title')</title>

        <!-- Favicon-->
        <link rel="shortcut icon" href="{{ asset('assets/frontend/themes/img/incattech/icon.ico') }}">
        
        <!--=============================================
            CSS
        ============================================= -->
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets/frontend/themes/css/linearicons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/themes/css/font-awesome.min.css') }}">
        <link href="{{ asset('assets/frontend/themes/css/ionicons.css') }}" rel="stylesheet">

        <!-- Vendors -->
        <link rel="stylesheet" href="{{ asset('assets/frontend/themes/css/vendor/jquery-ui.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/themes/css/vendor/bootstrap/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/themes/css/vendor/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/themes/css/vendor/nice-select.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/themes/css/vendor/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/themes/css/vendor/demo.css') }}">      

        <!-- OwlCarousel -->
        <link rel="stylesheet" href="{{ asset('assets/frontend/themes/owlcarousel/dist/assets/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/themes/owlcarousel/dist/assets/owl.theme.default.min.css') }}">

        <!-- Core Css -->
        <link rel="stylesheet" href="{{ asset('assets/frontend/themes/css/default/main.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/frontend/themes/css/skins/themes.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        

        @stack('css')
    </head>
    <body id="default">

        @yield('content')

        <!-- Back to top -->
        <div id="back-to-top"></div>
        <!-- Back to top -->

        <!-- SCIPTS -->
        <script src="{{ asset('assets/frontend/themes/js/vendor/jquery-2.2.4.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
                crossorigin="anonymous">
                // integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" 
        </script>
        <script src="{{ asset('assets/frontend/themes/js/vendor/bootstrap-4.3.1.min.js') }}"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
        <script src="{{ asset('assets/frontend/themes/js/easing.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/themes/js/hoverIntent.js') }}"></script>
        <script src="{{ asset('assets/frontend/themes/js/superfish.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/themes/js/jquery.ajaxchimp.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/themes/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/themes/js/mn-accordion.js') }}"></script>
        <script src="{{ asset('assets/frontend/themes/js/jquery-ui.js') }}"></script>
        <script src="{{ asset('assets/frontend/themes/js/jquery.nice-select.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/themes/owlcarousel/dist/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/frontend/themes/js/mail-script.js') }}"></script>
        <script src="{{ asset('assets/frontend/themes/js/main.js') }}"></script>
        <script src="{{ asset('assets/frontend/themes/js/vendor/demo.js') }}"></script>
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

        {{--<script type="text/javascript">
            var prevScrollpos = window.pageYOffset;
            window.onscroll = function() {
              var currentScrollPos = window.pageYOffset;
              if (prevScrollpos > currentScrollPos) {
                document.getElementById("navbar").style.top = "45px";
              } else {
                document.getElementById("navbar").style.top = "-50px";
              }
              prevScrollpos = currentScrollPos;
            }
        </script>--}}
        @stack('js')
    </body>
</html>
