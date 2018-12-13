<!DOCTYPE html>
<html lang="en">
<head>
    @if(isset($setting) && !empty($setting->title))
        <title>
            {{$setting->title}} - Yönetim Paneli
        </title>
    @endif
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    @yield('css')
    <link rel="stylesheet" href="/admin/font-awesome/css/font-awesome.css"/>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
</head>
<body>
