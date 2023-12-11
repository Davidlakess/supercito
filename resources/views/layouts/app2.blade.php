<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="base_url" content="{{ url('/') }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/vuetify@1.x/dist/vuetify.min.css" rel="stylesheet">
    <!-- Styles -->
    <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body id="body2">
    <v-app id="app">
      <b-navbar style="padding-bottom: 0;padding-top: 0;" toggleable="lg"  class="menu" id="menu">
    <b-navbar-brand href="{{ url('/') }}">
      <logo-app></logo-app>
    </b-navbar-brand>
</b-navbar>
        <main >
            @yield('content')
        </main>
    </v-app>
     @extends('layouts.footer')
    <script type="text/javascript">
        var url= document.head.querySelector('meta[name="base_url"]').content+'/';
    </script>
    <style type="text/css">
        body{
            background-color: #ebebeb;
        }
   
    </style>
</body>
</html>
