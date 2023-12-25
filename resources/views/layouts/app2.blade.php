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
    <link rel="shortcut icon" href="{{ url('/my.ico') }}" />
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/vuetify@1.x/dist/vuetify.min.css" rel="stylesheet">
    <!-- Styles -->
    <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <v-app id="app">
      <b-navbar style="padding-bottom: 0;padding-top: 0;" toggleable="lg"  class="menu" id="menu">
    <b-navbar-brand href="{{ url('/') }}">
      <logo-app></logo-app>
    </b-navbar-brand>
</b-navbar>
        <div id="page-container">
          <div id="content-wrap">
          @yield('content')
          </div>
        <s-footer></s-footer>
        </div>
    </v-app>
    <script type="text/javascript">
        var url= document.head.querySelector('meta[name="base_url"]').content+'/';
    </script>
    <style type="text/css">
        body{
            background-color: #ebebeb;
        }
@media (max-width: 768px) {
    #page-container {
        min-height: 100% !important;
    }
    #content-wrap {
        padding-bottom: 4.5rem !important;    /* Footer height */
    }
    #ancho-contacto{
        padding: 0 !important;
    }
    .page-title {
    font-size: 33px;
    color: #404262;
    font-weight: bold;
  }
  .subtitle-contacto{
    display: grid;
    text-align: center;
    line-height: 1.98;
    font-size: 13px;
    margin: 4%;
  }
}
#ancho-contacto{
    padding: 4% 15% 10% 15%;
}

#page-container {
  position: relative;
  min-height: 100vh;
}

#content-wrap {
  padding-bottom: 2.5rem;    /* Footer height */
}

#footer {
/*  position: absolute;*/
  bottom: 0;
  width: 100%;
  height: 2.5rem;            /* Footer height */
}
    </style>
</body>
</html>
