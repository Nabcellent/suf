<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Suf - About Us</title>
    <link rel="shortcut icon" href="{{url('images/general/store_logo.jpg')}}">

    {{--    BOOTSTRAP CSS    --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    {{--    FONTAWESOME CSS    --}}
    <link rel="stylesheet" href="{{url('css/font-awesome/css/all.min.css')}}">

    {{--    BOXICONS CSS    --}}
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    {{--    MY CSS    --}}
    <link rel="stylesheet" href="{{url('css/about.css')}}">

</head>
<body>

<!-- Background & animion & navbar & title -->
<div class="container-fluid">
    <!-- Background animtion-->
    <div class="background">
        <div class="cube"></div>
        <div class="cube"></div>
        <div class="cube"></div>
        <div class="cube"></div>
        <div class="cube"></div>
        <div class="cube"></div>
        <div class="cube"></div>
    </div>
    <!-- header -->
    <header>
        <!-- navbar -->
        <nav>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
            </ul>
        </nav>
        <!-- logo -->
        <div class="logo"><a href="{{ route('home') }}"><img src="{{ asset('images/general/store_logo.jpg') }}" alt=""></a></div>
        <!-- title & content -->
        <div class="row vh-100 justify-content-center align-items-center">
            <div class="col-12 col-md-8">
                <canvas id="canvas" width="1178" height="587"></canvas>
            </div>
            <div class="col d-flex justify-content-center align-items-center">
                <section class="header-content">
                    <h1>HEY AWESOME</h1>
                    <p> Welcome to our fashion store. We are a passionated group of people,<br>
                        making high quality products designed to make your life easier.</p>
                    <button>Know more</button>
                    <button>Meet us</button>
                </section>
            </div>
        </div>
    </header>
</div>

<!--<div id="" class="container px-lg-5">

    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-auto">
            <img src="{{ asset('images/illustrations/undraw_gone_shopping_vwmc.svg') }}" width="500" alt="">
        </div>
    </div>

</div>-->


    {{--    JQUERY CDN    --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    {{--    BOOTSTRAP JS    --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

<script type="text/javascript">
    function init() {
        let canvas = document.getElementById('canvas');
        let context = canvas.getContext('2d');
        let w = canvas.width;
        let h = canvas.height;

        let bg = new Image();
        bg.src = "images/illustrations/undraw_add_to_cart_vkjp.svg";

        let flakes = [];

        function snowFall() {
            context.clearRect(0, 0, w, h);
            context.drawImage(bg, 0, 0);
            addFlake();
            snow();
        }

        function addFlake(){
            let x = Math.ceil(Math.random() * w);
            let s = Math.ceil(Math.random() * 4);
            flakes.push({x, y: 0, s});
        }

        function snow(){
            flakes.forEach(flake => {
                context.beginPath();
                context.fillStyle = "rgba(100, 100, 255, 0.7)";
                context.arc(flake.x, flake.y += flake.s / 2, flake.s/2, 0, 2 * Math.PI);
                context.fill();
                if(flake.y > h) {
                    flakes.splice(flake, 1);
                }
            });
        }

        setInterval(snowFall, 20);
    }

    window.onload = init;
</script>
</body>
</html>
