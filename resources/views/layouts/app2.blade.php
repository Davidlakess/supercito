<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="base_url" content="{{ url('/') }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
      <b-navbar style="padding-bottom: 0;padding-top: 0;" toggleable="lg"  class="menu" id="menu">
    <b-navbar-brand href="{{ url('/') }}">
      <logo-app></logo-app>
    </b-navbar-brand>
</b-navbar>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
     @extends('layouts.footer')
    <script type="text/javascript">
        var url= document.head.querySelector('meta[name="base_url"]').content+'/';
    </script>
</body>
</html>
