<!doctype html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @yield('css')
    <!-- Favicon -->
    <link rel="icon" href="/V1/assets/img/brand/favicon.png" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="/V1/assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="/V1/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="/V1/assets/css/argon.css?v=1.2.0" type="text/css">


</head>
<body>
    @yield('content')
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="/V1/assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="/V1/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/V1/assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="/V1/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="/V1/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Optional JS -->
    <script src="/V1/assets/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="/V1/assets/vendor/chart.js/dist/Chart.extension.js"></script>
    <!-- Argon JS -->
    <script src="/V1/assets/js/argon.js?v=1.2.0"></script>
    <!-- Cookie JS -->
    <script src="/V1/assets/js/users/cookie.js?v=1.2.0"></script>
    @yield('js')
</body>
</html>
