<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Suf - @yield('title')</title>
    <link rel="shortcut icon" href="{{url('images/general/store_logo.jpg')}}">

    {{--    BOOTSTRAP CSS    --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    {{--    SWIPER CSS    --}}
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    {{--    FONTAWESOME CSS    --}}
    <link rel="stylesheet" href="{{url('css/font-awesome/css/all.min.css')}}">

    {{--    BOXICONS CSS    --}}
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    {{--    NICENUMBER CSS    --}}
    <link href="{{url('css/jquery.nice-number.css')}}" rel='stylesheet'>

    {{--    MY CSS    --}}
    <link rel="stylesheet" href="{{url('css/app.css')}}">
    <link rel="stylesheet" href="{{url('css/responsive.css')}}">
</head>
<body id="bg">
<canvas></canvas>
@include('partials.background')
@include('partials.alert')
@include('partials.top_header')

@if(isset($pageTitle) && $pageTitle === "Index")
    @include('partials.home_banners')
@endif

@yield('content')

@include('partials.footer')


{{--    JQUERY CDN    --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

{{--    BOOTSTRAP JS    --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

{{--    JQuery Validation CDN    --}}
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>

<!--    Swiper JS CDN    -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

{{--    SweetAlert2 CDN    --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.all.min.js" integrity="sha256-C7IaCo6kN3RN2EjOcM6WEMmykQV8mK72CI1jx0kqeZg=" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>


{{--    MY JS    --}}
<script src="{{url('js/main.js')}}"></script>
<script src="{{ url('js/Global.js') }}"></script>
<script src="{{url('js/JqueryValidation.js')}}"></script>
<script src="{{url('js/swiper.js')}}"></script>
<script src="{{url('js/search.js')}}"></script>
<script src="{{url('js/fetch.js')}}"></script>
<script src="{{url('js/sweetAlert.js')}}"></script>
<script src="{{url('js/payment.js')}}"></script>
<script src="{{url('js/jquery.nice-number.js')}}"></script>
</body>
</html>
