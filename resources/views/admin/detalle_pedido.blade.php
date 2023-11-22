@extends('admin.dashboard')

@section('content')
<b-container style="min-width: 100%;" >
  <b-row align-h="center" >

      <b-col cols="12" lg="7" >
        <component-resumen  
        fecha="{{$detalle['fecha']}}"
        idventa="{{$detalle['id_venta']}}" 
        envio="{{$detalle['envio']}}" 
        propina="{{$detalle['propina']}}" 
        :items="{{$detalle['detalle']}}"
        >  
        </component-resumen>
        
        <component-direccion  :estatus="{{$detalle['status']}}" 
        idventa="{{$detalle['id_venta']}}"
        iduser="{{$detalle['id_usuario']}}" 
        :dom="{{$detalle['domicilio']}}">
        </component-direccion>

      </b-col>   
      <b-col cols="12" lg="" style="padding-top:3%;">  
        <component-detalle-producto :items="{{$detalle['detalle']}}"></component-detalle-producto>
      </b-col>
  </b-row>
</b-container>
@endsection
<script>

</script>
<style>
  body{
    background-color:#eee;
    cursor: auto !important;
  }
  .mb-10{
    margin-bottom: 15px;
  }
  .tl-end{
    text-align:end;
  }
  .mt-22{
  margin-top: 22px;
  }
  div.white {
    background: #FFF;
    background-color: rgb(255, 255, 255);
    border-radius: 0.8em;
    -moz-border-radius: 0.8em;
    -webkit-border-radius: 0.8em;
    height: 111%;
    padding: 10px;
    font-size: 33px;
    text-align: center;
  }


  .card-product:after {
    content: "";
    display: table;
    clear: both;
    visibility: hidden;
    margin-bottom: 10px; 
  }
  .card-product .img-wrap {
    border-radius: 3px 3px 0 0;
    overflow: hidden;
    position: relative;
    height: 100%;
    text-align: center; 
  }
    .card-product .img-wrap img {
      max-height: 100%;
      max-width: 100px;
      object-fit: cover;

  }

.card-item{
  margin-left: -37px;
  color: #898989;
  font-weight: 300;
  font-size: 14px;
}
.row{
 margin:0 !important;
}
</style>