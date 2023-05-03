<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Movies Index 2</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- <link href="https://getbootstrap.com/docs/5.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

        <!-- Daterangepicker css -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/daterangepicker/daterangepicker.css') }}">

        <!-- Vector Map css -->
        <link rel="stylesheet" href="{{ asset('assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}">

        <!-- Theme Config Js -->
        <script src="{{ asset('assets/js/hyper-config.js') }}"></script>

        <!-- Icons css -->
        <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="{{ asset('assets/css/app-modern.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    </head>
    <body>
        <div id="app">
            <router-view></router-view>
        </div>

        @vite('resources/js/app.js')
        <!-- Vendor js -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
    </body>
</html>
