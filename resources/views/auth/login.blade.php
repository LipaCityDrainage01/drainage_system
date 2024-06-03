<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
    <title>Login | {{ env('APP_NAME') }}</title>
    <!-- [Meta] -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Aviarthard Software Solutions">

    <!-- [Favicon] icon -->
    <link rel="icon" href="{{ asset('admin') }}/images/favicon.svg" type="image/x-icon"> <!-- [Font] Family -->
    <link rel="stylesheet" href="{{ asset('admin') }}/fonts/inter/inter.css" id="main-font-link" />
    <link rel="stylesheet" href="{{ asset('admin') }}/fonts/tabler-icons.min.css" >
    <link rel="stylesheet" href="{{ asset('admin') }}/fonts/feather.css" >
    <link rel="stylesheet" href="{{ asset('admin') }}/fonts/fontawesome.css" >
    <link rel="stylesheet" href="{{ asset('admin') }}/fonts/material.css" >
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="{{ asset('admin') }}/css/style.css" id="main-style-link" >
    <link rel="stylesheet" href="{{ asset('admin') }}/css/style-preset.css" >

    <style>
        /*.bg-primary {*/
        /*    !*background-color: #ef6c00 !important;*!*/
        /*}*/
    </style>

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
<!-- [ Pre-loader ] End -->
<div class="auth-main">
    <div class="auth-wrapper v1">
        <div class="auth-form">
            <div class="card my-5">
                <div class="card-body">
                    <form action="/adminLogin" method="POST">
                        @csrf
                        <div class="text-center">
                            <a href="#">
{{--                                <div class="text-h6 text-black text-bolder">RefreshIt</div>--}}
                                <img src="{{ asset('logo.png') }}" class="img img-fluid" style="width: 30%" alt="img">
                            </a>
                        </div>
                        @if(Session::has('message'))
                            <div class="alert alert-{{ Session::get('type') }} alert-dismissible fade show mt-3" role="alert">
                                {{ Session::get('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="form-group mb-3">
                            <div class="form-floating mb-0">
                                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Email address">
                                <label for="floatingInput">Email address</label>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <div class="form-floating mb-0">
                                <input type="password" name="password" class="form-control" id="floatingInput1" placeholder="Password">
                                <label for="floatingInput1">Password</label>
                            </div>
                        </div>
                        <div class="d-flex mt-1 justify-content-between align-items-center">
                            <div class="form-check">
                                <input class="form-check-input input-primary" type="checkbox" id="customCheckc1" checked="" name="remember">
                                <label class="form-check-label text-muted" for="customCheckc1">Remember me?</label>
                            </div>
                            <h6 class="text-secondary f-w-400 mb-0">Forgot Password?</h6>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit"  class="btn btn-primary text-white">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
<!-- Required Js -->
<script src="{{ asset('admin') }}/js/plugins/popper.min.js"></script>
<script src="{{ asset('admin') }}/js/plugins/simplebar.min.js"></script>
<script src="{{ asset('admin') }}/js/plugins/bootstrap.min.js"></script>
<script src="{{ asset('admin') }}/js/fonts/custom-font.js"></script>
<script src="{{ asset('admin') }}/js/pcoded.js"></script>
<script src="{{ asset('admin') }}/js/plugins/feather.min.js"></script>

</body>
<!-- [Body] end -->
</html>
