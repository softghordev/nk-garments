<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="admin, dashboard" />
	<meta name="author" content="DexignZone" />
	<meta name="robots" content="index, follow" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="MOPHY : Payment Admin Dashboard  Bootstrap 5 Template" />
	<meta property="og:title" content="MOPHY : Payment Admin Dashboard  Bootstrap 5 Template" />
	<meta property="og:description" content="MOPHY : Payment Admin Dashboard  Bootstrap 5 Template" />
	<meta property="og:image" content="social-image.png"/>
	<meta name="format-detection" content="telephone=no">
    <title>Kanak</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('asset/images/favicon.png')}}">
	<link rel="stylesheet" href="{{asset('asset/vendor/chartist/css/chartist.min.css')}}">
    <link href="{{asset('asset/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('asset/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('asset/vendor/toastr/css/toastr.min.css')}}">
    @yield('extra_css')
</head>

<body data-typography="poppins" data-theme-version="dark" data-layout="vertical" data-nav-headerbg="color_1" data-headerbg="color_1" data-sidebar-style="full" data-sibebarbg="color_1" data-sidebar-position="fixed" data-header-position="fixed" data-container="wide" direction="ltr" data-primary="color_1" data-sibebartext="color_1">
    <div id="main-wrapper" class="show">

       @include('admin.inc.nav')
       @include('admin.inc.sidebar')
        @yield('content')

        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="https://softghor.com/" target="_blank">softghor Limited</a> {{date('Y')}}</p>
            </div>
        </div>
    </div>

    <!-- Required vendors -->
    <script src="{{asset('asset/vendor/global/global.min.js')}}"></script>
	<script src="{{asset('asset/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
	<script src="{{asset('asset/vendor/chart.js/Chart.bundle.min.js')}}"></script>
	<!-- Chart piety plugin files -->
    <script src="{{asset('asset/vendor/peity/jquery.peity.min.js')}}"></script>

	<!-- Apex Chart -->
	<script src="{{asset('asset/vendor/apexchart/apexchart.js')}}"></script>

	<!-- Dashboard 1 -->
	<script src="{{asset('asset/js/dashboard/dashboard-1.js')}}"></script>

    <script src="{{asset('asset/js/custom.min.js')}}"></script>
    <script src="{{asset('asset/js/demo.js')}}"></script>
    <script src="{{asset('asset/vendor/toastr/js/toastr.min.js')}}"></script>

	@yield('extra_js')
    @include('admin.inc.toaster-alerts')

</body>
</html>
