<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Coderthemes" name="R Mike">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('admin/admin/assets/images/favicon.ico')}}">

        <!-- third party css -->
        <link href="{{asset('admin/assets/css/vendor/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet" type="text/css">
        <!-- third party css end -->

        <!-- App css -->
        @yield('styles')

    </head>

    <body class="loading" data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
        
          <!-- Pre-loader -->
        
        <!-- End Preloader-->
        
        <!-- Begin page -->
        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
          
            {{View::make('admin.layouts.left-sidebar')}}
          
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                   
                    {{View::make('admin.layouts.navbar')}}

                    <!-- end Topbar -->
                    
                    <!-- Start Content-->
                   @yield('content')
                    <!-- container -->

                </div>
                <!-- content -->

                <!-- Footer Start -->
               {{View::make('admin.layouts.footer')}}
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Right Sidebar -->
      {{View::make('admin.layouts.right-sidebar')}}
        <!-- /End-bar -->

        <script src="{{asset('admin/assets/js/vendor.min.js')}}"></script>
        <script src="{{asset('admin/assets/js/app.min.js')}}"></script>

        <!-- third party js -->
        <script src="{{asset('admin/assets/js/vendor/apexcharts.min.js')}}"></script>
        <script src="{{asset('admin/assets/js/vendor/jquery-jvectormap-1.2.2.min.js')}}"></script>
        <script src="{{asset('admin/assets/js/vendor/jquery-jvectormap-world-mill-en.js')}}"></script>
        <!-- third party js ends -->

        <!-- demo app -->
        @yield('scripts')
        <!-- end demo js-->
    </body>
</html>