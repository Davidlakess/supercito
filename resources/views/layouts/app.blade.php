
<html >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base_url" content="{{ url('/') }}">
    <link rel="shortcut icon" href="/my.ico" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css">
     <link href='https://fonts.googleapis.com/css?family=Roboto:400,700|Material+Icons' rel="stylesheet" type="text/css">
    <!-- Styles --> 
  
    <style>
/*////////////////TOP NAV BAR////////////////*/
  /*@import url("https://fonts.googleapis.com/css?family=Amiri:300,400");*/

  /*@import url("../../sass/Amiri");*/

body{
  background: rgb(235, 235, 235) none repeat scroll 0% 0% !important;
  overflow-x: hidden;
}
.ancho-ideal{
  margin-right: 70px !important;
  margin-left: 60px !important;
  margin-top: 10px !important;
}
/*carousel*/
.carousel .carouse-indicators {
    position: inherit;
  z-index: 15;
  display: flex;
  justify-content: end;
  list-style: none;
  width: 100%;
  padding: 0;
  margin-bottom: 5px;
}
.carouse-indicators li.active {
  border-radius: 50%;
  width: 10px !important;
  height: 10px !important;
  margin: 4px;
  border-radius: 50%;
  border-color: transparent;
  background-color: #3483fa !important;
}
.carouse-indicators li{
  background-color: #bababa;
  border-radius: 50%;
  display: inline;
  height: 6px;
  padding: 1px;
  width: 6px;
  margin-top: 6px;
  cursor: pointer;
  margin-right: 4px;
}

.confirm_correo{
margin-left: 30px !important;
border: 3px solid rgb(255, 255, 255) !important;
border-radius: 10px !important;
padding: 10px !important;
font-weight: bold !important;
color: #fff !important;
}

.confirm_correo:hover{
  color:white;
}
.mc-content{
  padding: 30px 60px 30px 60px;
  height: 100%;
}   

.super-titulo{
 /* margin: 20px 0 4px;
padding: 0;
text-align: justify;
font-size: 19px;
font-weight: 300;
display: block;*/

/*text-transform: uppercase;*/
text-align: justify;
font-size: 22px;
font-weight: 600;
margin-bottom: 20px;

}
.super-titulo-m{
margin: 20px 0 4px;
/*padding: 0;*/
text-align: justify;
font-size: 17px;
font-weight: 600;
display: block;
/*text-transform: uppercase;*/
/*margin-bottom: 20px;*/

}

header {
  padding: 50px 0;
}
header h1 {
  color: #020202;
  /*text-shadow: 1px 3px 4px rgba(0, 0, 0, 0.4);*/
  text-align: center;
  font-size: 50px;
  letter-spacing: 0.4px;
  /*font-family: "Raleway", sans-serif;*/
}
.title-section{
  padding: 25px 54px;
}
.title-raleway{
  margin-bottom: 24px;
}
.title-raleway span{
  font-size: 24px;
  font-weight: 400;
  margin: 24px auto;
  padding: 0;
  color: #4a4a4a;
}

#nav1.top-bar{background-color:black;min-height:40px;padding-top:5px;padding-bottom: 0px;}
.top-bar .nav-text {
    color: #00BCD4;
    display: block;
    margin-top: 5px;
}
.navbar-light .navbar-nav .nav-link {
    color: #fff !important;
}

.navbar-light .navbar-nav .nav-link:hover, .navbar-light .navbar-nav .nav-link:focus {
     
     color: #ffc3c3 !important;
}

.dropdown-toggle:hover,.dropdown-toggle:focus {

    color: #ffc3c3 !important;
}
.container {
  display: inline-block;
  cursor: pointer;

}

/*.bar1, .bar2, .bar3 {
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
*/
 .dropdown-menu.notify-drop {
  min-width: 330px;
  background-color: #fff;
  min-height: 360px;
  max-height: 360px;
}
 .dropdown-menu.notify-drop .notify-drop-title {
  border-bottom: 1px solid #e2e2e2;
  padding: 5px 15px 10px 15px;
}
 .dropdown-menu.notify-drop .drop-content {
  min-height: 280px;
  max-height: 280px;
  overflow-y: scroll;
}
 .dropdown-menu.notify-drop .drop-content::-webkit-scrollbar-track
{
  background-color: #F5F5F5;
}

 .dropdown-menu.notify-drop .drop-content::-webkit-scrollbar
{
  width: 8px;
  background-color: #F5F5F5;
}

 .dropdown-menu.notify-drop .drop-content::-webkit-scrollbar-thumb
{
  background-color: #ccc;
}
 .dropdown-menu.notify-drop .drop-content > li {
  border-bottom: 1px solid #e2e2e2;
  padding: 10px 0px 5px 0px;
}
 .dropdown-menu.notify-drop .drop-content > li:nth-child(2n+0) {
  background-color: #fafafa;
}
 .dropdown-menu.notify-drop .drop-content > li:after {
  content: "";
  clear: both;
  display: block;
}
 .dropdown-menu.notify-drop .drop-content > li:hover {
  background-color: #fcfcfc;
}
 .dropdown-menu.notify-drop .drop-content > li:last-child {
  border-bottom: none;
}
 .dropdown-menu.notify-drop .drop-content > li .notify-img {
  float: left;
  display: inline-block;
  width: 45px;
  height: 45px;
  margin: 0px 0px 8px 0px;
}
 .dropdown-menu.notify-drop .allRead {
  margin-right: 7px;
}
 .dropdown-menu.notify-drop .rIcon {
  float: right;
  color: #999;
}
 .dropdown-menu.notify-drop .rIcon:hover {
  color: #333;
}
 .dropdown-menu.notify-drop .drop-content > li a {
  font-size: 12px;
  font-weight: normal;
}
 .dropdown-menu.notify-drop .drop-content > li {
  font-weight: bold;
  font-size: 11px;
}
 .dropdown-menu.notify-drop .drop-content > li hr {
  margin: 5px 0;
  width: 70%;
  border-color: #e2e2e2;
}
 .dropdown-menu.notify-drop .drop-content .pd-l0 {
  padding-left: 0;
}
 .dropdown-menu.notify-drop .drop-content > li p {
  font-size: 11px;
  color: #666;
  font-weight: normal;
  margin: 3px 0;
}

.dropdown-menu.notify-drop .drop-content > li p.time {
  font-size: 10px;
  font-weight: 600;
  top: -6px;
  margin: 8px 0px 0px 0px;
  padding: 0px 3px;
  border: 1px solid #e2e2e2;
  position: relative;
  background-image: linear-gradient(#fff,#f2f2f2);
  display: inline-block;
  border-radius: 2px;
  color: #B97745;
}

.dropdown-menu.notify-drop .drop-content > li p.time:hover {
  background-image: linear-gradient(#fff,#fff);
}

.dropdown-menu.notify-drop .notify-drop-footer {
  border-top: 1px solid #e2e2e2;
  bottom: 0;
  position: relative;
  padding: 8px 15px;
}

.dropdown-menu.notify-drop .notify-drop-footer a {
  color: #777;
  text-decoration: none;
}

.dropdown-menu.notify-drop .notify-drop-footer a:hover {
  color: #333;
}

.dropdown-menu{
  z-index: 9999 !important;
}

</style>
</head>
<body id="bd">
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
  </form>

  <div id="app">
  <template v-if="isMobil()">  
    <div>
      
      
            <!-- tiendas="route('tiendas')" -->
           @if (Auth::guest())
                   <navbar-mobil
           rutalogin="{{ route('login') }}"
           rutaregistrar="{{ route('register') }}"
           misproductos="{{route('misproductos')}}"
            perfil="{{ route('perfil') }}"
            miscompras="{{ route('miscompras') }}"
            carrito="{{route('middlecarrito')}}"
            :logeado="false"
             name="'-'"
          ></navbar-mobil>
          @else
          <!-- tiendas=" route('tiendas')" -->
          <navbar-mobil
          rutalogin="{{ route('login') }}"
          rutaregistrar="{{ route('register') }}"
          misproductos="{{route('misproductos')}}"
          perfil="{{ route('perfil') }}"
          miscompras="{{ route('miscompras') }}"
          carrito="{{route('middlecarrito')}}"
          name="{{auth()->user()->name}}"
          :logeado="true"
          ></navbar-mobil>
          @endif  

    </div>
  </template>
  <template v-else> 
  <b-navbar toggleable="lg"  class="menu" id="menu" style="background-color: rgb(236, 2, 2);">
    <b-navbar-brand style="margin-left: 25px;color: #fff;" href="{{ url('/') }}">
      <!-- <img alt="" style="width: 50px;" src="/my.png"> -->
    <!-- {{ config('app.name', 'Laravel') }} -->
      <logo-app></logo-app>
    </b-navbar-brand>
    <b-navbar-toggle target="nav-collapse" onclick="myFunction(this)">
      <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
    </b-navbar-toggle>
    <b-collapse id="nav-collapse" is-nav type="dark">
      <b-navbar-nav  style="display: contents;">
          <!-- <li class="nav-item" style="cursor: pointer;" id="btn-departamentos">
            <span>Categorias</span>
             <i class="fa fa-caret-down"></i> -->
           <select-categoria ></select-categoria>
          <!-- </li>       -->
          <!-- <b-nav-item href="route('middlevender')">Vender</b-nav-item>    -->
          <!-- <b-nav-item style="margin-left: 10px;" href=" route('supermercado')">SuperMercado</b-nav-item>    -->
        </b-navbar-nav>
          <div style="width: 34%;margin-left: 20px;"> 

            <!-- <input-search></input-search> -->
          </div>        
          @if (Auth::guest())
          <b-navbar-nav class="ml-auto">
            <b-nav-item href="{{ route('login') }}" >Iniciar sesion</b-nav-item>
            <b-nav-item href="{{ route('register') }}">Crea tu cuenta</b-nav-item>
          @else

              @if (auth()->user()->email_confirm==0)  
                <verificar-email></verificar-email>
              @endif   
              <b-navbar-nav class="ml-auto">
            <notifications></notifications>
            <div style="display: flex;">
            <i class="fa fa-user-circle" style="margin-top: 12px; color:#fff;"></i>
            <b-nav-item-dropdown style="font-weight: bold; "  text="Mi Perfil"  right>
            
              <b-dropdown-item style="background-color:gainsboro; z-index: 9999 !important;">
                <i class="fa fa-user-circle"></i> {{auth()->user()->name}}</b-dropdown-item>
                <!-- <b-dropdown-item href="{{ route('misproductos') }}" >Mi Productos</b-dropdown-item> -->
                <b-dropdown-item href="{{ route('perfil') }}" >Mis Datos</b-dropdown-item>
                <b-dropdown-item href="{{ route('favoritos') }}" >Mis Favoritos</b-dropdown-item>
                <b-dropdown-item @click="logout()" >Salir</b-dropdown-item>
            </b-nav-item-dropdown>

            <b-nav-item href="{{ route('miscompras') }}">Mis Compras</b-nav-item>
            </div>
          @endif      
          <!-- <b-nav-item href="route('tiendas')">Tiendas</b-nav-item> -->
          <b-nav-item href="{{route('middlecarrito')}}" class="d-lg-block" style="display: none;"> 
            <!-- <b-button  style=""> -->
            <!-- <button type="button" class="btn btn-primary"> -->
                <!-- <i class="fa fa-shopping-cart" aria-hidden="true" style="font-size:20px;"></i> -->
                <!-- <span class="badge bg-secondary">9</span> -->
            <!-- </b-button> -->
            <img src="{{ url('/shopi.png')}}" style="height: 34px;width: 54px;" title="ver el Carrito de Compras" width="29">

            </b-nav-item>

          <b-nav-item href="{{route('middlecarrito')}}" class="d-lg-none">
              Mi Carrito 
            <i class="fa fa-shopping-cart" aria-hidden="true" style="font-size:17px;"></i>
          </b-nav-item>
        </b-navbar-nav>
    </b-collapse>
  </b-navbar>           
   </template>
    @yield('content')
   

  </div>
  @extends('layouts.footer')
    <!-- Scripts -->

<script type="text/javascript">
 var url= document.head.querySelector('meta[name="base_url"]').content+'/';

 // var url="http://192.168.1.72:8080/"; 
 
function myFunction(x) {
  x.classList.toggle("change");
}

function isMobil() {
          if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
             return true
           } else {
             return false
           }
      }
</script>
     <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
