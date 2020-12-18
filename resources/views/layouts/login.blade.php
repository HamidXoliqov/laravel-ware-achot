<?php
/**
 * Created by PhpStorm.
 * User: Xoliqov. A
 * Date: 26.02.2020
 * Time: 11:32
 */
//dd('keldi login')
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property=”og:image” content="http://okschain.info/{{asset('themes/frontend/img/favicon.png')}}" />
    <meta name="keywords" content="GM Uzbekistan">
    <meta name="description" content=" Okschain news">
    <meta name="Author" content="GM Uzbekistan">
    <title>@yield('title')</title>
    <link rel="icon" href="{{asset('themes/frontend/img/favicon.png')}}">
    <link rel="stylesheet" href="{{ asset('themes/backend/css/bootstrap4-toggle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/backend/login/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/backend/login/css/main.css') }}">
</head>
<body>
<style type="text/css">
    .txt2{
        text-decoration: none;
    }
    .erros-text
    {
        color: red;
        text-align: center;
        margin-bottom: 5px;
    }
</style>
    <div class="limiter">
        <div class="container-login100">
            @yield('content')
        </div>
    </div>
<script src="{{ asset('themes/backend/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('themes/backend/login/js/tilt.jquery.min.js') }}"></script>
<script type="text/javascript">
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>
</body>
</html>
