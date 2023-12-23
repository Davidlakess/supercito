@extends('layouts.app')

@section('content')


 <perfil :user="{{$perfil}}" ></perfil>


@endsection
<style>
body {




height: 100vh;
}

.super-title{
  text-align: center;
font-size: 24;
margin-bottom: 10px;
font-weight: 600;
}

.title-head{
    text-align: justify;
    font-weight: 600;
    font-size: 17px;
    margin-bottom: 0px;
    margin-top: 15px;

}

.subtitle-head{

  margin-bottom: 20px;
  text-align: justify;
  font-weight: 1;  

}

.input-group>.custom-select:not(:last-child),
.input-group>.form-control:not(:last-child) {
    border-top-right-radius: 0px;
    border-bottom-right-radius: 0px;
}


.service-form-group {
    position: relative;
}

.form-icon {
    position: absolute;
    right: 14px;
    bottom: 15px;
    font-size: 13px;
}
.btns {
font-family: 'Barlow Semi Condensed', sans-serif;
font-size: 14px;
text-transform: uppercase;
font-weight: 700;
padding: 3px 25px;
letter-spacing: 0px;
border-radius: 0px;
line-height: 2;
-webkit-transition: all 0.3s;
-moz-transition: all 0.3s;
transition: all 0.3s;
word-wrap: break-word;
white-space: normal !important;
}


.btns-default {
    background-color: #ce0058;
    color: #fff;
    border: 2px solid #ce0058;
}

.btns-default:hover {
    background-color: transparent;
    color: #ce0058;
    border: 2px solid #ce0058;
}

.btns-default.focus,
.btns-default:focus {
    background-color: transparent;
    color: #ce0058;
    border: 2px solid #ce0058;
    box-shadow: 0 0 0 0.2rem rgb(206, 0, 88);
}


.card-login {
  padding: 18px;
  max-width: 39.5rem;
  margin-bottom: 15px;
}

.card-header {
    color: #fff;
    /*background: #ff0000;*/
    font-family: sans-serif;
    font-size: 20px;
    font-weight: 600 !important;
    margin-top: 10px;
    border-bottom: 0;
}

@media only screen and (max-width: 1264px) {

   #content-p{
    display: inline-block !important ;
    padding: 0;
    padding-right:17px; 
    padding-left:17px;
   } 

}


.container {
    cursor:auto !important;
}
</style>