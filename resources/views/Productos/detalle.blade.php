@extends('layouts.app')

@section('content')
<div>
   <producto-detalle  
   :producto="{{$data['producto']}}"  
   :extras="{{$data['extra']}}"  
   :nav="{{$data['nav']}}"
   :características="{{$data['caracteristicas']}}"
   :logeado="{{(Auth::guest()== 1) ? 'false' : 'true'}}" >
    </producto-detalle>
</div>
@endsection
<style>
  

  /*.envio-p{
    font-size: 20px;
    text-align: justify;
    padding-bottom: 15px;
  }
  .vendido-por-p{
    padding-bottom: 20px;
    font-size: 18px;
    text-align: justify;
  }
  .btn-carrito-p{
    text-align: center;
  }*/
  #autocomplete-result-list-1{
    z-index: 1024 !important;
  }
  .target-p{
    color: #a9a4a4;
    font-weight: lighter;
  }

  @media only screen and (max-width: 1264px) {

   #content-p{
    padding: 0;
    padding-right:25px; 
    padding-left:25px;
   } 

  }
#content-p{    
  padding-right:60px; 
  padding-left:60px;
  padding-top: 20px;
  padding-bottom: 20px;
  display: flex;
  flex-direction: column;
   }
    .andes-breadcrumb {
    margin: 0 0 6px;
    font-family: Proxima Nova,-apple-system,Helvetica Neue,Helvetica,Roboto,Arial,sans-serif;
    font-size: 14px;
    padding: 0;
    display: -webkit-inline-box;
    position: sticky;
    z-index: 999;

}

.icon-category{
  font-size: 15px;
font-weight: bold;
margin-left: 5px;
margin-right: 1px;
}
.link-category{
  color: #212529;
  text-decoration: none;
}

.li-sin-decoracion{
  list-style: none;
}


.text-category{
  text-transform: capitalize;


}
.breadcrumb__link {
    color: #3483fa;
    text-decoration: none;
    cursor: pointer;
}
.separador{
      color: #afafaf;
    font-size: 14px;
    margin-right: 3px;
}

</style>
 <!--  <b-row align-h="center" style="padding: 10px;">
      <b-col cols="12" style="font-size: 25px; padding: 10px;">
        <span>  Preguntas y respuestas</span>
    </b-col>
    <b-col cols="12" style="margin-top: 20px;">
      <b-col>
          <label for="textarea-small">¡Escribe Una Pregunta!</label>
      </b-col>
      <b-col >
        <b-form-textarea
        id="textarea-small"
        size="sm"
        placeholder="¡Escribe Una Pregunta!"
          ></b-form-textarea>
      </b-col>
    </b-col>
  </b-row> -->