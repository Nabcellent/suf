<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SUF-STORE</title>

    {{--    BOOTSTRAP CSS    --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Varela+Round&display=swap');
        :root {
            --z-index-1: 10!important;
            --z-index-2: 20!important;
            --z-index-3: 30!important;
            --z-index-4: 40!important;
            --z-index-5: 50!important;

            /*""""""""""""""  COLORS  """"""""""""""*/
            --dark-red: rgba(159, 25, 16, 1);
            --dark-blue: rgb(0, 0, 208);
            --dark-gold: rgb(152, 127, 29);
            --standard-gold: rgb(174, 124, 11);
            --light-gold: rgb(194, 144, 11);
            --body-color: rgba(230, 230, 255, .7);

            /*""""""""""""""  FONTS  """"""""""""""*/
            --font-size-tiny: 9pt;
            --font-size-small: 10pt;
            --font-size-normal: 11pt;
        }
        section {
            box-sizing: border-box;
            font-family: 'Varela Round', cursive;
            height: 100vh;
            background: linear-gradient(232deg, var(--body-color), #000000, var(--light-gold));
            animation: Gradient 15s ease infinite;
            position: relative;
            background-size: 400% 400%;
        }
        #particles-js {
            width: 100%;
            height: 100%;
        }
        @keyframes Gradient {
            0% {
                background-position: 0 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0 50%;
            }
        }

        .container {
            position: absolute;
            top: 50%;
            left:50%;
            transform:translateX(-50%) translateY(-50%);
        }
        .col.main {
            background-color: rgba(230, 230, 255, .8);
            padding: 7rem;
            color: rgb(100,100, 150);
        }
    </style>
</head>
<body>
<section>
    <div id="particles-js">
        <div class="container">
            <div class="row">
                <div class="col main rounded shadow-lg">
                    <h5 class="position-absolute" style="bottom: 1rem; right: 1rem;">COMING SOON...!🚛🚛</h5>
                    <h1>Hey You... Good to see you!</h1>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h6 class="mt-5">Hope you're here to stay.😌</h6>
                        </div>
                        <div class="col-5 border-left border-secondary">
                            <h4 class="text-right">This is just the beginning.😁 </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>


{{--    JQUERY CDN    --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ url('js/particles/particles.min.js') }}"></script>
<script src="{{ url('js/particles/app.js') }}"></script>

</body>
</html>
