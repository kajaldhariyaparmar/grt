<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">


        <!-- Begin CSS -->
        <script src="https://kit.fontawesome.com/609d6d90d8.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/bootstrap-grid.min.css')}}">
        <link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/flexslider.css')}}">
        <link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/fonts.css')}}">
        <link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/style.css')}}">
        <link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/responsive.css')}}">
        <link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/loading.css')}}">
        <link rel="stylesheet" type="text/css" media="all" href="{{ asset('css/custom.css')}}">
        <!--// End CSS -->

        <!-- Begin Crowdfunding css -->
        <link rel="stylesheet" type="text/css" href="https://theplayculture.com/grt/css/cf-style.css">
        <link rel="stylesheet" type="text/css" href="https://theplayculture.com/grt/css/cf-custom.css">
        <link rel="stylesheet" type="text/css" href="https://theplayculture.com/grt/css/cf-responsive.css">
        <!--// End CSS -->



        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
