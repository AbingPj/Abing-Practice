<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('css/loading.css') }}" rel="stylesheet">
    <link href="{{ asset('css/loading-bar.css') }}" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {

            /* background-color: #fff; */
            color: black;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .bgImage {
            background-image: url('/img/bg.jpeg');
            background-attachment: no-repeat;
            background-size: cover;
            background-position: center;
            /* background-attachment: fixed; */

        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            background-color: whitesmoke;
            position: absolute;
            right: 10px;
            top: 18px;
            color: black;
        }

        .content {
            text-align: center;
            /* background: rgba(255, 255, 255, 0.4); */
            background-color: whitesmoke;
            width: 100%;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: black;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            /*margin-bottom: 30px;*/
            margin-bottom: 0px;
            margin-top: 30px;
        }

        /* .ldBar.label-center>.ldBar-label {
            padding-top: 250px;
        } */
      
    </style>
</head>

<body class="bgImage">
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
            <a href="{{ url('/home') }}">Home</a>

            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="content">

            <div class="title m-b-md">

                <img src="{{ asset('img/luffy.svg') }}" class="ld ld-rubber" onclick="return LoadingLoadingLoading();" />AbingLeopold Practice
            </div>

            <center>
                    <div id="myItem1" class="ldBar label-center" data-type="fill" data-img="{{ asset('img/luffy3.svg') }}" data-img-size="200,200"></div>
            </center>
         
            <div class="links">
                {{-- <a href="https://laravel.com/docs">Docs</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a> --}}
            </div>
        </div>
    </div>

   
    <script type="text/javascript" src="{{ asset('js/loading-bar.js') }}"></script>




    <script>
        var interval;
        var bar1 = new ldBar("#myItem1");
        var num = 0;
        var time = 10;
        interval = setInterval(myTimer, time);
        function myTimer() {
            console.log(num);
            if (num >= 70) {
                num = num + 0.8;
            } else if (num >= 40) {
                num = num + 1;
            } else if (num < 40) {
                num = num + 0.05;
            } else if (num < 5) {
                num = num + 1;
            }
            bar1.set(num);

            if (num >= 110) {
                clearInterval(interval);
            }
        }
    </script>
</body>

</html>