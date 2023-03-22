<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <meta name="author" content="R Mike">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{('user/assets/images/icons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{('user/assets/images/icons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{('user/assets/images/icons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{('user/assets/images/icons/site.html')}}">
    <link rel="mask-icon" href="{{('user/assets/images/icons/safari-pinned-tab.svg')}}" color="#666666">
    <link rel="shortcut icon" href="{{('user/assets/images/icons/favicon.ico')}}">
    <meta name="application-name" content="E-com">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="{{('user/assets/images/icons/browserconfig.xml')}}">
    <meta name="theme-color" content="#ffffff">
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{asset('user/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/css/plugins/owl-carousel/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('user/assets/css/plugins/magnific-popup/magnific-popup.css')}}">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{asset('user/assets/css/style.css')}}">
@yield('styles')
</head>

<body>
    <div class="page-wrapper">
      
        
        
        @yield('content')
        
        {{View::make('user.layouts.footer')}}
        
    </div><!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>
    
    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div><!-- End .mobil-menu-overlay -->
    
    {{View::make('user.layouts.mobile-menu')}}
    
    
    <!-- Sign in / Register Modal -->
    
    
 

    <!-- Plugins JS File -->
    <script src="{{asset('user/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('user/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('user/assets/js/jquery.hoverIntent.min.js')}}"></script>
    <script src="{{asset('user/assets/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('user/assets/js/superfish.min.js')}}"></script>
    <script src="{{asset('user/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('user/assets/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- Main JS File -->
    <script src="{{asset('user/assets/js/main.js')}}"></script>
    @yield('scripts')
</body>


</html>