
<link rel="shortcut icon" href="{{url('images/general/store_logo.jpg')}}">

{{--    BOOTSTRAP CSS    --}}
<link rel="stylesheet" href="{{ asset('vendor/bootstrap5/bootstrap.min.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

{{--    FONTAWESOME CSS    --}}
<link rel="stylesheet" href="{{url('css/font-awesome/css/all.min.css')}}">

{{--    BOXICONS CSS    --}}
<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

<!--    Toastify    -->
<link rel="stylesheet" type="text/css" href="{{ asset('vendor/Toastify/toastify.min.css') }}">

<!--    SELECT 2 CSS    -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />

{{--    SWIPER CSS    --}}
<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

{{--    NICENUMBER CSS    --}}
<link href="{{url('css/jquery.nice-number.css')}}" rel='stylesheet'>

{{--    DYNAMIC CSS    --}}
@stack('stylesheets')
@livewireStyles

{{--    MY CSS    --}}
<link href="{{ asset('css/global.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('css/style.css')}}">
<link rel="stylesheet" href="{{asset('css/responsive.css')}}">
