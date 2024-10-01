<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main-style.css') }}" />
    <!----===== FontAwesome CSS ===== -->
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome-6.6.0-all.min.css') }}" />
    <!----===== Toasttr CSS ===== -->
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.css') }}" />
    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <title>{{ config('app.name', 'OSAMIS') }} - {{ Request::path() }}</title>
    @routes
</head>
<body>
    <main class="container">    
        
        @include('layouts.nav')

        <section class="wrapper">
            {{-- PAGE CONTENT GOES HERE --}}
            @yield('content')
            {{-- PAGE CONTENT GOES HERE --}}
        </section>
    </main>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/navigation.js') }}" defer></script>
    <script src="{{ asset('assets/js/main.js') }}" defer></script>
    <script src="{{ asset('assets/js/font-awesome-6.6.0-all.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/sweetalert2-11.js') }}" defer></script>
</body>
</html>