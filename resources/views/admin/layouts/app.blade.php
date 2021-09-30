<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SU-F ~ @yield('title')</title>

@include('admin.include.links')

<!--    Jquery CDN    -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
    <script src="{{ asset('vendor/Toastify/toastify.min.js') }}"></script>
    <!--    DataTables CDN    -->
    <script src="{{ asset('vendor/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('js/Admin/DataTables.js') }}"></script>
</head>
<body id="app">

@if(Request::routeIs('admin.dashboard'))
    <div class="page-loader-gif">
        <div class="water"></div>
    </div>
@endif

<section @auth() @if(Auth::user()->hasverifiedEmail()) class="nav_body" @endif @endauth>
    @include('admin.include.alert')

    @auth()
        @if(Auth::user()->hasverifiedEmail())
            @include('admin.include.navbar')
        @endif
    @endauth


    <main id="content">
        <section>
            @yield('content')
        </section>
    </main>

    @include('admin.include.footer')
</section>

@include('admin.include.scripts')
<script>
    setTimeout(() => {
        $('.page-loader-gif').fadeToggle();
    }, 1500);
</script>

</body>
</html>
