<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <base href="/"/>
    <title>@yield('title', 'Artemblog')</title>
    <link rel="stylesheet" href="libs/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="libs/owlcarousel2/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="libs/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="libs/fancybox/dist/jquery.fancybox.min.css">
    <link rel="stylesheet" href="sprites/sprite.css">
    <link rel="stylesheet" href="css/main.css">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @endif
</head>

<body>
@include('includes.header')
@yield('content')
@include('includes.footer')
</body>
</html>
