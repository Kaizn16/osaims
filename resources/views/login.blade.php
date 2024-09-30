<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>OSA Information Management System Login</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/admin-staff-login.css') }}">
</head>
<body>
    <main class="container">
        <section class="welcome-section">
            <div class="logo">
                <img src="{{ asset('assets/Images/FCU-Logo.jpg') }}" alt="FCU INC. LOGO">
            </div>
            <div class="welcome-title">
                <h1>
                    WELCOME
                    <p>OSA-IMS</p>
                </h1>
            </div>
        </section>
        <section class="login-container">
            <header class="header"><strong>LOGIN ACCOUNT</strong></header>
            <div class="form-container">
                <form method="POST" action="{{ route('login.store') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="username" placeholder="Username | FCU-CC523" autocomplete="off"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Enter you password" />
                    </div>
                    <a href="" id="forgot-password">Forgot password?</a>
                    <button>SIGN IN</button>
                </form>
            </div>
            <footer><strong>EST 2024</strong></footer>
        </section>
    </main>
</body>
</html>