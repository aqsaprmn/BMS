<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('auth.name', 'SOP-ALPRO') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="shortcut icon" href="{{ url('') }}/assets/images/logo/api.png" type="image/x-icon">

    <link rel="stylesheet" href="{{ url('') }}/assets/vendors/bootstrap-icons/bootstrap-icons.css">

    <link rel="stylesheet" href="{{ url('') }}/assets/css/style.css">

    <!-- Scripts -->
    @vite('resources/js/app.js')

    <style>
        .logo-login {
            margin: auto;
            position: relative;
            width: 200px;
        }

        .logo-login img {
            object-fit: contain;
        }
    </style>
</head>

<body>
    @include('sweetalert::alert')
    <div id="app">
        {{-- Test GIT --}}
        <main class="">
            @yield('content')
        </main>
    </div>

    <script src="{{ url('') }}/assets/js/extensions/jquery.min.js"></script>
    <script src="{{ url('') }}/assets/js/admin/login.js"></script>
</body>

</html>
