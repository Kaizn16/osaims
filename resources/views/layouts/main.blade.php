<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome-6.6.0-all.min.css') }}" />
    <title>Filamer Christian University - OSA</title>
</head>
<body>
    <main class="content-wrapper">
        <section class="header">
            <header class="university-header">
                <figure>
                    <img src="{{ asset('assets/Images/FCU-Logo.jpg') }}" alt="FCU Logo">
                </figure>
                <div class="header-text">
                    <h1>Filamer Christian University Inc.</h1>
                    <h2>Office of the Student Affairs</h2>
                </div>
            </header>        
            @include('layouts.main-nav')
        </section>
        <section class="main-content">
            @yield('landing-page-content')
        </section>
        <footer class="footer">
            OSAIMS
        </footer>
    </main>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/font-awesome-6.6.0-all.min.js') }}" defer></script>
</body>
</html>