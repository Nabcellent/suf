<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="{{ $metaDesc ?? "This is an online fashion store in Nairobi Kenya. Come buy apparel." }}">
    <meta name="keywords"
          content="{{ $metaKeywords ?? "suf, su-F, strathmore fashion, buy clothes, fashion, clothes, strathmore ecommerce, suf store, fashion store, delivery, become a seller" }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Suf - @yield('title')</title>

    @include('partials.links')

    {{--    JQUERY    --}}
    <script src="{{ asset('vendor/jquery.js') }}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('vendor/Toastify/toastify.min.js') }}"></script>
</head>
<body id="bg">

@if(Request::routeIs('home') && url()->previous() === route('login'))
    <div class="loader-bg">
        <div class="loader"></div>
    </div>
@endif

<canvas></canvas>
@include('partials.background')
@include('partials.alert')
@include('partials.top_header')

@if(Request::routeIs('home'))
    @include('partials.home_banners')
@endif

@yield('content')

@include('partials.footer')
@include('partials.scripts')

</body>
</html>
