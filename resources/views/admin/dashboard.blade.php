<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
      <meta name="base_url" content="{{ url('/') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
   <div id="app">
      <b-navbar toggleable="lg" type="dark" variant="dark">>
    <b-navbar-brand  href="{{ url('/') }}">
    {{ config('app.name', 'Laravel') }} Admin</b-navbar-brand>
    
    <b-navbar-toggle target="nav-collapse" small style="background: aliceblue;" onclick="myFunction(this)">
      <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
    </b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav type="dark">
      <b-navbar-nav >
      </b-navbar-nav>
        <b-navbar-nav class="ml-auto">  
            <b-nav-item href="{{ route('login') }}" >Iniciar sesion</b-nav-item>
            <b-nav-item href="{{ route('register') }}">Crea tu cuenta</b-nav-item>
        </b-navbar-nav>
    </b-collapse>
  </b-navbar>  
    <div id="wrapper">
      <nav class="navbar-expand-lg  navbar-dark bg-dark">
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav side-nav text-white">
            <li >
              <small class="nav-link">Apps</small>
            </li>
            <li class="nav-item navitem">
              <a class="nav-link" href="">
                <i class="fa fa-book"></i> Categorias
              </a>
            </li>
            <li class="nav-item navitem">

              <a class="nav-link" href="{{ route('ventas') }}"><i class="fa fa-shopping-cart"></i> Ventas</a>
            </li>
            <li class="nav-item navitem">
              <a class="nav-link" href="">
              <i class="fa fa-user "></i> Usuarios</a>
            </li>
              <li class="nav-item navitem">
              <a class="nav-link" href="{{ route('productos') }}">
              <i class="fa fa-user "></i>Productos</a>
            </li>
          </ul>
        </div>
      </nav>
    <div class="container-fluid" style="margin-top: 30px;">
      @yield('content')
    </div>
  </div>       
</div>
<script type="text/javascript">
function myFunction(x) {
  x.classList.toggle("change");
}
</script>
<style>
 .navitem{
   padding-left: 10px;
 }
 .navitem:hover{
  background-color: #3b3a3a;  
 }

@media(min-width:992px) {
#wrapper{
  margin-left: 200px;
  padding: 25px 15px 15px;}
.navbar-nav.side-nav{
  background: #0f1a26;
  box-shadow: 2px 1px 2px rgb(72, 13, 13);
  position:absolute;
  top:56px;
  flex-direction: column!important;
  left:0;
  width:200px;
  overflow-y:auto;
  bottom:0;
  overflow-x:hidden;
  padding-bottom:40px;
  height: 100%;
  position: fixed;
}
}


.bar1, .bar2, .bar3 {
  width: 35px;
  height: 5px;
  background-color: #333;
  margin: 6px 0;
  transition: 0.4s;
}

.change .bar1 {
  -webkit-transform: rotate(-45deg) translate(-9px, 6px);
  transform: rotate(-45deg) translate(-9px, 6px);
}

.change .bar2 {opacity: 0;}

.change .bar3 {
  -webkit-transform: rotate(45deg) translate(-8px, -8px);
  transform: rotate(45deg) translate(-8px, -8px);
}

.actual{
background-color: #3b3a3a;  
}

.navbar {
    position: fixed;
    width: 100%;
    z-index: 9;
    padding-bottom: 10px;
}
</style>
<script>
    var url= document.head.querySelector('meta[name="base_url"]').content+'/';
</script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>