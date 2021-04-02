<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Suf - @yield('title')</title>
    <link rel="shortcut icon" href="{{url('images/general/main_logo.jpg')}}">

    {{--    BOOTSTRAP CSS    --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    {{--    SWIPER CSS    --}}
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    {{--    FONTAWESOME CSS    --}}
    <link rel="stylesheet" href="{{url('css/font-awesome/css/all.min.css')}}">

    {{--    BOXICONS CSS    --}}
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    {{--    MY CSS    --}}
    <link rel="stylesheet" href="{{url('css/style.css')}}">
    <link rel="stylesheet" href="{{url('css/responsive.css')}}">
</head>
<body>
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

<!--    Swiper JS CDN    -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

{{--    MY JS    --}}
<script src="{{url('js/main.js')}}"></script>
<script src="{{url('js/swiper.js')}}"></script>
</body>
</html>
