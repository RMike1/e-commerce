@section('title','MK | 503 Maintenance mode')
@extends('user.layouts.master')

@section('content')

@include('user.layouts.header-err')


<main class="main">

    <div class="error-content text-center" style="background-image: url({{asset('user/assets/images/backgrounds/error-bg.jpg')}})">
        <div class="container">
            <h1 class="error-title">503</h1><!-- End .error-title -->
            <h2 class="text-uppercase">Maintainance mode.</h2>
            {{-- <a href="{{route('home')}}" class="btn btn-outline-primary-2 btn-minwidth-lg">
                <span>BACK TO HOMEPAGE</span>
                <i class="icon-long-arrow-right"></i>
            </a> --}}
        </div><!-- End .container -->
    </div><!-- End .error-content text-center -->
</main><!-- End .main -->

@endsection
