<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if(isset($setting) && !empty($setting->title))
        <title>
            {{$setting->title}}
        </title>
    @endif

    @if(isset($setting) && !empty($setting->description))
        <meta name="description" content="{{$setting->description}}">
    @endif

    @if(isset($setting) && !empty($setting->keywords))
        <meta name="keywords" content="{{$setting->keywords}}">
    @endif

    <link href="/site/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="/site/assets/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="/site/assets/css/iconmoon.css" rel="stylesheet">
    <link href="/site/style.css" rel="stylesheet">
    <link href="/site/assets/css/menu.css" rel="stylesheet">
    <link href="/site/assets/css/color.css" rel="stylesheet">
    <link href="/site/assets/css/widget.css" rel="stylesheet">
    <link href="/site/assets/css/browser-detect.css" rel="stylesheet">
    <link href="/site/assets/css/responsive.css" rel="stylesheet">
    <!-- <link href="/site/assets/css/rtl.css" rel="stylesheet"> Uncomment it if needed! -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">

    @yield('css')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="wrapper">
