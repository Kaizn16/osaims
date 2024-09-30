@extends('layouts.app')

@section('content')
<div class="main-content">
    <header class="header">
        <strong class="title">Admin Dashboard</strong>
        <span>Home</span>
    </header>

    <div class="boxes">
        <div class="box">
            <img src="{{ asset('assets/Images/Students.png') }}" alt="Icon">
            <span><div class="vertical-line"></div></span>
            <div class="info">
                <p>Students</p>
                <strong>2046</strong>
            </div>
        </div>

        <div class="box">
            <img src="{{ asset('assets/Images/Staff.png') }}" alt="Icon">
            <span><div class="vertical-line"></div></span>
            <div class="info">
                <p>Staff</p>
                <strong>4</strong>
            </div>
        </div>

        <div class="box">
            <img src="{{ asset('assets/Images/Student Violators.png') }}" alt="Icon">
            <span><div class="vertical-line"></div></span>
            <div class="info">
                <p>Student Violators</p>
                <strong>4</strong>
            </div>
        </div>

        <div class="box">
            <img src="{{ asset('assets/Images/Organizations.png') }}" alt="Icon">
            <span><div class="vertical-line"></div></span>
            <div class="info">
                <p>Organization</p>
                <strong>12</strong>
            </div>
        </div>
    </div>

    <div class="Director-Info-Wrapper">
        <img src=" {{ asset('assets/Images/Rev Dr Webster Bedecir.png') }} " alt="Director Avatar">
        <div class="Director-Information">
            <strong>Rev. Dr. Webster Bedecir</strong>
            <span class="Position">OSA Director <p class="Schedule">3:00 - 4:00 PM | August 10, 2024 - August 15, 2024</p></span>
            <span class="status Leave">Leave</span>
            <span class="edit-status">Edit Status</span>
        </div>
    </div>


</div>
@endsection