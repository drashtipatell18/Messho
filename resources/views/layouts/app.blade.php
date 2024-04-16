<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        @import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700);
        @import url(https://fonts.googleapis.com/css?family=Arimo:300,400,400italic,700,700italic);

        /=====================================Basic CSS====================================/ * {
            margin: 0px;
            padding: 0px;
            list-style: none;
        }

        body {
            font-family: "Open Sans";
            overflow-x: hidden !important;
        }

        html,
        body {
            overflow: hidden;
        }


        img {
            max-width: 100%;
        }

        a {
            text-decoration: none;
            outline: none;
            color: #444;
        }

        a:hover {
            color: #444;
        }

        ul {
            margin-bottom: 0;
            padding-left: 0;
        }

        ol,
        ul {
            margin: 0px;
            padding: 0px;
        }

        a:hover,
        a:focus,
        input,
        textarea {
            text-decoration: none;
            outline: none;
        }

        .form-02-main {
            background-image: url('/assets/images/bg-01.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            position: relative;
            z-index: 2;
            overflow: hidden;
            height: 100vh;
        }

        ._lk_de {

            background-repeat: no-repeat;
            background-size: cover;
            padding: 40px 0px;
            position: relative;

        }

        .form-03-main {
            width: 500px;
            display: block;
            margin: 20px auto;
            padding: 25px 50px 25px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 6px;
            z-index: 9;
        }

        .logo {
            display: block;
            margin: 20px auto;
            width: 100px;
            height: 100px;
        }

        .form-group {
            padding: 20px 0px;
            display: inline-block;
            width: 100%;
            position: relative;
        }

        .form-group p {
            margin: 0px;
        }

        .form-control {
            min-height: 45px;
            -webkit-box-shadow: none;
            box-shadow: none;
            padding: 10px 15px;
            border-radius: 20px;
            border: 1px solid#8d4be1;
        }

        .checkbox {
            display: flex;
            justify-content: space-around;
        }

        ._btn_04 {
            display: inline-block;
            width: 100%;
            padding: 12px 0px;
            background: #8d4be1;
            border-radius: 20px;
            text-align: center;
            font-size: 16px;
            color: #fff;
        }

        .rolebtn {
            display: inline-block;
            width: 100%;
            padding: 12px 0px;
            border-radius: 20px;
            text-align: center;
            font-size: 16px;
            color: #fff;
        }

        ._btn_04 a {
            font-size: 15px;
            color: #fff;
        }

        .nm_lk {
            text-align: center;
        }



        @media screen and (max-width: 600px) {
            .form-03-main {
                width: 100%;
            }
        }

        .py-4 {
            padding-top: 0rem !important;
            padding-bottom: 0rem !important;
        }

        @media (max-width: 768px) {
            .form-02-main {
                height: auto;
                padding: 20px;
            }

            .container,
            .row,
            .col-md-12 {
                padding: 0;
                margin: 0;
                width: 100%;
            }

            .form-03-main {
                margin: 0 auto;
                width: 90%;
            }

            .form-control {
                font-size: 16px;
            }

            .button {
                width: 100%;

                padding: 10px 20px;
         
            }
        }

        @media (max-width: 600px) {
            .form-03-main {
                width: 100%;

            }
        }
    </style>
</head>

<body>

    <main class="py-4">
        @yield('content')
    </main>

</body>

</html>
