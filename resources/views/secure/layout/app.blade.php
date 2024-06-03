<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>Drainage | {{ env('APP_NAME') }}</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Leggo">

    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('admin') }}/images/favicon.svg" type="image/x-icon">
    <!-- [Font] Family -->
    <link rel="stylesheet" href="{{ asset('admin') }}/fonts/inter/inter.css" id="main-font-link" />
    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="{{ asset('admin') }}/fonts/tabler-icons.min.css" />
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="{{ asset('admin') }}/fonts/feather.css" />
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="{{ asset('admin') }}/fonts/fontawesome.css" />
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="{{ asset('admin') }}/fonts/material.css" />
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('admin') }}/css/style.css" id="main-style-link" />
    <link rel="stylesheet" href="{{ asset('admin') }}/css/style-preset.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @yield('app-css')
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme_contrast="" data-pc-theme="light">
<!-- [ Pre-loader ] start -->
<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>
<div id="app">
    <!-- [ Pre-loader ] End -->
    <!-- [ Sidebar Menu ] start -->
    @include('secure.layout.sidebar')
    <!-- [ Sidebar Menu ] end -->

    <!-- [ Header Topbar ] start -->
    @include('secure.layout.header')
    <!-- [ Header ] end -->


    <!-- [ Main Content ] start -->
    <div class="pc-container">
        <div class="pc-content">
                @yield('content')
        </div>
    </div>
    <!-- [ Main Content ] end -->

    @include('secure.layout.footer')
</div>


<!-- Required Js -->
<script src="{{ asset('admin') }}/js/plugins/popper.min.js"></script>
<script src="{{ asset('admin') }}/js/plugins/simplebar.min.js"></script>
<script src="{{ asset('admin') }}/js/plugins/bootstrap.min.js"></script>
<script src="{{ asset('admin') }}/js/fonts/custom-font.js"></script>
<script src="{{ asset('admin') }}/js/pcoded.js"></script>
<script src="{{ asset('admin') }}/js/plugins/feather.min.js"></script>

@yield('app-scripts')
</body>
<!-- [Body] end -->
</html>
