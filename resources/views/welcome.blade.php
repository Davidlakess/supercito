@extends('layouts.app')

@section('content')
<div style="background: #ebebeb">
           <welcome 
            :categorias="{{$data['categorias']}}"
            :productos="{{$data['productos']}}" 
            :pronuevos="{{$data['pronuevos']}}" 
            :collection="{{(isset($data['collection'])) ? $data['collection'] : []}}" 
            :historial="{{$data['historial']}}"  
            :logeado="{{(Auth::guest()== 1) ? 'false' : 'true'}}" 
           ></welcome>
</div>
@endsection
<style>
.foot-main {
    display: -webkit-flex;
    display: flex;
    -webkit-flex-direction: column;
    flex-direction: column;
    -webkit-justify-content: center;
    justify-content: center;
    padding-left: 25px;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    margin: -1px 0 0;
    height: 99px;
    width: 383px;
    border-top: 0;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    box-shadow: none;
}
.main-item-label {
    color: #4b4b4b;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 4px;
    text-transform: uppercase;
}

.main-item-title {
    font-size: 25px;
    font-weight: 700;
    text-transform: uppercase;
    color: #4b4b4b;
    white-space: nowrap;
    overflow: hidden;
}

html {
  font-size: 14.5px;
}

body {
  font-family: "Open Sans", sans-serif;
  line-height: 1.45em;
  background-color: #f0f0f0;
  color: #404646;
}

* {
  box-sizing: border-box;
}

.main-container {
  margin: 1.6rem 0.8rem;
}

.grid-container {
  margin: auto;
  display: grid;
  grid-gap: 1.1312rem;
  grid-template-columns: repeat(auto-fit, 12.8rem);
  grid-auto-rows: 12.8rem;
  grid-auto-flow: dense;
  -webkit-box-pack: center;
          justify-content: center;
}

.card {
  grid-row: auto / span 1;
  grid-column: auto / span 1;
  background-color: white;
  box-shadow: 1px 3px 3px rgba(0, 10, 20, 0.06);
}
.card h1,
.card h2,
.card h3,
.card h4,
.card p {
  margin-top: 0;
  font-weight: normal;
}
.card__image {
  height: 100%;
  max-height: 100%;
  width: 100%;
  display: -webkit-box;
  display: flex;
}
.card__image img {
  height: 100%;
  min-height: 100%;
  max-height: 100%;
  width: 100%;
  -o-object-fit: cover;
     object-fit: cover;
}
.card__side-by-side {
  height: 100%;
  width: 100%;
  display: -webkit-box;
  display: flex;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
          flex-flow: row nowrap;
}
.card__side-by-side--m {
  height: 100%;
  width: 100%;
  display: -webkit-box;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
          flex-flow: column nowrap;
}
.card__side-by-side--m img {
  min-height: auto;
}
.card__content {
  padding: 1.6rem;
}
.card__button {
  margin: 1.6rem 0;
  text-align: center;
  padding: 0.8rem 1.6rem;
  background: none;
  border: 0.5px solid #777;
  border-radius: 2px;
}
.card__button:hover {
  border-color: #d099a0;
}
.card--featured {
  grid-row: auto / span 3;
  grid-column: auto / span 2;
}
.card--2x {
  grid-row: auto / span 2;
  grid-column: auto / span 2;
}
.card--vertical {
  grid-row: auto / span 2;
}
.card--horizontal {
  grid-column: auto / span 2;
}
.card--frameless {
  background-color: transparent;
  box-shadow: none;
}

#content-p{
  padding-right:60px; 
  padding-left:60px;
  padding-top: 20px;
}
</style>
