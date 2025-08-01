@extends('layouts.app')

@section('content')
   @if ($response['productos'])   
                 <productocategoria 
                :productos="{{$response['productos']}}" 
                :categorias="{{$response['categorias']}}" 
                :nav="{{$response['nav']}}" 
                query="{{$response['query']}}"
                :logeado="{{(Auth::guest()== 1) ? 'false' : 'true'}}" 
                ></productocategoria>
        @else
         
          <div style="background: #ebebeb">
            <b-container style="height: 100%;display: flex;flex-direction: column;">
              <b-card no-body class="overflow-hidden" style="margin: 8%;" >
                <b-card-body style="padding:15px 0px 20px;">
                  <b-row align-h="center">
                    <b-col md="2" sm="1" class="search-button-message">
                      <i class="fa fa-search"></i>
                    </b-col>
                      <b-col md="10" sm="12"style="margin-top: 10px; padding-left: 75px">
                        <div class="title-error-message">
                          <span>No hay productos en esta categoria por ahora.</span>
                        </div>
                        <ul class="list-sugges">
                          <li class="item-list-sugges">Intenta con otra</li>
                          <li>Intenta escribir en el buscador</li>
                        </ul>
                      </b-col>
                    </b-row>
                 </b-card-body>
                </b-card>
              </b-container>
            </div>
        @endif  

@endsection
<style>
.search-button-message{
  margin-top: 35px;
  padding-left: 100px;
  font-size: 55px;
}
.title-error-message{
  margin: 18px 10px 10px 0;
  font-size: 21px;
  font-weight: bold;
}
.items-search:after{
  content: "-";
  padding: 0 8px;
}
  
.poner-borde{
  border-bottom: thin solid #eee;
  margin-bottom: 15px;
  padding-bottom: 10px;
}
.lista-breadcum{
    padding: 0 ;
margin-bottom: 10px;
  }
.items-categoria{
  list-style: none;
margin: 0 0 6px;

/*
font-size: 14px;
font-weight: 300;
color: #999;
*/
font-weight: 400;
font-size: 14px;
/*margin-left: 0;*/
white-space: nowrap;
}

.items-categoria a{
  color: #666 !important;
  text-decoration: none !important;
}


  .titulo-breadcrumb{
    color: #333;
    display: block;
    font-size: 26px;
    font-weight: 600;
    line-height: 30px;
    padding-right: 16px;
    position: relative;
    word-wrap: break-word;
    z-index: 1;
  }



 .img-wrap {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    position: relative;
    height: 160px;
    text-align: center; 
    margin-top: 15px;
    left: 25;
  }
  
  .img-wrap img {
      max-height: 100%;
      max-width: 100%;
      object-fit: cover; }
      

/*producto solo*/
.thumb-wrapper {
  padding: 25px 15px;
  background: #fff;
  border-radius: 6px;
  text-align: center;
  position: relative;
  box-shadow: 0 2px 3px rgba(0,0,0,0.2);
} 
</style>