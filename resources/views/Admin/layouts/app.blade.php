<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!--    Bootstrap CSS    -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!--    Boxicons CSS    -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <!--    Font Awesome CSS    -->
    <link rel="stylesheet" href="{{ asset('/css/font-awesome/css/all.min.css') }}">

    <!--    DataTables CSS    -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">

    <!--    Select 2 CSS    -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />

    <!--    Swiper CSS    -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/Admin/style.css') }}" rel="stylesheet">
</head>
<body id="app" @if(Auth::guard('admin')->check()) class="nav_body" @endif>
@include('Admin.include.alert')

@if(Auth::guard('admin')->check())
    @include('Admin.include.navbar')
@endif



<main id="content">
    <section>
        @yield('content')
    </section>
</main>

@include('Admin.include.footer')

<!--    Jquery CDN    -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--    Bootstrap CDN    -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<!--    Jquery Validation CDN    -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/additional-methods.min.js"></script>

<!--    DataTables CDN    -->
<script type="text/javascript" src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

<!--    Select 2 JS    -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>

<!--    Swiper JS    -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!--    SweetAlert JS    -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js" integrity="sha256-tFXKkrzNScHtIKgp71cCOiVCPAokgE5k7m/i2VfU+4w=" crossorigin="anonymous"></script>


<!-- Scripts -->
<!--<script src="{{ asset('js/app.js') }}" defer></script>-->
<script src="{{ asset('js/Admin/Main.js') }}"></script>
<script src="{{ asset('js/Admin/Fetch.js') }}"></script>
<script src="{{ asset('js/Admin/Validations.js') }}"></script>
<script src="{{ asset('js/Admin/Dynamic.js') }}" defer></script>
<script src="{{ asset('js/Admin/SweetAlert.js') }}" defer></script>
<script src="{{ asset('js/Admin/Select2.js') }}" defer></script>
<script src="{{ asset('js/Admin/DataTables.js') }}" defer></script>
<script src="{{ asset('js/Admin/Swipers.js') }}" defer></script>

</body>
</html>
