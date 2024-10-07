@extends('layouts.main')

@section('landing-page-content')
    <section class="home-page">
        <div class="carousel-slider">
            <div class="carousel-list">
                <div class="item">
                    <img src="{{ asset('storage/Carousel/Student Handbook.PNG') }}" alt="Carousel-Image"> 
                </div>
                <div class="item">
                    <img src="{{ asset('storage/Carousel/Student Handbook.PNG') }}" alt="Carousel-Image"> 
                </div>
                <div class="item">
                    <img src="{{ asset('storage/Carousel/Student Handbook.PNG') }}" alt="Carousel-Image"> 
                </div>
                <div class="item">
                    <img src="{{ asset('storage/Carousel/Student Handbook.PNG') }}" alt="Carousel-Image"> 
                </div>
                <div class="item">
                    <img src="{{ asset('storage/Carousel/Student Handbook.PNG') }}" alt="Carousel-Image"> 
                </div>
            </div>
    
            <ul class="dots">
                <li class="active"></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>

        </div>

        <div class="events-container">
            <header class="header">
                <strong>EVENTS</strong>
            </header>
            <div class="event-list-boxes">
                <div class="box event-1">

                </div>
                <div class="box event-2">

                </div>
                <div class="box event-3">

                </div>
                <div class="box event-4">

                </div>
                <div class="box event-5">

                </div>
                <div class="box event-6">

                </div>
                <div class="box event-7">

                </div>
                <div class="box event-8">

                </div>
            </div>
        </div>

    </section>
    <script src="{{ asset('assets/js/carousel.js') }}"></script>
@endsection