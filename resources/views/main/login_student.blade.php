@extends('layouts.main')

@section('landing-page-content')
    <section class="form-content">
        <div class="form-wrapper">
            <form>
                <header>Login to your OSAIMS Account!</header>
                <div class="form-group">
                    <input type="text" name="student_id" id="student_id" placeholder="Enter your ID Number" />
                </div>
                <div class="form-group">
                    <input type="text" name="password" id="password" placeholder="Enter your Password" />
                </div>
                <button type="submit">SIGN IN</button>
            </form>
        </div>
    </section>
@endsection