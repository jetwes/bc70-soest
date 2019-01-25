<!doctype html>
<html lang="zxx">

<head>

    <!-- meta tags -->
    @section('meta-tags')
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    @show
    @section('title')
        <title>{{ config('app.name') }}</title>
    @show
    @section('css')
        <!-- CSS -->
        <link rel="stylesheet" href="{{ url('css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ url('css/fontawesome-all.css') }}">
        <link rel="stylesheet" href="{{ url('css/slick-slider.css') }}">
        <link rel="stylesheet" href="{{ url('css/fancybox.css') }}">
        <link rel="stylesheet" href="{{ url('css/smartmenus.css') }}">
        <link rel="stylesheet" href="{{ url('css/style.css') }}">
        <link rel="stylesheet" href="{{ url('css/color.css') }}">
        <link rel="stylesheet" href="{{ url('css/responsive.css') }}">
    @show

</head>

<body class="@yield('body_class')">
<div class="ritekhed-wrapper">

    <!-- Header -->
    @include('layouts.header')

    <!-- Content -->
    @yield('content')

    <!-- Footer -->
    @include('layouts.footer')
</div>

@section('js')
    <!-- jQuery -->
    <script src="{{ url('script/jquery.js') }}"></script>
    <script src="{{ url('script/popper.min.js') }}"></script>
    <script src="{{ url('script/bootstrap.min.js') }}"></script>
    <script src="{{ url('script/smartmenus.min.js') }}"></script>
    <script>
        // Responsive Main Menu Function
        jQuery('#main-menu').smartmenus({
            subMenusSubOffsetX: 1,
            subMenusSubOffsetY: -10
        });

        // Menu Link Function
        jQuery( ".ritekhed-menu-link" ).on("click", function() {
            jQuery( "#main-nav" ).slideToggle( "slow", function() {
            });
        });
    </script>
@show
</body>

</html>